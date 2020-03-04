<?php

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;

// Return if PMS is not active
if( ! defined( 'PMS_VERSION' ) ) return;

Class PMS_Admin_Group_Memberships {

	public function __construct(){

		// Figure out how to add the Group subscription type to the Subscription Plans interface
		add_action( 'admin_init',                                 array( $this, 'hook_subscription_plan_type_change' ) );

		// Add the admin field to specify the available seats
		add_action( 'pms_view_meta_box_subscription_details_top', array( $this, 'add_subscription_plan_seats_field' ) );

		// Save the extra fields from the Subscription Plan Details meta-box on post save
		add_action( 'pms_save_meta_box_pms-subscription',         array( $this, 'save_subscription_plan_settings_fields' ) );

		// Allow admins to define new subscription plan tiers
		add_filter( 'pms_action_add_new_subscription_plan',       array( $this, 'members_list_allow_add_new_action' ) );

		// Display custom 'group' column in the Members List
		add_filter( 'pms_members_list_table_columns',             array( $this, 'members_list_add_group_column' ) );

		// Populate the group column
		add_filter( 'pms_members_list_table_entry_data',          array( $this, 'members_list_add_group_column_data' ), 20, 2 );

		// Add Filter by Group select
		add_action( 'pms_members_list_extra_table_nav',           array( $this, 'members_list_add_group_filter' ) );

		// Filter Members by Group
		add_filter( 'pms_get_members',                            array( $this, 'members_list_filter_members_by_group' ) );

		// Remove Views count when filtering by Groups
		add_filter( 'pms_members_list_table_get_views', 		  array( $this, 'members_list_remove_views' ) );

		// Add `Edit Owner` custom row action
		add_filter( 'pms_members_list_username_actions',          array( $this, 'members_list_add_edit_owner_action' ), 20, 2 );

		// Filter page output to add the Group Details and Edit Page
		add_filter( 'pms_submenu_page_members_output',            array( $this, 'members_list_output' ) );

		// Edit Group Details
		add_action( 'wp_ajax_pms_edit_group_details', 			  array( $this, 'members_list_edit_group_details' ) );

		// Remove Members functionality
		add_action( 'admin_init',                                 array( $this, 'members_list_remove_members' ) );
	}

	public function hook_subscription_plan_type_change(){
	    /**
	     * If the Fixed Period Membership add-on is active, hook into its subscription types, else add our own Select field
	     */
	    if( function_exists( 'pms_msfp_add_subscription_plan_settings_fields' ) )
	    	add_filter( 'pms_subscription_plan_types', array( $this, 'add_subscription_plan_type_filter' ) );
	    else
	    	add_action( 'pms_view_meta_box_subscription_details_top', array( $this, 'add_subscription_plan_type' ) );
	}

	// If not already present, generate the Subscription Plan Type Select field
	public function add_subscription_plan_type( $subscription_plan_id ){

		$subscription_type = get_post_meta( $subscription_plan_id, 'pms_subscription_plan_type', true );

		$types = array(
			'regular' => esc_html__( 'Regular', 'paid-member-subscriptions' ),
			'group'   => esc_html__( 'Group', 'paid-member-subscriptions' )
		);

		$types = apply_filters( 'pms_subscription_plan_types', $types );

		//Don't let users bundle together Group Subscriptions with other types

		//Add Subscription
		if( !empty( $_REQUEST['pms-action'] ) && !empty( $_REQUEST['plan_id'] ) ){

			$plan_id = sanitize_text_field( $_REQUEST['plan_id'] );
			$plan = pms_get_subscription_plan( (int)$plan_id );

			if( $plan->type == 'group' )
				$types = array( 'group'   => esc_html__( 'Group', 'paid-member-subscriptions' ) );
			else
				unset( $types['group'] );

		} else if ( !empty( $_GET['post'] ) ){

			$group = pms_get_subscription_plans_group( (int)$_GET['post'] );

			$show = true;

			foreach( $group as $plan ){
				if( $plan->type != 'group' ){
					$show = false;
					break;
				}
			}

			if( $show ) {
				$types = array();
				$types['group'] = esc_html__( 'Group', 'paid-member-subscriptions' );
			} else
				unset( $types['group'] );

		}
		?>

		<!-- Subscription Plan Type -->
		<div class="pms-meta-box-field-wrapper">
		    <label for="pms-subscription-plan-type" class="pms-meta-box-field-label">
				<?php esc_html_e( 'Subscription Type', 'paid-member-subscriptions' ); ?>
			</label>

		    <select id="pms-subscription-plan-type" name="pms_subscription_plan_type">

				<?php foreach( $types as $slug => $label ) : ?>
					<option value="<?php echo $slug; ?>" <?php selected( $subscription_type, $slug ); ?>><?php echo $label; ?></option>
				<?php endforeach; ?>

		    </select>
		    <p class="description"><?php esc_html_e( 'Please select the duration type for this subscription plan.', 'paid-member-subscriptions' ); ?></p>
		</div>

		<?php

	}

	// Add the necessary type to the existing select
	public function add_subscription_plan_type_filter( $types ){
		if( !empty( $_REQUEST['pms-action'] ) && !empty( $_REQUEST['plan_id'] ) ){
			$plan_id = sanitize_text_field( $_REQUEST['plan_id'] );
			$plan    = pms_get_subscription_plan( (int)$plan_id );

			if( $plan->type == 'group' ){
				$types = array();
				$types['group'] = esc_html__( 'Group', 'paid-member-subscriptions' );
			}
		} elseif( !empty( $_GET['post'] ) ){
			$group = pms_get_subscription_plans_group( (int)$_GET['post'] );

			$show = true;

			foreach( $group as $plan ){
				if( $plan->type != 'group' ){
					$show = false;
					break;
				}
			}

			if( $show ) {
				$types = array();
				$types['group'] = esc_html__( 'Group', 'paid-member-subscriptions' );
			}

		} else
			$types['group'] = esc_html__( 'Group', 'paid-member-subscriptions' );

		return $types;
	}

	public function add_subscription_plan_seats_field( $subscription_plan_id ){

		$seats = get_post_meta( $subscription_plan_id, 'pms_subscription_plan_seats', true );
		?>

		<div class="pms-meta-box-field-wrapper">

			<label for="pms-subscription-plan-seats" class="pms-meta-box-field-label"><?php esc_html_e( 'Seats', 'paid-member-subscriptions' ); ?></label>

			<input type="number" name="pms_subscription_plan_seats" id="pms-subscription-plan-seats" min="2" value="<?php echo $seats; ?>" />

			<p class="description"><?php esc_html_e( 'The number of additional members, including the owner, that can be added to the subscription.', 'paid-member-subscriptions' ); ?></p>

		</div>
	<?php
	}

	public function save_subscription_plan_settings_fields( $subscription_plan_id ){

		if( empty( $_POST['post_ID'] ) || $subscription_plan_id != $_POST['post_ID'] )
	        return;

	    if( isset( $_POST['pms_subscription_plan_type'] ) )
	        update_post_meta( $subscription_plan_id, 'pms_subscription_plan_type', sanitize_text_field( $_POST['pms_subscription_plan_type'] ) );

	    if( isset( $_POST['pms_subscription_plan_seats'] ) )
	        update_post_meta( $subscription_plan_id, 'pms_subscription_plan_seats', sanitize_text_field( $_POST['pms_subscription_plan_seats'] ) );

	}

	public function members_list_add_group_column( $columns ){
		$subscriptions = $columns['subscriptions'];

		unset( $columns['subscriptions'] );

		$columns['group']         = __( 'Group', 'paid-member-subscriptions' );
		$columns['subscriptions'] = $subscriptions;

		return $columns;
	}

	public function members_list_add_group_column_data( $data, $member ){
		if( empty( $member->subscriptions ) )
			return $data;

		//determine id
		$subscription_id = '';
		foreach( $member->subscriptions as $subscription ){
			$plan = pms_get_subscription_plan( $subscription['subscription_plan_id'] );

			if( $plan->type != 'group' )
				continue;

			$subscription_id = $subscription['id'];
			break;
		}

		if( empty( $subscription_id ) )
			return $data;

		if( pms_gm_is_group_owner( $subscription_id ) )
			$owner_subscription_id = $subscription_id;
		else
			$owner_subscription_id = pms_get_member_subscription_meta( $subscription_id, 'pms_group_subscription_owner', true );

		if( empty( $owner_subscription_id ) )
			return $data;

		$group_name = pms_gm_get_group_name( $subscription_id );

		if( empty( $group_name ) )
			$group_name = 'Undefined';

		$data['group'] = sprintf( '<a href="%s">%s</a>', add_query_arg( array( 'subpage' => 'group_details', 'group_owner' => $owner_subscription_id ) ), $group_name );

		return $data;
	}

	public function members_list_allow_add_new_action( $action ){
	    return 'allow';
	}

	public function members_list_add_group_filter(){
		$groups = pms_gm_get_all_meta_values_by_key( 'pms_group_name' );

		if( empty( $groups ) )
			return;

		echo '<select name="pms-filter-group">';
			echo '<option value="">' . __( 'Filter by Group...', 'paid-member-subscriptions' ) . '</option>';

			foreach( $groups as $group )
				echo '<option value="' . $group['meta_id'] . '" ' . ( !empty( $_GET['pms-filter-group'] ) ? selected( $group['meta_id'], $_GET['pms-filter-group'], false ) : '' ) . '>' . $group['meta_value'] . '</option>';
		echo '</select>';
	}

	public function members_list_filter_members_by_group( $members ){

		if( !is_admin() || !isset( $_GET['pms-filter-group'] ) || empty( $_GET['pms-filter-group' ] ) || !is_array( $members ) )
			return $members;

		$filter = sanitize_text_field( $_GET['pms-filter-group' ] );

		foreach( $members as $key => $member ){
			if( empty( $member->subscriptions ) )
				continue;

			$remove = true;

			foreach( $member->subscriptions as $subscription ){
				$owner_subscription_id = pms_get_member_subscription_meta( $subscription['id'], 'pms_group_subscription_owner', true );

				if( empty( $owner_subscription_id ) )
					$owner_subscription_id = $subscription['id'];

				$group_id = pms_gm_get_meta_id_by_key( $owner_subscription_id, 'pms_group_name' );

				if( $group_id == $filter ){
					$remove = false;
					break;
				}
			}

			if( $remove )
				unset( $members[$key]);
		}

		return $members;
	}

	public function members_list_remove_views( $views ){
		if( !empty( $_GET['pms-filter-group'] ) )
			return array();

		return $views;
	}

	public function members_list_add_edit_owner_action( $actions, $item ){
		if( empty( $item['subscriptions'][0] ) )
			return $actions;

		$plan = pms_get_subscription_plan( $item['subscriptions'][0]->subscription_plan_id );

		if( $plan->type != 'group' )
			return $actions;

		$owner_subscription_id = pms_get_member_subscription_meta( $item['subscriptions'][0]->id, 'pms_group_subscription_owner', true );

		if( empty( $owner_subscription_id ) )
			return $actions;

		$owner_subscription = pms_get_member_subscription( $owner_subscription_id );

		if( empty( $owner_subscription ) )
			return $actions;

		$actions['group_owner_edit'] = '<a href="' . add_query_arg( array( 'subpage' => 'edit_member', 'member_id' => $owner_subscription->user_id ) ) . '">' . __( 'Edit Owner', 'paid-member-subscriptions' ) . '</a>';

		return $actions;
	}

	public function members_list_output( $content ){

		if( isset( $_GET['subpage'] ) && $_GET['subpage'] == 'group_details' && !empty( $_GET['group_owner'] ) )
			include_once 'views/view-page-members-group-details.php';
		else
			return $content;

	}

	public function members_list_edit_group_details(){
		check_ajax_referer( 'pms_gm_admin_edit_group_details_nonce', 'security' );

		if( empty( $_POST['owner_id'] ) )
			$this->ajax_response( 'error', esc_html__( 'Something went wrong.', 'paid-member-subscriptions' ) );

		$group_name      = sanitize_text_field( $_POST['group_name'] );
		$group_seats     = (int)$_POST['seats'];
		$subscription_id = (int)$_POST['owner_id'];

		$subscription = pms_get_member_subscription( $subscription_id );

		//Validate
		if( empty( $subscription->id ) )
			pms_errors()->add( 'subscription', esc_html__( 'Invalid subscriptions.', 'paid-member-subscriptions' ) );

		if( empty( $group_name ) )
			pms_errors()->add( 'group_name', esc_html__( 'Group name cannot be empty.', 'paid-member-subscriptions' ) );

		if( empty( $group_seats ) )
			pms_errors()->add( 'group_seats', esc_html__( 'Group seats cannot be empty.', 'paid-member-subscriptions' ) );

		if( !is_numeric( $group_seats ) )
			pms_errors()->add( 'group_seats', esc_html__( 'Group seats needs to be a number', 'paid-member-subscriptions' ) );

		if( $group_seats < pms_gm_get_used_seats( $subscription_id ) )
			pms_errors()->add( 'group_seats', esc_html__( 'Available seats needs to be equal or bigger than used seats.', 'paid-member-subscriptions' ) );

		if ( count( pms_errors()->get_error_codes() ) > 0 ){
			$errors = pms_errors()->get_error_messages();
			$this->ajax_response( 'error', $errors[0] );
		}

		pms_update_member_subscription_meta( $subscription->id, 'pms_group_name', $group_name );

		pms_update_member_subscription_meta( $subscription->id, 'pms_group_seats', $group_seats );

		if( !empty( $_POST['group_description'] ) )
			pms_update_member_subscription_meta( $subscription->id, 'pms_group_description', sanitize_text_field( $_POST['group_description'] ) );

		$this->ajax_response( 'success', esc_html__( 'Group subscription details edited successfully !', 'paid-member-subscriptions' ) );
	}

	public function members_list_remove_members(){

        if( ! current_user_can( 'manage_options' ) )
            return;

		if( !isset( $_REQUEST['pmstkn'] ) || !wp_verify_nonce( $_REQUEST['pmstkn'], 'pms_remove_members_form_nonce' ) )
			return;

		if( empty( $_POST['pms_reference'] ) || empty( $_POST['pms_subscription_id'] ) )
			return;

		$reference          = sanitize_text_field( $_POST['pms_reference'] );
		$subscription_id    = sanitize_text_field( $_POST['pms_subscription_id'] );
		$owner_subscription = pms_get_member_subscription( (int)$subscription_id );

		$user = get_user_by( 'email', $reference );

		if( !empty( $user->ID ) ){
			$member_subscription = pms_get_member_subscriptions( array( 'user_id' => $user->ID ) );

			if( empty( $member_subscription[0] ) )
				return;

			$member_subscription_id = $member_subscription[0]->id;
			$member_subscription[0]->remove();

            if( pms_delete_member_subscription_meta( $owner_subscription->id, 'pms_group_subscription_member', (int)$member_subscription_id ) )
                pms_success()->add( 'remove_member', esc_html__( 'Member removed successfully !', 'paid-member-subscriptions' ) );

		} else {
			$meta_id = pms_gm_get_meta_id_by_value( $owner_subscription->id, $reference );

            pms_delete_member_subscription_meta( $owner_subscription->id, 'pms_gm_invited_emails_' . $meta_id );

            if( pms_delete_member_subscription_meta( $owner_subscription->id, 'pms_gm_invited_emails', $reference ) )
				pms_success()->add( 'remove_member', esc_html__( 'Member removed successfully !', 'paid-member-subscriptions' ) );
		}

	}

	private function ajax_response( $type, $message ){
		echo json_encode( array( 'status' => $type, 'message' => $message ) );
		die();
	}

}

$pms_group_memberships_admin = new PMS_Admin_Group_Memberships;

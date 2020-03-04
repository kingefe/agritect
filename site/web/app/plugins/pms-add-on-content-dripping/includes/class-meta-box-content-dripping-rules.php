<?php

if( !class_exists( 'PMS_Meta_Box' ) )
    return;

Class PMS_Meta_Box_Content_Dripping_Rules extends PMS_Meta_Box {


    /*
     * Initialise all needed components
     *
     */
    public function init() {

        add_action( 'pms_output_content_meta_box_' . $this->post_type . '_' . $this->id, array( $this, 'output' ) );

        add_action( 'pms_save_meta_box_' . $this->post_type, array( $this, 'save_data' ) );

        add_action( 'wp_ajax_get_select_type_options', array( $this, 'ajax_get_select_type_options' ) );
        add_action( 'wp_ajax_get_select_content_options', array( $this, 'ajax_get_select_content_options' ) );

    }


    /*
     * Outputs the content of the meta-box
     *
     */
    public function output() {

        global $post;

        // Get the saved rules
        $content_rules = get_post_meta( $post->ID, 'pms-content-dripping-rules', true );
        $content_rules = !empty( $content_rules ) ? $content_rules : array();

        // Add a nonce field to use when doing ajax calls
        echo wp_nonce_field( 'pms_content_dripping_rules', 'pmstkn' );

        // Get and set post types
        $post_types = array();
        foreach( get_post_types( array( 'public' => true ) ) as $post_type ) {
            $post_type_obj = get_post_type_object( $post_type );
            $post_types[$post_type] = $post_type_obj->labels->singular_name;
        }

        // Set delay units
        $delay_units = array( 'day' => __( 'Day(s)', 'pms-content-dripping-add-on' ), 'week' => __( 'Week(s)', 'pms-content-dripping-add-on' ), 'month' => __( 'Month(s)', 'pms-content-dripping-add-on' ) );

        // Add some global js variables
        echo '<script type="text/javascript">';
            echo 'var pmsPostTypes = {';
                foreach( $post_types as $post_type => $post_type_name )
                    echo '\'' . $post_type . '\'' . ':' . '\'' . $post_type_name . '\'' . ',';
            echo '}';
        echo '</script>';

        echo '<script type="text/javascript">';
            echo 'var pmsDelayUnits = {';
            foreach( $delay_units as $delay_unit_slug => $delay_unit )
                echo '\'' . $delay_unit_slug . '\'' . ':' . '\'' . $delay_unit . '\'' . ',';
            echo '}';
        echo '</script>';

        // Content dripping rules
        echo '<table id="pms-content-dripping-rules">';

            // Table header
            echo '<thead>';
                echo '<tr>';
                    echo '<td></td>';
                    echo '<td><h4><label>' . __( 'Delay', 'pms-content-dripping-add-on' ) . '</label></h4></td>';
                    echo '<td><h4><label>' . __( 'Post Type', 'pms-content-dripping-add-on' ) . '</label></h4></td>';
                    echo '<td><h4><label>' . __( 'Type', 'pms-content-dripping-add-on' ) . '</label></h4></td>';
                    echo '<td><h4><label>' . __( 'Content', 'pms-content-dripping-add-on' ) . '</label></h4></td>';
                    echo '<td></td>';
                echo '</tr>';
            echo '<thead>';

            // Table body
            echo '<tbody>';
            foreach( $content_rules as $key => $rule ) {
                echo '<tr class="pms-content-dripping-rule">';
                    echo '<td><span class="pms-handle"></span><div class="spinner"></div></td>';

                    echo '<td>';
                        echo '<select name="pms-content-dripping-rules[' . $key . '][delay]" class="pms-select-delay">';
                            foreach( range( 0, 31 ) as $number )
                                echo '<option value="' . $number . '" ' . selected( $rule['delay'], $number, false ) . '>' . $number . '</option>';
                        echo '</select>';

                        echo '<select name="pms-content-dripping-rules[' . $key . '][delay_unit]" class="pms-select-delay-unit">';
                            foreach( $delay_units as $unit_slug => $unit_name )
                                echo '<option value="' . $unit_slug . '" ' . selected( $rule['delay_unit'], $unit_slug, false ) . '>' . $unit_name . '</option>';
                        echo '</select>';
                    echo '</td>';

                    echo '<td>';
                        echo '<select name="pms-content-dripping-rules[' . $key . '][post_type]" class="widefat pms-select-post-type">';
                            echo '<option value="0">' . __( 'Choose...', 'pms-content-dripping-add-on' ) . '</option>';

                            foreach( $post_types as $post_type => $post_type_name ) {
                                echo '<option value="' . $post_type . '" ' . selected( $rule['post_type'], $post_type, false ) . '>' . $post_type_name . '</option>';
                            }
                        echo '</select>';
                    echo '</td>';

                    echo '<td>';
                        echo '<select name="pms-content-dripping-rules[' . $key . '][type]" class="widefat pms-select-type">';

                            // Add default "By post" option
                            // This will permit the user to add individual posts
                            echo '<option value="0">' . __( 'Choose...', 'pms-content-dripping-add-on' ) . '</option>';
                            echo '<optGroup label="' . __( 'By Post', 'pms-content-dripping-add-on' ) . '"><option value="pms_list_of_posts" ' . selected( $rule['type'], 'pms_list_of_posts', false ) . '>' . __( 'List of Posts', 'pms-content-dripping-add-on' ) . '</option></optGroup>';

                            // Add available taxonomies for the saved post type
                            $taxonomies = ( !empty( $rule['post_type'] ) ? get_object_taxonomies( $rule['post_type'], 'objects' ) : array() );
                            if( !empty( $taxonomies ) ) {
                                echo '<optGroup data-tax="true" label="'. __( 'By Taxonomy', 'pms-content-dripping-add-on' ) . '">';
                                foreach( $taxonomies as $taxonomy_slug => $taxonomy ) {
                                    echo '<option value="' . $taxonomy_slug . '" ' . selected( $rule['type'], $taxonomy_slug, false ) . '>' . $taxonomy->label . '</option>';
                                }
                                echo '</optGroup>';
                            }
                        echo '</select>';
                    echo '</td>';

                    echo '<td>';
                        echo '<select name="pms-content-dripping-rules[' . $key . '][content][]" multiple class="widefat pms-chosen pms-select-content">';

                            if( !empty( $rule['type'] ) ) {
                                $values = ( $rule['type'] == 'pms_list_of_posts' ? get_posts( array( 'post_type' => $rule['post_type'], 'numberposts' => -1 ) ) : get_terms( array( 'taxonomy' => $rule['type'] ) ) );

                                if( !empty( $values ) ) {
                                    foreach( $values as $value_object ) {
                                        $value = ( $rule['type'] == 'pms_list_of_posts' ? $value_object->ID : $value_object->term_id );
                                        $name  = ( $rule['type'] == 'pms_list_of_posts' ? $value_object->post_title : $value_object->name );

                                        echo '<option value="' . $value . '" ' . ( in_array( $value, $rule['content'] ) ? 'selected' : '' ) . '>' . $name . '</option>';
                                    }
                                }
                            }

                        echo '</select>';
                    echo '</td>';

                    echo '<td><a href="#" class="pms-content-dripping-remove-rule" title="Remove this rule"><span class="dashicons dashicons-no"></span></a></td>';
                echo '</tr>';
            }
            echo '</tbody>';

        echo '</table>';

        // Add New rule button
        echo '<a href="#" id="pms-content-dripping-add-rule" class="button button-primary"><span class="dashicons dashicons-plus"></span>' . __( 'Add New', 'pms-content-dripping-add-on' ) . '</a>';

    }


    /*
     * Save data of the meta-box
     *
     */
    public function save_data( $post_id ) {

        // Check nonce
        if( !isset( $_POST['pmstkn'] ) || !wp_verify_nonce( $_POST['pmstkn'], 'pms_content_dripping_rules' ) )
            return;

        // Check to see if any rules were added
        if( empty( $_POST['pms-content-dripping-rules'] ) )
            return;

        if( ! is_array( $_POST['pms-content-dripping-rules'] ) )
            return;

        $content_dripping_rules = $_POST['pms-content-dripping-rules'];

        // Filter empty content dripping rules
        foreach( $content_dripping_rules as $key => $rule ) {
            if( empty( $rule['content'] ) )
                unset( $content_dripping_rules[$key] );
        }
        $content_dripping_rules = array_values( $content_dripping_rules );

        // Add the data to the db
        update_post_meta( $post_id, 'pms-content-dripping-rules', $content_dripping_rules );

    }


    /**
     * Returns an array with the taxonomy slug and name for a given
     * post type
     *
     * @return string
     *
     */
    public function ajax_get_select_type_options() {

        if( !isset( $_POST['pmstkn'] ) || !wp_verify_nonce( $_POST['pmstkn'], 'pms_content_dripping_rules' ) ) {
            echo 0;
            wp_die();
        }

        $post_type = esc_attr( $_POST['post_type'] );
        $row_index = esc_attr( $_POST['row_index'] );

        $taxonomies = get_object_taxonomies( $post_type, 'objects' );

        $return = array();

        $return['row_index'] = $row_index;

        if( !empty( $taxonomies ) ) {
            foreach( $taxonomies as $taxonomy_slug => $taxonomy )
                $return['taxonomies'][$taxonomy_slug] = $taxonomy->label;
        }

        echo json_encode( $return );

        wp_die();
    }


    /*
     * Returns an array with the post_id/post_name or term_id/term_name
     * depending on the post type and type
     *
     * @return string
     *
     */
    public function ajax_get_select_content_options() {

        if( !isset( $_POST['pmstkn'] ) || !wp_verify_nonce( $_POST['pmstkn'], 'pms_content_dripping_rules' ) ) {
            echo 0;
            wp_die();
        }

        $post_type = esc_attr( $_POST['post_type'] );
        $type      = esc_attr( $_POST['type'] );
        $row_index = esc_attr( $_POST['row_index'] );

        $return = array();
        $return['row_index'] = $row_index;

        // If lists of posts was selected get all posts from that post_type
        if( $type == 'pms_list_of_posts' ) {

            $posts = get_posts( array( 'post_type' => $post_type, 'numberposts' => -1 ) );

            foreach( $posts as $post_object )
                $return['data'][$post_object->ID] = $post_object->post_title;

        } else {

            $terms = get_terms( array( 'taxonomy' => $type ) );

            foreach( $terms as $term_object )
                $return['data'][$term_object->term_id] = $term_object->name;

        }

        echo json_encode( $return );

        wp_die();
    }

}

$pms_meta_box_content_dripping_rules = new PMS_Meta_Box_Content_Dripping_Rules( 'pms_content_dripping_rules', __( 'Content', 'pms-content-dripping-add-on' ), 'pms-content-dripping', 'normal' );
$pms_meta_box_content_dripping_rules->init();
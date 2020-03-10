<script type="text/html" id="tmpl-imc-insert-post">
    <div class='modal fade' id='{{ data.current_modal_id }}' class='imc_email_campaign_editor_modal'>
	
	<div class='modal-dialog'>
	    
	    <div class='modal-content wp-core-ui wp-editor-wrap html-active has-dfw' id='{{ data.current_editor_wrapper_id }}'>
		
		<div class='modal-header'>
		    
		    <div id='imc-wp-content-media-buttons' class='wp-media-buttons'>
			<a href='#' id='imc-insert-media-button' class='button add_media insert-media' title='Add Media' data-editor='{{ data.current_editor_id }}'><span class='wp-media-buttons-icon'></span> <?php _e( 'Add Media', 'integral-mailchimp' ); ?></a>
			<a href='#' id='imc-insert-post-button' class='button _add_media _insert-media' title='Insert Post' data-editor='{{ data.current_editor_id }}'><span class='wp-menu-image dashicons-before dashicons-admin-post'></span><?php _e( 'Insert Post', 'integral-mailchimp' ); ?></a>
		    </div>
		    
		    <br><br><br>

		    <div style='display: none;' id='imc-insert-post-select'>
			
			<ul class='list-unstyled'>
			    <li>
				<label>{{ data.i18n.post_type }}</label>: <select id='imc_post_type_select' data-ajax-action='ajax_build_campaign' data-email-action='load_taxonomies_by_post_type'></select><div id='imc-spinner' class='spinner' style='float:none;'></div>
			    </li>
			    
			    <li>
				<label>{{ data.i18n.post_category }}</label>: <select id='imc_post_category_select' data-ajax-action='ajax_build_campaign' data-email-action='load_posts_by_category'></select>
			    </li>
			    
			    <li>
				<label>{{ data.i18n.post_select }}</label>: <select id='imc_post_select'></select>
			    </li>
			    
			    <li>
				<label>{{ data.i18n.post_search }}</label>: <input type=text maxlength=60 size=20 placeholder='<?php _e( 'Search Selected Category', 'integral-mailchimp' ); ?>' id='imc_post_search' data-ajax-action='ajax_build_campaign'>
			    <div style='position:relative;'>
				<div class='list-group' id='post_search_results' style='display:none;position:absolute; top:0; left:0; z-index:15000;'></div>
			    </div>
			    </li>
			</ul>
			    <hr>
			    <h3><?php _e( 'Insert Options', 'integral-mailchimp' ); ?></h3>
			    <input type='radio' name='imc_insert_type' id='imc_insert_type' value='excerpt' checked='checked'> <?php _e( 'Excerpt', 'integral-mailchimp' );?> &nbsp;&nbsp;<input type=radio name='imc_insert_type' id='imc_insert_type' value='full'> <?php _e( 'Full Content', 'integral-mailchimp' ); ?> 
			    <hr>
			    
			    <h3><?php _e( 'Link Options', 'integral-mailchimp' ); ?></h3>
			    <p><?php _e( 'Include a link to the original post?', 'integral-mailchimp' ); ?></p>
			    <ul class='list-unstyled'>
				<li><input type=radio name='imc_post_link_type' id='imc_post_link_type' value='1' checked='checked'> <?php _e( 'Yes', 'integral-mailchimp' ); ?> &nbsp;&nbsp;<input type='radio' name='imc_post_link_type' id='imc_post_link_type' value='0'> <?php _e( 'No', 'integral-mailchimp' ); ?></li>
			    </ul>
			    <hr>

			    <a href='#' id='imc-insert-post-into-text' class='button' data-ajax-action='ajax_build_campaign' data-email-action='load_post_content'><?php _e( 'Insert Selected Post', 'integral-mailchimp' ); ?></a>
			    
                    </div><!-- #imc-insert-post-select -->
                
		</div>

		<div class='modal-body wp-editor-container' id='{{ data.current_editor_container_id }}'>

		    <textarea class='wp-editor-area imc_mceEditor' style='height: 350px; width: 100%;' name='{{ data.current_editor_id }}' id='{{ data.current_editor_id }}'></textarea>
                         
		</div>
                                    
		<div class='modal-footer'>

		    <button type='button' class='btn btn-default' name='imc_text_modal_close' data-dismiss='modal'> <?php _e( 'Close', 'integral-mailchimp' ); ?></button>

		    <button type='button' name='imc_text_modal_submit' class='btn btn-primary'><?php _e( 'Save changes', 'integral-mailchimp' ); ?></button>

		</div>
	    </div><!-- .modal-content -->
		
	</div><!-- .modal-dialog -->
	
    </div><!-- .modal-fade -->
</script>
var activeTinyEditor = '';
var current_modal_id = '';
var current_editor_id = '';
var current_editor_wrapper_id = '';
var current_editor_container_id = '';
var imc_styles = {};
var email_html = '';
var tinymceBodyBackgroundColor = '';
var selected_post_id = '';

jQuery(document).ready(function($) {
    'use strict';
    //- disable navigation confirmation
    delete postL10n.saveAlert;

    //- over ride the default behavior of wpLink close() method so adding links doesn't send focus back to the main page
    var imcLink = {
        editor: '',
        inputs: {},
        close: function() {
            if (!wpLink.isMCE()) {
                wpLink.textarea.focus();

                if (wpLink.range) {
                    wpLink.range.moveToBookmark(wpLink.range.getBookmark());
                    wpLink.range.select();
                }
            } else {
                tinyMCE.get(tinyMCE.activeEditor.id).focus();
            }
            $('#wp-link-backdrop').hide();
            $('#wp-link-wrap').hide();
            $(document).trigger('wplink-close', $('#wp-link-wrap'));
        }
    };
    $.extend(wpLink, imcLink);

    //- Make the post title field tab to our custom email subject field
    $('input[name="post_title"]').attr('tabindex', '99').on('keydown', function(event) {
        var keyCode = event.keyCode || event.which;
        if (9 == keyCode) {
            event.preventDefault();
            setTimeout(function() {
                $('#imc_email_subject').focus();
            }, 500);

        }
    });

    //- disable metabox reordering for this page
    $('.postbox').each(function(index, value) {
        //- Remove postbox class(disables drag) and add stuffbox class(styling is close to the original)
        $(this).removeClass('postbox').addClass('stuffbox');

        //- Remove redundant handle div
        if ($(this).has('.handlediv'))
            $(this).children('.handlediv').remove();

        //- Remove redundant cursor effect on hover
        if ($(this).has('h3'))
            $(this).children('h3').css('cursor', 'default');

    });


    var original_height = $('.template.clearfix').height();

    //- based on list selected, load the segments and fill in the email sending defaults
    //- trigger the change event when the page loads to fill out the default list values
    $('select.list-select').change(function() {
        var opt_val = $(this).val();
        var action = $(this).data('ajaxAction');
        $('input[name=imc_from_email]').val('');
        $('input[name=imc_from_name]').val('');
        $(this).parent().nextAll('div.clearfix').css('position', 'absolute').addClass('template-loading');
        $.getJSON(
                ajaxurl,
                {
                    action: action,
                    email_action: 'load_segments_and_defaults',
                    list_id: opt_val,
                    post_id: $('#post_ID').val()
                }).done(function(data) {
            //- returns a json encoded array of arrays with the list id as the key
            var list = data.lists;
            //- update the default fields 
            $('input[name=imc_from_email]').val(list.default_from_email);
            $('input[name=imc_from_name]').val(list.default_from_name);
            //- append the new groups menu
            $('#groups_holder').html(data.groups[opt_val].html).removeClass('hide');
            //- append the new segments menu
            $('#segments_holder').html(data.segments[opt_val].html).removeClass('hide');
            $('.template-loading').removeClass('template-loading');
        });
    });

    setTimeout(function() {
        $('select.list-select').change();
        load_post_content_into_template_holder();

    }, 500);

    //- on template select load the template into an iframe and make editable. 
    $('select.template-select').change(function() {
        //- remove any existing modals
        $("div[id^='imc_modal_']").remove();
        //- destroy any existing tinymce editors
        if (typeof(tinyMCE) !== 'undefined') {
            var length = tinyMCE.editors.length;
            for (var i = length; i > 0; i--) {
                tinyMCE.editors[i - 1].remove();
            }
            ;
        }
        //- set the other template select back to none
        $('select.template-select').not(this).val('none');
        var action = $(this).data('ajaxAction');
        var target = $('#' + $(this).data('ajaxTarget'));
        //- clear any content in the iframe
        $(target).contents().find('html').html('');
        //- reset the height & add the loading status indicator
        $('.template.clearfix').height(original_height).addClass('template-loading');
        var opt_val = $(this).val();
        $.post(
                ajaxurl,
                {action: action, value: opt_val},
        function(data) {
            var iframeHtml = $(target).contents().find('html').get(0);
            iframeHtml.innerHTML = data.source;
            $('#imc_content').text(data.source);
            //- add a custom style for editable areas
            load_imc_styles(target);
            //- make sure all images are loaded before calculating height
            var $el = $(target.contents()), deferreds;
            deferreds = $el.find('img').map(getOnLoadDeferred);
            $.when.apply($, deferreds).done(function() {
                var height = $(target).contents().find('body').outerHeight(true);
                $(target).height(height + 60);
                $('.template.clearfix').removeClass('template-loading').height('100%');
                //- parse the mc:edit areas
                parse_editable(iframeHtml);
                $(target).removeClass('hidden').addClass('show');
            });

        });

    });//- end template select change function

    var imc_media = {
        id: '',
        element: '',
        attachment: '',
        email_html: '',
        size: '',
        openMediaDialog: function(id, element) {
            this.id = id;
            this.element = element;
            //- Check if the frame is already declared.
            //- If true, open the frame.
            if (this._frame) {
                this._frame.open();
                return;
            }
            /**
             * Creates the frame which is based on wp.media().
             *
             * wp.media() handles the default media experience. It automatically creates
             * and opens a media frame, and returns the result.
             * wp.media() can take some attributes.
             * We make use of:
             *  - title: The title of the frame
             *  - button
             *     - text: The string of the select button in the toolbar (bottom)
             *  - multiple: If false, only one media item can be selected at once
             *  - library
             *     - type: Declares which media mime types will be displayed in the library
             *             Examples: `image` for images, `audio` for audio, `video` for video
             *
             * Note: When the frame is generated once, you can open the dialog from the JS
             * console too: wp.media.editor.open() or wp.media.editor.close()
             */
            this._frame = imc_media.frame = wp.media({
                title: 'Choose Image',
                //- default frame type is 'select' -- doesn't give you the option to select size, etc.
                //- http://code.tutsplus.com/tutorials/getting-started-with-the-wordpress-media-uploader--cms-22011
                //frame: 'select',
                frame: 'post',
                library: {
                    type: 'image'
                },
                button: {
                    text: 'Choose Image'
                },
                multiple: false,
                state: 'insert'
            });

            /**
             * Handles the ready event.
             *
             * The frame triggers some events on special things. For example when the frame
             * is opened/closed or is ready.
             * The ready event will be fired once when the frame is completely initialised.
             */
            this._frame.on('ready', function() {
                // Here we can add a custom class to our media modal.
                // .media-modal doesn't exists before the frame is
                // completely initialised.
                //$('.media-modal').addClass('no-sidebar');
                $('.media-menu-item:last-child').remove();
            });
            /**
             * Handles select button function.
             *
             * Our frame has currently one state, the library state.
             * When you have selected a media item and click the select button
             * the frame will close. Now it's the time to get the selected attachment.
             * The default frame type is "select" and the action is "select". If you set
             * the frametype to "post" then the action is "insert"
             */

            this._frame.on('insert', function() {
                var size = imc_media.frame.$el.parent().find('select[name=size]').val();
                // Get the selected attachment. Since we have disabled multiple selection
                imc_media.attachment = imc_media.frame.state().get('selection').first().toJSON();
                // Make sure that we have the URL of an image to display
                if (0 > $.trim(imc_media.attachment.url.length)) {
                    return;
                }
                // Call the function which will output the attachment details
                imc_media.handleMediaAttachment(size);
            });

            /** 
             * Handle insert from URL
             */
            this._frame.on('select', function() {
                //console.log(imc_media.frame.state());
            });
            /**
             * Opens the modal.
             *
             * Now the frame is adjusted and we can open it.
             */
            this._frame.open();
        },
        /**
         * Handles the attachment details output
         *
         * The attachment is a model and so we can get access to each attachment
         * attribute: attachment.get( key )
         */
        handleMediaAttachment: function(size) {
            $(this.element).attr('src', this.attachment.sizes[size].url);
            //- add a width tag to enforce size if they use a bigger image
            $(this.element).attr('width', this.attachment.sizes[size].width + 'px')
                    .attr('alt', this.attachment.caption)
                    .attr('title', this.attachment.title);
            imc_media.updatePostContent();
        },
        /**
         * Send the updated iframe HTML to the post content field
         * whenever a modal is closed
         */
        updatePostContent: function() {
            imc_media.email_html = $('#template_holder').contents().find('html').clone();
            //- remove the image tag wrapper class
            $(imc_media.email_html).find('.tinymce_enabled.image').children('img').unwrap();
            //- remove the main tinymce_enabled class
            $(imc_media.email_html).find('.tinymce_enabled').removeClass('tinymce_enabled');
            //- update the imc_content field
            $('#imc_content').text('<html>' + $(imc_media.email_html).html() + '</html>');

        }
    };

    function parse_editable(iframeHtml) {
        var new_styles = $(iframeHtml).find('style').text();
        var editables = $(iframeHtml).find('[mc\\:edit]');
        var rendered_styles = {};
		
        //- disable links
        $(iframeHtml).find('a').click(function(e) {
            e.preventDefault();
        });

        $( editables ).each( function( index, element ) {
			
            //- check for image only editable blocks
            if ( $( element ).attr( 'mc:label' ) !== undefined && $( element ).attr( 'mc:label' ) !== false ) {
                $( element ).wrap( '<div></div>' ).parent().addClass( 'tinymce_enabled image' )
                        .hover( function() {
                    $( element ).parent().prepend( "<span class='imc_img_specs'>Use an image with the following dimensions: width = " + $( element ).width() + "px, height = " + $( element ).height() + "px</span>" );
                }, function() {
                    $( this ).children( '.imc_img_specs' ).remove();
                })
                        .on( 'click', function() {
                    //- remove the image specs
                    $( this ).children( '.imc_img_specs' ).remove();
                    //- use the media object
                    imc_media.openMediaDialog( $( element ).attr( 'mc:edit' ), $( element ));
                });
            } 
			
			else {
                //- handle text blocks with tinymce + modal
                $( element ).addClass( 'tinymce_enabled' ).click( function() {
					var template = wp.template( 'imc-insert-post' );
					var data = {};
					//- translatable strings
					data.i18n = i18n;
					
                    data.id = $( this ).attr( 'mc:edit' );
                    data.current_modal_id = 'imc_modal_' + data.id;
                    if ( typeof ( tinyMCE ) == "object" && typeof ( tinyMCE.execCommand ) == "function" ) {
                        data.current_editor_id = 'imc_' + data.id + '_editor';
                        data.current_editor_wrapper_id = 'wp-' + data.current_editor_id + '-wrap';
                        data.current_editor_container_id = 'wp-' + data.current_editor_id + '-editor-container';

                        $( 'body' ).append( template( data ) );

						if ( typeof ( imc_insert_post_types_array ) !== "undefined" ){
							$.each( imc_insert_post_types_array, function( index, element ) {
                                $( '#imc_post_type_select' ).append( $( '<option></option>' ).text( element ).val( index ) );
                            });
						}

                        if ( typeof ( imc_insert_post_array ) !== "undefined" ) {
                            $.each( imc_insert_post_array, function( index, element ) {
                                $( '#imc_post_select' ).append( $( '<option></option>' ).text( element.Name ).val( element.ID ) );
                            });
                        }

                        if ( typeof ( imc_insert_post_categories_array ) !== "undefined" ) {
                            $.each( imc_insert_post_categories_array, function( index, element ) {
                                $( '#imc_post_category_select' ).append( $( '<option></option>' ).text( element.Name ).val( element.ID ) );
                            });
                        }
						
						//- stop modal from adding modal-open class to body -- breaks new inline link editor
						$( document ).on( 'shown.bs.modal wplink-open', function( e ){
							$( document.body ).removeClass( 'modal-open' );
						} );


                        //- bind a submit event to the modal
                        $('button[name=imc_text_modal_submit]').on('click', function(event) {
                            //- update imc_content
                            //- verify that we've changed anything
                            if ( tinyMCE.activeEditor.isNotDirty == false ) {
                                var newContent = tinyMCE.activeEditor.getContent();
                                newContent = $( newContent ).html();
                                $( element ).html( newContent );
                                //- update the imc_content field
                                var updatedHtml = $( '#template_holder' ).contents().find( 'html' ).clone().find( '.tinymce_enabled' ).removeClass( 'tinymce_enabled' ).end().find( '#imc_styles' ).remove().end().html();
                                //- update the content
                                $( '#imc_content' ).text( '<html>' + updatedHtml + '</html>' );
                            }
                            //- trigger the modal close
                            $( '#' + data.current_modal_id ).modal( 'hide' );
                        });
						
						//- bind a close event to the modal
                        $( '#' + data.current_modal_id ).on( 'hide.bs.modal', function( e ){
                       
							//- remove the modal
                            $( '#' + data.current_modal_id ).remove();
                            if ( typeof( tinyMCE ) !== 'undefined' ) {
                                var length = tinyMCE.editors.length;
                                for ( var i = length; i > 0; i-- ) {
                                    tinyMCE.editors[i - 1].remove();
                                };
                            };
						} );


                        //- open the editor in a modal window & add a tinyMCE editor instance
                        tinyMCEPreInit.mceInit[data.current_editor_id] = tinyMCEPreInit.mceInit.content;
                        tinyMCEPreInit.mceInit[data.current_editor_id].selector = '#' + data.current_editor_id;
                        tinyMCEPreInit.mceInit[data.current_editor_id].resize = true;
						tinyMCEPreInit.mceInit[data.current_editor_id].wp_autoresize_on = false;
                        tinyMCEPreInit.mceInit[data.current_editor_id].forced_root_block = false;
                        tinyMCEPreInit.mceInit[data.current_editor_id].keep_styles = false;
						
                        $( '#' + data.current_modal_id ).modal();
                        imc_tinymce_init();

                        $( '#' + data.current_editor_id + '_ifr' ).contents().find( 'style' ).html( new_styles );
                        //- remove default tinymce css styles
                        $( '#' + data.current_editor_id + '_ifr' ).contents().find( 'link[rel=stylesheet]' ).prop( 'disabled', true ).remove();

                        try {
                            var selectedContent = $( "<div />" ).append( $( element ).clone().removeClass( 'tinymce_enabled' ).attr( 'id', 'imc_' + data.id ) ).html();
                            //- set the content
                            if ( $( this ).prop( 'tagName' ) === 'TD' ) {
                                selectedContent = "<div id='imc_" + data.id + "'>" + selectedContent + "</div>";
                            }
                            ;
                            tinyMCE.get( data.current_editor_id ).setContent(selectedContent);
                            //- get the rendered style of the element
                            var styles_html = "#imc_" + data.id + "{" + cloneComputedStyles( element ) + "}";
                            //- get the rendered styles of each child element
                            $( element ).children().each( function( index, el ) {
                                styles_html += "#imc_" + data.id + " " + $( el ).prop( 'tagName' ) + "{" + cloneComputedStyles( el ) + "}";
                            });

                            //- set the background color of the tinymce body
                            $( '#' + data.current_editor_id + '_ifr' ).contents().find( 'body' ).css( 'background-color', tinymceBodyBackgroundColor );

                            //- get the tinymce copy of the content and apply the styles 
                            imc_styles[data.id] = $( "<style>", {
                                id: data.id,
                                type: "text/css",
                                html: styles_html
                            }).appendTo( $( '#' + data.current_editor_id + '_ifr' ).contents().find( 'head' ) );

                            tinymceBodyBackgroundColor = '';

                        } catch (e) {
                            console.log(e);
                        }

                    }
                    else {
                        alert('tinyMCE Editor not available!');
                    }
                });
            }
        });
    }

    function getOnLoadDeferred() {
        var deferred = $.Deferred();
        this.onload = function imgOnLoad() {
            deferred.resolve();
        };
        return deferred;
    }

    function load_imc_styles(target) {
        imc_styles['tinymce_enabled'] = $("<style>", {
            id: 'imc_styles',
            type: "text/css",
            html: "\
                        .tinymce_enabled{position:relative;}\n\
                        .tinymce_enabled:hover:after{\n\
                        content:' ';\n\
                        position:absolute;\n\
                        width:100%;\n\
                        height:100%;\n\
                        top:0;\n\
                        left:0;\n\
                        background-color: #2ba9c0;\n\
                        opacity: .5;\n\
                        filter:alpha(opacity=50);\n\
                        z-index: 9999;}\n\
                        .imc_img_specs{\n\
                        position:absolute;\n\
                        background-color:black;\n\
                        color: white;\n\
                        padding:6px;\n\
                        font-size:14px;\n\
                        z-index: 10000;\n\
                        font-family: Arial, Helvetica, sans-serif;\n\
                        font-weight: bold;\n\
                        }"
        }).appendTo($(target).contents().find('head'));
    }

    function  load_post_content_into_template_holder() {

        var target = $('#template_holder');

        var this_post_content = $('#imc_content').val();

        var iframeHtml = $(target).contents().find('html').get(0);

        iframeHtml.innerHTML = this_post_content;

        load_imc_styles(target);

        //- make sure all images are loaded before calculating height

        var $el = $(target.contents()), deferreds;

        deferreds = $el.find('img').map(getOnLoadDeferred);

        $.when.apply($, deferreds).done(function() {

            var height = $(target).contents().find('body').outerHeight(true);

            $(target).height(height + 60);

            $('.template.clearfix').removeClass('template-loading').height('100%');

            //- parse the mc:edit areas

            parse_editable(iframeHtml);

            $(target).removeClass('hidden').addClass('show');

        });

        $(target).removeClass('hide');
    }


    function cloneComputedStyles(element) {
        var cs = false;
        var computedStyles = '';
        var supportedStyles = new Array(
                "background",
                "background-color",
                "color",
                "font",
                "font-family",
                "font-size",
                "font-style",
                "font-variant",
                "font-weight",
                "line-height",
                "list-style",
                "margin",
                "padding",
                "text-align",
                "text-decoration",
                "text-indent",
                "text-shadow",
                "text-transform"
                );

        if (element.currentStyle)
            cs = element.currentStyle;
        else if (window.getComputedStyle)
            cs = document.defaultView.getComputedStyle(element, null);
        if (!cs)
            return null;

        for (var prop in cs)
        {
            if ($.inArray(prop, supportedStyles) != -1) {
                if (cs[prop] != undefined && cs[prop].length > 0 && typeof cs[prop] !== 'object' && typeof cs[prop] !== 'function' && prop != parseInt(prop))
                {
                    computedStyles += prop + ':' + cs[prop] + ';\n\ ';

                }
            }
        }
        //- background color could be showing through from a parent element much higher up the dom tree. Find it!
        if ($.inArray('backgroundColor', supportedStyles) == -1) {
            InheritedBackgroundColor(element);
        }
        return computedStyles;
    }

    function InheritedBackgroundColor(element) {
        var parent = $(element).parent();
        var bc = $(parent).css("background-color");
        if (bc == "transparent" || bc == 'rgba(0, 0, 0, 0)') {
            return InheritedBackgroundColor(parent);
        }
        else {
            tinymceBodyBackgroundColor = bc;
            return;
        }
    }


    function activateTinyMCETab(selectedTab, visualTab, htmlTab, elementId) {
        if (selectedTab == 'visual') {
            tinyMCE.execCommand('mceAddEditor', false, elementId);
            $(visualTab).addClass('active');
            $(htmlTab).removeClass('active');
        } else if (selectedTab == 'html') {
            tinyMCE.execCommand('mceRemoveEditor', false, elementId);
            $(visualTab).removeClass('active');
            $(htmlTab).addClass('active');
        }
    }

    /**
     * Load taxonomies from a selected post type. Updates when the selected post type changes.
	 * 
     */
    $( document.body ).on( 'change', '#imc_post_type_select', function( event ) {
		$( '#imc-spinner' ).addClass( 'is-active' );
		$( 'select, #imc_post_search' ).attr( 'disabled', 'disabled' ).addClass( 'disabled' );
        var action = $( this ).data( 'ajaxAction' );
		var email_action = $( this ).data( 'emailAction' );
        var post_type = $( '#imc_post_type_select' ).val();
		//- clear the search box and any results
        $( '#imc_post_search' ).val( '' );
		$( 'ul#post_search_results' ).html( '' );

        $.getJSON(
                ajaxurl,
                {
                    action: action,
                    email_action: email_action,
                    post_type: post_type
                }).done( function( data ) {
		
            $( '#imc_post_category_select' ).html( '' );
            var enable_post_load = true;
            $.each( data.taxonomies, function( index, element ) {
                if ( element.ID == 0 ) {
                    enable_post_load = false;
                }

                $( '#imc_post_category_select' ).append( $( '<option></option>' ).text( element.Name ).val( element.ID ).attr( 'data-tax-type', element.Type ) );
            });
			$( '#imc_post_category_select' ).change();

            if ( enable_post_load ) {
                $( '#imc-insert-post-into-text' ).removeAttr( 'disabled' ).removeClass( 'disabled' );
            }


        });
    });

    



    /**
     * Load posts from a selected category. Updates when the selected category changes
	 * 
     */
    $( document.body ).on( 'change', '#imc_post_category_select', function( event ) {
        var action = $( this ).data( 'ajaxAction' );
		var email_action = $( this ).data( 'emailAction' );
		var post_type = $( '#imc_post_type_select' ).val();
		var tax_type = $( '#imc_post_category_select option:selected' ).data( 'taxType' );
        var cat_id = $( '#imc_post_category_select' ).val();
		//- clear the search box and any results
        $( '#imc_post_search' ).val( '' );
		$( 'ul#post_search_results' ).html( '' );

        $( '#imc_post_select, #imc_post_category_select, #imc-search-post, #imc-insert-post-into-text' ).attr( 'disabled', 'disabled' ).addClass( 'disabled' );
        $( '#imc-insert-post-select .spinner' ).addClass( 'is-active' );

        $.getJSON(
                ajaxurl,
                {
                    action: action,
                    email_action: email_action,
					post_type: post_type,
                    category_id: cat_id,
					tax_type: tax_type
                } ).done( function( data ) {

            $( '#imc_post_select' ).html( '' );

            var enable_post_load = true;
            $.each( data.posts, function( index, element ) {
                if ( element.ID == 0 ) {
                    enable_post_load = false;
                }

                $('#imc_post_select').prepend($('<option></option>').text(element.Name).val(element.ID));
            });


            $('select, #imc_post_search').removeAttr('disabled').removeClass('disabled');//.removeClass('ajax-select-loading');
            $('#imc-spinner').removeClass( 'is-active' );

            if (enable_post_load) {
                $('#imc-insert-post-into-text').removeAttr('disabled').removeClass('disabled');//.attr('href','#');
            }


        });
    });
	
	/**
	 * Returns a function, that, as long as it continues to be invoked, will not
	 * be triggered. The function will be called after it stops being called for
	 * N milliseconds. If `immediate` is passed, trigger the function on the
	 * leading edge, instead of the trailing.
	 */
	function debounce( wait, immediate, func ) {
		var timeout;
		return function() {
			var context = this, args = arguments;
			var later = function() {
				timeout = null;
				if ( ! immediate ) func.apply( context, args );
			};
			var callNow = immediate && ! timeout;
			clearTimeout( timeout );
			timeout = setTimeout( later, wait );
			if ( callNow ) func.apply( context, args );
		};
	};
	
	 /**
     * Load posts that match a search query and optionally a selected category
	 * 
     */
    $( document.body ).on( 'keyup', '#imc_post_search', debounce ( 250, false, function( event ) {
		var post_search = $( this ).val();
		if( post_search.length > 2 ){
			//- remove any selection from the posts dropdown menu
			$( '#imc_post_select option:selected' ).removeAttr( 'selected' );
			var action = $( this ).data('ajaxAction');
			var cat_id = $( '#imc_post_category_select' ).val();
			var post_type = $( '#imc_post_type_select' ).val();
			var tax_type = $( '#imc_post_category_select option:selected' ).data( 'taxType' );

			$( 'select, #imc-search-post, #imc-insert-post-into-text').attr('disabled', 'disabled').addClass( 'disabled' );
			$( '#imc-spinner').addClass( 'is-active' );

			$.getJSON(
                ajaxurl,
                {
                    action: action,
                    email_action: 'load_posts_by_category',
                    post_type: post_type,
                    category_id: cat_id,
					tax_type: tax_type,
                    post_search: post_search
                }).done( function( data ) {

            var enable_post_load = true;
			$( '#post_search_results' ).html( '' );
			
            $.each( data.posts, function( index, element ) {
                if ( element.ID == 0 ) {
                    enable_post_load = false;
					$( '#post_search_results' ).append( '<button type="button" class="list-group-item">' + element.Name + '</button>' ).show();
                }
				else{
					$( '#post_search_results' ).append( '<button type="button" class="list-group-item" data-post-id="' + element.ID + '">' + element.Name + '</button>' ).show();
				}

            });


            $('select, #imc-search-post').removeAttr('disabled').removeClass('disabled');//.removeClass('ajax-select-loading');
            $('#imc-spinner').removeClass( 'is-active' );

            if (enable_post_load) {
                $('#imc-insert-post-into-text').removeAttr('disabled').removeClass('disabled');//.attr('href','#');
            }
			});
		}
		//- clear the results if the input is empty
		else{
			if( post_search.length < 1 ){
				$( '#post_search_results' ).html( '' );
			}	
		}
    } ) );
	
	/**
	 * Grab ID when choosing a post
	 * The matching posts are displayed using Bootstrap's button class
	 */
	$( document.body ).on( 'click', '#post_search_results button', function( event ){
		selected_post_id = $( this ).data('postId');
		$( '#imc_post_search' ).val( $( this ).text() );
		$( '#post_search_results' ).html( '' );
		$( '#imc_post_select' ).val( '' );
	});
	/**
     * (4/2016) - New post insert functionality
     */
    $( document.body ).on( 'click', '#imc-insert-post-button', function( event ) {
        event.preventDefault();
		$( "#imc-insert-post-select").slideToggle();
        return false;

    });
    
        
    /**
     * (4/2016) - New post insert functionality
     */
    $( document.body ).on( 'click', '#imc-insert-post-into-text', function( event ) {
        event.preventDefault();
        
        var action = $( this ).data( 'ajaxAction' );
		
		var email_action = $( this ).data('emailAction' );
        
        var post_id = ( selected_post_id ) ? selected_post_id : $( '#imc_post_select' ).val();

		var post_length = $( 'input[name="imc_insert_type"]:checked' ).val();

        var current_el = this;
        
        if ( post_id > 0 ) {
        
            $( '#imc_post_select, #imc_post_category_select, #imc-search-post, #imc-insert-post-into-text' ).attr( 'disabled', 'disabled' ).addClass( 'disabled' );
            
            $( '#imc-insert-post-select .spinner' ).addClass( 'is-active' );

            $.getJSON(
                        ajaxurl,
                        {
                            action: action,
                            email_action: email_action,
                            post_id: post_id,
							post_length: post_length
                        }).done( function( data ) {

                    var post_content = data.post_content;

                    tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, post_content );
					$( '#post_search_results' ).html( '' );
					$( '#imc-search-post' ).val( '' );
					$( "#imc-insert-post-select").slideToggle();
                    $('#imc_post_select, #imc_post_category_select, #imc-search-post, #imc-insert-post-into-text').removeAttr('disabled').removeClass('disabled');
                
                    $('#imc-insert-post-select .spinner').removeClass( 'is-active' );

                });
        }
        return false;

    });
    

    $('button.imc-email-process').click(function(event) {
        event.preventDefault();

        $('#imc-email-campaign-message').html('').addClass('template-loading').show();

        var current_action = $(this).data('ajaxAction');
        //- strip out the default content field
        //- var form_data = $('input[name!=content]', form).serialize();
        var form_data = $(this).closest('form').serialize();
        $.post(
                ajaxurl,
                {'form_data': form_data, action: 'ajax_save_campaign', current_action: current_action},
        function(resp) {
            var message_class = 'updated';
            var this_message = null;
            if (resp instanceof Array || resp instanceof Object) {
                for (var key in resp) {
                    this_message = null;
                    switch (key) {
                        case 'msg':
                            this_message = resp[key];
                            break;
                        case 'cid':
                            $('input[name=imc_campaign_id]').val(resp[key]);
                            break;
                        case 'reload':
                            setTimeout(function() {
                                window.location = resp[key];
                            }, 2000);
                            //this_message = '<div>Reloading page ...</div>';
                            break;
                        default:
                            this_message = '<div>' + resp[key] + '</div>';
                            message_class = 'error';
                            $('#' + key).addClass('highlight-error');
                            break;
                    }

                    if (this_message) {
                        $('#imc-email-campaign-message').append(this_message);
                    }
                }
            }

            $('#imc-email-campaign-message').hide()
                    .removeClass('error')
                    .removeClass('updated, template-loading')
                    .addClass(message_class)
                    .show();


        });
    });

    var imc_init_run = false;

    function imc_tinymce_init() {
        var init, edId, qtId, firstInit, wrapper;

        if (typeof tinyMCE !== 'undefined') {
            for (edId in tinyMCEPreInit.mceInit) {
                if (edId !== 'content') {
                    if (firstInit) {
                        init = tinyMCEPreInit.mceInit[edId] = tinyMCE.extend({}, firstInit, tinyMCEPreInit.mceInit[edId]);
                    } else {
                        init = firstInit = tinyMCEPreInit.mceInit[edId];
                    }

                    wrapper = tinyMCE.DOM.select('#wp-' + edId + '-wrap')[0];

                    if (true) {
                        try {
                            tinyMCE.init(init);

                            imc_init_run = true;

                            if (!window.wpActiveEditor) {
                                window.wpActiveEditor = edId;
                            }
                        } catch (e) {
                            console.log('Error initializing tinyMCE: ');
                            console.log(e);
                        }
                    } else {
                        //console.log('---- Skipping tinyMCE.init()-----');
                    }
                } else {
                    //console.log('---- Skipping mceInit-----');
                }
            }
        }

        if (typeof quicktags !== 'undefined') {
            //-console.log(tinyMCEPreInit);
            for (qtId in tinyMCEPreInit.qtInit) {
                if (qtId !== 'content') {
                    try {

                        quicktags(tinyMCEPreInit.qtInit[qtId]);

                        if (!window.wpActiveEditor) {
                            window.wpActiveEditor = qtId;
                        }
                    } catch (e) {
                        console.log('Error initializing tinyMCE QuickTags: ');
                        console.log(e);
                    }

                }
            }
        } else {
            console.log('---- quicktags() is undefined -----');
        }

        if (!imc_init_run) {
            if (typeof jQuery !== 'undefined') {
                jQuery('.wp-editor-wrap').on('click.wp-editor', function() {
                    if (this.id) {
                        window.wpActiveEditor = this.id.slice(3, -5);
                    }
                });
            } else {
                for (qtId in tinyMCEPreInit.qtInit) {
                    if (qtId !== 'content') {
                        document.getElementById('wp-' + qtId + '-wrap').onclick = function() {
                            window.wpActiveEditor = this.id.slice(3, -5);
                        };
                    }
                }
            }
        }

    }

});

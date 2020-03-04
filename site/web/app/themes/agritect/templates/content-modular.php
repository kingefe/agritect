<?php /* Modular Layout */


// check if the flexible content field has rows of data
if( have_rows('modules') ):
     // loop through the rows of data
    while ( have_rows('modules') ) : the_row();

        if( get_row_layout() == 'content' ) {
          echo '<div class="module container '.get_sub_field('style').' '.get_sub_field('class').'"><div class="row">';
          the_sub_field('content');
          echo '</div></div>';

        }
        elseif( get_row_layout() == 'hero' ) {

          echo '<div class="module hero container">';

          echo '<h2>'.get_sub_field('headline').'</h2>';
          $button = get_sub_field('button');
          echo '<a href="'.$button['url'].'" class="btn btn-primary">'
            .$button['text'].
            '</a>';

          if(is_array(get_sub_field('partners'))) {
            echo '<div class="row partners">';
            foreach(get_sub_field('partners') as $partner) {
              echo '<div class="partner col-12 col-md-4">'.
                '<a href="'.$partner['url'].'">'.
                '<img src="'.$partner['logo']['sizes']['medium'].'"
                alt="'.$partner['name'].'" />'.
                '</a></div>';
            }
            echo '</div>';
          }

          echo '</div>';

        }
        elseif( get_row_layout() == 'steps' ) {
          echo '<div class="module steps dark container">';
          echo '<div class="row"><h3>'
            .get_sub_field('headline').
            '</h3></div>';
          if(is_array(get_sub_field('steps'))) {
            $n=0;
            foreach(get_sub_field('steps') as $step) {
              $n++;
              echo '<div class="row step">'
                .'<div class="content col-12 col-sm-7">'
                  .'<h4>Step '.$n.':<br />'.$step['title'].'</h4>'
                  .'<p>'.$step['content'].'</p>'
                .'</div>'
                .'<div class="graphic col-12 col-sm-5">'
                  .'<img src="'.$step['graphic']['sizes']['large'].'" alt="'.$step['title'].'" />'
                .'</div>'
              .'</div>';
            }
          }
          echo '</div>';
        }

    endwhile;
else :
    // no layouts found
endif;



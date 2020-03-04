<h2 class="text-uppercase"><div class="text-highlight"><span><?php the_title(); ?></span></div></h2>
<?php the_content(); ?>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>

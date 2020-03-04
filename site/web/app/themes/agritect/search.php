<?php get_template_part('templates/page', 'header'); ?>

<div class="blog-parts">

	<div class="container blog-directory"><div class="row justify-content-between">
		<div class="col-content col col-xs-12">

			<?php if (!have_posts()) : ?>
			  <div class="alert alert-warning">
			    <?php _e('Sorry, no results were found.', 'sage'); ?>
			  </div>
		  <?php get_search_form(); ?>
			  <br /><br />
			<?php endif; ?>

			<?php /* while (have_posts()) : the_post(); ?>
			  <?php get_template_part('templates/content', 'search'); ?>
			<?php endwhile; */ ?>

			<div class="row blog-icons"><?php while (have_posts()) : the_post(); ?>
			  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3"><?php get_template_part('templates/content', 'post'); ?></div>
			<?php endwhile; ?></div>

			<?php the_posts_navigation(); ?>

		</div>
	</div></div>

	<div class="container-fluid blog-nav">
		<?php get_template_part('templates/sidebar', 'blog'); ?>
	</div>

</div>
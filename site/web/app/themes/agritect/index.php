<?php get_template_part('templates/page', 'header'); ?>


<div class="blog-parts">

	<? if(is_home()) {
	// Show Featured Article if there's a Sticky Post
	$sticky = get_option( 'sticky_posts' );
	$args = array(
		'posts_per_page' => 1,
		'post__in'  => $sticky,
		'ignore_sticky_posts' => 1
	);
	$query = new WP_Query( $args );
	if ( isset($sticky[0]) ) { ?>
		<div class="featured"><a href="<?= get_the_permalink( $sticky[0] ) ?>">
			<div class="container">
				<h6>Featured Article</h6>
				<h3><?= fw_span(get_the_title($sticky[0])); ?></h3>
			</div>
			<div class="container-fluid" style="background-image: url('<?= get_the_post_thumbnail_url( $sticky[0] ); ?>')">
			</div>
		</a></div>
	<? } } ?>


	<div class="container blog-directory"><div class="row justify-content-between">
		<div class="col-content col col-xs-12">

			<?php if (!have_posts()) : ?>
			  <div class="alert alert-warning">
			    <?php _e('Sorry, no results were found.', 'sage'); ?>
			  </div>
			  <?php get_search_form(); ?>
			<?php endif; ?>

			<div class="row blog-icons"><?php while (have_posts()) : the_post(); ?>
			  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3"><?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?></div>
			<?php endwhile; ?></div>

			<?php the_posts_navigation(); ?>

		</div>
	</div></div>

	<div class="container-fluid blog-nav">
		<?php get_template_part('templates/sidebar', 'blog'); ?>
	</div>

</div>
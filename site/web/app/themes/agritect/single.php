<? // PAGE HEADER ?>

<div class="page-header">
	<div class="background-panel" style="background-image: url(<?= get_the_post_thumbnail_url( get_the_ID(), 'full' )?>);"></div>
	<div class="container-fluid align-self-bottom"><div class="container">
		<a class="backlink" href="javascript: history.go(-1)">Back</a>
		<h1 class="page_title"><?= fw_span(get_the_title()); ?></h1>
		<p><?php the_author_meta( 'display_name', $post->post_author ); ?> | <?= get_the_date( 'F Y' ); ?></p>
	</div></div>
	</div>

<? // PAGE CONTENT ?>

<div class="container-fluid">

	<div class="blog-parts row">

		<div class="blog-content container">
			<div class="col-content col col-xs-12">
				<?php get_template_part('templates/content-single', get_post_type()); ?>
			</div>
		</div>

		<div class="container blog-social">
			<div class="col-sidebar col-auto">
				<?php get_template_part('templates/sidebar', 'blog-social'); ?>
			</div>
		</div>

	</div>

</div>

<?php related_posts(); ?>    


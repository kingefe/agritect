<?php 
$thumb='';
if(strlen(get_the_post_thumbnail_url(get_the_ID()))>0) { 
	$thumb = 'background-image: url('.get_the_post_thumbnail_url( get_the_ID(), 'small' ).')';
} 
?>

<article <?php post_class(); ?>>
<a href="<?php the_permalink(); ?>">
	<div class="square" style="<?=$thumb?>"> </div>
	<h2 class="entry-title"><?php the_title(); ?></h2>
</a>
<p><?= wp_trim_words(get_the_excerpt(),17,''); ?></p>
<?php get_template_part('templates/entry-meta'); ?>
</article>
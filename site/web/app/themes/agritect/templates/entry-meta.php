<div class="post_meta">
<p>
	<?

	// Categories
	$postcats = get_the_category();
	if ($postcats) {
		foreach($postcats as $cat) { 
    		echo '<a href="'.get_category_link($cat->term_id).'">'.$cat->name. '</a> <br />'; 
		}
	}

	// Tags
	$posttags = get_the_tags();
	if ($posttags) {
		foreach($posttags as $tag) {
			echo '<a href="'.get_category_link($tag->term_id).'">#'.$tag->name . '</a> '; 
		}
		echo '<br />';
	}

	// Author
	if(get_the_author_posts_link()) { 
		the_author_posts_link();
	}

	?>
</p>	

<p>
	<time class="updated" datetime="<?= get_post_time('c', true); ?>"><?= get_the_date( 'm/d/Y' ); ?></time>
</p>

</div>

<?php use Roots\Sage\Titles; ?>

<?php

// Declare variables
	wp_reset_postdata();
	global $cmb_pre;
	$header_type='';
	$header_style='';
	$header_content='';
	$header_background='';
	$header_overlay='';
	$header_sub='';
	$header_sub_theme='bg-pink';

?>

<div class="page-header <?=$header_type;?>" data-king="test">
	<div class="background-panel" style="<?=$header_style;?>"><?=$header_background;?></div>
	<div class="container-fluid align-self-bottom"><div class="container"><?=$header_content;?></div></div>
	<?=$header_overlay;?>
	</div>
<?=$header_sub;?>

<?php

// defaults
$details = get_option('404_details');

if(isset($details[cmb_pre().'404_title'])) { 
	$page_title = fw_span($details[cmb_pre().'404_title']);
} 
else { 
	$page_title = fw_span('Uh oh.');
}

if(isset($details[cmb_pre().'404_subtitle'])) { 
	$page_subtitle = $details[cmb_pre().'404_subtitle'];
} 
else { 
	$page_subtitle = 'We can\'t find the page you\'re looking for.';
}

if(isset($details[cmb_pre().'404_content'])) { 
	$page_content = $details[cmb_pre().'404_content'].'<div class="clear" style="padding-top:2em; padding-bottom: 2em"></div>';
} 
else { 
	$page_content = '';
}

?>

<div class="page-header" data-king="test-2">
	<div class="background-panel" style=""></div>
	<div class="container-fluid align-self-bottom"><div class="container"><h1 class="page_title"><?=$page_title?></h1></div></div>
	</div>

<div class="header_sub"><div class="container"><?=$page_subtitle?></div></div>
    	
<div class="container" style="padding-top: 6em; padding-bottom: 6em">
	<?=$page_content?>
	<?php get_search_form(); ?>
</div>

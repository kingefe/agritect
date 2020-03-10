<?php
// Program / Country CTAs
function program_cta_shortcode( $atts, $content = "" ) {
  $atts = shortcode_atts(array(
    'loc'     => '', // top or end
    'show'    => '', // (by) default, else requires true toggle
    'default_content' => '', // blurb
    'default_button'  => 'Chat', // button text
    'default_type'    => 'url', // url or webtolead
    'default_url'     => '#def', // button url
    'default_leadid'  => '', // webtolead campaign ID
    'default_leadret' => '', // webtolead return URL
    'default_leadintro' => '', // webtolead form intro text
  ),$atts);

  /* set $atts['vars'] to $vars */
  foreach($atts as $key=>$val) { $$key = $val; }

  if (
    ( $show == 'default' && vo_meta('cta_toggle_'.$loc) != false ) // show by default & not hidden
    || ( vo_meta('cta_toggle_'.$loc)==true ) // visibility toggle is "true"
   ) {
    $cta_content = vo_meta('cta_content_'.$loc) ? : $default_content;
    $cta_button  = vo_meta('cta_button_'.$loc) ?: $default_button;
    $cta_type    = vo_meta('cta_type_'.$loc) ?: $default_type;
    $cta_url     = vo_meta('cta_url_'.$loc) ?: $default_url;
    $cta_leadid  = vo_meta('cta_leadid_'.$loc) ?: $default_leadid;
    $cta_leadret = vo_meta('cta_leadret_'.$loc) ?: get_the_permalink();
    $cta_leadintro = vo_meta('cta_leadintro_'.$loc) ?: $default_leadintro;
    $modal = $cta_type == 'webtolead' ? 'data-toggle="modal" data-target="#ctaModal_'.$loc.'"' : '';
?>
  <div class="bg-light" style="padding: 4em 0">
  <div class="container"><div class="row text-center"><div class="col">

    <img src="<?= get_template_directory_uri(); ?>/assets/images/logo/ventureout-logo.png" alt="ventureout" width="80" /><br /><br />
    <h6 style="color:black"><?=$cta_content?></h6><br />
    <a href="<?=$cta_url?>" class="button min" style="float:none;display: inline-block;" <?=$modal?>><?=$cta_button?></a>

  </div></div></div>
  </div>

<? if ($cta_type == 'webtolead') { ?>
  <div class="modal fade webtolead" id="ctaModal_<?=$loc?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <?= wpautop($cta_leadintro) ?>
          <?= do_shortcode('[webtolead campaign="'.$cta_leadid.'" return="'.$cta_leadret.'"]') ?>
        </div>
      </div>
    </div>
  </div>
<?
    } // end modal if webtolead
  } // end toggle CTA visibility
} // end shortcode func.
add_shortcode( 'program_cta', 'program_cta_shortcode' );
?>

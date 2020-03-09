<?php
/**
 * Template for displaying title of section in single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/section/title.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$user        = learn_press_get_current_user();
$course      = learn_press_get_the_course();
$user_course = $user->get_course_data( get_the_ID() );

if ( ! isset( $section ) ) {
	return;
}

$title = $section->get_title();


$items = $section->get_items();

foreach ($items as $item) {
    $permalink = $item->get_permalink();
    $image = get_the_post_thumbnail($item->get_id());
    if ($permalink) {
        break;
    }
}

?>
<div class="row no-gutters">
    <div class="col-md-5">
        <a class="section-image" href="<?php echo $permalink; ?>">
            <?php echo $image; ?>
        </a>
    </div>
    <div class="col-md-7">
        <div class="section-info">
            <h5 class="section-stt">
                <a href="<?php echo $permalink; ?>" title="<?php echo $title; ?>">
                Lesson <?php echo $section->get_id(); ?>.
                </a>
            </h5>
            <?php if ( $title ) { ?>
                <h5 class="section-title"><?php echo $title; ?></h5>
            <?php } ?>

            <?php if ( $description = $section->get_description() ) { ?>
                <p class="section-desc"><?php echo $description; ?></p>
            <?php } ?>
          
            <p class="float-right foot-txt">
                <?php echo $section->count_items(); ?> modules
            </p>

            <span class="section-status"><i class="fa fa-check"></i></span>

        </div>
    </div>

</div>




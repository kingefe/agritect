<?php
/**
 * Template for displaying course content within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-single-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

if ( post_password_required() ) {
	echo get_the_password_form();

	return;
}

/**
 * @deprecated
 */
do_action( 'learn_press_before_main_content' );
do_action( 'learn_press_before_single_course' );
do_action( 'learn_press_before_single_course_summary' );

/**
 * @since 3.0.0
 */
do_action( 'learn-press/before-main-content' );

do_action( 'learn-press/before-single-course' );

?>
<?php 

$course = LP_Global::course();

$course_id = $course->get_id();

$user        = learn_press_get_current_user();

if ($user->is_author_of($course_id) || $user->is_admin() || $user->can_access_course($course_id)) { ?>
	<h2 class="text-uppercase">
		<div class="text-highlight"><span>LESSON OVERVIEW</span></div>
	</h2>

	<?php 

		$curriculum = $course->get_curriculum();

		if ( $curriculum = $course->get_curriculum() ) {

            echo '<ul class="curriculum-sections">';

			foreach ( $curriculum as $section ) {
				learn_press_get_template( 'single-course/loop-section.php', array( 'section' => $section ) );
			} 

			echo '</ul>';

		}

	 ?>
<?php } else {

	if ( ! $price = $course->get_price_html() ) {

		return;
	
	}
	$images = get_the_post_thumbnail($course_id);
	$curriculums = $course->get_curriculum();
	$count_curr = 0;
	$duration = 0;
	foreach ($curriculums as $curr) {
		$count_curr++;
		// foreach ($curr->get_items() as $item) {
		// 	$duration = $duration + $item->get_duration();
		// }
	}
?>

<div id="learn-press-course" class="course-summary">
	<h2 class="text-uppercase">
		<div class="text-highlight"><span>Course Preview</span></div>
	</h2>
	<h4 class="title-course"><?php the_title(); ?></h4>
	
	<?php
	/**
	 * @since 3.0.0
	 *
	 * @see learn_press_single_course_summary()
	 */
	do_action( 'learn-press/single-course-summary' );
	?>
</div>

<div class="unlock-section">
	<h2 class="text-uppercase"><div class="text-highlight"><span>UNLOCK ALL <?php echo $count_curr; ?> CLASS</span></div></h2>
	<div class="row">
		<div class="col-md-6 order-md-1 order-2">
			<div class="cover-wrapper">
				<div class="slider-cover">
					<?php echo $images; ?>
				</div>
				<div class="bottom-wrap">
					<h4 class="title">
						<?php the_title(); ?>
					</h4>
					<p class="time">
						<?php echo minutes($course->get_duration()); ?>
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-6 order-md-2 order-1">
			<h3>Purchase the class today with only <?php echo $price; ?></h3>

			<?php do_action( 'learn-press/before-course-buttons' ); ?>
			<?php
			/**
			 * @see learn_press_course_purchase_button - 10
			 * @see learn_press_course_enroll_button - 10
			 * @see learn_press_course_retake_button - 10
			 */
			do_action( 'learn-press/course-buttons' );
			?>
			<?php do_action( 'learn-press/after-course-buttons' ); ?>

		</div>
	</div>
</div>

<?php 

}  ?>

<?php

/**
 * @since 3.0.0
 */
do_action( 'learn-press/after-main-content' );

do_action( 'learn-press/after-single-course' );

/**
 * @deprecated
 */
do_action( 'learn_press_after_single_course_summary' );
do_action( 'learn_press_after_single_course' );
do_action( 'learn_press_after_main_content' );
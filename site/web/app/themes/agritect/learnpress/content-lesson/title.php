<?php
/**
 * Template for displaying title of lesson.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-lesson/title.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$lesson = LP_Global::course_item();

if ( ! $title = $lesson->get_title( 'display' ) ) {
	return;
}

$description = get_field('lesson_description', $lesson->get_id());
?>

<h3 class="course-item-title question-title">
	<div class="text-highlight"><span><?php echo $title; ?></span></div>
</h3>

<?php if ($description) {
	echo '<p class="module-description">'.$description.'</p>';
} ?>

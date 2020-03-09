<?php
/**
 * Template for displaying description of lesson.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-lesson/description.php.
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

// lesson no content
if ( ! $content = $lesson->get_content() ) {
	learn_press_get_template( 'content-lesson/no-content.php' );

	return;
}
?>

<nav>
  	<div class="nav nav-tabs" id="nav-tab" role="tablist">
    	<a class="nav-item nav-link active" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">About the Class</a>
    	<a class="nav-item nav-link" id="assignment-tab" data-toggle="tab" href="#assignment" role="tab" aria-controls="assignment" aria-selected="false">Assignment</a>
  	</div>
</nav>
<div class="tab-content" id="nav-tabContent">
	<div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
		<div class="content-item-description lesson-description"><?php echo $content; ?></div>
	</div>
	<div class="tab-pane fade" id="assignment" role="tabpanel" aria-labelledby="assignment-tab">
	  	<?php
			$files = get_field('assignment',$lesson->get_id());
			if ($files) {
				echo "<ul>";
				foreach ($files as $file) {
					echo "<li><a href='".$file['file']."'><i class='fa fa-file'></i>".$file['title_document']."</a></li>";
				}
				echo "</ul>";
			}
		?>
	</div>
</div>
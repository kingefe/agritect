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


do_action( 'learn-press/before-main-content' );

do_action( 'learn-press/before-single-item' );

$course      = learn_press_get_the_course();
$item   = LP_Global::course_item();

$user        = learn_press_get_current_user();

if (!$user->is_author_of($course_id) && !$user->is_admin() && !$user->can_access_course($course_id)) { ?>

	<div class="content-item-scrollable-ct">

        <div class="content-item-wrap">

			

			<div class="learn-press-content-protected-message">

			    <span class="icon"></span>

				This content is protected, please <a href="<?php echo wp_login_url(); ?>">login</a> and enroll course to view this content!
			</div>


	        </div>

	    </div>
<?php die; }
if ( $curriculum = $course->get_curriculum() ) { 

	foreach ( $curriculum as $section ) {

		foreach ($section->get_items() as $item_section) {
			
			if ($item_section->get_id() == $item->get_id()) {

				$curr_section = $section;

				$section_tile = $section->get_title();

				$section_id = $section->get_id();

				$section_order = $section->get_order();
				
				break 2; 
				
			}
			
		}

	} 
}

?>
<div class="single-module">
	<div class="row">
		<div class="col-12">
			<h2 class="text-uppercase">
				<div class="text-highlight"><span>LESSON <?php echo $section_id; ?>.</span></div>
			</h2>
			
		</div>
		<div class="col-md-8">
			<?php if ($section_tile) { 
				echo '<h4 class="course-title">'.$section_tile.'</h4>';
			} 
			?>
			<div class="video-wrap">
				<?php

				$video = get_field('iframe_video',$item->get_id());

				if ($video) {
					echo $video;
				}
				
				?>
			</div>
			<div id="learn-press-course" class="course-summary">
				<?php
				/**
				 * @since 3.0.0
				 *
				 * @see learn_press_single_item_summary()
				 */
				do_action( 'learn-press/single-item-summary' );
				?>
			</div>
		</div>
		<div class="col-md-4">
			<div class="mark-as-complete">
				<?php 
		
				if ( $item->is_preview() ) {
					return;
				}

				$completed = $user->has_completed_item( $item->get_id(), $course->get_id() );
				$security  = $item->create_nonce( 'complete' );
				?>

				<form method="post" name="learn-press-form-complete-lesson"
				      data-confirm="<?php ! $completed ? LP_Strings::esc_attr_e( 'confirm-complete-lesson', '', array( $item->get_title() ) ) : ''; ?>"
				      class="learn-press-form form-button<?php echo $completed ? ' completed' : ''; ?>">

					<?php do_action( 'learn-press/lesson/before-complete-button' ); ?>

					<?php if ( $completed ) { ?>

				        <p><i class="fa fa-check"></i> <?php echo __( 'Completed', 'learnpress' ); ?></p>

					<?php } else { ?>

				        <input type="hidden" name="id" value="<?php echo $item->get_id(); ?>"/>
				        <input type="hidden" name="course_id" value="<?php echo $course->get_id(); ?>"/>
				        <input type="hidden" name="complete-lesson-nonce" value="<?php echo esc_attr( $security ); ?>"/>
				        <input type="hidden" name="type" value="lp_lesson"/>
				        <input type="hidden" name="lp-ajax" value="complete-lesson"/>
				        <input type="hidden" name="noajax" value="yes"/>
				        <button class="lp-button button button-complete-item button-complete-lesson"><?php echo __( 'Mark Complete:', 'learnpress' ); ?> <i class="fa fa-check"></i></button>

					<?php } ?>

					<?php do_action( 'learn-press/lesson/after-complete-button' ); ?>

				</form>
			</div>
			<div class="modules-wrap">

				<?php 

				if ($curr_section->get_items()) {
					$count = 0;
					echo '<ul class="modules-list">';
					global $wp;
					$current_url  = home_url( $wp->request ).'/';
			
					foreach ($curr_section->get_items() as $module_item) {
				
						$count++;
						echo '<li>';
						?>
						<?php
						if ( $module_item->is_visible() ) {

							do_action( 'learn-press/begin-section-loop-item', $module_item );

							if ( $user->can_view_item( $module_item->get_id() ) ) {

								?>
		                        <a class="section-item-link <?php if ($current_url == $module_item->get_permalink()) echo 'active'; ?>" href="<?php echo $module_item->get_permalink(); ?>">
									<?php learn_press_get_template( 'single-course/section/content-item.php', array(
										'item'    => $module_item,
										'section' => $curr_section
									) ); ?>
		                        </a>
							<?php } else { 


								?>
		                        <div class="section-item-link">
									<?php learn_press_get_template( 'single-course/section/content-item.php', array(
										'item'    => $module_item,
										'section' => $curr_section
									) ); ?>
		                        </div>
							<?php } ?>

							<?php
	
							do_action( 'learn-press/end-section-loop-item', $module_item );
						}

						?>
						<?php

						echo '</li>';
					} 

					echo '</ul>';
					if ($count>5) {

						echo '<div class="scolldown"><i class="fa fa-chevron-down"></i></div>';
					}

				}

				?>
			</div>
		</div>
		<div class="col-12">
			<div class="continue-watching">
			<h4>Continue Watching</h4>
			<?php 

				if ( $curriculum = $course->get_curriculum() ) { 

					echo '<div class="row">';

					foreach ( $curriculum as $section ) { 

						$title = $section->get_title();
						$order = $section->get_order();

						if($order > $section_order) {

							$items_lesson = $section->get_items();
							$duration = 0;

							foreach ($items_lesson as $item_les) {
							    $permalink = $item_les->get_permalink();
							    $image = get_the_post_thumbnail($item_les->get_id());
							    $duration = $item_les->get_duration();
							    if ($permalink) {
							        break;
							    }
							}

						?>
						<div class="col-md-4">
							<a class="item-lesson" href="<?php echo $permalink; ?>">	
								<h4 class="section-stt">
					                Lesson <?php echo $section->get_id(); ?>.
					            </h4>
								
					            <div class="image">
					            	<?php echo $image; ?>
					            </div>

						        <div class="section-info">
						            <?php if ( $title ) { ?>
						                <h4 class="section-title"><?php echo $title; ?></h4>
						            <?php } ?>

						            <p class="duration"><?php echo $duration; ?></p>

						        </div>
							</a>
						</div>

					<?php }

					}

					echo '</div>';

				}
			?>
			</div>
		</div>
	</div>
</div>
<?php

/**
 * @since 3.0.0
 */
do_action( 'learn-press/after-main-content' );

do_action( 'learn-press/after-single-course' );

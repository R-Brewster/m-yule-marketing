<?php
/**
 * Student Account - View Courses.
 *
 * This template can be overridden by copying it to yourtheme/wp-courseware/account/account-view-courses.php.
 *
 * @package WPCW
 * @subpackage Templates\Account
 * @version 4.6.4
 *
 * Variables available in this template:
 * ---------------------------------------------------
 * @var array $courses The array of student courses.
 * @var int $current_page The current page of the student courses.
 * @var string $courses_table The courses table.
 * @var string $settings The courses table settings.
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

$courses_columns = apply_filters( 'wpcw_student_account_courses_columns', array(
	'course-title'    => esc_html__( 'Course', 'wp-courseware' ),
) );

if ( $courses ) : ?>
	<h2><?php echo apply_filters( 'wpcw_student_account_courses_title', esc_html__( 'Enrolled Courses', 'wp-courseware' ) ); ?></h2>

    <div class="my-courses">
        <?php 
            foreach($courses as $course){
                $the_course = get_object_vars($course);
                //var_dump($the_course);

                $course_id = $the_course["course_id"];
                $course_title = $the_course["course_title"];
                $course_img = $the_course["course_desc"]; ?>
                <div class="course">
                    <h4><?php echo $course_title;?></h4>
                    <?php echo $course_img;?>
                    <div class="complete-course-content"><?php echo do_shortcode('[wpcourse course='. $course_id .']');?></div>
                </div>
            <?php }
        ?>
    </div>

    <script>
        jQuery('.my-courses .course').each(function() {
            let courseLink = jQuery(this).find('.complete-course-content tbody tr.wpcw_fe_module_group_1 a').attr('href');
            jQuery(this).append(`<a class='button' href='${courseLink}'>View Course</a>`);
            jQuery(this).find('.complete-course-content').remove();
        })
    </script>

<?php else : ?>
	<?php wpcw_print_notice( sprintf( __( 'You are not enrolled in any courses. <a href="%s">View Courses &rarr;</a>', 'wp-courseware' ), wpcw_get_page_permalink( 'courses' ) ), 'info' ); ?>
<?php endif; ?>

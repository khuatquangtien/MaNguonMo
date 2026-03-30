<?php
/**
 * Plugin Name: LearnPress Stats Dashboard
 * Description: Hiển thị thống kê LearnPress
 * Version: 1.0
 * Author: Huy
 */

// Tổng số khóa học
function lp_total_courses() {
    $args = array(
        'post_type' => 'lp_course',
        'post_status' => 'publish'
    );
    return count(get_posts($args));
}

// Tổng số học viên
function lp_total_students() {
    $args = array(
        'role__in' => array('subscriber', 'author', 'contributor')
    );
    return count(get_users($args));
}

// Số khóa học đã hoàn thành
function lp_completed_courses() {
    global $wpdb;
    $table = $wpdb->prefix . 'learnpress_user_items';

    return $wpdb->get_var("
        SELECT COUNT(*)
        FROM $table
        WHERE status = 'completed'
        AND item_type = 'lp_course'
    ");
}

// Hiển thị Dashboard
function lp_stats_widget() {
    echo "<h3>Thống kê LearnPress</h3>";
    echo "<p>📚 Tổng khóa học: " . lp_total_courses() . "</p>";
    echo "<p>👨‍🎓 Tổng học viên: " . lp_total_students() . "</p>";
    echo "<p>✅ Khóa học hoàn thành: " . lp_completed_courses() . "</p>";
}

// Thêm vào Dashboard
function lp_add_dashboard_widget() {
    wp_add_dashboard_widget(
        'lp_stats_dashboard',
        'LearnPress Stats',
        'lp_stats_widget'
    );
}
add_action('wp_dashboard_setup', 'lp_add_dashboard_widget');

// Shortcode
function lp_stats_shortcode() {
    $output = "<div style='padding:10px;border:1px solid #ccc'>";
    $output .= "<h3>📊 Thống kê khóa học</h3>";
    $output .= "<p>📚 Tổng khóa học: " . lp_total_courses() . "</p>";
    $output .= "<p>👨‍🎓 Tổng học viên: " . lp_total_students() . "</p>";
    $output .= "<p>✅ Hoàn thành: " . lp_completed_courses() . "</p>";
    $output .= "</div>";
    // Trả về HTML để hiển thị
    return $output;
}
add_shortcode('lp_total_stats', 'lp_stats_shortcode');
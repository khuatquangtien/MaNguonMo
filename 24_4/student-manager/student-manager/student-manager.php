<?php
/**
 * Plugin Name: Student Manager
 * Description: Plugin quản lý sinh viên dành cho bài tập thực hành.
 * Version: 1.0
 * Author: Tên của bạn
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once plugin_dir_path( __FILE__ ) . 'includes/register-cpt.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/meta-boxes.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/shortcode.php';

function student_manager_enqueue_styles() {
    wp_enqueue_style( 'student-manager-style', plugin_dir_url( __FILE__ ) . 'assets/style.css' );
}
add_action( 'wp_enqueue_scripts', 'student_manager_enqueue_styles' );
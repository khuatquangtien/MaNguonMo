<?php
function create_student_cpt() {
    $labels = array(
        'name'               => 'Sinh viên',
        'singular_name'      => 'Sinh viên',
        'menu_name'          => 'Sinh viên',
        'add_new'            => 'Thêm Sinh viên',
        'add_new_item'       => 'Thêm Sinh viên mới',
        'edit_item'          => 'Sửa Sinh viên',
        'all_items'          => 'Tất cả Sinh viên',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-welcome-learn-more', 
        'supports'           => array( 'title', 'editor' ), 
    );

    register_post_type( 'sinh_vien', $args );
}
add_action( 'init', 'create_student_cpt' );
<?php
function student_list_shortcode() {
    $args = array(
        'post_type'      => 'sinh_vien',
        'posts_per_page' => -1,
        'post_status'    => 'publish'
    );
    $query = new WP_Query( $args );

    ob_start();

    if ( $query->have_posts() ) {
        echo '<table class="student-manager-table">';
        echo '<thead><tr><th>STT</th><th>MSSV</th><th>Họ tên</th><th>Lớp</th><th>Ngày sinh</th></tr></thead>';
        echo '<tbody>';
        
        $stt = 1;
        while ( $query->have_posts() ) {
            $query->the_post();
            $post_id = get_the_ID();
            
            $mssv = get_post_meta( $post_id, '_student_mssv', true );
            $lop  = get_post_meta( $post_id, '_student_class', true );
            $ngay_sinh = get_post_meta( $post_id, '_student_dob', true );
            
            $ngay_sinh_format = $ngay_sinh ? date( 'd/m/Y', strtotime( $ngay_sinh ) ) : '';

            echo '<tr>';
            echo '<td>' . $stt++ . '</td>';
            echo '<td>' . esc_html( $mssv ) . '</td>';
            echo '<td>' . esc_html( get_the_title() ) . '</td>';
            echo '<td>' . esc_html( $lop ) . '</td>';
            echo '<td>' . esc_html( $ngay_sinh_format ) . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
        
        wp_reset_postdata(); 
    } else {
        echo '<p>Chưa có dữ liệu sinh viên nào.</p>';
    }

    return ob_get_clean(); 
}
add_shortcode( 'danh_sach_sinh_vien', 'student_list_shortcode' );
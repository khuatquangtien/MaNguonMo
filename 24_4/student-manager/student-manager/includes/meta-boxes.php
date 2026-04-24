<?php

function student_add_meta_box() {
    add_meta_box(
        'student_info_box',          
        'Thông tin chi tiết Sinh viên', 
        'student_meta_box_html',     
        'sinh_vien',                 
        'normal',                   
        'high'                      
    );
}
add_action( 'add_meta_boxes', 'student_add_meta_box' );

function student_meta_box_html( $post ) {

    wp_nonce_field( 'save_student_data', 'student_nonce' );
    $mssv = get_post_meta( $post->ID, '_student_mssv', true );
    $lop  = get_post_meta( $post->ID, '_student_class', true );
    $ngay_sinh = get_post_meta( $post->ID, '_student_dob', true );
    ?>
    <p>
        <label for="student_mssv"><b>Mã số sinh viên (MSSV):</b></label><br>
        <input type="text" id="student_mssv" name="student_mssv" value="<?php echo esc_attr( $mssv ); ?>" style="width:100%;">
    </p>
    <p>
        <label for="student_class"><b>Lớp/Chuyên ngành:</b></label><br>
        <select id="student_class" name="student_class" style="width:100%;">
            <option value="CNTT" <?php selected( $lop, 'CNTT' ); ?>>Công nghệ thông tin</option>
            <option value="Kinh tế" <?php selected( $lop, 'Kinh tế' ); ?>>Kinh tế</option>
            <option value="Marketing" <?php selected( $lop, 'Marketing' ); ?>>Marketing</option>
        </select>
    </p>
    <p>
        <label for="student_dob"><b>Ngày sinh:</b></label><br>
        <input type="date" id="student_dob" name="student_dob" value="<?php echo esc_attr( $ngay_sinh ); ?>" style="width:100%;">
    </p>
    <?php
}

function student_save_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['student_nonce'] ) || ! wp_verify_nonce( $_POST['student_nonce'], 'save_student_data' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( isset( $_POST['student_mssv'] ) ) {
        update_post_meta( $post_id, '_student_mssv', sanitize_text_field( $_POST['student_mssv'] ) );
    }
    if ( isset( $_POST['student_class'] ) ) {
        update_post_meta( $post_id, '_student_class', sanitize_text_field( $_POST['student_class'] ) );
    }
    if ( isset( $_POST['student_dob'] ) ) {
        update_post_meta( $post_id, '_student_dob', sanitize_text_field( $_POST['student_dob'] ) );
    }
}
add_action( 'save_post', 'student_save_meta_box_data' );
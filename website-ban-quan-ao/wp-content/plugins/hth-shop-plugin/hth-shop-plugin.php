<?php
/*
Plugin Name: HTH Shop Custom Features
Description: Plugin tùy biến chức năng dành riêng cho Shop Quần Áo HTH (Thêm cam kết mua hàng).
Version: 1.0
Author: Nhóm của bạn
*/

// Khóa bảo mật: Chặn người lạ truy cập trực tiếp vào file này
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* ====================================================================
   CHỨC NĂNG 1: THÊM BẢNG CAM KẾT DƯỚI NÚT "THÊM VÀO GIỎ HÀNG"
==================================================================== */

// Sử dụng hook của WooCommerce để chèn code vào đúng vị trí
add_action( 'woocommerce_after_add_to_cart_button', 'hth_them_cam_ket_chat_luong' );

function hth_them_cam_ket_chat_luong() {
    // In ra mã HTML hiển thị bảng cam kết
    echo '<div style="margin-top: 15px; padding: 15px; background-color: #ecf0f1; border-left: 4px solid #e74c3c; border-radius: 4px;">
            <strong style="color: #2c3e50; font-size: 16px;">🌟 Cam kết của HTH Shop:</strong>
            <ul style="margin-bottom: 0; padding-left: 20px; color: #34495e; font-size: 14px; margin-top: 5px;">
                <li>Đổi trả miễn phí trong 7 ngày nếu không vừa size.</li>
                <li><strong>Freeship</strong> cho đơn hàng từ 500.000đ.</li>
                <li>Chất vải chuẩn 100% như hình ảnh minh họa.</li>
            </ul>
          </div>';
}
?>
<?php

include(__DIR__ . '/model/ketnoi.php');
include($_SERVER['DOCUMENT_ROOT'] . '/QLBV/model/mPKQK.php');  

if (isset($_GET['maDonThuoc'])) {
    $maDonThuoc = $_GET['maDonThuoc'];
    $mDonThuoc = new mPKQK();

    $phieuthuoc = $mDonThuoc->getKQKham($maDonThuoc);
 
    header('Content-Type: application/json');
    if ($phieuthuoc) {
        echo json_encode($phieuthuoc);
    } else {
        echo json_encode([]); // Trả về mảng rỗng nếu không có dữ liệu
    }

}

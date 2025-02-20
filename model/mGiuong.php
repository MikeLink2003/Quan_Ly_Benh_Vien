<?php
include_once('ketnoi.php');

class mGiuong {
    public function getGiuongsByPhong($MaPhong) {

        $p = new clsKetNoi();
        $con = $p->moKetNoi();
        
        $sql = "
    SELECT giuong.MaGiuong, giuong.TenGiuong
    FROM giuong
    LEFT JOIN phieunamvien ON giuong.MaGiuong = phieunamvien.MaGiuong AND phieunamvien.TrangThai = 'Nhập viện'
    WHERE giuong.MaPhong = ?
    AND phieunamvien.MaGiuong IS NULL";

        $stmt = mysqli_prepare($con, $sql);
        
        mysqli_stmt_bind_param($stmt, 's', $MaPhong); 
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        $giuongs = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $giuongs[] = $row;
        }
        
        $p->dongKetNoi($con);
        
        return $giuongs;
    }
    public function getGiuong($MaPhong) {

        $p = new clsKetNoi();
        $con = $p->moKetNoi();
        
        $sql = "
   SELECT 
    giuong.MaGiuong,
    giuong.TenGiuong,
    phieunamvien.TrangThai AS TrangThaiGiuong,
    benhnhan.HoTen AS BenhNhan,
    benhnhan.NgaySinh,
    benhnhan.GioiTinh,
    phieunamvien.ThoiGianNV
FROM giuong
LEFT JOIN phieunamvien 
    ON giuong.MaGiuong = phieunamvien.MaGiuong 
    AND phieunamvien.TrangThai = 'Nhập viện'
LEFT JOIN benhnhan 
    ON phieunamvien.MaBN = benhnhan.MaBN
WHERE giuong.MaPhong = ?
";

        $stmt = mysqli_prepare($con, $sql);
        
        mysqli_stmt_bind_param($stmt, 's', $MaPhong); 
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        $giuongs = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $giuongs[] = $row;
        }
        
        $p->dongKetNoi($con);
        
        return $giuongs;
    }
}
?>

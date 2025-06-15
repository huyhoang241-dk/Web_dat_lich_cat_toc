<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Kết nối CSDL
$conn = mysqli_connect("sql101.infinityfree.com", "if0_39215589", "AbCde2811", "if0_39215589_db_barber");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Kiểm tra nếu có ID gửi lên
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = (int)$_POST['id'];

    // Xóa dữ liệu
    $sql = "DELETE FROM booking WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        die("Lỗi prepare: " . mysqli_error($conn));
    }
}

mysqli_close($conn);

// Quay lại trang lịch sử
header("Location: ../history.php");
exit;

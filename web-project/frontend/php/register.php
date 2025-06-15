<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Kết nối database
$conn = mysqli_connect("sql101.infinityfree.com", "if0_39215589", "AbCde2811", "if0_39215589_db_barber");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Lấy dữ liệu từ form
$fullname = $_POST['fullname'] ?? '';
$email    = $_POST['email'] ?? '';
$phone    = $_POST['phone'] ?? '';
$password = $_POST['password'] ?? '';

// Kiểm tra có đủ dữ liệu không
if ($fullname && $email && $phone && $password) {
    // Ghi dữ liệu vào database
    $stmt = mysqli_prepare($conn, "INSERT INTO register (fullname, email, phone, password) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $fullname, $email, $phone, $password);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Đăng ký thành công!'); window.location.href = '../login.html';</script>";
    } else {
        echo "Lỗi khi ghi vào database: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "<h3>Vui lòng nhập đầy đủ thông tin.</h3>";
}

mysqli_close($conn);
?>

<?php
session_start(); // nếu sau này bạn cần dùng session

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Kết nối CSDL
$conn = mysqli_connect("sql101.infinityfree.com", "if0_39215589", "AbCde2811", "if0_39215589_db_barber");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");

// Lấy dữ liệu từ form
$input    = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($input && $password) {
    $sql = "SELECT * FROM register WHERE (email = ? OR phone = ?) AND password = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $input, $input, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
        // ✅ Lưu thông tin vào session
        $_SESSION['user'] = [
            'full_name' => $user['full_name'],
            'phone'     => $user['phone'],
            'email'     => $user['email']
        ];

        echo "<script>
            alert('Đăng nhập thành công!');
            localStorage.setItem('isLoggedIn', 'true');
            window.location.href='../index.html';
        </script>";
    } else {
        echo "<script>alert('Sai email/số điện thoại hoặc mật khẩu.'); history.back();</script>";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "<script>alert('Vui lòng nhập đầy đủ thông tin.'); history.back();</script>";
}

mysqli_close($conn);
?>

<?php
// Hiển thị lỗi nếu có
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Kết nối CSDL
$conn = mysqli_connect("sql101.infinityfree.com", "if0_39215589", "AbCde2811", "if0_39215589_db_barber");

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Lấy dữ liệu từ form
$fullname         = $_POST['full_name'] ?? '';
$phone            = $_POST['phone'] ?? '';
$email            = $_POST['email'] ?? '';
$appointment_date = $_POST['appointment_date'] ?? '';
$appointment_time = $_POST['appointment_time'] ?? '';
$branch           = $_POST['branch'] ?? '';
$service          = $_POST['service'] ?? '';
$barber           = $_POST['barber'] ?? '';
$notes            = $_POST['notes'] ?? '';

// Kiểm tra dữ liệu bắt buộc
if ( $fullname && $phone && $appointment_date && $branch && $service && $barber) {

    // Chuẩn bị câu lệnh
    $sql = "INSERT INTO booking 
        (fullname, phone, email, appointment_date, appointment_time, branch, service, barber, notes)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssssss", 
            $fullname, $phone, $email, 
            $appointment_date, $appointment_time, 
            $branch, $service, $barber, $notes);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
    alert('Đặt lịch hẹn thành công!');
    window.location.href='../history.php';
</script>";
        } else {
            echo "❌ Lỗi khi thêm dữ liệu: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "❌ Lỗi chuẩn bị câu lệnh: " . mysqli_error($conn);
    }

} else {
    echo "⚠️ Vui lòng điền đầy đủ thông tin bắt buộc.";
}

mysqli_close($conn);
?>

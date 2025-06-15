<?php
$conn = mysqli_connect("sql101.infinityfree.com", "if0_39215589", "AbCde2811", "if0_39215589_db_barber");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

$sql = "SELECT * FROM booking ORDER BY appointment_date DESC, appointment_time DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Sử Đặt Hẹn - Barber Shop</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/history-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<header class="site-header">
        <div class="container header-container">
            <div class="logo">
                <img src="./image_cnpm/logo.png" alt="Barber Shop Logo">
            </div>

            <div class="hamburger-icon">
                <i class="fas fa-bars"></i>
                </div>

            <div class="mobile-menu-overlay">
                 <div class="mobile-menu-content">
                     <div class="close-icon">
                         <i class="fas fa-times"></i>
                         </div>
                     <nav class="mobile-nav">
                         <ul>
                             <li><a href="index.html">Trang chủ</a></li>
                             <li><a href="about.html">Về chúng tôi</a></li>
                             <li><a href="services.html">Dịch vụ</a></li>
                             <li><a href="news.html">Tin tức</a></li> 
                         </ul>
                     </nav>
                     <div class="mobile-header-buttons">
                         <a href="appointment.php" class="btn primary-btn">Đặt lịch hẹn</a> 
                         <a href="login.html" class="btn primary-btn ">Đăng nhập</a> 
                         <a href="register.html" class="btn primary-btn">Đăng ký</a>     
                     </div>
                 </div>
            </div>

            <nav class="desktop-nav">
                <ul>
                    <li><a href="index.html">Trang chủ</a></li>
                    <li><a href="about.html">Về chúng tôi</a></li> 
                    <li><a href="services.html">Dịch vụ</a></li> 
                    <li><a href="news.html">Tin tức</a></li>  
            </nav>
            <div class="header-buttons desktop-buttons">
                <a href="appointment.php" class="btn primary-btn">Đặt lịch hẹn</a> 
            </div>
            <div class="header-buttons desktop-buttons">
                 <div class="user-account">
                <a href="login.html" class="user-icon-link logged-out-only"> 
                    <i class="fas fa-user-circle"></i>
                    <span>Đăng nhập</span>
                </a>

                <div class="account-dropdown logged-in-only"> 
                    <a href="my-profile.php">Tài khoản của tôi</a>
                    <a href="history.php">Lịch sử đặt lịch</a>
                    <a href="./js/script.js" id="desktop-logout-link">Đăng xuất</a>
                </div>
        </div>
    </header>

<main class="page-main">
    <div class="container">
        <h1>Lịch Sử Đặt Hẹn</h1>
        <p id="customer-name-display" class="customer-history-info"></p>

        <div class="appointment-history-list">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="appointment-history-item">
                        <div class="appointment-details-card">
                            <p><strong>Salon:</strong> <?= htmlspecialchars($row['branch']) ?></p>
                            <p><strong>Dịch Vụ:</strong> <?= htmlspecialchars($row['service']) ?></p>
                            <p><strong>Thợ Cắt:</strong> <?= htmlspecialchars($row['barber']) ?></p>
                            <p><strong>Thời Gian:</strong> <?= htmlspecialchars($row['appointment_date']) ?>, <?= htmlspecialchars($row['appointment_time']) ?></p>
                            <p><strong>Ghi Chú:</strong> <?= htmlspecialchars($row['notes']) ?: "Không có ghi chú" ?></p>
                            <!-- Nếu có cột tổng tiền thì thêm ở đây -->
                            <p class="appointment-status-card status-completed">Trạng Thái: Đang chờ xử lý</p>
                        </div>
                        <form method="POST" action="php/delete_booking.php" onsubmit="return confirm('Bạn có chắc muốn hủy lịch này?');">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit" class="btn btn-cancel-appointment">Hủy Lịch</button>
                        </form>

                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-history">
                    <p>Chưa có lịch đặt nào.</p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</main>

<footer style="background-color: #1a1a1a; color: #fff; text-align: center; padding: 20px;">
    <p>Barber Shop. All rights reserved.</p>
</footer>

<script src="./js/script.js"></script>

</body>
</html>

<?php mysqli_close($conn); ?>

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Của Tôi - Barber Shop</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/my-profile-styles.css">
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
                    <a href="history.html">Lịch sử đặt lịch</a>
                    <a href="./js/script.js" id="desktop-logout-link">Đăng xuất</a>
                </div>
        </div>
    </header>

    <main class="page-main">
        <div class="container">
            <div class="profile-card">
                <h2>Thông Tin Cá Nhân Của Tôi</h2> 
                <form id="profile-form">
                    <div class="form-group">
                        <label for="customer-name">Tên Khách hàng:</label>
                       <input type="text" id="customer-name" name="customerName" readonly required
                        value="<?php echo isset($_SESSION['user']['full_name']) ? htmlspecialchars($_SESSION['user']['full_name']) : ''; ?>">

                    </div>
                    <div class="form-group">
                        <label for="phone-number">Số điện thoại:</label>
                        <input type="tel" id="phone-number" name="phoneNumber" readonly required
                        value="<?php echo isset($_SESSION['user']['phone']) ? htmlspecialchars($_SESSION['user']['phone']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email (Tùy chọn):</label>
                        <input type="email" id="email" name="email" readonly
                        value="<?php echo isset($_SESSION['user']['email']) ? htmlspecialchars($_SESSION['user']['email']) : ''; ?>"> 
                    </div>
                    <div class="form-group">
                        <label for="registration-date">Ngày đăng ký:</label>
                        <input type="text" id="registration-date" name="registrationDate" readonly>
                    </div>
                    <div class="profile-actions">
                        <button type="button" id="edit-profile-btn" class="btn btn-edit"><i class="fas fa-edit"></i> Chỉnh sửa</button> 
                        <button type="submit" id="update-profile-btn" class="btn btn-update hidden"><i class="fas fa-save"></i> Cập Nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </main>


    <footer style="background-color: #1a1a1a; color: #fff; text-align: center; padding: 20px;">
         <p> Barber Shop. All rights reserved.</p>
     </footer>

    <script src="./js/script.js"></script>

</body>
</html>

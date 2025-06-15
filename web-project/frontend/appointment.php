<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lịch hẹn - Barber Shop</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/appointment-styles.css">
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

                 <a href="#" class="user-icon-link logged-in-only"> 
                    <i class="fas fa-user-circle"></i>
                    <span>Tài khoản của tôi</span>
                    <i class="fas fa-chevron-down"></i> 
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
            <h1>Đặt lịch hẹn</h1>
             <p>Vui lòng điền thông tin để đặt lịch hẹn của bạn.</p>

            <div class="appointment-form-container">
                 <form id="appointment-form" action="./php/booking.php" method="POST"> 
                     <input type="hidden" id="selected-salon-id" name="selected_salon_id">
                     <div id="display-selected-salon" style="margin-bottom: 15px; font-weight: bold; color: green;"></div>

                     <div class="form-group">
                         <label for="full-name">Họ và tên:</label>
                         <input type="text" id="full-name" name="full_name"
                        value="<?php echo htmlspecialchars($_SESSION['user']['full_name'] ?? ''); ?>"
                             <?php echo isset($_SESSION['user']['full_name']) ? : ''; ?> required>

                     </div>
                        
                     <div class="form-group">
                         <label for="phone">Số điện thoại:</label>
                         <input type="tel" id="phone" name="phone" required
                        value="<?php echo isset($_SESSION['user']['phone']) ? htmlspecialchars($_SESSION['user']['phone']) : ''; ?>"
                            <?php if (isset($_SESSION['user']['phone'])) echo 'readonly'; ?>>

                     </div>

                      <div class="form-group">
                         <label for="email">Email (Tùy chọn):</label>
                         <input type="tel" id="email" name="email" required
                        value="<?php echo isset($_SESSION['user']['email']) ? htmlspecialchars($_SESSION['user']['email']) : ''; ?>"
                            <?php if (isset($_SESSION['user']['email'])) echo 'readonly'; ?>>

                     </div>

                     <div class="form-group">
                         <label for="appointment-date">Ngày hẹn:</label>
                         <input type="date" id="appointment-date" name="appointment_date" required>
                     </div>

                    
                     <div class="time-slot-section"> 
                         <div class="form-group"> 
                             <label for="selected-time">Chọn khung giờ dịch vụ <span class="required">*</span>:</label>
                             <select name="appointment_time" required>
                                 <option value="">Chọn giờ</option>
                                 <option value="08:00">08:00</option>
                                 <option value="08:30">08:30</option>
                                 <option value="09:00">09:00</option>
                                 <option value="09:30">09:30</option>
                                 <option value="10:30">10:30</option>
                                 <option value="11:00">11:00</option>
                                 <option value="13:00">13:00</option>
                                 <option value="13:30">13:30</option>
                                 <option value="14:00">14:00</option>
                                 <option value="14:30">14:30</option>
                                 <option value="15:00">15:00</option>
                                 <option value="15:30">15:30</option>
                                 <option value="16:00">16:00</option>
                                 <option value="16:30">16:30</option>
                                 <option value="17:00">17:00</option>
                                 <option value="17:30">17:30</option>
                                 <option value="18:00">18:00</option>
                                 <option value="18:30">18:30</option>
                                 <option value="19:00">19:00</option>
                                 <option value="19:30">19:30</option>
                                </select>
                                
                             
                         </div>
                     </div>
                     <div class="form-group">
                         <label for="service">Chọn dịch vụ:</label>
                         <select id="service" name="service" required>
                             <option value="">-- Chọn dịch vụ --</option>
                             <option value="Cắt tóc (150.000 VNĐ)" data-price="150000">Cắt tóc (150.000 VNĐ)</option>
                             <option value="Cạo râu (100.000 VNĐ)" data-price="100000">Cạo râu (100.000 VNĐ)</option> 
                             <option value="Chăm sóc da mặt (200.000 VNĐ)" data-price="200000">Chăm sóc da mặt (200.000 VNĐ)</option>
                             <option value="Nhuộm tóc (500.000 VNĐ)" data-price="500000">Nhuộm tóc (500.000 VNĐ)</option> 
                         </select>
                     </div>
                     <div class="form-group">
                         <label for="branch">Chọn chi nhánh:</label>
                         <select id="branch" name="branch" required>
                             <option value="">-- Chọn chi nhánh --</option>
                             <option value="Chi nhánh Lê Hồng Phong, Quận 10" >Chi nhánh Lê Hồng Phong, Quận 10</option>
                             <option value="Chi nhánh Lê Văn Việt, TP Thủ Đức" >Chi nhánh Lê Văn Việt, TP Thủ Đức</option> 
                             <option value="Chi nhánh Trần Đại Nghĩa, Huyện Bình Chánh" >Chi nhánh Trần Đại Nghĩa, Huyện Bình Chánh</option>
                             <option value="Chi nhánh Trần Văn Kiểu, Quận 6" >Chi nhánh Trần Văn Kiểu, Quận 6</option> 
                             <option value="Chi nhánh Điện Biên Phủ, Quận 3" >Chi nhánh Điện Biên Phủ, Quận 3</option> 
                             <option value="Chi nhánh Man Thiện, TP Thủ Đức" >Chi nhánh Man Thiện, TP Thủ Đức</option> 
                         </select>
                     </div>

                      <div class="form-group">
                         <label for="barber">Chọn thợ (Tùy chọn):</label>
                         <select id="barber" name="barber">
                             <option value="">-- Không chọn thợ --</option>
                             <option value="Lê Hiếu">Thợ Lê Hiếu</option>
                             <option value="Khoa Đăng">Thợ Khoa Đăng</option>
                             <option value="Ngọc Đăng">Thợ Ngọc Đăng</option>
                             <option value="Tuấn Anh">Thợ Tuấn Anh</option>
                             <option value="An Lê">Thợ An Lê</option>
                         </select>
                     </div>

                      <div class="form-group">
                         <label for="notes">Ghi chú thêm (Tùy chọn):</label>
                         <textarea id="notes" name="notes" rows="4"></textarea>
                     </div>

                    
                     <div class="form-group total-amount-display"> 
                         <label>Tổng tiền dự kiến:</label>
                         <span id="estimated-total">0 VNĐ</span>
                     </div>
                     <button type="submit" class="btn primary-btn">Xác nhận đặt lịch</button>
                 </form>
            </div>
            </div>
    </main>

    <footer style="background-color: #1a1a1a; color: #fff; text-align: center; padding: 20px;">
         <p>&copy; Barber Shop. All rights reserved.</p>
     </footer>

    <div class="confirmation-modal-overlay">
        <div class="confirmation-modal-content">
            <h2>Xác Nhận Lịch Hẹn</h2>
            <div class="appointment-details-summary">
                <p><strong>Họ và Tên:</strong> <span id="summary-full-name"></span></p>
                <p><strong>Số Điện Thoại:</strong> <span id="summary-phone"></span></p>
                <p><strong>Salon:</strong> <span id="summary-salon"></span></p>
                <p><strong>Dịch Vụ:</strong> <span id="summary-service"></span></p>
                <p><strong>Stylist:</strong> <span id="summary-barber"></span></p>
                <p><strong>Thời Gian:</strong> <span id="summary-date-time"></span></p>
                <p><strong>Ghi Chú:</strong> <span id="summary-notes"></span></p>
                 <p class="summary-total"><strong>Tổng tiền:</strong> <span id="summary-total-amount"></span></p>
            </div>
            <div class="modal-buttons">
                <button id="confirm-appointment-btn" class="btn confirm-btn">Xác Nhận</button>
                <button id="cancel-appointment-btn" class="btn cancel-btn">Hủy Bỏ</button>
            </div>
        </div>
    </div>
    <script src="./js/script.js"></script>
</body>
</html>


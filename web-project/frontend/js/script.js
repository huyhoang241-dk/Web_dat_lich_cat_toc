document.addEventListener("DOMContentLoaded", function () {
  console.log("DOM fully loaded. Initializing script.js");

  // --- Logic cho Menu Responsive ---
  const hamburgerIcon = document.querySelector(".hamburger-icon");
  const mobileMenuOverlay = document.querySelector(".mobile-menu-overlay");
  const closeIcon = document.querySelector(".mobile-menu-content .close-icon");
  const body = document.body;

  if (hamburgerIcon && mobileMenuOverlay && closeIcon && body) {
    function openMobileMenu() {
      mobileMenuOverlay.classList.add("visible", "active");
      body.style.overflow = "hidden";
      console.log("Mobile menu opened.");
    }

    function closeMobileMenu() {
      mobileMenuOverlay.classList.remove("visible", "active");
      body.style.overflow = "";
      console.log("Mobile menu closed.");
    }

    hamburgerIcon.addEventListener("click", openMobileMenu);
    closeIcon.addEventListener("click", closeMobileMenu);
    mobileMenuOverlay.addEventListener("click", function (event) {
      if (event.target === mobileMenuOverlay) {
        closeMobileMenu();
        console.log("Mobile menu closed by clicking overlay.");
      }
    });

    const mobileNavLinks = document.querySelectorAll(".mobile-nav a");
    mobileNavLinks.forEach((link) => {
      link.addEventListener("click", closeMobileMenu);
    });
    console.log("Menu responsive logic initialized.");
  } else {
    console.log("Menu responsive elements not found.");
  }

  // --- Logic cho Header Đăng nhập/Đăng xuất ---
  const userAccount = document.querySelector(".user-account");
  const accountDropdown = document.querySelector(".account-dropdown");
  const userIconLink = document.querySelector(".user-icon-link");
  const userIconLinkLoggedIn = document.querySelector(
    ".user-icon-link.logged-in-only"
  );
  const userIconLinkLoggedOut = document.querySelector(
    ".user-icon-link.logged-out-only"
  );
  const desktopLogoutLink = document.getElementById("desktop-logout-link");
  const mobileLogoutLink = document.getElementById("mobile-logout-link");

  function isUserLoggedIn() {
    return (
      localStorage.getItem("isLoggedIn") === "true" ||
      localStorage.getItem("userToken")
    );
  }

  function getUserRole() {
    return localStorage.getItem("userRole") || "customer";
  }

  function updateHeaderLoginStatus() {
    const isLoggedIn = isUserLoggedIn();
    const loggedInUser = JSON.parse(
      localStorage.getItem("loggedInUser") || "{}"
    );
    const userRole = getUserRole();

    if (body) {
      body.classList.toggle("is-logged-in", isLoggedIn);
      body.classList.toggle("is-logged-out", !isLoggedIn);
      body.classList.remove("user-role-admin", "user-role-customer");
      if (isLoggedIn) {
        body.classList.add(`user-role-${userRole}`);
      }
    }

    if (userIconLink) {
      if (isLoggedIn && loggedInUser.username) {
        userIconLink.href = "#";
        userIconLink.querySelector("span").textContent =
          userRole === "admin"
            ? "Quản lý Admin"
            : loggedInUser.username || "Tài khoản của tôi";
        userIconLink.classList.add("logged-in");
        userIconLink.classList.remove("logged-out-only");
      } else {
        userIconLink.href = "login.html";
        userIconLink.querySelector("span").textContent = "Đăng nhập / Đăng ký";
        userIconLink.classList.remove("logged-in");
        userIconLink.classList.add("logged-out-only");
      }
    }

    if (userIconLinkLoggedIn && isLoggedIn) {
      userIconLinkLoggedIn.querySelector("span").textContent =
        userRole === "admin" ? "Quản lý Admin" : "Tài khoản của tôi";
      if (!userIconLinkLoggedIn.querySelector(".fa-chevron-down")) {
        const arrowIcon = document.createElement("i");
        arrowIcon.classList.add("fas", "fa-chevron-down");
        userIconLinkLoggedIn.appendChild(arrowIcon);
      }
    }

    if (userIconLinkLoggedOut && !isLoggedIn) {
      userIconLinkLoggedOut.querySelector("span").textContent = "Đăng nhập";
      const arrowIcon = userIconLinkLoggedOut.querySelector(".fa-chevron-down");
      if (arrowIcon) arrowIcon.remove();
    }

    if (accountDropdown) {
      accountDropdown.style.display = isLoggedIn ? "block" : "none";
    }

    if (mobileLogoutLink) {
      mobileLogoutLink.style.display = isLoggedIn ? "block" : "none";
      const mobileLoginLink = document.querySelector(
        '.mobile-nav a[href="login.html"]'
      );
      if (mobileLoginLink) {
        mobileLoginLink.style.display = isLoggedIn ? "none" : "block";
      }
    }

    console.log("Header login status updated.");
  }

  function handleLogout(event) {
    event.preventDefault();
    console.log("Logging out...");
    localStorage.removeItem("isLoggedIn");
    localStorage.removeItem("loggedInUser");
    localStorage.removeItem("userToken");
    localStorage.removeItem("userRole");
    sessionStorage.removeItem("userToken");
    updateHeaderLoginStatus();
    window.location.href = "index.html";
  }

  if (userAccount && accountDropdown) {
    userAccount.addEventListener("click", function (event) {
      const clickedUserLink = event.target.closest(
        ".user-icon-link.logged-in-only"
      );
      if (clickedUserLink && isUserLoggedIn()) {
        event.preventDefault();
        userAccount.classList.toggle("active");
        console.log("Account dropdown toggled.");
      }
    });

    document.addEventListener("click", function (event) {
      if (
        !event.target.closest(".user-account") &&
        userAccount.classList.contains("active")
      ) {
        userAccount.classList.remove("active");
        console.log("Clicked outside user account. Dropdown closed.");
      }
    });
    console.log("User account dropdown logic initialized.");
  }

  if (desktopLogoutLink) {
    desktopLogoutLink.addEventListener("click", handleLogout);
  }

  if (mobileLogoutLink) {
    mobileLogoutLink.addEventListener("click", handleLogout);
  }

  updateHeaderLoginStatus();

  // --- Logic cho Background Image Slider ---
  const slides = document.querySelectorAll(".hero-background .slide");
  const indicators = document.querySelectorAll(".slider-indicators span");
  let currentSlideIndex = 0;
  const slideIntervalTime = 10000;

  if (slides.length > 0 && indicators.length === slides.length) {
    function showSlide(index) {
      slides.forEach((slide) => slide.classList.remove("active"));
      indicators.forEach((indicator) => indicator.classList.remove("active"));
      slides[index].classList.add("active");
      indicators[index].classList.add("active");
    }

    function nextSlide() {
      currentSlideIndex = (currentSlideIndex + 1) % slides.length;
      showSlide(currentSlideIndex);
    }

    let sliderInterval = setInterval(nextSlide, slideIntervalTime);
    const heroSection = document.querySelector(".hero-section");
    if (heroSection) {
      heroSection.addEventListener("mouseover", () =>
        clearInterval(sliderInterval)
      );
      heroSection.addEventListener("mouseout", () => {
        sliderInterval = setInterval(nextSlide, slideIntervalTime);
      });
    }

    indicators.forEach((indicator, index) => {
      indicator.addEventListener("click", () => {
        currentSlideIndex = index;
        showSlide(currentSlideIndex);
        clearInterval(sliderInterval);
        sliderInterval = setInterval(nextSlide, slideIntervalTime);
      });
    });

    showSlide(currentSlideIndex);
    console.log("Slider logic initialized.");
  }

  // --- Logic cho Trang Đặt lịch hẹn ---
  const appointmentForm = document.getElementById("appointment-form");
  const appointmentDateInput = document.getElementById("appointment-date");
  const timeSlotSection = document.querySelector(".time-slot-section");
  const selectedTimeInput = document.getElementById("selected-time");
  const timeSlotButtons = document.querySelectorAll(".time-slot-button");
  const searchButton = document.getElementById("search-button");
  const locationSearchInput = document.getElementById("location-search");
  const salonListResults = document.getElementById("salon-list-results");
  const selectedSalonIdInput = document.getElementById("selected-salon-id");
  const displaySelectedSalon = document.getElementById(
    "display-selected-salon"
  );
  const serviceSelect = document.getElementById("service");
  const barberSelect = document.getElementById("barber");
  const confirmationModalOverlay = document.querySelector(
    ".confirmation-modal-overlay"
  );
  const confirmAppointmentBtn = document.getElementById(
    "confirm-appointment-btn"
  );
  const cancelAppointmentBtn = document.getElementById(
    "cancel-appointment-btn"
  );
  const summaryFullName = document.getElementById("summary-full-name");
  const summaryPhone = document.getElementById("summary-phone");
  const summarySalon = document.getElementById("summary-salon");
  const summaryService = document.getElementById("summary-service");
  const summaryBarber = document.getElementById("summary-barber");
  const summaryDateTime = document.getElementById("summary-date-time");
  const summaryNotes = document.getElementById("summary-notes");
  const estimatedTotalDisplay = document.getElementById("estimated-total");
  const summaryTotalAmount = document.getElementById("summary-total-amount");

  const branchesData = [
    {
      id: "salon-1",
      name: "Salon A",
      address: "123 Đường ABC, Quận 1",
      services: [
        { value: "cat-toc", text: "Cắt tóc (150.000 VNĐ)", price: "150000" },
        { value: "cao-rau", text: "Cạo râu (100.000 VNĐ)", price: "100000" },
        {
          value: "cham-soc-da",
          text: "Chăm sóc da mặt (200.000 VNĐ)",
          price: "200000",
        },
        {
          value: "nhuom-toc",
          text: "Nhuộm tóc (500.000 VNĐ)",
          price: "500000",
        },
        {
          value: "nhuom-toc",
          text: "Nhuộm tóc (500.000 VNĐ)",
          price: "500000",
        },
      ],
      stylists: [
        { value: "tho-a", text: "Thợ A" },
        { value: "tho-b", text: "Thợ B" },
        { value: "tho-b", text: "Thợ C" },
        { value: "tho-b", text: "Thợ D" },
        { value: "tho-b", text: "Thợ E" },
        { value: "tho-b", text: "Thợ F" },
        { value: "tho-b", text: "Thợ B" },
      ],
    },
    {
      id: "salon-2",
      name: "Salon B",
      address: "456 Đường XYZ, Quận 3",
      services: [
        { value: "cat-toc", text: "Cắt tóc (150.000 VNĐ)", price: "150000" },
        {
          value: "nhuom-toc",
          text: "Nhuộm tóc (500.000 VNĐ)",
          price: "500000",
        },
        { value: "uon-toc", text: "Uốn tóc (300.000 VNĐ)", price: "300000" },
      ],
      stylists: [
        { value: "tho-c", text: "Thợ C" },
        { value: "tho-d", text: "Thợ D" },
        { value: "tho-e", text: "Thợ E" },
      ],
    },
    {
      id: "salon-3",
      name: "Salon C",
      address: "789 Đường DEF, Quận 5",
      services: [
        { value: "cat-toc", text: "Cắt tóc (150.000 VNĐ)", price: "150000" },
        {
          value: "cham-soc-da",
          text: "Chăm sóc da mặt (200.000 VNĐ)",
          price: "200000",
        },
      ],
      stylists: [{ value: "tho-f", text: "Thợ F" }],
    },
  ];

  // Hàm cập nhật tổng tiền
  function updateTotalAmount() {
    const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
    if (selectedOption && selectedOption.value) {
      // Lấy giá từ data-price hoặc từ branchesData nếu không có
      let price = selectedOption.getAttribute("data-price");
      if (!price) {
        // Tìm giá từ branchesData nếu không có trong data-price
        const selectedSalon = branchesData.find(
          (b) => b.id === selectedSalonIdInput.value
        );
        if (selectedSalon) {
          const selectedService = selectedSalon.services.find(
            (s) => s.value === selectedOption.value
          );
          price = selectedService ? selectedService.price : "0";
        }
      }
      const formattedPrice = parseInt(price || "0").toLocaleString("vi-VN");
      estimatedTotalDisplay.textContent = `${formattedPrice} VNĐ`;
      if (summaryTotalAmount) {
        summaryTotalAmount.textContent = `${formattedPrice} VNĐ`;
      }
    } else {
      estimatedTotalDisplay.textContent = "0 VNĐ";
      if (summaryTotalAmount) {
        summaryTotalAmount.textContent = "0 VNĐ";
      }
    }
  }

  function populateServicesDropdown(branchId) {
    if (!branchId && serviceSelect.children.length > 1) {
      console.log("Retaining HTML service options.");
      return;
    }
    serviceSelect.innerHTML = '<option value="">-- Chọn dịch vụ --</option>';
    if (branchId) {
      const branch = branchesData.find((b) => b.id === branchId);
      if (branch && branch.services.length > 0) {
        branch.services.forEach((service) => {
          const option = document.createElement("option");
          option.value = service.value;
          option.textContent = service.text;
          option.setAttribute("data-price", service.price);
          serviceSelect.appendChild(option);
        });
        console.log("Services dropdown populated for branch:", branchId);
      }
    }
    // Cập nhật tổng tiền sau khi thay đổi dropdown
    updateTotalAmount();
  }

  function populateStylistsDropdown(branchId) {
    if (!branchId && barberSelect.children.length > 1) {
      console.log("Retaining HTML stylist options.");
      return;
    }
    barberSelect.innerHTML = '<option value="">-- Không chọn thợ --</option>';
    if (branchId) {
      const branch = branchesData.find((b) => b.id === branchId);
      if (branch && branch.stylists.length > 0) {
        branch.stylists.forEach((stylist) => {
          const option = document.createElement("option");
          option.value = stylist.value;
          option.textContent = stylist.text;
          barberSelect.appendChild(option);
        });
        console.log("Stylists dropdown populated for branch:", branchId);
      }
    }
  }

  if (
    appointmentForm &&
    appointmentDateInput &&
    timeSlotSection &&
    selectedTimeInput &&
    timeSlotButtons.length > 0 &&
    searchButton &&
    locationSearchInput &&
    salonListResults &&
    selectedSalonIdInput &&
    displaySelectedSalon &&
    serviceSelect &&
    barberSelect &&
    confirmationModalOverlay &&
    confirmAppointmentBtn &&
    cancelAppointmentBtn &&
    summaryFullName &&
    summaryPhone &&
    summarySalon &&
    summaryService &&
    summaryBarber &&
    summaryDateTime &&
    summaryNotes
  ) {
    // Thêm sự kiện lắng nghe cho dropdown dịch vụ
    serviceSelect.addEventListener("change", updateTotalAmount);

    function showTimeSlots() {
      timeSlotSection.style.display = "block";
    }

    function hideTimeSlots() {
      timeSlotSection.style.display = "none";
      selectedTimeInput.value = "";
      timeSlotButtons.forEach((button) => button.classList.remove("active"));
    }

    appointmentDateInput.addEventListener("change", function () {
      if (this.value) {
        showTimeSlots();
        console.log("Date selected:", this.value);
      } else {
        hideTimeSlots();
        console.log("Date cleared.");
      }
    });

    if (!appointmentDateInput.value) {
      hideTimeSlots();
    }

    const timeSlotsContainer = document.querySelector(".time-slots-container");
    if (timeSlotsContainer) {
      timeSlotsContainer.addEventListener("click", function (event) {
        const clickedButton = event.target.closest(".time-slot-button");
        if (clickedButton && !clickedButton.classList.contains("unavailable")) {
          timeSlotButtons.forEach((button) =>
            button.classList.remove("active")
          );
          clickedButton.classList.add("active");
          selectedTimeInput.value = clickedButton.getAttribute("data-time");
          console.log("Selected time:", selectedTimeInput.value);
        }
      });
    }

    searchButton.addEventListener("click", function () {
      const location = locationSearchInput.value.trim();
      console.log("Search input:", locationSearchInput.value.trim());
      console.log("Filtered results:", results); // Debug trong searchButton.addEventListener
      salonListResults.innerHTML = "";
      if (location) {
        const results = branchesData.filter(
          (branch) =>
            branch.name.toLowerCase().includes(location.toLowerCase()) ||
            branch.address.toLowerCase().includes(location.toLowerCase())
        );
        if (results.length > 0) {
          results.forEach((salon) => {
            const salonItem = document.createElement("div");
            salonItem.classList.add("salon-item");
            salonItem.innerHTML = `<strong>${salon.name}</strong> - ${salon.address}`;
            salonItem.setAttribute("data-salon-id", salon.id);
            salonItem.setAttribute("data-salon-name", salon.name);
            salonListResults.appendChild(salonItem);

            salonItem.addEventListener("click", function () {
              console.log("Salon clicked:", salon.id); // Debug
              selectedSalonIdInput.value = salon.id;
              locationSearchInput.value = `${salon.name} - ${salon.address}`;
              displaySelectedSalon.textContent = `Salon đã chọn: ${salon.name}`;
              salonListResults.innerHTML = "";
              populateServicesDropdown(salon.id);
              populateStylistsDropdown(salon.id);
              console.log("Salon selected:", salon.name);
            });
          });
        } else {
          salonListResults.innerHTML =
            "<div class='salon-item'>Không tìm thấy salon nào.</div>";
        }
      } else {
        selectedSalonIdInput.value = "";
        displaySelectedSalon.textContent = "";
        populateServicesDropdown(null);
        populateStylistsDropdown(null);
        console.log("Location search cleared.");
      }
    });

    function showConfirmationModal(details) {
      summaryFullName.textContent = details.fullName;
      summaryPhone.textContent = details.phone;
      summarySalon.textContent = details.salon;
      summaryService.textContent = details.service;
      summaryBarber.textContent = details.barber || "Không chọn";
      summaryDateTime.textContent = `${details.date}, ${details.time}`;
      summaryNotes.textContent = details.notes || "Không có ghi chú";

      // Cập nhật tổng tiền trong modal
      updateTotalAmount();

      confirmationModalOverlay.classList.add("visible");
      body.style.overflow = "hidden";
    }

    function hideConfirmationModal() {
      confirmationModalOverlay.classList.remove("visible");
      body.style.overflow = "";
    }

    appointmentForm.addEventListener("submit", function (event) {
      event.preventDefault();
      if (appointmentForm.checkValidity()) {
        const formData = new FormData(appointmentForm);
        const details = {
          fullName: formData.get("full_name"),
          phone: formData.get("phone"),
          salon: locationSearchInput.value || "Chưa chọn Salon",
          service: serviceSelect.options[serviceSelect.selectedIndex].text,
          barber: barberSelect.options[barberSelect.selectedIndex].text,
          date: formData.get("appointment_date"),
          time: formData.get("appointment_time"),
          notes: formData.get("notes"),
        };
        showConfirmationModal(details);
      }
    });

    confirmAppointmentBtn.addEventListener("click", function () {
      const appointmentData = Object.fromEntries(new FormData(appointmentForm));
      appointmentData.selected_salon_name = displaySelectedSalon.textContent
        .replace("Salon đã chọn: ", "")
        .trim();
      appointmentData.selected_service_name =
        serviceSelect.options[serviceSelect.selectedIndex].text;
      appointmentData.selected_barber_name =
        barberSelect.options[barberSelect.selectedIndex].text;
      sessionStorage.setItem(
        "currentAppointmentData",
        JSON.stringify(appointmentData)
      );
      window.location.href = "/history.html";
      hideConfirmationModal();
    });

    cancelAppointmentBtn.addEventListener("click", hideConfirmationModal);
    confirmationModalOverlay.addEventListener("click", function (event) {
      if (event.target === confirmationModalOverlay) {
        hideConfirmationModal();
      }
    });

    // Gọi hàm cập nhật tổng tiền lần đầu khi trang load
    updateTotalAmount();
    console.log("Appointment page logic initialized.");
  } else {
    console.log("Appointment page elements not found.");
  }
});

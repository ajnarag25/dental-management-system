
<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top"> 
    <!-- Logo -->
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="/iSmileDentalCare/uploads/images/system_images/logo.jpg" alt="Logo" width="160" height="60" class="d-inline-block">
      </a>

      <!-- Nav Elements -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <!-- HOME -->
            <li <?php if ($active_page == 'home') { echo 'class="nav-item active fw-bold"';}?>>
              <a class="nav-link" href="<?php echo base_url('General')?>">Home</a>
            </li>

            <!-- ABOUT US -->
            <li <?php if ($active_page == 'about_us') { echo 'class="nav-item active fw-bold"';}?>>
              <a class="nav-link" href="<?php echo base_url('General/about_us')?>">About Us</a>
            </li>

            <!-- GALLERY -->
            <li <?php if ($active_page == 'gallery') { echo 'class="nav-item active fw-bold"';}?>>
              <a class="nav-link" href="<?php echo base_url('General/gallery')?>">Gallery</a>
            </li>

            <!-- SERVICES -->
            <li <?php if ($active_page == 'services') { echo 'class="nav-item active fw-bold"';}?>>
              <a class="nav-link" href="<?php echo base_url('General/services')?>">Services</a>
            </li>

            <!-- CONTACT US -->
            <li <?php if ($active_page == 'contact_us') { echo 'class="nav-item active fw-bold"';}?>>
              <a class="nav-link" href="<?php echo base_url('General/contact_us')?>">Contact Us</a>
            </li>

            <!-- BOOK AN APPOINTMENT -->
            <li <?php if ($active_page == 'login' || $active_page == 'register') { 
                        echo 'class="nav-item active fw-bold"';
                      }else{
                        echo 'class="nav-item"';
                      }?>>
              <a class="nav-link" href="<?php echo base_url('Login')?>">Book an Appointment</a>
            </li>
        </ul>
      </div>
  </div>
</nav>




<!-- HAMBURGER 
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Celadiña Dental Clinic</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Gallery</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Book an Appointment</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Login/Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
          </li>
        </ul>
      </div>
    </div> -->

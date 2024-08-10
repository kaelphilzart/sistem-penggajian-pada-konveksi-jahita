<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dwi Tailor</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/img/favicon.png" rel="icon">
  <link href="/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    .toast-container {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 1000;
    }

    .toast {
      display: none;
      min-width: 300px;
      padding: 15px;
      margin-bottom: 10px;
      border-radius: 5px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      opacity: 0;
      transition: opacity 0.5s ease, bottom 0.5s ease;
    }

    .toast.show {
      display: block;
      opacity: 1;
      bottom: 30px;
    }

    .toast-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 10px;
    }

    .toast-body {
      padding: 10px 0;
    }

    .toast.success {
      background-color: #d4edda;
      border-left: 5px solid #28a745;
    }

    .toast.error {
      background-color: #f8d7da;
      border-left: 5px solid #dc3545;
    }

    .toast-header img {
      width: 16px;
      height: 16px;
      margin-right: 10px;
    }

    .toast-header .btn-close {
      cursor: pointer;
      background: none;
      border: none;
      font-size: 1.2em;
      line-height: 1;
      color: #000;
    }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="/img/logo.png" alt="">
        <span class="d-none d-lg-block">Dwi Tailor</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->



    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

       

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2 mx-2">{{Auth::user()->name}}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{Auth::user()->email}}</h6>
              <span>Sebagai {{Auth::user()->level}}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('logout-karyawan')}}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{route('dashboard_karyawan')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{route('profile')}}">
          <i class="bi bi-menu-button-wide"></i>
          <span>Profile</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{route('tugas-jahitan')}}">
          <i class="bi bi-menu-button-wide"></i>
          <span>Tugas Jahitan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{route('rekap-jahit')}}">
          <i class="bi bi-menu-button-wide"></i>
          <span>Rekap Penjahitan</span>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link " href="{{route('data-pesanan')}}">
          <i class="bi bi-file-earmark"></i>
          <span>Penggajian</span>
        </a>
      </li> -->
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>{{ ucfirst(request()->route()->getName()) }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">{{ ucfirst(request()->route()->getName()) }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      @yield('content')
    </section>

  </main><!-- End #main -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/vendor/chart.js/chart.umd.js"></script>
  <script src="/vendor/echarts/echarts.min.js"></script>
  <script src="/vendor/quill/quill.min.js"></script>
  <script src="/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="/vendor/tinymce/tinymce.min.js"></script>
  <script src="/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/js/main.js"></script>

  <div class="toast-container">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <img id="toast-icon" src="" class="rounded me-2" alt="" style="width: 16px; height: 16px;">
        <strong id="toast-title" class="me-auto"></strong>
        <button type="button" class="btn-close" onclick="closeToast()" aria-label="Close">&times;</button>
      </div>
      <div id="toast-body" class="toast-body"></div>
    </div>
  </div>

  <!-- JavaScript untuk Toast -->
  <script>
    function showToast(type, message) {
      var toast = document.getElementById('liveToast');
      var toastIcon = document.getElementById('toast-icon');
      var toastTitle = document.getElementById('toast-title');
      var toastBody = document.getElementById('toast-body');

      if (type === 'success') {
        toast.classList.add('success');
        toast.classList.remove('error');
        toastIcon.src = '/img/success.png';
        toastTitle.textContent = 'Berhasil';
      } else if (type === 'error') {
        toast.classList.add('error');
        toast.classList.remove('success');
        toastIcon.src = '/img/failed.png';
        toastTitle.textContent = 'Gagal';
      }

      toastBody.textContent = message;
      toast.classList.add('show');

      setTimeout(function () {
        toast.classList.remove('show');
      }, 3000);
    }

    function closeToast() {
      var toast = document.getElementById('liveToast');
      toast.classList.remove('show');
    }

    // Tampilkan toast jika ada sesi error atau success
    document.addEventListener('DOMContentLoaded', function () {
      @if(session('error'))
      showToast('error', '{{ session('error') }}');
      @elseif(session('success'))
      showToast('success', '{{ session('success') }}');
      @endif
    });
  </script>

</body>

</html>

<script>
    // fungsi untuk mengeubah warna menu pada sidebar sesuai dengan url yang dilihat
    function setActiveClass() {
        var currentUrl = window.location.href;
        var links = document.querySelectorAll('.nav-link');
        links.forEach(function(link) {
            if (link.href === currentUrl) {
                link.classList.add('active');
                if (link.classList.contains('collapsed')) {
                    link.classList.remove('collapsed');
                }
            } else {
                link.classList.remove('active');
                if (!link.classList.contains('collapsed')) {
                    link.classList.add('collapsed');
                }
            }
        });
    }

    // Call the function when the page loads
    window.onload = setActiveClass;
</script>
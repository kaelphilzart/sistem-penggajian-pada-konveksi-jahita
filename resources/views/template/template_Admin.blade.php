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
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
  <!-- Vendor CSS Files -->
  <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/vendor/simple-datatables/style.css" rel="stylesheet">


  <link href="/css/style.css" rel="stylesheet">


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
   <style>
    .notification-container {
      max-height: 300px; /* Sesuaikan dengan tinggi yang diinginkan */
      overflow-y: scroll;
    }
    .notification-item {
      padding: 10px;
    }
    
.notification-item {
  padding: 10px;
}

.new-notification {
  background-color: #e6ffe6; /* Warna latar belakang untuk notifikasi baru (hijau muda) */
}

.old-notification {
  background-color: #ffffff; /* Warna latar belakang untuk notifikasi lama (putih) */
}
.overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
            z-index: 9998; /* Ensure it is behind the loader */
            display: none; /* Hide by default */
        }

        .loader {
            position: fixed;
            left: 50%;
            top: 50%;
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-radius: 50%;
            border-top: 5px solid #3498db;
            animation: spin 1s linear infinite;
            z-index: 9999;
            display: none; /* Hide by default */
            transform: translate(-50%, -50%);
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
  </style>
</head>

<body>
<div id="overlay" class="overlay"></div>
    <div id="loader" class="loader"></div>


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

      <li class="nav-item dropdown">
    <a class="nav-link nav-icon" href="#" id="notificationBell" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>
        <span class="badge bg-primary badge-number" id="notificationCount"></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications notification-container" id="notificationList">
        <li class="dropdown-header">
            You have <span id="notificationCountText"></span> new notifications
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
    </ul>
</li>


<!-- End Notification Nav -->


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
            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout-admin')}}">
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
        <a class="nav-link " href="{{route('dashboard_admin')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->


      <li class="nav-item">
        <a class="nav-link " href="{{route('data-karyawan')}}">
          <i class="bi bi-menu-button-wide"></i>
          <span>Data Karyawan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{route('data-busana')}}">
          <i class="bi bi-menu-button-wide"></i>
          <span>Busana</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{route('data-pesanan')}}">
          <i class="bi bi-file-earmark"></i>
          <span>Pesanan</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('data-rekap')}}">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Rekap Jahitan</span>
        </a>
      </li><!-- End Login Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('data-gaji')}}">
          <i class="bi bi-dash-circle"></i>
          <span>Penggajian</span>
        </a>
      </li><!-- End Error 404 Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('rekap-gaji')}}">
          <i class="bi bi-file-earmark"></i>
          <span>Rekap Gaji</span>
        </a>
      </li><!-- End Blank Page Nav -->

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


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

   

  <!-- Vendor JS Files -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

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
  
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('confirmSubmit').addEventListener('click', function() {
            document.getElementById('serahForm').submit();
        });
    });
</script>

</body>

</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let notificationBell = document.getElementById('notificationBell');
        let notificationList = document.getElementById('notificationList');
        let notificationCount = document.getElementById('notificationCount');
        let notificationCountText = document.getElementById('notificationCountText');

        function showLoader() {
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('loader').style.display = 'block';
        }

        function hideLoader() {
            setTimeout(() => {
                document.getElementById('overlay').style.display = 'none';
                document.getElementById('loader').style.display = 'none';
            }, 3000);
        }

        function fetchNotifications() {
            fetch('/fetch-notifications', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                updateNotificationDisplay(data.notifications, data.count);
            })
            .catch(error => console.error('Error:', error));
        }

        function updateNotificationDisplay(notifications, count) {
            notificationCount.innerText = count > 0 ? count : '';
            notificationCountText.innerText = count;

            notificationList.innerHTML = `
                <li class="dropdown-header">
                    You have <span id="notificationCountText">${count}</span> new notifications
                    <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>`;

            notifications.forEach(notif => {
                let notifItem;

                if (notif.status == 'baru') {
                    notifItem = `
                        <li class="notification-item shadow-sm new-notification" data-status="${notif.status}" data-id="${notif.id}">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4 style="font-weight: bold;">${notif.karyawan}</h4>
                                <p>Telah menyelesaikan jahitan pesanan atas nama <span class="text-info" style="font-weight: bold;">${notif.nama_pemesan}</span>,
                                    dan nama pemilik pakaian <span class="text-dark" style="font-weight: bold;">${notif.nama_pcs}</span> 
                                    jenis busana <span class="text-primary" style="font-weight: bold;">${notif.jenis_busana}</span></p>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-success btn-sm me-2 btn-konfirmasi" data-id="${notif.id}">Konfirmasi</button>
                                    <button class="btn btn-danger btn-sm btn-abaikan" data-id="${notif.id}">Abaikan</button>
                                </div>
                                <p class="text-end">${new Date(notif.created_at).toLocaleDateString()} ${new Date(notif.created_at).toLocaleTimeString()}</p>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>`;
                } else if (notif.status == 'ambil') {
                    notifItem = `
                        <li class="notification-item shadow-sm new-notification" data-status="${notif.status}" data-id="${notif.id}">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4 style="font-weight: bold;">${notif.karyawan}</h4>
                                <p>Ingin mengambil tugas dari <span class="text-dark" style="font-weight: bold;">${notif.karyawan_tugas}</span> jahitan dengan nama 
                                   <span class="text-info" style="font-weight: bold;">${notif.nama_pemesan}</span>,
                                   dan nama pemilik pakaian <span class="text-dark" style="font-weight: bold;">${notif.nama_pcs}</span> 
                                   jenis busana <span class="text-primary" style="font-weight: bold;">${notif.jenis_busana}</span></p>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-success btn-sm me-2 btn-setuju" data-id="${notif.id}">Setujui</button>
                                    <button class="btn btn-danger btn-sm btn-tolak" data-id="${notif.id}">Tolak</button>
                                </div>
                                <p class="text-end">${new Date(notif.created_at).toLocaleDateString()} ${new Date(notif.created_at).toLocaleTimeString()}</p>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>`;
                } else if (notif.status == 'disetujui' || notif.status == 'ditolak') {
                    notifItem = `
                        <li class="notification-item shadow-sm old-notification" data-status="${notif.status}" data-id="${notif.id}">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4 style="font-weight: bold;">${notif.karyawan}</h4>
                                <p>Ingin mengambil tugas dari <span class="text-dark" style="font-weight: bold;">${notif.karyawan_tugas}</span> jahitan dengan nama 
                                   <span class="text-info" style="font-weight: bold;">${notif.nama_pemesan}</span>,
                                   dan nama pemilik pakaian <span class="text-dark" style="font-weight: bold;">${notif.nama_pcs}</span> 
                                   jenis busana <span class="text-primary" style="font-weight: bold;">${notif.jenis_busana}</span></p>
                                <p class="text-end">${new Date(notif.created_at).toLocaleDateString()} ${new Date(notif.created_at).toLocaleTimeString()}</p>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>`;
                } else if (notif.status == 'dikonfirmasi' || notif.status == 'diabaikan'){
                    notifItem = `
                        <li class="notification-item shadow-sm old-notification" data-status="${notif.status}" data-id="${notif.id}">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4 style="font-weight: bold;">${notif.karyawan}</h4>
                                <p>Telah menyelesaikan jahitan pesanan atas nama <span class="text-info" style="font-weight: bold;">${notif.nama_pemesan}</span>,
                                    dan nama pemilik pakaian <span class="text-dark" style="font-weight: bold;">${notif.nama_pcs}</span> 
                                    jenis busana <span class="text-primary" style="font-weight: bold;">${notif.jenis_busana}</span></p>
                                <p class="text-end">${new Date(notif.created_at).toLocaleDateString()} ${new Date(notif.created_at).toLocaleTimeString()}</p>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>`;
                } else if (notif.hasOwnProperty('tgl_pengambilan')) { // Check if it's a pesananDueSoon notification
                    notifItem = `
                        <li class="notification-item shadow-sm new-notification" data-id="${notif.id}">
                            <i class="bi bi-clock text-warning"></i>
                            <div>
                                <h4 style="font-weight: bold;">Pesanan Mendekati Tanggal Pengambilan</h4>
                                <p>Pesanan atas nama <span class="text-info" style="font-weight: bold;">${notif.nama_pemesan}</span>,
                                    dengan tanggal pengambilan <span class="text-dark" style="font-weight: bold;">${new Date(notif.tgl_pengambilan).toLocaleDateString()}</span></p>
                               
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>`;
                }

                notificationList.insertAdjacentHTML('beforeend', notifItem);
            });

            attachEventListeners();
        }

        function updateNotificationStatus(id, url) {
            showLoader();
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                hideLoader();
                if (data.success) {
                    fetchNotifications();
                } else {
                    console.error('Failed to update notification status');
                }
            })
            .catch(error => {
                hideLoader();
                console.error('Error:', error);
            });
        }

        function attachEventListeners() {
            document.querySelectorAll('.btn-konfirmasi').forEach(button => {
                button.addEventListener('click', function() {
                    let id = this.getAttribute('data-id');
                    let url = `/konfirmasi-jahitan/${id}`;
                    updateNotificationStatus(id, url);
                });
            });

            document.querySelectorAll('.btn-abaikan').forEach(button => {
                button.addEventListener('click', function() {
                    let id = this.getAttribute('data-id');
                    let url = `/abaikan-jahitan/${id}`;
                    updateNotificationStatus(id, url);
                });
            });

            document.querySelectorAll('.btn-setuju').forEach(button => {
                button.addEventListener('click', function() {
                    let id = this.getAttribute('data-id');
                    let url = `/disetujui/${id}`;
                    updateNotificationStatus(id, url);
                });
            });

            document.querySelectorAll('.btn-tolak').forEach(button => {
                button.addEventListener('click', function() {
                    let id = this.getAttribute('data-id');
                    let url = `/ditolak/${id}`;
                    updateNotificationStatus(id, url);
                });
            });
        }

        notificationBell.addEventListener('click', function() {
            fetchNotifications();
        });

        setInterval(fetchNotifications, 60000); // Update notifications every 60 seconds
    });
</script>



<script>
  // fungsi untuk mengeubah warna menu pada sidebar sesuai dengan url yang dilihat
  function setActiveClass() {
    var currentUrl = window.location.href;
    var links = document.querySelectorAll('.nav-link');
    links.forEach(function (link) {
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
<?php 
  // cek dulu apakah ada sessionnya ngak ?

require 'function.php';
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
 $Id = $_SESSION['login'];


class anggotaKelompok {
  public $namaKetua;
  private $NimKetua;
  public $namaKelompok;
  public $kelas;
  public $email;
  public $alamat;
  private $Nim;
  private $userId;
  private $angotaId;


  public function setAtribut () {
    $this ->Nim;
    $this ->NimKetua;
    $this ->userId;
    $this ->angotaId;
  }
  public function getNimKetua () {
    return $this ->NimKetua;
  }
  public function getUserId () {
    return $this ->userId;
  }
  public function getAnggotaId () {
    return $this ->angotaId;
  }
  public function getAtributNim(){
    return $this ->Nim;
  }

  // ambil semua inputan user didalam $_post
  public function ambilDataKetua ($data) 
  {

    //ambil data ketua
    $namaKetua = $this ->namaKetua = $data ['ketua'];
    $NimKetua =  $this ->NimKetua = $data ['NimKetua'];
    //masukan kedalam 1 array
    $arrayKetua = [
                  "namaKetua" => $namaKetua,
                  "NimKetua" => $NimKetua
                  ];
     //kembalikan array
    return $arrayKetua;
 
    
  }
  public function ambilDataAnggota ($anggota){
   
    $namaAnggota = $this ->namaKelompok = $anggota ['NamaAnggota'];
    $NIM = $this ->Nim = $anggota ['NIM'];
    $kelas = $this ->kelas =$anggota ['kelas'];
    $email = $this ->email =$anggota ['Email'];
    $alamat = $this ->alamat = $anggota ['Alamat'];
    $userId =  $this ->userId = $anggota ['User_Id'];
    $anggotaId = $this ->anggotaId = $anggota ['Anggota_Kelompok'];

    //masukan ke dalam array
    $arrayAnggota = [
                    "namaKelompok" => $namaAnggota,
                    "nim" => $NIM,
                    "kelas" => $kelas,
                    "email" => $email,
                    "alamat" => $alamat,
                    "userId" => $userId,
                    "anggotaId" => $anggotaId
                    ];
      //kembbailkan aray
      return $arrayAnggota;
  }
}
     //ambil data user
  $user = query ("SELECT * FROM user");
  // ambil data di anggota kelompok\
  $daftarKetua =  query ("SELECT * FROM anggota_kelompok");
  //ambil data nama user
    $nama =  query ("SELECT Nama,Anggota_Kelompok_Id FROM user_mahasiswa WHERE User_Id = $Id")[0];

  // cek user menabahakan ketua belum
 if(isset ($_POST['submit'])) {
  // buat objek yang diinginkan
  $objk =  new anggotaKelompok();
  $dataKetua =  $objk ->ambilDataKetua ($_POST);

    if(tambahKetua ($dataKetua) > 0 ) {
      echo "
      <script>
        alert('data berhasil ditambahkan');
        document.location.href = 'profile.php';

      </script>

          ";
    }else {
      echo "
        <script>
        alert('data gagal ditambahkan');

      </script>


          ";
    }
 }
// menambahkan anggota
 if(isset ($_POST['submit1'])) {
  // buat objek yang diinginkan
    $objk1 =  new anggotaKelompok();
  $dataAnggota = $objk1 -> ambilDataAnggota ($_POST);
    if( tambahAnggota($dataAnggota) > 0) {
      echo "
      <script>
        alert('data berhasil ditambahkan');
        document.location.href = 'profile.php';

      </script>

          ";
    }else {
      echo "
        <script>
        alert('data gagal ditambahkan');

      </script>


          ";
    }
 }


 ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Information Kp</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center" style="background-image: linear-gradient(120deg,#2980b9,#a244ad);">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="https://tse2.mm.bing.net/th?id=OIP.CQox7uRRDuM-w9HZHzGxHQHaHP&pid=Api&P=0" alt="">
        <span class="d-none d-lg-block">Information PK</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->
        <!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="https://tse3.mm.bing.net/th?id=OIP.EVdhcEQF7Nfegerne_8DtgHaIw&pid=Api&P=0" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">Four Team</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Four Team</h6>
              <span>Information Kp</span>
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
              <a class="dropdown-item d-flex align-items-center" href="index.php">
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
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Home</span>
        </a>
      </li><!-- End Dashboard Nav -->

        <!-- Help Desk -->
        <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-question-circle"></i><span>HelpDesk</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="helpdesk/Form-Form KP - Poliwangi.pdf">
              <i class="bi bi-circle"></i><span>Formulir</span>
            </a>
          </li>
          <li>
            <a href="helpdesk/Panduan Kerja Praktik Poliwangi - 2015 (3).pdf">
              <i class="bi bi-circle"></i><span>Panduan Pendaftar KP</span>
            </a>
          </li>
        </ul>
      </li>
      
     


  </aside>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dasboard.php">Home</a></li>
          <li class="breadcrumb-item active">Profil</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
      <!-- profile -->
  <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="https://tse3.mm.bing.net/th?id=OIP.EVdhcEQF7Nfegerne_8DtgHaIw&pid=Api&P=0" alt="Profile" class="rounded-circle">
                <h2>Selamat Datang</h2>
              <h3>Daftarkan Anda Pada Kelompok</h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-start">
              <p>Petunjuk Pendaftaran Kelompok</p>
              <p><li>Jika anda seorang ketua maka diwajibkan mendaftar ketua dan Anggota</li> </p>
              <p><li>Jika anada seorang anggota maka diwajibkan hnaya mendaftar Anggota</li></p>
              <p><li>Cek data diri yang dimasukan harus sesuai</li></p>
            </div>
          </div>
          


        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">
                   <li class="nav-item">
                  <button class="nav-link active">Daftar Kelompok</button>
                </li>
              </ul>
              <div class="tab-content pt-2">

                  <!-- Profile Edit Form -->
                  <form action="" method="post">
                     <h5 class="card-title">Daftar Ketua Kelompok</h5>
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama Ketua</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="ketua" type="text" class="form-control" id="fullName">
                      </div>
                    </div>
                       <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">NIM Ketua</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="NimKetua" type="text" class="form-control" id="fullName">
                      </div>
                    </div>
                    <div class="text-start">
                      <button type="submit" class="btn btn-primary" name="submit">Tambah Ketua</button>
                    </div>
                  </form>

                    <form action="" method="post">
                     <h5 class="card-title">Daftar Anggota Kelompok</h5>
                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="NamaAnggota" type="text" class="form-control" id="company">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">NIM</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="NIM" type="text" class="form-control" id="company">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Kelas</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="kelas" type="text" class="form-control" id="Job" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="Email" type="text" class="form-control" id="Country" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="Alamat" type="text" class="form-control" id="Address">
                      </div>
                    </div>

                    <div class="row mb-3">
                    <label for="inputText" class="col-md-4 col-lg-3 col-form-label">Username</label>
                     <div class="col-md-8 col-lg-9">
                       <select class="form-select" aria-label="Default select example" name="User_Id">
                       <option selected>Open this select menu</option>
                         <?php foreach ($user as $item1): ?>
                          <option value="<?= $item1['Id'] ?>"><?= $item1['Username'] ?></option>
                        <?php endforeach; ?>  
                      </select>
                     </div>
                    </div>

                    <div class="row mb-3">
                       <label for="inputText" class="col-md-4 col-lg-3 col-form-label">Kelompok</label>
                     <div class="col-md-8 col-lg-9">
                       <select class="form-select" aria-label="Default select example" name="Anggota_Kelompok">
                       <option selected>Open this select menu</option>
                         <?php foreach ($daftarKetua as $item): ?>
                          <option value="<?= $item['Id'] ?>"><?= $item['Nama_Anggota'] ?></option>
                        <?php endforeach; ?>  
                      </select>
                     </div>
                    </div>

                    <div class="text-start">
                      <button type="submit1" class="btn btn-primary" name="submit1">Daftar Anggota</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>


    </section>
  
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
     <div class="copyright">
      &copy; Copyright <strong><span>2022</span></strong>
    </div>
    <div class="credits">

    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
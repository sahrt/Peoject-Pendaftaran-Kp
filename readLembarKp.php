<?php 
  // cek dulu apakah ada sessionnya ngak ?
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
//baru jalankan classnya
  require 'connect.php';
  require 'function.php';
 

  class readLembarKp {
  public $conn;
  public $rows;
  public $result;
  public $data;

// mengambil semua isi database
  function ambilPendaftar ($query){

  global$conn;
  //kita ambil data dari database
  $result = mysqli_query($conn,$query);
  // tempat penampungan data
    $rows = [];
  while ($data = mysqli_fetch_assoc($result)) {
    $rows[] = $data;
  }
  return $rows;
}


}

  $data = new readLembarKp();
  $arrayData =  $data -> ambilPendaftar("SELECT * FROM lembar_kerja_kp");

//search
  if (isset($_POST["cari"])) {
  $arrayData = search($_POST["keyword"],'lembar_kerja_kp','Id','Tanggal','Anggota_Kelompok_Id'); 
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
      <form class="search-form d-flex align-items-center" method="post" action="">
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
              <a class="dropdown-item d-flex align-items-center" href="profile.php">
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

      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Mahasiswa</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="PendaftaranKp.php">
              <i class="bi bi-circle"></i><span>Pendaftaran KP</span>
            </a>
          </li>
          <li>
            <a href="UploadSuratIzinKP.php">
              <i class="bi bi-circle"></i><span>Uploud Surat Izin KP</span>
            </a>
          </li>
          <li>
            <a href="UploudLembarKerjaKp.php">
              <i class="bi bi-circle"></i><span>lembar Kerja KP</span>
            </a>
          </li>
          <li>
            <a href="PendaftaranUjianKP.php">
              <i class="bi bi-circle"></i><span>Pendaftaran Ujian KP</span>
            </a>
          </li>
          <li>
            <a href="JadwalUjianKP.php">
              <i class="bi bi-circle"></i><span>Jadwal Ujian KP</span>
            </a>
          </li>
          <li>
            <a href="MasukanNilai.php">
              <i class="bi bi-circle"></i><span>Melihat Nilai</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>List Pendaftar</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="readPendaftaranKp.php">
              <i class="bi bi-circle"></i><span>Lihat Pendaftar Kp</span>
            </a>
          </li>
          <li>
            <a href="readUjianKp.php">
              <i class="bi bi-circle"></i><span>Lihat Pendaftar Ujian Kp</span>
            </a>
          </li>
          <li>
            <a href="readLembarKp.php">
              <i class="bi bi-circle"></i><span>Lihat Lembar Kerja </span>
            </a>
          </li>
        </ul>
      </li>
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



     <!-- End Blank Page Nav -->

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Lembar Kp</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">list daftar</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

        <!-- Left side columns -->
    
          <div class="row">

            <div class="col-md">

              <div class="card info-card customers-card p-5">
                 <div class="pagetitle">
                        <h1>Daftar Lembar Kp</h1>
                          </div>
                         <div class="search-bar">
                            <form class="search-form d-flex align-items-center" method="post" action="">
                              <input type="text" name="keyword" placeholder="Search" title="Enter search keyword">
                              <button type="submit" title="Search" name="cari"><i class="bi bi-search"></i></button>
                            </form>
                          </div>
                          <div class="row" style="margin-top: 30px;">

                            </div>
  
                            
                            <!-- tabel read pendaftaran kp -->
                            <div class="table-responsive">
                                <table class="table  table-bordered  border-dark table-hover">
                            <tr>
                              <th scope="col">No</th>
                              <th scope="col">Aksi</th>
                              <th scope="col">Id</th>
                              <th scope="col">Tanggal</th>
                              <th scope="col">Lembar Kp</th>
                              <th scope="col">Kelompok Id</th>
                            </tr>

                           <!-- kita akan me looping array dan dimaksukan setiap array didalma -->
                        <?php $nomor = 1 ?>
                            <?php foreach ($arrayData as $Kp ) : ?>

                              <tr>
                                <td><?= $nomor; ?></td>
                                <td>
                                    <a href="ubahLembarKerjaKp.php?id=<?= $Kp["Id"]?>"><img src="assets/img/editing.png" style="width:20px;"></a>|
                                    <?php //<-- onclik disini untuk konfirmasi jika datanya mau dihapus --> ?>
                                    
                                    <a href="deleteLembarKerjaKp.php?id= <?= $Kp["Id"];?>" onclick= " return confirm ('apakah anda yakin menghapus data ini?');"><img src="assets/img/remove.png" style="width:20px;"></a>
                                  </td>
                                </td>
                                <td><?= $Kp["Id"]; ?></td>
                                <td><?= $Kp["Tanggal"]; ?></td>
                                <td><a href="viewLembarKerja.php?name=<?= $Kp["NamaFile"];?>"><?= $Kp["NamaFile"];?></a></td>
                                <td><?= $Kp["Anggota_Kelompok_Id"];?></td>    

                              </tr>
                          <?php $nomor++; ?>
                            <?php endforeach; ?>
                          </table>    
                        </div>
                      </div>
           
            <!-- End Customers Card -->
      
         



       
        













          </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

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
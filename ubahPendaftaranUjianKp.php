<?php 
//cek udah ada sesion ?
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
} 

require 'function.php';
class UbahUjianKp {

  private $PendaftaranKpId;
  private $accUjianKp;
  private $id;
  public $laporanLama;
  public $nameFile;
  public $type;
  public $temp;
  public $error;
  public $size;

  // kita set atribut private
  function setAtribut (){
    $this ->id;
    $this ->PendaftaranKpId;
    $this ->accUjianKp;
  }
  // ambil atribut private
  function getAtributId (){
    return $this ->id; 
  }
  function getAtributPKpId(){
    return $this ->PendaftaranKpId;
  }
  function getAtributAcc(){
    return $this ->accUjianKp;
  }
  }
  public function uploudFile ($file){
    foreach ($file as $item) {
      $nama = $this->nameFile = $item['name'];
      $type = $this->type = $item ['type'];
      $temp_name = $this ->temp = $item['tmp_name'];
      $error = $this ->error =$item['error'];
      $size = $this ->size =$item['size'];
    }

      $arrayFiles = [
            "namafile" => $nama,
            "type" => $type, 
            "temp_name" => $temp_name, 
            "error" => $error, 
            "size" => $size
           ];

    return $arrayFiles;
  }
  function ambiluserUjianKp ($data){
    // memasukan semua data menjadi perbagian
    $id = $this -> id = $data['id'];
    $pendafKp = $this -> PendaftaranKpId = $data['PendaftaranKp_Id'];
    $accUji = $this -> accUjianKp = $data['accUjianKp'];
    $laporanLama = $this -> laporanLama = $data['laporanLama'];

    // satukan menjadi 1 array utama
    $arrayData = [
          "id" => $id,
          "laporanLama" => $laporanLama,
          "pendafKp" => $pendafKp,
          "accUjianKp" => $accUji
          ];
    //kembalikan dalam bentuk array
    return $arrayData;
  }

}

// ambil id nama perusahaan di database perusahaan
$dataAccUjian = query("SELECT id,Dosen_Penguji FROM acc_ujian");
// untuk menyimpan data yang alam kita perlu mengambil data lma pada database
//ambil data url
$id = $_GET["id"];
// query data mahasiswa berdasarkan id
$dataKp = query("SELECT * FROM pendaftaran_ujian_kp WHERE Id = $id")[0];



//cek apakah user sudah menaktifkan  tombol ubah
if (isset($_POST['submit'])) {
  // ambil objek dari class pendaftaran ujian kp
  $dataUser = new UbahUjianKp ();
  //jalankan methodnya 
  $input = $dataUser ->ambiluserUjianKp ($_POST);
  $file = $dataUser ->uploudFile($_FILES);
  // cek apakah user berhasil 
  $cek = UbahPendaftarUjianKp($input,$file);
  if ($cek > 0) {
    echo "
      <script>
        alert('data berhasil dirubah');
        document.location.href = 'readUjianKp.php';
      </script>
      ";
  } else {
    echo "
      <script>
        alert('data gagal dirubah');
      </script>
    ";
  }
}



 ?>




<!-- line Html -->
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

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Pendaftaran Ujian KP</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item"><a href="index.html">Mahasiswa</a></li>
          <li class="breadcrumb-item"><a href="index.html">Pendaftaran Ujian KP</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row" style="color: black;">

        <!-- Left side columns -->
        <div class="col">
          <div class="row">

          <!-- from lembar kp -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ubah Data  Pendaftaran Ujian KP</h5>

              <!-- General Form Elements -->
              <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $dataKp["Id"]; ?>">
                  <!-- Hiden penyimpanan value data lama -->
                <input type="hidden" name="laporanLama" value="<?= $dataKp["Laporan_KP"]; ?>">
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-2 col-form-label">Pendaftar Kp Id</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="PendaftaranKp_Id" required>
                  </div>
                </div>
                 <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Laporan Ujian</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile" name="laporan_kp" >
                  </div>
                </div>
                 <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Acc Ujian Kp</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="accUjianKp" required>
                      <option selected>Open this select menu</option>
                         <?php foreach ($dataAccUjian as $item): ?>
                          <option value="<?= $item['id'] ?>"><?= $item['Dosen_Penguji'] ?></option>
                        <?php endforeach; ?>  
                    </select>
                  </div>
                </div>
               
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">
                  </label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="submit">Ubah</button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>
        

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
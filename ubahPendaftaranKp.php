<?php 
  // cek dulu apakah ada sessionnya ngak ?
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

  // kita hubungkan file function
  require 'function.php';

  class UbahDataPendaftaran_Kp
{
  //atribut objek
  public $tempatKp;
  public $alamatKp;
  public $TanggalMulai;
  public $TanggalSelesai;
  public $NamaProposalLama;
  private $id;
  private $anggotaKelompokId;
  private $dosenId;
  private $perusahaanId;
  
  // set atributnya  dengan method constructor
  // set atributnya untuk mengAkses
  public function setAtribut (){
    $this -> id;
    $this -> anggotaKelompokId;
    $this -> dosenId;
    $this -> perusahaanId;

  }
  // ambil getAtribut untuk meng akses
  public function getAtribut(){
    return $this -> id;
    return  $this -> anggotaKelompokId;
    return  $this -> dosenId;
    return  $this -> perusahaanId;
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


  function ambilInputUser ($data) {
    $tKp = $this->tempatKp = $data ['Tempat_KP'];
    $alKp = $this->alamatKp = $data ['Alamat_Kp'];
    $tglMulai = $this->TanggalMulai = $data ['Tanggal_Mulai'];
    $tglSelesai = $this->TanggalSelesai = $data ['Tanggal_Selesai'];
    $anggotaKelompokId = $this ->anggotaKelompokId = $data["Anggota_Kelompok"];
    $dosenId = $this->dosenId = $data ['Dosen_Id'];
    $persId = $this->perusahaanId = $data ['Perusahaan_Id'];
    $fileLama = $this->NamaProposalLama = $data ['FileLama'];
    $id = $this -> id = $data['id'];

    //masukan satu array

    $array = [
          "TempKp" => $tKp,
          "almatKp" => $alKp, 
          "tglMulai" => $tglMulai, 
          "tglSelesai" => $tglSelesai,
          "anggtKelompok" => $anggotaKelompokId, 
          "dosenId" =>$dosenId,
          "persId" =>$persId,
          "fileLama" => $fileLama,
          "id" => $id
          ];
    return $array;
  }


}
  // ambil id nama kelompk di database kelompok
  $datakelompok = query("SELECT Id,Nama_Anggota FROM anggota_kelompok");
    // ambil id nama dosenPembimbinf di database dosen id
  $dataDosen = query("SELECT Id,Nama_Dosen FROM dosen");
      // ambil id nama perusahaan di database perusahaan
  $dataPerusahaan = query("SELECT Id,Nama_Perusahaan FROM perusahaan");


  //ambil data url
  $id = $_GET["id"];
  // query data mahasiswa berdasarkan id
  $dataKp = query("SELECT * FROM mahasiswa WHERE id = $id")[0];


 // cek apakah tombol submit sudah dipencet atau belum
if (isset($_POST["submit"])) {
  
  // ambil data inputan user
  $data = new UbahDataPendaftaran_Kp();
  $user = $data -> ambilInputUser($_POST);
  $file = $data -> uploudFile ($_FILES);
  // cek apakah data berhasil ubah
  if ( ubahDataPendaftaran_Kp($user, $file) > 0) {
    //menampilkan koding javascript
    echo "
      <script>
        alert('data berhasil diubah');
        document.location.href = 'readPendaftaranKp.php';
      </script>
    ";
  }else{
    echo "
      <script>
        alert('data gagal diubah');
        document.location.href = 'readPendaftaranKp.php';
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

<body style="background-color: silver;">

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center" style="background-image: linear-gradient(120deg,#2980b9,#a244ad);">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="https://tse2.mm.bing.net/th?id=OIP.CQox7uRRDuM-w9HZHzGxHQHaHP&pid=Api&P=0" alt="">
        <span class="d-none d-lg-block">Information KP</span>
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
                <h4>Pendaftaran Kp</h4>
                <p>Pendaftaran Peserta telah berhasil</p>
                <p>1 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Cek data setelah Mendaftar</h4>
                <p>Untuk Perserta baru mendaftara silahkan cek datanya</p>
                <p>2 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Help Coustemer</h4>
                <p>Jika Ada Kedalah dalam proses mendaftar Hub kami</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Selamat Datang Di Pendaftara KP</h4>
                <p>Politeknik Negeri Banyuwangi</p>
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
     <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Home</span>
        </a>
      </li><!-- End Dashboard Nav -->

  </aside>

  </header><!-- End Header -->

   <main id="main" class="main">

   <div class="pagetitle">
      <h1>Ubah Pendaftaran KP</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item"><a href="index.html">Mahasiswa</a></li>
          <li class="breadcrumb-item"><a href="index.html">PendaftaranKp</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col">
          <div class="row">

          <!-- from lembar kp -->
          <div class="card p-5">
            <div class="card-body">
                <a class="card-title" href="readPendaftaranKp.php"><- Kembali</a>
              <h5 class="card-title">Ubah Data  Pendaftaran KP</h5>

              <!-- General Form Elements -->
              <form action="" method="post" enctype="multipart/form-data">
                  <!-- file hiden untuk menyipan inputan user yang lama -->
                <input type="hidden" name="id" value="<?= $dataKp["Id"]; ?>">
                <!-- Hiden penyimpanan value data lama -->
                <input type="hidden" name="FileLama" value="<?= $dataKp["Proposal"]; ?>">

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Tempat KP</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="Tempat_KP" value="<?= $dataKp["Tempat_KP"] ?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Alamat Kp</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="Alamat_Kp" value="<?= $dataKp["Alamat_KP"] ?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Tanggal Mulai</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="Tanggal_Mulai">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Tanggal Selesai</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control"  name="Tanggal_Selesai">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Proposal</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" name="Proposal">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Anggota Kelompok Id</label>
                  <div class="col-sm-10">
                     <select class="form-select" aria-label="Default select example" name="Anggota_Kelompok">
                      <option selected>Open this select menu</option>
                          <?php foreach ($datakelompok as $item): ?>
                          <option value="<?= $item['Id'] ?>"><?= $item['Nama_Anggota'] ?></option>
                          <?php endforeach; ?>  
            
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Dosen Id</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="Dosen_Id">
                      <option selected>Open this select menu</option>
                        <?php foreach ($dataDosen as $item1) : ?>
                          <option value="<?= $item1['Id'] ?>"><?= $item1['Nama_Dosen'] ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Perusahaan Id</label>
                  <div class="col-sm-10">
                     <select class="form-select" aria-label="Default select example" name="Perusahaan_Id">
                      <option selected>Open this select menu</option>
                         <?php foreach ($dataPerusahaan as $item): ?>
                          <option value="<?= $item['Id'] ?>"><?= $item['Nama_Perusahaan'] ?></option>
                        <?php endforeach; ?>  
                    </select>
                  </div>
                </div>
                
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">
                  </label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name ="submit">Ubah</button>
                  </div>
                </div>

              </form>
              <!-- End General Form Elements -->

            </div>
          </div>

        </div>

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
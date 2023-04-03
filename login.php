<?php
// mengaktifkan sesion pada halaman web
session_start();

require "connect.php";
 //setiap peng aktifan session harus dimulai dengan session_star();

// untuk kemudahan loging maka kita cek cookienya disini jika user menonaktifkan browser dicek apakah ada cookie didalam browser jika ada maka user tidak lagi login sesuai batas cookie yang dibentuk
if (isset($_COOKIE['key1']) && isset($_COOKIE['key2'])) {
  
// tampung data cookie kedalam variable
  $id = $_COOKIE['key1'];
  $key = $_COOKIE['key2'];

  // ambil username berdasarkan id
  $result = mysqli_query ($conn, "SELECT username FROM user WHERE id = $key1");
  // ambil array dengan username yang kita cari
  $row = mysqli_fetch_assoc($result);

  //cek cookie dan username
  if ($key === hash('sha256', $row['Username'])) {
    // ambil id yang dibutukan dalam user
    $result == mysqli_query ($conn, "SELECT Id FROM user WHERE Username = $Username");
    //ambil id tabel user
    $row = mysqli_fetch_assoc($result);
    // ambil idnya masukan session 
    $_SESSION['login'] = $row ["Id"];
  }
  
    header("Location: index.php");

}

// misal user mau kembali ke loging lagi maka larang user kembali sembelum tekan log out
if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}


// untuk user baru loging web maka program ini eksekusi 

if (isset($_POST["submit"])) {
  $username = $_POST['username'];
  $password = $_POST['password'];


  $result = mysqli_query($conn, "SELECT * FROM user WHERE Username = '$username'");
  $cek = mysqli_num_rows($result);


  //cek username 
  // fungsi ini menghitung ada berapa baris dikembalikan nilai 1 tidak ada nilainya 0 yang artinya jika ada data didalam data base maka nilai yang dihasilakn 1 jika tidak ada nilai dihasilkan 0

  if ($cek === 1){
    //cek paswordnya
    //didalam row isi datanya id username ada pasword diacak
    $row = mysqli_fetch_assoc($result); 
  
    //pasword verify cek sebuah string sama tidak dengan hasnya denga argumentnya password asli dan password yang diacak/ has passwordnya
    $loging = password_verify($password, $row['Password']);
    if ($loging) {
      // jika user loging
      $_SESSION['login']= $row["Id"];

      // cek remember me
      if (isset($_POST['remember'])) {
        // buat cookie;
        // cookie dibuat dengan setcookie ("nama file"."value","lama cookie digunakan")
        //untuk keamanan kita gunakan enkripsi
        // membuat 2 cookie id dan username
        setcookie("key1",$row['Id'], time()+120);
        setcookie("key2",hash('sha256', $row['Username'], time()+120));

      }

      header("Location: login.php");
      exit;
    }

  } 
  //jika terjadi salaha maka error akan ditampilkan
  
  $error = true;
  

  /* sesion mekanisme penyimpnana informasi ke dalam variable agar bisa digunakan di lebih dari satu halaman  
  super gelobal $_SESSION
  // sebelum menuliskan mengunkana session
  mengunakan session_start()
  sesion berfungsi agar user nakal tidak masuk sembarangn kedalam website kita
  

  */
  
}

 ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Login - NiceAdmin Bootstrap Template</title>
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

<body style="background-image: linear-gradient(120deg,#2980b9,#a244ad);">

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Kp Information</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login Mahasiswa</h5>
                    <p class="text-center small">Masukan Username dan Password</p>
                  </div>

                  <form class="row g-3 needs-validation" action="" method="post">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <!-- cek apakah user berhasil ? -->

                    <?php if (isset($error)):?>
                      <p style="color:red; font-style: italic;">Username dan Password Salah !!!</p>
                    <?php endif; ?>


                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe" name="remember">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name = "submit">Login</button>
                    </div>
                     <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="register.php">Create an account</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                 <div class="copyright">
                    &copy; Copyright <strong><span>2022</span></strong>
                  </div>
                 <div class="credits">

                  </div>
            
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

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
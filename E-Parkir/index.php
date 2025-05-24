<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-Parking</title>

  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/font-awesome.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/animate.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/nouislider.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/select2.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/ionrangeslider/ion.rangeSlider.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/ionrangeslider/ion.rangeSlider.skinFlat.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/bootstrap-material-datetimepicker.css"/>
  <link href="asset/css/style.css" rel="stylesheet">
  <link rel="shortcut icon" href="asset/img/uin.png">

  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
    }

    .main-container {
      display: flex;
      height: 100vh;
    }

    .left-section {
      width: 40%;
      background-color: white;
      box-shadow: 0 7px 16px #00655b, 0 4px 5px #006f64;
      padding: 20px;
      overflow-y: auto;
    }

    .right-section {
      width: 100%;
      height: 100%;
      overflow: hidden;
      background-color: #009688;
    }

    .right-section img {
      max-width: 130%;
      max-height: 120%;
      object-fit: fill;
      display: block;
    }
  </style>
</head>

<?php
  include "config/koneksi.php";

  date_default_timezone_set("Asia/Jakarta");
  $waktu = date('H:i');
  $tanggal = date('D, d M Y');

  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($con, "SELECT * FROM tb_login WHERE username = '$username' AND password = '$password'");
    $row = mysqli_fetch_array($query);

    if ($row['username'] == $username && $row['password'] == $password) {
        session_start();
        $_SESSION['username'] = $row['username'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['role'] = "petugas";

        $query = mysqli_query($con, "INSERT INTO tb_akses_admin VALUES('$username','$waktu')");
        echo "<script>document.location.href='home.php?nama=$username'</script>";
    } else {
        echo "<script>alert('Username atau Password Salah !!');document.location.href='index.php'</script>";
    }
  }

  if (isset($_POST['signup'])) {
        header('location:admin.php');
  }
?>

<body>
  <div class="main-container">
    <!-- Kiri: Form Login -->
    <div class="left-section">
      <div class="panel-body d-flex">
        <div style="margin-right: 20px;">
          <img src="asset/img/uin.png" width="100px" class="animated fadeInDown">
        </div>
        <div>
          <h1 class="animated fadeInLeft" id="jam" style="font-size: 62pt"><?= $waktu ?></h1>
          <p class="animated fadeInRight" style="font-size: 14pt;"><?= $tanggal;?></p>
        </div>
      </div>
      <div class="panel-heading bg-teal">
        <h4 style="color: white" class="animated zoomIn">Parkir Uin Raden Intan Lampung</h4>
      </div>
      <div class="col-md-12 panel-body">
        <div class="col-md-11">
          <form class="cmxform" method="POST">
            <div class="form-group form-animate-text" style="margin-top:50px !important;">
              <input type="text" class="form-text form-control" id="validate_username" name="username" required>
              <label>Username</label>
            </div>
            <div class="form-group form-animate-text" style="margin-top:20px !important;">
              <input type="password" class="form-text form-control" id="validate_password" name="password" required>
              <label>Password</label>
            </div>
            <input class="submit btn btn-success col-md-5 col-sm-5 col-xs-12" style="margin-top: 10px; margin-left: 10px;height: 40px;" type="submit" value="Login" name="login">
          </form>
          <form class="cmxform" method="POST">
            <input class="submit btn btn-danger col-md-5 col-sm-5 col-xs-12" style="margin-top: 10px; margin-left: 10px; height: 40px;" type="submit" value="Admin" name="signup">
          </form>
        </div>
      </div>
    </div>

    <!-- Kanan: Gambar -->
    <div class="right-section">
      <img src="asset/img/gedungg.jpg" alt="Tampilan Gambar">
    </div>
  </div>
</body>
</html>

<?php
session_start();
if(isset($_SESSION['name']))
{
  if($_SESSION['role']=="USER")
  {
    header("Location: ../user");
  }
  else if($_SESSION['role']=="ADMIN")
  {
    header("Location: ../admin");
  }
  else if($_SESSION['role']=="COUNSELOR")
  {
    
  }
}
else
{
  header("Location: ../login.php");
}
include('../db.php');
$query="SELECT COUNT(*) FROM  counselling_list WHERE STATUS='PENDING' AND COUNSELLOR_ID ='".$_SESSION["id"]."'";
$result=mysqli_query($db,$query);
$row=mysqli_fetch_array($result);
$count=$row[0];
?>
<!DOCTYPE html>
<html lang="en">

<head>
<style>
   #animated-text {
            padding: 5px;
            background-color: #3498db;
            color: #ffffff;
            border-radius: 5px;
            font-size: 16px;
            animation: slideIn 1s ease-out;
            opacity: 0;
            animation-fill-mode: forwards;
        }
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
          }
  iframe{
    width: 80%;
    position: absolute;
    top:8.5%;
    left:19.5%;
    height: 1200px;
    border: 1px solid red;}
body{background-image:url(images/bg.jpg)!important;background-size:1400px 900px;background-repeat:no-repeat}
 h2{
      color: pink;
      font-size:15px
      text-decoration: none;
      margin-center: 15px}
</style>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>wellmind</title>
  <!-- font wesome stylesheet -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

  <title>User page</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Vendor CSS Files 
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">-->

  <!-- Template Main CSS File -->
  <script src="https://kit.fontawesome.com/1b38070603.js" crossorigin="anonymous"></script>

  <link href="assets/css/style.css" rel="stylesheet">
<link href="css/styleuser.css" rel="stylesheet" />
</head>
<body>
  <div class="hero_area">
  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>       
  <header id="header">
<img src="images/logo.png" alt=""><br><h2 style="margin-left: 30px">WellMind</h2>
    <div class="d-flex flex-column">
<br><br><br>
      <nav id="navbar" class="nav-menu navbar">

        <ul>
          <li><a href="today.php" target="main" class="nav-link scrollto active"><i class="fa fa-calendar" style="color: #FFD43B;"></i> <span>Today Counselling</span></a></li>
          <li><a href="request.php" target="main" class="nav-link scrollto active"><i class="fa fa-clock-o" style="color: #FFD43B;"></i> <span>Counselling Requests</span></a></li>
          <li><a href="history.php"  target="main" class="nav-link scrollto"><i class="fa fa-history" style="color: #FFD43B;"></i> <span>Counselling History</span></a></li>
          <li><a href="profileedit.php" target="main" class="nav-link scrollto"><i class="fas fa-user-edit" style="color: #FFD43B;"></i> <span>Profile Edit</span></a></li>
          //<li><a href="#portfolio" target="main" class="nav-link scrollto"><i class="bx bx-book-content"></i> <span></span></a></li1.
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
       <li class="nav-item" style="margin-right:20px">
          <a class="nav-link" href="request.php" id="animated-text" target="main" style="font-size:20px;color:white"">Pending Request: <?php echo $count; ?> </a>
        </li>
          <li class="nav-item active" style="margin-right: 20px;color:white">
          <a class="nav-link" href="about.html" target="main" style="font-size:20px;color:white"">About Us <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item" style="margin-right:20px">
          <a class="nav-link" href="service.html" target="main" style="font-size:20px;color:white"">Service</a>
        </li>
        <li class="nav-item" style="margin-right: 20px">
          <a class="nav-link" href="feedback.html" target="main" style="font-size:20px;color:white">Feedback</a>
        </li>
        <li class="nav-item" style="margin-right: 20px">
          <a class="nav-link" href="#" style="font-size:20px;color:white"><?php echo "Hello " . $_SESSION["name"]; ?></a>
        </li>
        <li class="nav-item" style="margin-right: 20px">
          <a class="nav-link" href="../logout.php" style="font-size:20px;color:white">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

      </div>
    </section><!-- End Breadcrumbs -->
</main>
</div>
<section class="inner-page" align="right">
      <!-- <div class="container" align="left">
        <p align="right">
          Example inner page template
        </p> 
        
      </div> -->
      <iframe name="main" ></iframe>

    </section>
</body>
</html>

 
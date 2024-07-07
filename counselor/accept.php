<!DOCTYPE html>
<html lang="en">

<head>
  <style>

  </style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Counseling</title>
</head>

<body>

</body>

</html>
<?php
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;

session_start();
if (isset($_SESSION['name'])) {
  if ($_SESSION['role'] == "USER") {
    header("Location: ../user");
  } else if ($_SESSION['role'] == "ADMIN") {
    header("Location: ../admin");
  } else if ($_SESSION['role'] == "COUNSELOR") {
  }
} else {
  header("Location: ../login.php");
}
?>
<?php



if (isset($_GET["action"]) && isset($_GET["id"])) {
  include("../db.php");
  $id = $_GET["id"];
  $action = $_GET["action"];
  if ($action == "true") {
    $sql = "UPDATE counselling_list SET STATUS='ACCEPTED' WHERE ID='$id'";
    // $result=mysqli_query($db,$sql);
    if ($result) {
      $user_id = "SELECT USER_ID FROM counselling_list WHERE ID='$id'";
      $user_id_result = mysqli_query($db, $user_id);
      $user_id_row = mysqli_fetch_array($user_id_result);
      $user_id = $user_id_row['USER_ID'];
      $user_mail = "SELECT MAIL FROM register WHERE ID='$user_id'";
      $user_mail_result = mysqli_query($db, $user_mail);
      $user_mail_row = mysqli_fetch_array($user_mail_result);
      $user_mail = $user_mail_row['MAIL'];
      //send appointment accepted mail
      echo $user_mail;
      $mail = new PHPMailer(true);
      $mail->IsSMTP();
      $mail->Host = "smtp.gmail.com";
      $mail->SMTPAuth = true;
      $mail->Username = "noreplywellmind@gmail.com";
      $mail->Password = "haothaqfebpevmao";
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      $mail->Port = 465;
      $mail->IsHTML(true);
      $mail->AddAddress($user_mail, "User");
      $mail->SetFrom("noreplywellmind@gmail.com");
      $mail->Subject = "Appointment Accepted";
      $content = "<b>Your appointment has been accepted by the counselor. Please login to your account to get the details of the appointment.</b>";
      $mail->MsgHTML($content);
      if (!$mail->Send()) {
        echo "Error while sending Email.";
      } else {
        echo "Email sent successfully";
      }

      echo "document.getElementById('myModal').style.display='block'";
      echo "<script>alert('Appointment Accepted Successfully');</script>";

      echo "<script>window.location.href='request.php';</script>";
    } else {
      echo "<script>alert('Appointment Accepting Failed');</script>";
    }
  } else if ($action == "false") {
    $sql = "UPDATE counselling_list SET STATUS='REJECTED' WHERE ID='$id'";
    // $result=mysqli_query($db,$sql);
    if ($result) {
      echo "<script>alert('Appointment Rejected Successfully');</script>";
      echo "<script>window.location.href='request.php';</script>";
    } else {
      echo "<script>alert('Appointment Rejecting Failed');</script>";
    }
  }
}
?>
<?php
session_start();
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;

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
?>
  <!DOCTYPE html>
<html>
<head>
    <style>
        form {
            display: flex;
            flex-direction: column;
            width: 50%;
            margin: auto;
        }
        label {
            margin-top: 10px;
        }
        input {
            padding: 10px;
            margin-top: 5px;
        }
        input[type="submit"] {
            margin-top: 20px;
            background-color: green;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: darkgreen;
        }
        h1 {
            text-align: center;
            margin-top: 50px;
            color: brown;
        }
    
    
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        a{
            text-decoration: none;
            color: #fff;
        }
        button {
            background-color: green;
            margin-left: 10px;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        table {
            
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            color: brown;
        }

        table {
            width: 70%;
            margin: auto;
            font-family: Arial, Helvetica, sans-serif;
        }

        table,
        tr,
        th,
        td {
            border: 1px solid #d4d4d4;
            border-collapse: collapse;
            padding: 12px;
        }

        th,
        td {
            text-align: left;
            vertical-align: top;
        }

        tr:nth-child(even) {
            background-color: #e7e9eb;
        }
        .modal{
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgb(0,0,0);
      background-color: rgba(0,0,0,0.4);
    }
    .modal-content{
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
    }

    </style>
</head>
<body>
    <script>
        function func(status,id)
        {
            document.querySelector('.modal').style.display = "block";
            var form=document.getElementById('appointment_form');
        var id_field=document.createElement('input');
        id_field.type='hidden';
        id_field.name='id';
        id_field.value=id;
        form.appendChild(id_field);
       
          /* 
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);
                    location.reload();
                }
            };
            xhttp.open("GET", "update.php?status="+status+"&id="+id, true);
            xhttp.send(); */
        }
        
     var modal = document.querySelector('.modal');
        // var btn = document.querySelector('button');
        // var span = document.querySelector('.close');

        function close1(){
           var modal=document.querySelector('.modal');    
           modal.style.display = "none";
        }
        
    
    </script>

    
    <div class="modal">
      <div class="modal-content">
        <button class="close" onclick="close1()">&times;</button>
        <h2>Appointment Details</h2>
        <form  id="appointment_form" method="post">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" required />
            <label for="time">Time</label>
            <input type="time" name="time" id="time" required />
            <label for="link">Link</label>
                <input type="text" name="link" required />
            <input type="submit" name="submit" value="Submit">
        </form>
      </div>
    </div>
    
<?php
include("../db.php");
if(isset($_GET["id"])&&isset($_GET["status"]))
    {
        if($_GET["status"]=="false")
        {
            $id=$_GET["id"];
            $sql="UPDATE counselling_list SET STATUS='REJECTED' WHERE ID='$id'";
            $result=mysqli_query($db,$sql);
            if($result)
            {
                echo "<script>alert('Appointment Rejected Successfully');</script>";
                echo "<script>window.parent.location.href='index.php';</script>";
            }
            else
            {
                echo "<script>alert('Appointment Rejecting Failed');</script>";
            }
        }
    }
 if($_SERVER["REQUEST_METHOD"]=="POST")
 {
    $date=$_POST["date"];
    $time=$_POST["time"];
    $link=$_POST["link"];
    $id=$_POST["id"];
    
        $user_id = "SELECT USER_ID FROM counselling_list WHERE ID='$id'";
      $user_id_result = mysqli_query($db, $user_id);
      $user_id_row = mysqli_fetch_array($user_id_result);
      $user_id = $user_id_row['USER_ID'];
      $user_mail = "SELECT MAIL FROM register WHERE ID='$user_id'";
      $user_mail_result = mysqli_query($db, $user_mail);
      $user_mail_row = mysqli_fetch_array($user_mail_result);
      $user_mail = $user_mail_row['MAIL'];
      $user_name="SELECT NAME FROM user_details WHERE USER_ID='$user_id'";
        $user_name_result=mysqli_query($db,$user_name);
        $user_name_row=mysqli_fetch_array($user_name_result);
        $username=$user_name_row['NAME'];
        
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
      $content = "<h1 style='color: #4CAF50;'>Dear $username ,</h1><br><br>
    <h2>Your Appointment Has Been Accepted!</h2><br>
    <br>
    <h3>Date:</h3><p style='font-size: 24px;'>$date</p><br>
    <h3>Time:</h3><p style='font-size: 24px;'>$time</p><br>
    <h3>Link:</h3><p style='font-size: 24px;'><a href='$link' style='color: #1E90FF; font-weight: bold; text-decoration: underline;'>Click Here to Access Your Appointment</a></p><br>
    <br>
    <h2>Please Log in to Your Account for More Details.</h2><br>
    <br>
    <p style='font-size: 20px;'>We appreciate your trust in our services and look forward to assisting you. If you have any questions or need further assistance, feel free to contact us at any time.</p><br>
    <br>
    <h1 style='color: #FF4500;'>Thank You for Choosing Us!</h1>";

      $mail->MsgHTML($content);
      if (!$mail->Send()) {
        echo "Error while sending Email.";
      } else {
        $sql="UPDATE counselling_list SET STATUS='ACCEPTED',DATE_OF_APPOINTMENT='$date',APPOINTMENT_TIME='$time',LINK='$link' WHERE ID='$id'";
    $result=mysqli_query($db,$sql);    
        echo "<script>alert('Appointment Accepted Successfully');</script>";
        echo "<script>window.parent.location.href='index.php';</script>";
      }

    }
    
    







$sql = "SELECT * FROM counselling_list WHERE STATUS='PENDING' AND COUNSELLOR_ID='" . $_SESSION['id'] . "'";
$user_query = "SELECT * FROM user_details WHERE USER_ID IN (SELECT USER_ID FROM counselling_list WHERE COUNSELLOR_ID='" . $_SESSION['id'] . "')";
$user_result = mysqli_query($db, $user_query);
$result = mysqli_query($db, $sql);

$user_details = array(); // Array to store user details

// Fetching all user details
while ($row_user = mysqli_fetch_assoc($user_result)) {
    $user_details[$row_user['USER_ID']] = $row_user;
}

// Displaying counseling requests along with user details
?>
<h1>Counseling Requests</h1>
<?php
if ($result->num_rows > 0) {
    echo "<table><tr><th>SNO</th>";
    echo "<th>UserName</th>";
    echo "<th>Mail id</th>";
    echo "<th>Reason</th>";
    echo "<th>Application Date</th>";
    echo "<th>Action</th>";
    $sno = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $sno++ . "</td>";
        // Fetching user details using stored array
        if (isset($user_details[$row['USER_ID']])) {
            $user_row = $user_details[$row['USER_ID']];
            echo "<td>" . $user_row['NAME'] . "</td>";
            echo "<td>" . $user_row['MAIL'] . "</td>";
        } else {
            // Handle case where user details are not found
            echo "<td colspan='2'>User details not found</td>";
        }
        echo "<td>" . $row['REASON'] . "</td>";
        echo "<td>" . $row['DATE_OF_APPLICATION'] . "</td>";
        echo "<td>";
        echo "<button onclick='func(true,".$row['ID'].")'>Accept</button>";
        echo "<a href='request.php?id=".$row['ID']."&status=false'><button >Reject</td></button></a>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}
?>
</body>
</html>

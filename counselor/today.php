<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today Counseling</title>
    <style>
        a{
            text-decoration: none;
            color: blue;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    
</body>
</html>
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
    $id=$_SESSION['id'];
    
  }
}
else
{
  header("Location: ../login.php");
}
include('../db.php');
if(isset($_SESSION["id"])&&$_SESSION["role"]=="COUNSELOR")
{
  $id=$_SESSION["id"];
  $sql="SELECT * FROM counselling_list WHERE `counsellor_id`='$id' AND DATE_OF_APPOINTMENT='".date('Y-m-d')."'";
  $result=mysqli_query($db,$sql);
  if(mysqli_num_rows($result)>0)
  {
    $row=mysqli_fetch_assoc($result);
    $user_id=$row['USER_ID'];
    $sql1="SELECT * FROM `user_details` WHERE `id`='$user_id'";
    $result1=mysqli_query($db,$sql1);
    $row1=mysqli_fetch_assoc($result1);
    echo "<h1>Today's Appointment</h1>";
    echo "<table>";
    echo "<tr>";
    echo "<th>SNO</th>";
    echo "<th>USER NAME</th>";
    echo "<th>REASON</th>";
    echo "<th>DATE OF APPLICATION</th>";
    echo "<th>DATE OF APPOINTMENT</th>";
    echo "<th>TIME</th>";
    echo "<th>LINK</th>";
    echo "<th>STATUS</th>";
    echo "</tr>";
    $result=mysqli_query($db,$sql);
    while($row=mysqli_fetch_assoc($result))
    {
      echo "<tr>";
      echo "<td>".$row['ID']."</td>";
      echo "<td>".$row1['NAME']."</td>";
      echo "<td>".$row['REASON']."</td>";
      echo "<td>".$row['DATE_OF_APPLICATION']."</td>";
      echo "<td>".$row['DATE_OF_APPOINTMENT']."</td>";
      echo "<td>".$row['APPOINTMENT_TIME']."</td>";
      echo "<td><a href='".$row['LINK']."'>".$row['LINK']."</a></td>";
      echo "<td>".$row['STATUS']."</td>";
      echo "</tr>";
    }
  }
  else
  {
    echo "<h1>No Appointments Today</h1>";
  }
}

?>
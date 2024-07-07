<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <style>
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

<?php
include('../db.php');
session_start();
if($_SESSION["role"]=="ADMIN")
{
    header("Location: ../admin");
}
else if($_SESSION["role"]=="COUNSELOR")
{
    header("Location: ../counselor");
}
else if(!isset($_SESSION["id"])||$_SESSION["role"]!="USER")
{
    header("Location: ../login.php");
}
if(isset($_SESSION["id"])&&$_SESSION["role"]=="USER")
{
    $query="SELECT * FROM  counselling_list WHERE user_id='".$_SESSION["id"]."'";
    $result=mysqli_query($db,$query);

    if(mysqli_num_rows($result) > 0) {
        echo "<h1>Appointment History</h1>";
        echo "<table>";
        echo "<tr><th>SNO</th><th>COUNSELOR NAME</th><th>REASON</th><th>DATE OF APPLICATION</th><th>DATE OF APPOINTMENT</th><th>STATUS</th><th>LINK</th></tr>";

        $i=1;
        while($row=mysqli_fetch_array($result))
        {
            $counselor_id=$row["COUNSELLOR_ID"];
            $query1="SELECT NAME FROM  counselor_details WHERE counsellor_id='".$counselor_id."'";
            $result1=mysqli_query($db,$query1);
            $row1=mysqli_fetch_array($result1);
            echo "<tr><td>".$i."</td><td>".$row1[0]."</td><td>".$row["REASON"]."</td><td>".$row["DATE_OF_APPLICATION"]."</td><td>".$row["DATE_OF_APPOINTMENT"]."</td><td>".$row["STATUS"]."</td><td>".$row["LINK"]."</td></tr>";
            $i++;
        }

        echo "</table>";
    } else {
        echo "<p>No appointments found.</p>";
    }
}
?>

</body>
</html>

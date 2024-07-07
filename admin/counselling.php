<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counselling Management</title>
    <style>
        h1{
            text-align: center;
            margin-top: 50px;
            color:brown;
        }
        table{
            width: 100%;
            border-collapse: collapse;
        }
        th,td{
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th{
            background-color: #588c7e;
            color: white;
        }
        tr:nth-child(even){
            background-color: #f2f2f2;
        }
        #searchInput {
            width: 50%;
            padding: 12px;
            margin: 20px auto;
            display: block;
        }
    </style>
    <script>
        function searchTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (var j = 0; j < td.length; j++) {
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break;
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
}
    </script>
</head>
<body>
    <h1>Counselling List</h1>
    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search ..">
</body>
</html>
<?php
include('../db.php');
session_start();
if(isset($_SESSION['name']))
{
  if($_SESSION['role']=="USER")
  {
    header("Location: ../user");
  }
  else if($_SESSION['role']=="ADMIN")
  {
    
  }
  else if($_SESSION['role']=="COUNSELOR")
  {
    header("Location: ../counselor");
  }
  else
    {
        header("Location: ../login.php");
    }
}
else
{
  header("Location: ../login.php");
}
$query="SELECT * FROM counselling_list";
$result=mysqli_query($db,$query);
if($result->num_rows>0)
{
    echo "<table id='myTable'><tr><th>ID</th><th>USER_ID</th><th>USER NAME</th><th>COUNSELLOR_ID</th><th>COUNSELOR NAME</th><th>REASON</th><th>DATE_OF_APPLICATION</th><th>DATE_OF_APPOINTMENT</th><th>STATUS</th><th>LINK</th></tr> ";
while($row=mysqli_fetch_array($result))
{
  $id=$row['ID'];
  $user_id=$row['USER_ID'];
  $user_name="SELECT NAME FROM user_details WHERE USER_ID='$user_id'";
    $user_name_result=mysqli_query($db,$user_name);
    $user_name_row=mysqli_fetch_array($user_name_result);
    $user_name=$user_name_row['NAME'];

  $counselor_id=$row['COUNSELLOR_ID'];
    $counselor_name="SELECT NAME FROM counselor_details WHERE COUNSELLOR_ID='$counselor_id'";
        $counselor_name_result=mysqli_query($db,$counselor_name);
        $counselor_name_row=mysqli_fetch_array($counselor_name_result);
        $counselor_name=$counselor_name_row['NAME'];
        
  $reason=$row['REASON'];
  $date_of_application=$row['DATE_OF_APPLICATION'];
  $date_of_appointment=$row['DATE_OF_APPOINTMENT'];
    $status=$row['STATUS'];
    $link=$row['LINK'];
  echo "<tr><td>".$id."</td><td>".$user_id."</td><td>".$user_name."</td><td>".$counselor_id."</td><td>".$counselor_name."</td><td>".$reason."</td><td>".$date_of_application."</td><td>".$date_of_appointment."</td><td>".$status."</td><td>".$link."</td></tr>";

}
}
else
{
  echo "0 results";
}
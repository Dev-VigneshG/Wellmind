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
    
  }
  else if($_SESSION['role']=="COUNSELOR")
  {
    header("Location: ../counselor");
  }
}
else
{
  header("Location: ../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <style>
        .verify-btn {
            max-width: 100px;
            min-width: 100px;
            background-color: #4CAF50;
            color: white;
            padding: 8px;
            border: none;
            cursor: pointer;
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

        .delete-btn {
            max-width: 100px;
            min-width: 100px;
            margin-top: 10%;
            background-color: #ff5757;
            color: #fff;
            padding: 8px;
            border: none;
            cursor: pointer;
        }
        #searchInput {
            width: 50%;
            padding: 12px;
            margin: 20px auto;
            display: block;
        }
    </style>
      <script>
        
        // function deleteUser(userId) {
            
        //     var xhr = new XMLHttpRequest();
        //     xhr.open('GET', 'delete_user.php?role=counsellor&id=' + userId, true);
        //     xhr.onreadystatechange = function () {
        //         if (xhr.readyState == 4 && xhr.status == 200) {
        //             console.log(xhr.responseText);
        //             location.reload();
        //         }
        //     };
        //     xhr.send();
            
        // }
     function verifyUser(userId,action) {
            
             var xhr = new XMLHttpRequest();
             xhr.open('GET', 'verify_user.php?action='+action+'&'+'id=' + userId, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                    location.reload();
                }
            };
            xhr.send();
            
          
        }
        

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
    <h1>COUNSELOR DETAILS</h1>
    
    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search ..">
    <?php
    include("../db.php");
    // Output Form Entries from the Database
    $sql = "SELECT * FROM counselor_details";

    // Fire query
    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<table id="myTable"> 
                <tr> 
                    <th>COUNSELLOR ID</th> 
                    <th>NAME</th> 
                    <th>QUALIFICATION</th> 
                    <th>MAIL</th> 
                    <th>LICENCE NUMBER</th>
                    <th>ADDRESS</th>
                    <th>STATUS</th>
                    <th>RATINGS</th>
                    <th>ACTION</th>
                </tr>';
         
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr> 
                    <td>' . $row["COUNSELLOR_ID"] . '</td>
                    <td>' . $row["NAME"] . '</td>
                    <td>' . $row["QUALIFICATION"] . '</td>
                    <td>' . $row["MAIL"] . '</td>
                    <td>' . $row["LICENCE_NO"] . '</td>
                    <td>' . $row["ADDRESS"] . '</td>
                    <td>' . $row["STATUS"] . '</td>
                    <td>' . $row["RATINGS"] . '</td>
                    ';
                    if($row["STATUS"]=="NOT VERIFIED")
                    {
                    echo "<td><button class='verify-btn' onclick=verifyUser(" . $row['COUNSELLOR_ID'] . ",'verify')>Verify</button>";
                    echo "<button class='delete-btn' onclick=deleteUser(" . $row['COUNSELLOR_ID'] . ")>Delete</button></td>";
                    }
                    
                    else{
                        echo "<td><button class='verify-btn' onclick=verifyUser(" . $row['COUNSELLOR_ID'] . ",false)>Remove Verify</button>";
                        echo "<button class='delete-btn' onclick=deleteUser(" . $row['COUNSELLOR_ID'] . ")>Delete</button></td>";
                    }
                  echo "</tr>";
        }

        echo '</table>';
    } else {
        echo "0 results";
    }

    // Closing connection
    mysqli_close($db);
    ?>
   
</body>

</html>
 
 
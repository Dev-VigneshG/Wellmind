<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Edit</title>
    
    <style>
        h2{
            color: pink;
            font-size:15px
            text-decoration: none;
            margin-center: 15px}
        form{
            position: absolute;
            top: 5%;
            left: 20%;
            width: 60%;
            
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
            padding: 20px;
            border-radius: 10px;
        }
        input[type=text]{
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type=submit]{
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type=submit]:hover{
            background-color: #45a049;
        }
        label{
            color: white;
        }
    </style>
</head>
<body>
    
</body>
</html>
<?php
include("../db.php");
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
if($_SERVER["REQUEST_METHOD"]=="POST")
{
  $name=$_POST['name'];
  $qualification=$_POST['qualification'];
  $mail=$_POST['mail'];
  $licenceno=$_POST['licenceno'];
  $address=$_POST['address'];
  $id=$_SESSION["id"];
  $query="update counselor_details set NAME='$name',QUALIFICATION='$qualification',MAIL='$mail',LICENCE_NO='$licenceno',ADDRESS='$address' where COUNSELLOR_ID='$id'";
  mysqli_query($db,$query);
  if(isset($_POST['category']))
  {
  $category=$_POST['category'];
  foreach($category as $c)
  {
    
    $q="DELETE FROM category WHERE COUNSELOR_ID='$id' AND CATEGORY='$c'";
    mysqli_query($db,$q);
   $q="INSERT INTO category(COUNSELOR_ID,CATEGORY) VALUES('$id','$c')";
   mysqli_query($db,$q);
  }
  $list=array("Career","Rehabilitation","School","Child","Clinical");
  foreach($list as $l)
  {
    if(!in_array($l,$category))
    {
      $q="DELETE FROM category WHERE COUNSELOR_ID='$id' AND CATEGORY='$l'";
      mysqli_query($db,$q);
    }

  }
  } 
  else
  {
    $del_all="DELETE FROM category WHERE COUNSELOR_ID='$id'";
    mysqli_query($db,$del_all);
  }
  $query="update register set NAME='$name' where ID='$id'";
  mysqli_query($db,$query);
  $_SESSION['name']=$name;
 // echo "<script>window.top.location.href = 'index.php';</script>";
}
$query="select * from counselor_details where COUNSELLOR_ID='$id'";

$result=mysqli_query($db,$query);
echo "<form method=post>";
while($row=mysqli_fetch_assoc($result))
{
  $name=$row['NAME'];
  $qualification=$row['QUALIFICATION'];
  $mail=$row['MAIL'];
  $licenceno=$row['LICENCE_NO'];
  $address=$row['ADDRESS'];
  $id=$_SESSION["id"];
  echo "<h2>Name:</h2><input type=text name=name value='$name'><br><br>";
    echo "<h2>Qualification:</h2><input type=text name=qualification value='$qualification'><br><br>";
    echo "<h2>Mail:</h2><input type=text name=mail value='$mail'><br><br>";
    echo "<h2>Licence No:</h2><input type=text name=licenceno value='$licenceno'><br><br>";
    echo "<h2>Address:</h2><input type=text name=address value='$address'><br><br>";
    echo "Category :";
    $sql="SELECT CATEGORY FROM category WHERE COUNSELOR_ID='$id'";
    $result=mysqli_query($db,$sql);
    $a=array();
    while($row=$result->fetch_array())
    {
      array_push($a,$row['CATEGORY']);
       echo "<input type='checkbox' name='category[]' value=".$row['CATEGORY']. " checked>".$row['CATEGORY'] ;
    }
    $list=array("Career","Rehabilitation","School","Child","Clinical");
    foreach($list as $value)
    {
      if(!in_array($value,$a))
      {
        echo "<input type='checkbox' name='category[]' value=".$value.">".$value;
      }
    }
    echo "<input type=submit name=submit value=Update>";
    

}
echo "</form>";
?>

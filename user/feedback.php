<?php
session_start();
if(isset($_SESSION['name']))
{
  if($_SESSION['role']=="USER")
  {
    header("Location: user");
  }
  else if($_SESSION['role']=="ADMIN")
  {
    header("Location: admin");
  }
  else if($_SESSION['role']=="COUNSELOR")
  {
    header("Location: counselor");
  }
}
else
{
  header("Location: login.php");
}
?>
<?php
include('../db.php');
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $email = $_POST['email'];
  $feedback = $_POST['feedback'];
  $sql = "INSERT INTO feedback (mail, feedback) VALUES ('$email', '$feedback')";
  $result = mysqli_query($db,$sql);
  if($result){
    echo "<script>alert('Feedback submitted successfully!')</script>";
  }
  else{
    echo "<script>alert('Feedback not submitted!')</script>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
  form {
  height:300px;width:300px;align-items:center;}
    body {
      font-family: Arial, sans-serif;
      background-color: cyan;
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .login-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
      width: 300px;
    }

    input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      box-sizing: border-box;
    }

    button {
      background-color: #4caf50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #45a049;
    }

    .options {
      margin-top: 10px;
      display: flex;
      justify-content: space-between;
    }
/* Add padding to containers */
.container {
  padding: 16px;
text-align:left
}

    a {
      color: #3498db;
      font-size:15px;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
  <title>Login Page</title>
</head>
<body>
  <div class="login-container">
    <h2>Feedback</h2>
    <form  method="post">
<div class="container">
      <label for="email" >Email:</label>
      <input type="email" id="email" name="email" required>
<br><br>
      <label for="feedback">Feedback:</label><br>
      <textarea id="address" name="feedback" rows="5" cols="33" required></textarea>
<br><br>
      <button type="submit">Submit</button>
   </form>
  
</body>
</html>
                                     
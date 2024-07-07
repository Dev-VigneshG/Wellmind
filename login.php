<?php
$db = new mysqli("localhost", "root", "", "wellmind");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $gmail = $_POST["mail"];
  $password = $_POST["password"];
  $result = mysqli_query($db, "SELECT * FROM register WHERE MAIL='$gmail' AND BINARY PASSWORD='$password'");
  if ($result->num_rows > 0) {
    $row = mysqli_fetch_array($result);
    $id = $row["ID"];
    if ($row["ROLE"] == "USER") {
      session_start();
      $_SESSION["id"] = $id;
      $_SESSION["name"] = $row["NAME"];
      $_SESSION["mail"] = $row["MAIL"];
      $_SESSION["role"] = $row["ROLE"];
      header("Location: user");
    } else if ($row["ROLE"] == "ADMIN") {
      session_start();
      $_SESSION["id"] = $id;
      $_SESSION["name"] = $row["NAME"];
      $_SESSION["mail"] = $row["MAIL"];
      $_SESSION["role"] = $row["ROLE"];
     
      header("Location: admin");
    } else if ($row["ROLE"] == "COUNSELOR") {
      session_start();
      $_SESSION["id"] = $id;
      $_SESSION["name"] = $row["NAME"];
      $_SESSION["mail"] = $row["MAIL"];
      $_SESSION["role"] = $row["ROLE"];
      header("Location: counselor");
    }
  } else {
    echo "<p class='error'>Incorrect Mail id Or Password .Please Try Again😢</p>";
    echo "<script> setTimeout(function(){
      var error=document.querySelector('.error');
      if(error){error.style.display='none';}
    }, 5000);</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    .error {
      position: absolute;
      top: 2%;
      background-color: #ffe6e6;
      color: #f44336;
      padding: 15px;
      margin-top: 20px;
      border-left: 6px solid #f44336;
      width: 25%;
      margin-left: auto;
      margin-right: auto;
      border-radius: 5px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      font-size: 16px;
      line-height: 1.5;
    }

    form {
      height: 300px;
      width: 300px;
      align-items: center;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: lightgreen;
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

    input[type="submit"] {
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

    .container {
      padding: 16px;
      text-align: left
    }

    a {
      color: #3498db;
      font-size: 15px;
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
    <h2>Login</h2>
    <form method="post">
      <div class="container">
        <label for="mail">Mail Id:</label>
        <input type="text" name="mail" placeholder="Mail Id" required>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" placeholder="Password" required>
        <br><br>
        <input type="submit" value="Login" />
    </form>
  </div>
  <div class="options">
    <a href="signup.php">Don't have an account?signup</a>
    <a href="forget.php">Forgot password?</a>
  </div>
  </div>
</body>

</html>
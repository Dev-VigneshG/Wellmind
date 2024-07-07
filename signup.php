<?php
//connect with db
$db = new mysqli("localhost", "root", "", "wellmind");
//check connection error
if ($db->connect_error) {
    echo "Database Connection Error: " . $db->connect_error;
}
//if user click signup button post method will run
//if user click submit button

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submit'])) {
        //get role of the user from signup form user or counselor
        $role = $_POST["role"];
        //if role is user get data from user signup form
        if ($role == "USER") {
            $name = $_POST["name"];
            $password = $_POST["password"];
            $gmail = $_POST["gmail"];
            $phonenumber = $_POST["phonenumber"];
            $age = $_POST["age"];
            //check user is already register or not
            //if already user exist prevent to signup again
            if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM register WHERE MAIL='$gmail'")) > 0) {
                echo "<p class='error'>You Have Already Register With Us 😊 .Please Login !!</p>";
            } else {
                //if user not exist insert data to database for 2 table one is register table and another one is user details table
                //register table used to login and user details table used to store user details
                //insert data to register table
                mysqli_query($db, "INSERT INTO register(NAME,MAIL,PASSWORD,ROLE) VALUES('$name','$gmail','$password','$role') ");
                $id = mysqli_insert_id($db);
                //get last inserted id from register table and insert data to user details table
                mysqli_query($db, "INSERT INTO USER_DETAILS(NAME,MAIL,USER_ID,MOBILE,AGE) VALUES('$name','$gmail','$id','$phonenumber','$age')");
                echo "<p class='success'>Thank You For Register With Us 😊.Please login</p>";
                //redirect user to login page after 2 second
                echo "<script type='text/javascript'>setTimeout(function(){ window.location.href = 'login.php'; }, 2000);</script>";
            }
            //if role is counselor get data from counselor signup form
        } elseif ($role == "COUNSELOR") {
            $counselorName = $_POST["counselorName"];
            $qualification = $_POST["qualification"];
            $mailid = $_POST["mailid"];
            $password = $_POST["password"];
            $licenceno = $_POST["licenceno"];
            $address = $_POST["address"];
            $category = $_POST["category"];
            
            //check counselor is already register or not
            //if already counselor exist prevent to signup again
            if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM register WHERE MAIL='$mailid'")) > 0) {
                echo "<p class='error'>You Have Already Register With Us 😊.Please Login !!</p>";
            } else {
                //if counselor not exist insert data to database for 2 table one is register table and another one is counselor details table
                mysqli_query($db, "INSERT INTO register(NAME,MAIL,PASSWORD,ROLE) VALUES('$counselorName','$mailid','$password','$role') ");
                $id = mysqli_insert_id($db);
                // get last inserted id from register table and insert data to counselor details table
                
                mysqli_query($db, "INSERT INTO COUNSELOR_DETAILS(NAME,MAIL,COUNSELLOR_ID,QUALIFICATION,LICENCE_NO,ADDRESS) VALUES('$counselorName','$mailid','$id','$qualification','$licenceno','$address')");
                foreach ($category as $value) {
                    $query = "INSERT INTO CATEGORY(COUNSELOR_ID,CATEGORY) VALUES('$id','$value')";
                    mysqli_query($db, $query);
                    }
                    
                echo "<p class='success'>Thank You For Register With Us 😊.Please login</p>";
                //redirect counselor to login page after 2 second
                echo "<script type='text/javascript'>setTimeout(function(){ window.location.href = 'login.php'; }, 2000);</script>";
            }
        }
    
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: lightblue;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .signup-container {

            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            margin-top:15%;
            overflow: auto;    
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input{
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .success {
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
       
        
    </style>
</head>

<body>

    <div class="signup-container">
        <div class="form-group">
            <label for="userType">Select User Type:</label>
            <select id="userType" onchange="toggleForm()">
                <option value="user">User</option>
                <option value="counselor">Mental Health Counselor</option>
            </select>
        </div>

        <form id="userForm" style="display: block;" method="post">
                      <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="gmail">Gmail:</label>
                <input type="text" id="gmail" name="gmail" required>
            </div>
            <div class="form-group">
                <label for="Phonenumber">Phonenumber:</label>
                <input type="text" id="Phonenumber" name="phonenumber" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="text" id="Age" name="age" required>
            </div>
            <input type="hidden" name="role" value="USER">
            <input name="submit" type="submit" />
        </form>
        <div class="counselor">
        <form id="counselorForm" method="post" style="display: none;">
            
            <div class="form-group">
                <label for="counselorName">Counselor Name:</label>
                <input type="text" id="counselorName" name="counselorName" required>
            </div>
            <div class="form-group">
                <label for="qualification">Qualification:</label>
                <input type="text" id="qualification" name="qualification" required>
            </div>
            <div class="form-group">
                <label for="mailid">Mail id:</label>
                <input type="text" id="mailid" name="mailid" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="licence">Clinic licence No:</label>
                <input type="text" id="licence no" name="licenceno" required>
            </div>
            <div class="form-group">
                <label for="clinic address">Clinic Address:</label>
                <textarea id="address" name="address" rows="5" cols="65" required></textarea>
            </div>
            <div class="form-group">
                
                <input type="checkbox"  name="category[]" value="Marriage" /><label for="clinic address">Category:</label>
                <input type="checkbox"  name="category[]" value="Career" /><label for="category">Career</label>
                <input type="checkbox"  name="category[]" value="Rehabilitation" /><label for="category">Rehabilitation</label>
                <input type="checkbox"  name="category[]" value="School" /><label for="category">School</label>
                <input type="checkbox"  name="category[]" value="Child" /><label for="category">Child</label>
                <input type="checkbox"  name="category[]" value="Clinical" /><label for="category">Clinical</label>
            </div>
            <input type="hidden" name="role" value="COUNSELOR">

            <input name="submit" type="submit" value="Submit" />
        </form>
    </div>
    </div>

    <script>
        function toggleForm() {
            var userType = document.getElementById("userType").value;
            if (userType === "user") {
                document.getElementById("userForm").style.display = "block";
                document.getElementById("counselorForm").style.display = "none";
            } else {
                document.getElementById("userForm").style.display = "none";
                document.getElementById("counselorForm").style.display = "block";
            }
        }
    </script>

</body>

</html>
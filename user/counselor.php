<?php
session_start();
if(isset($_SESSION['name']))
{
  if($_SESSION['role']=="USER")
  {
    
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
include("../db.php");
if(isset($_POST['submitreason']))
{
    $reason=$_POST['reason'];
    $userid=$_POST['userid'];
    $counselorid=$_POST['counselorid'];
    $duplicate_query="SELECT * FROM counselling_list WHERE USER_ID='$userid' AND STATUS = 'PENDING'";
    $duplicate_result=mysqli_query($db,$duplicate_query);
    $duplicate_query2="SELECT * FROM counselling_list WHERE USER_ID='$userid' AND COUNSELLOR_ID='$counselorid' AND STATUS = 'PENDING'";
    $duplicate_result2=mysqli_query($db,$duplicate_query2);
    if($duplicate_result2->num_rows>0)
    {
        echo "<script>alert(' You Have Already Scheduled an Appointment with this Counselor')</script>";
    }
    else{
    if($duplicate_result->num_rows>2)
    {
        echo "<script>alert(' You Have Pending 3 Appointments')</script>";
    }
    else{
    $sql="INSERT INTO counselling_list(USER_ID,COUNSELLOR_ID,REASON) VALUES ('$userid','$counselorid','$reason')";
    $result=mysqli_query($db,$sql);

    if($result)
    {
        echo "<script>alert('Appointment Scheduled Successfully');</script>";
    }
    else
    {
        echo "<script>alert('Appointment Scheduling Failed');</script>";
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
    <title>Registered Counselors</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            border-radius: 8px;
        }

        body {
            background-color: #ffd699;
            /* Light Orange */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #ff8533;
            /* Dark Orange */
            color: #fff;
            text-align: center;
            padding: 1em;
        }

        .counselor-card {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 20px;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .counselor-card:hover {
            transform: scale(1.05);
        }

        .counselor-card h2 {
            color: #ff8533;
            /* Dark Orange */
            margin-bottom: 10px;
        }

        .counselor-card p {
            color: #555;
            margin-bottom: 5px;
        }

        .counselor-card .details-label {
            font-weight: bold;
        }

        .appointment-btn {
            background-color: #ff8533;
            
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .appointment-btn:hover {
            background-color: #e64d00;
            
        }
        #category {
        padding: 10px;
        border: 2px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        width: 200px;
        background-color: #f8f8f8;
        appearance: none; 
    }

   
    #category option {
        padding: 10px;
        font-size: 16px;
        background-color: #fff;
    }

   
    #category option:hover {
        background-color: #e0e0e0;
    }

    
    #category option:checked {
        background-color: #007bff;
        color: #fff;
    }
    label {
    display: block;
    margin-bottom: 5px;
    font-size: 25px;
    color: #333;
}
    .filter
    {
        text-align: center;
        margin-top: 20px;
    }
    </style>
</head>

<body>

    <header>
        <h1>Registered Counselors</h1>
    </header>
    
    <div class="filter">
    <label>Filter by Category:</label>
    <select name="category" id="category" >
        <option value="All">All</option>
        <option value="Marriage">Marriage and Family</option>
        <option value="Career">Career </option>
        <option value="Rehabilitation">Rehabilitation </option>
        <option value="School">School </option>
        <option value="Clinical">Clinical </option>
        <option value="Child">Child </option>
    </select>
    </div>
    <div id="noResultsMessage" style="display: none; text-align: center; margin-top: 20px;">
        <h2>No counselors found for the selected category</h2>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
           
            <form method="POST">
                <label for="reason" >Reason for Appointment</label>
                <input type="text" id="reason" name="reason" placeholder="Enter reason for appointment" required>
                <input type="hidden" id="userid" name="userid" value="<?php echo $_SESSION['id']; ?>">
                <input type="hidden" id="counselorid" name="counselorid" value="">
                <input type="submit" name="submitreason" value="Submit">
            </form>
            
        </div>
    </div>
        <div class="container">
            <div class="row">
                <?php
                $query = "SELECT * FROM counselor_details WHERE status='VERIFIED'";
                $result = mysqli_query($db, $query);
                
                $c=0;
                while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    $name = $row['NAME'];
                    $clinic = "Some";
                    $qualification = $row['QUALIFICATION'];
                    $id = $row['ID'];
                    $counsellorid = $row['COUNSELLOR_ID'];
                    $c=$c+1;
                    $category=[];
                    $category_query=mysqli_query($db,"SELECT * FROM category WHERE COUNSELOR_ID='$counsellorid'");
                    if($category_query->num_rows>0)
                    {
                    while($r=mysqli_fetch_assoc($category_query))
                    {
                        
                        array_push($category,$r['CATEGORY']);
                    }
                    
                }
                ?>
                    <div class="col-md-6">
                        <div class="counselor-card" data-categories="<?php echo implode(",", $category); ?>">
                            <h2>Counselor Name <?php echo  " : ".$name; ?> </h2>

                            <p class="details-label">Clinic Name:</p>
                            <p><?php echo $clinic; ?></p>
                            <p class="details-label">Qualification:</p>
                            <p><?php echo $qualification; ?></p>
                            <p class="details-label">Category</p>
                            <?php
                            $co="";
                            foreach($category as $r)
                            { 

                                $co.=$r.",";
                            }
                            $co=substr($co ,0,-1);
                            echo $co;
                            echo "<br>";
                            ?>
                            <button class="appointment-btn" onclick="scheduleAppointment('<?php echo $counsellorid; ?>')">Schedule Appointment</button>
                        </div>
                    </div>
                <?php
                }
            
                /*
            <div class="col-md-6">
                <div class="counselor-card">
                    <h2>Counselor Name 1</h2>
                    <p class="details-label">Clinic Name:</p>
                    <p>ABC Counseling Center</p>
                    <p class="details-label">Qualification:</p>
                    <p>Ph.D. in Psychology</p>
                    <!-- Add more details as needed -->
                    <button class="appointment-btn" onclick="scheduleAppointment('Counselor Name 1')">Schedule Appointment</button>
                </div>
            </div>

            <div class="col-md-6">
                <div class="counselor-card">
                    <h2>Counselor Name 2</h2>
                    <p class="details-label">Clinic Name:</p>
                    <p>XYZ Therapy Services</p>
                    <p class="details-label">Qualification:</p>
                    <p>MA in Counseling</p>
                    <!-- Add more details as needed -->
                    <button class="appointment-btn" onclick="scheduleAppointment('Counselor Name 2')">Schedule Appointment</button>
                </div>
            </div>*/
                ?>
            </div>
        </div>

        <!-- Add more counselor cards as needed -->

        <!-- Bootstrap JS (optional) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      
        <script>
       
    var backup = document.querySelector(".row").cloneNode(true); 

    function filterCounselorsByCategory() {
        var row = document.querySelector('.row');
        row.innerHTML = backup.innerHTML;
        row.style.display = "none";
        var category = document.getElementById("category").value;
        var counselorCards = document.querySelectorAll(".counselor-card");
        var visibleCards = [];

        counselorCards.forEach(function(card) {
            var categories = card.getAttribute("data-categories").split(",");
            if (category === "All" || categories.includes(category)) {
                card.style.display = "";
                visibleCards.push(card);
            } else {
                card.style.display = "none";
            }
        });

        var row = document.querySelector('.row');
        row.innerHTML = ''; 

        if (visibleCards.length > 0) {
            visibleCards.forEach(function(card) {
                row.appendChild(card); 
            });
            row.style.display = "block";
        }
             
        

        if (visibleCards.length === 0) {
            document.getElementById("noResultsMessage").style.display = "block";
        } else {
            document.getElementById("noResultsMessage").style.display = "none";
        }
    }

    document.getElementById("category").addEventListener("change", filterCounselorsByCategory);

    filterCounselorsByCategory();

    

            function scheduleAppointment(counselorId) {
                document.getElementById("counselorid").value = counselorId;
                var modal = document.getElementById("myModal");
                modal.style.display = "block";
                window.parent.scrollTo(0, 0);

            }
            let closeBtn = document.querySelector(".close");
            closeBtn.addEventListener("click", function() {
                let modal = document.getElementById("myModal");
                modal.style.display = "none";
            }); 

        </script>
</body>

</html>
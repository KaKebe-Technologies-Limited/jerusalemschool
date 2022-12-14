<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "../config/db.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM admission WHERE id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $fname = $row["fname"];
                $lname = $row["lname"];
                $dob = $row["dob"];
                $age = $row["age"];
                $address = $row["address"];
                $district = $row["district"];
                $phone = $row["phone_number"];
                $gender = $row["gender"];
                $nationality = $row["nationality"];
                $grades = $row["grades"];
                $course = $row["course"];

            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($conn);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>First Name</label>
                        <p><b><?php echo $row["fname"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <p><b><?php echo $row["lname"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <p><b><?php echo $row["dob"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Age</label>
                        <p><b><?php echo $row["age"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <p><b><?php echo $row["address"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>District</label>
                        <p><b><?php echo $row["district"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <p><b><?php echo $row["phone_number"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <p><b><?php echo $row["gender"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>nationality</label>
                        <p><b><?php echo $row["nationality"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Grades</label>
                        <p><b><?php echo $row["grades"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Course</label>
                        <p><b><?php echo $row["course"]; ?></b></p>
                    </div>
                   
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
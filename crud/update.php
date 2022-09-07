<?php
// Include config file
require_once "../config/db.php";
 
// Define variables and initialize with empty values
$fname = $lname = $dob = $age = $address = $district = $phone = $gender = $nationality = $grades = $course = "";
$fname_err = $lname_err = $dob_err = $age_err = $address_err = $district_err = $phone_err = $gender_err = $nationality_err = $grades_err = $course_err = "";
// $name_err = $address_err = $salary_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    // $input_name = trim($_POST["name"]);
    // if(empty($input_name)){
    //     $name_err = "Please enter a name.";
    // } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    //     $name_err = "Please enter a valid name.";
    // } else{
    //     $name = $input_name;
    // }
    
    // Validate address address
    // $input_address = trim($_POST["address"]);
    // if(empty($input_address)){
    //     $address_err = "Please enter an address.";     
    // } else{
    //     $address = $input_address;
    // }
    
    // Validate salary
    // $input_salary = trim($_POST["salary"]);
    // if(empty($input_salary)){
    //     $salary_err = "Please enter the salary amount.";     
    // } elseif(!ctype_digit($input_salary)){
    //     $salary_err = "Please enter a positive integer value.";
    // } else{
    //     $salary = $input_salary;
    // }
    
    // Check input errors before inserting in database
    if(empty($fname_err) && empty($lname_err) && empty($dob_err) && ($age_err) && empty($address_err) && empty($district_err) && ($phone_err) && empty($gender_err) && empty($nationality_err) && empty($grades_err) && empty($course_err)){
        // Prepare an update statement
        $sql = "UPDATE admission SET fname=?, lname=?, dob=?, age=?, address=?, district=?, phone_number=?, gender=?, nationality=?,
        grades=?, course=? WHERE id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            // mysqli_stmt_bind_param($stmt, "sssi", $param_fname  $param_lname $param_dob   $param_age $param_address
            //   $param_district $param_phone_number $param_gender $param_nationality  $param_grades $param_course $param_id);

            mysqli_stmt_bind_param($stmt, "ssssssssssssi", $param_fname,  $param_lname,$param_dob,  $param_age,
            $param_address,  $param_district, $param_phone_number, $param_gender, $param_nationality,  $param_grades,
            $param_course, $param_id);
            
            // Set parameters
            $param_fname = $fname;
            $param_lname = $lname;
            $param_dob = $dob;
            $param_age = $age;
            $param_address= $address;
            $param_district = $district;
            $param_phone_number = $phone_number;
            $param_gender = $gender;
            $param_nationality = $nationality;
            $param_grades = $grades;
            $param_course = $course;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM admission WHERE id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
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
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the student record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="fname" class="form-control <?php echo (!empty($fname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fname; ?>">
                            <span class="invalid-feedback"><?php echo $fname_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="lname" class="form-control <?php echo (!empty($lname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lname; ?>">
                            <span class="invalid-feedback"><?php echo $lname_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Date of Birth </label>
                            <input type="date" name="dob" class="form-control <?php echo (!empty($dob_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $dob; ?>">
                            <span class="invalid-feedback"><?php echo $dob;?></span>
                        </div>
                        <div class="form-group">
                            <label>Age </label>
                            <input type="number" name="age" class="form-control <?php echo (!empty($age_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $age; ?>">
                            <span class="invalid-feedback"><?php echo $age;?></span>
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>District </label>
                            <input type="text" name="district" class="form-control <?php echo (!empty($district_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $district; ?>">
                            <span class="invalid-feedback"><?php echo $district;?></span>
                        </div>

                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="number" name="phone_number" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone; ?>">
                            <span class="invalid-feedback"><?php echo $phone_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Gender </label>
                            <input type="text" name="gender" class="form-control <?php echo (!empty($gender_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $gender; ?>">
                            <span class="invalid-feedback"><?php echo $gender;?></span>
                        </div>

                        <div class="form-group">
                            <label>Nationality </label>
                            <input type="text" name="nationality" class="form-control <?php echo (!empty($nationality_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nationality; ?>">
                            <span class="invalid-feedback"><?php echo $nationality;?></span>
                        </div>

                        <div class="form-group">
                            <label>Grades </label>
                            <input type="number" name="grades" class="form-control <?php echo (!empty($grades_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $grades; ?>">
                            <span class="invalid-feedback"><?php echo $grades;?></span>
                        </div>

                        <div class="form-group">
                            <label>Course </label>
                            <input type="text" name="course" class="form-control <?php echo (!empty($course_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $course; ?>">
                            <span class="invalid-feedback"><?php echo $course;?></span>
                        </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
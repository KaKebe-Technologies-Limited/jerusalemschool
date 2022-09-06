
<?php
        // servername => localhost
        // username => root
        // password => empty
        // database name => staff
        $conn = mysqli_connect("localhost", "root", "", "jerusalem");
         
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }
if(isset($_POST['submit']))
    {
        // Taking all  values from the form data(input)
        $fname =  $_REQUEST['fname'];
        $lname = $_REQUEST['lname'];
        $dob =  $_REQUEST['dob'];
        $age = $_REQUEST['age'];
        $address = $_REQUEST['address'];
        $email = $_REQUEST['email'];
        $district = $_REQUEST['district'];
        $phone_number = $_REQUEST['student_phone'];
        $gender = $_REQUEST['gender'];
        $nationality = $_REQUEST['nationality'];
        $grades = $_REQUEST['grades'];
        $slip = $_REQUEST['slip'];
        $photo = $_REQUEST['passport_photo'];
        $course = $_REQUEST['program'];
        $sponsor_name = $_REQUEST['sponsor_name'];
        $sponsor_email = $_REQUEST['sponsor_email'];
        $sponsor_number = $_REQUEST['sponsor_number'];
        $sponsor_nationality = $_REQUEST['sponsor_nationality'];
        $parent_name = $_REQUEST['parent_name'];
        $parent_phone = $_REQUEST['parent_phone'];
         
        // Performing insert query execution
        // here our table name is college

        // $sql = "INSERT INTO j1 (name)
        // VALUES ('$name')";

        $sql = "INSERT INTO admission (fname,lname,dob,age,address,email,district,phone_number,
        gender,nationality,grades,slip,photo,course,sponsor_name,sponsor_email, sponsor_number, sponsor_nationality,
        parent_name,parent_phone)
        VALUES ('$fname','$lname','$dob', '$age','$address','$email','district', '$phone_number','$gender','$nationality',
        '$grades','$slip','$photo','$course','$sponsor_name', '$sponsor_email','$sponsor_number','$sponsor_nationality',
        '$parent_name','$parent_phone')";

        // $sql = "INSERT INTO admission  VALUES 
        // ('$fname',
        // '$lname',
        // '$dob',
        // '$age',
        // '$address',
        // 'email',
        // 'district',
        // 'phone_number',
        // 'gender',
        // 'nationality',
        // 'grades',
        // 'slip',
        // 'photo',
        // 'course',
        // 'sponsor_name',
        // 'sponsor_email',
        // 'sponsor_number',
        // 'sponsor_nationality',
        // 'parent_name',
        // 'parent_phone'       
        // )";

        if(mysqli_query($conn, $sql)){
            echo "<h3>Data stored in a database successfully."
               ;
 
            echo nl2br("\n$fname\n $lname\n "
                . "$gender\n $address\n $email");
        } else{
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($conn);
        }
        

}  
        // Close connection
        mysqli_close($conn);
        ?>
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="registration_employee.css">
</head>
<body>

    <header>
        <h1>Employee Registration</h1>
    </header>

    <div class="container">
    <?php
        if(isset($_POST["submit"])){
        $LastName = $_POST["LastName"];
        $FirstName = $_POST["FirstName"];
        $DOB = date("Y-m-d", strtotime($_POST["DateofBirth"]));
        $Address = $_POST["Address"];
        $Email = $_POST["Email"];
        $Contact = $_POST["ContactNo"];
        $password = $_POST["password"];
        $RepeatPassword = $_POST["repeat_password"];
        $errors = array();

	    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

 
        // validate if all fields are empty
        if (empty($LastName) OR empty($FirstName) OR empty($DOB) OR empty($Address) OR empty($Email) OR empty($Contact) OR empty($password) OR empty($RepeatPassword)) {
            array_push($errors,"All fields are required");
        }

        // Helper function to check if a string ends with a specific suffix
        function endsWith($haystack, $needle) {
            $length = strlen($needle);
                if ($length == 0) {
                return true;
         }
             return (substr($haystack, -$length) === $needle);
        }       

        // Validate if the email is not valid or doesn't have the correct domain
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL) || !endsWith($Email, "@employee.com")) {
            array_push($errors, "Email is not valid or does not have the correct domain");
        }



        // password should not be less than 8
        if (strlen($password)<8) {
            array_push($errors,"Password must be atleast 8 characters long");
        }
         // check if password is the same
         if($password!= $RepeatPassword){
            array_push($errors,"Password does not match");          
        }

        // Calculate age based on Date of Birth
        $dobTimestamp = strtotime($DOB);
        $currentTimestamp = time();
        $age = floor(($currentTimestamp - $dobTimestamp) / (365.25 * 24 * 60 * 60));

    
        require_once "database_employee.php";
        $sql = "SELECT * FROM tbl_employee WHERE EMAIL_ADD = '$Email'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount > 0){
            array_push($errors, "Email Already Exist!");
        }
        if (count($errors)> 0){
                foreach($errors as $error) {
                    echo"<div class='alert alert-danger'>$error</div>";
                }
             } else {
                require_once "database_employee.php";
                $sql ="INSERT INTO tbl_employee (LAST_NAME, FIRST_NAME, DOB, AGE, ADDRESS, EMAIL_ADD, CONTACT_NO, PASSWORD) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $preparestmt = mysqli_stmt_prepare($stmt, $sql);
            if ($preparestmt) {
                mysqli_stmt_bind_param($stmt, "ssisssss", $LastName, $FirstName, $DOB, $age, $Address, $Email, $Contact, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class = 'alert alert-success'> You are Registered Successfully! </div>";
            } else {
                die("Something went wrong!");
            }
             }
            }

             ?>
        <form action="registration_employee.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="LastName" placeholder="Last Name: ">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="FirstName" placeholder="First Name: ">
            </div>
            <label>Enter Date of Birth: </label>
            <div class="form-group">
                <input type="date" class="form-control" name="DateofBirth" placeholder="Date of Birth: ">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="Address" placeholder="Address: ">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="Email" placeholder="Email: ">
            </div>
            <div class="form-group">
                <input type="int" class="form-control" name="ContactNo" placeholder="Contact No: ">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password: ">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password: ">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary key" name="submit" placeholder="Submit ">
            </div>
            <div><p> Already Have an Account? <a href="login_employee.php"> Login Here</a></div>
        </form>
    </div>
</body>
 
</html>

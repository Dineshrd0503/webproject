<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Gym</title>
    <style>
        body {
            height: 100vh;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('https://images.pexels.com/photos/841130/pexels-photo-841130.jpeg');
            background-size: cover;
            color: #e6d176;
        }

        header {
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 5px;
            text-align: center;
        }

        nav {
            background-color: #444;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #ffcc00;
        }

        section {
            padding: 20px;
            text-align: center;
            margin-top: 20px;
            color: white;
            border-radius: 10px;
        }

        .register-container {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
            width: 300px;

            margin: 0 auto;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 0px 0;
            text-align: center;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        .para {
            color: white;
            font-size: 16px;
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background: white;
            color: black;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_POST["submit"])) {
        $fullname = $_POST["fullname"];
        $phoneno = $_POST["phoneno"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        // echo $password;
        $repeatpassword = $_POST["repeatpassword"];
        $membership = $_POST["membership"];

        $errors = array();
        if (empty($fullname) || empty($phoneno) || empty($email) || empty($password) || empty($repeatpassword) || empty($membership)) {
            array_push($errors, "ALL FIELDS ARE REQUIRED");
        }

        // if (strlen($password) < 8) {
        // array_push($errors, "Password must be at least 8 characters long");

        //}
        if ($password != $repeatpassword) {
            array_push($errors, "Passwords do not match");
        }
        // Your database connection logic goes here
        $conn = mysqli_connect("localhost", "root", "", "bharath");
        // Check if email already exists
        $sql = "SELECT * FROM USERS WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount > 0) {
            array_push($errors, "Email already exists");
        }
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {
            // Hash the password before saving (for better security)
            // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            //$hashed_password = password_hash($password,

            //PASSWORD_BCRYPT);

            //echo $hashed_password;
            $sql = "INSERT INTO USERS (fullname, phoneno, email, password, membership) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "sisss", $fullname, $phoneno, $email, $password, $membership);

                mysqli_stmt_execute($stmt);
                $_SESSION['user_id'] = $user['id'];
                // Redirect to YouTube or any other website
                header("Location: success.html");
                exit(); // Make sure to exit after redirection;
            } else {
                echo "<div class='alert alert-danger'>Something went wrong</div>";
            }
        }
        // Close the database connection
        mysqli_close($conn);
    }
    ?>

    <header>
        <h1>Welcome to Our Gym</h1>
        <p>Get fit. Stay fit. Feel great.</p>
    </header>
    <nav>
        <a href="index.html">Home</a>
        <a href="index.html#aboutus"">About Us</a>
        <a href=" #">Classes</a>
        <a href="index.html#memberships">Membership</a>
        <a href="index.html#class">Contact Us</a>
    </nav>
    <section>
        <div class="register-container">
            <h2>Register</h2>
            <form action="welcome.php" method="post">
                <label for="fullname">Full Name:</label><br>
                <input type="text" id="fullname" name="fullname"><br><br>
                <label for="phoneno">Phone no:</label><br>
                <input type="phonenumber" id="phoneno" name="phoneno"><br><br>
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email"><br><br>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password"><br><br>
                <label for="password">Repeat Password:</label><br>
                <input type="repeatpassword" id="repeatpassword" name="repeatpassword"><br><br>
                <label for="membership">Membership:</label><br>
                <select id="membership" name="membership">
                    <option value="3months">3 Months</option>
                    <option value="6months">6 Months</option>
                    <option value="1year">1 Year</option>
                </select><br><br>
                <input type="submit" name="submit" value="Register">
            </form>
        </div>
    </section>
    <!--

    
    <footer>
        <p>&copy; 2024 Our Gym. All rights reserved.</p>
    </footer>
    -->
</body>

</html>
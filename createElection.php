<?php
// Include the database connection file
require_once "conn.php";

// Check if form is submitted
if(isset($_POST['submit'])){
    // Get table name from form input
    $table_name = $_POST['election_name'];

    // SQL query to create table
    $sql_create_table = "CREATE TABLE $table_name (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        age INT(3),
        branch VARCHAR(255),
        votes INT(10) UNSIGNED
    )";

    // Execute query to create table
    if ($conn->query($sql_create_table) === TRUE) {
        echo "Table $table_name created successfully";
        
        // SQL query to insert table name into 'election' table
        $sql_insert_election = "INSERT INTO election (election_name) VALUES ('$table_name')";
        
        // Execute query to insert table name
        if ($conn->query($sql_insert_election) === TRUE) {
            echo "Table name '$table_name' added to the 'election' table successfully";
        } else {
            echo "Error inserting table name into 'election' table: " . $conn->error;
        }
    } else {
        echo "Error creating table: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Create Table</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./pics/expertadvice.webp" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_2.css" />
    <!-- Unicons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <style>
        #search {
            width : 170px;
            margin-left : 20px;
        }

        #b3 {
            height : 40px;
            border-radius : 10px;
            border-color : grey;
        }
        #p1{
            color : yellow;
        }
        #intro #p2{
            color : yellow;
        }

    </style>
</head>

<header class="header">
    <nav class="nav">
        <a href="#" class="nav_logo">DigiBallot</a>

        <ul class="nav_items">
            <li class="nav_item">
            <a href="main.html" class="nav_link">Home</a>
                <a href="#" class="nav_link">About</a>
                <a href="#" class="nav_link">Services</a>
                <a href="#" class="nav_link">Contact</a>
            </li>
        </ul>

        <button class="button" id="form-open">Login</button>
    </nav>
</header>
<body>
<section class="home">
        <div class="form_container">
            <i class="uil uil-times form_close"></i>
            <div class="form login_form">
                <form action="test1.php" method="post">
                    <h2>Login</h2>

                    <div class="input_box">
                        <input name="email" type="email" placeholder="Enter your email" required />
                        <i class="uil uil-envelope-alt email"></i>
                    </div>
                    <div class="input_box">
                        <input name="password" type="password" placeholder="Enter your password" required />
                        <i class="uil uil-lock password"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                    </div>
                    <div class="input_box">
                        <select name="user" id="userType" required>
                            <option value="">Select user type</option>
                            <option value="admin">Admin</option>
                            <option value="users">Voter</option>
                            <option value="candidate">Candidate</option>
                        </select>
                    </div>
                    <div class="option_field">
                        <span class="checkbox">
                            <input type="checkbox" id="check" />
                            <label for="check">Remember me</label>
                        </span>
                        <a href="#" class="forgot_pw">Forgot password?</a>
                    </div>

                    <button class="button">Login Now</button>

                    <div class="login_signup">Don't have an account? <a href="#" id="signup">Signup</a></div>
                </form>
            </div>

            <!-- <div id="intro">
                <p id="p1"> Welcome to skyheights!</p>
                <p id="p2"> Select your Location, Property type and Budget to continue </p>
            </div> -->

            <div class="form signup_form">
                <form action="#">
                    <h2>Signup</h2>

                    <div class="input_box">
                        <input type="email" placeholder="Enter your email" required />
                        <i class="uil uil-envelope-alt email"></i>
                    </div>
                    <div class="input_box">
                        <input type="password" placeholder="Create password" required />
                        <i class="uil uil-lock password"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                    </div>
                    <div class="input_box">
                        <input type="password" placeholder="Confirm password" required />
                        <i class="uil uil-lock password"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                    </div>

                    <button class="button">Signup Now</button>

                    <div class="login_signup">Already have an account? <a href="#" id="login">Login</a></div>
                </form>
            </div>
        </div>
        <div id='bac'>
        <div id="intro">
            <p id="p1"> Welcome to Voting portal!</p>
            <p id="p2"> Enter the name of the election.</p>
        </div>
        <div id="info">
            <center>
            <form method="post" action="createElection.php">
            Election Name: <input id="b3" class="select" type="text" name="election_name">
                    
                    <input id="search" class="select" type="submit" name="submit" value="Create Election">
                    </form>
            </center>
        </div>


    </div>
    </section>
</body>
</html>

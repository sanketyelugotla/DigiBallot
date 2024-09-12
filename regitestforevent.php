<?php
// Include the database connection file
require_once "conn.php";

// Query to fetch values from the election table
$sql = "SELECT election_name FROM election";
$result = $conn->query($sql);

// Array to store election names
$election_names = array();

// Fetch election names and store them in the array
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $election_names[] = $row['election_name'];
    }
}

// Check if form is submitted for registration
if(isset($_POST['submit'])){
    // Get form data
    $name = $_POST['name'];
    $age = $_POST['age'];
    $branch = $_POST['branch'];
    $election_name = $_POST['election_name']; // Selected election name from dropdown
    
    // SQL query to insert registration details into the table named as selected election
    $sql_insert = "INSERT INTO $election_name (name, age, branch) VALUES ('$name', $age, '$branch')";
    
    // Execute query to insert registration details
    if ($conn->query($sql_insert) === TRUE) {
        echo "Registration successful";
    } else {
        echo "Error registering: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register for Election</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./pics/expertadvice.webp" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_2.css" />
    <!-- Unicons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <style>
        #b3 {
            height : 40px;
            border-radius : 10px;
            border-color : grey;
        }
        #search {
            margin-bottom : 30px;
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
    </section>

    <div id="intro">
        <p id="p1"> Welcome to DigiBallot!</p>
        <p id="p2"> Fill the below details to continue </p>

    <form method="post">
        <label for="election_name">Select an Election:</label>
        <select id="election_name" name="election_name">
            <?php
            // Loop through the election names array to populate the dropdown options
            foreach ($election_names as $name) {
                echo "<option value=\"$name\">$name</option>";
            }
            ?>
        </select><br><br>
        Name: <input id="b3" type="text" name="name"><br><br>
        Age: <input id="b3" type="number" name="age"><br><br>
        Branch: <input id="b3" type="text" name="branch"><br><br>
        <input id="search" type="submit" name="submit" value="Register">
    </form>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>

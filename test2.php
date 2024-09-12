<?php
// Include the database connection file
require_once "conn.php";

// Initialize variables
$selected_election = "";

// Check if form is submitted
if(isset($_POST['submit'])){
    // Get selected election name
    $selected_election = $_POST['election_name'];
}

// Query to fetch values from the election table
$sql = "SELECT election_name FROM election";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Election Details and Voting</title>
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
            margin-bottom : 20px;
            margin-top : 0px;
            width : 170px;
        }
        center {
            border : 1px;
        }
        .id{
            width:120px;
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

    <h2>Select Election and Vote</h2>
    <form method="post">
        <label for="election_name">Select an Election:</label>
        <select id="election_name" name="election_name">
            <?php
            // Fetch election names and populate the dropdown options
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $election_name = $row['election_name'];
                    // Check if the election is selected
                    $selected = ($election_name == $selected_election) ? 'selected' : '';
                    echo "<option value=\"$election_name\" $selected>$election_name</option>";
                }
            }
            ?>
        </select><br><br>
        <input id="search" type="submit" name="submit" value="Select Election">
    </form>
    <center>
    <?php
    // If an election is selected, display details of registered candidates
    if (!empty($selected_election)) {
        // Query to fetch registered candidates for the selected election
        $sql_candidates = "SELECT id, name, age, branch FROM $selected_election";
        $result_candidates = $conn->query($sql_candidates);
        
        if ($result_candidates->num_rows > 0) {
            // Display the details of registered candidates
            echo "<h2>Registered Candidates for Election: $selected_election</h2>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Name</th><th>Age</th><th>Branch</th><th>Action</th></tr>";
            while($row = $result_candidates->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['age']."</td>";
                echo "<td>".$row['branch']."</td>";
                echo "<td><form method='post'><input type='hidden' name='vote_id' value='".$row['id']."'><input type='hidden' name='election_name' value='$selected_election'><input type='submit' name='vote' id='search' class='id' value='Vote'></form></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No candidates registered for this election";
        }
    }
    
    // Handle voting process
    if(isset($_POST['vote'])){
        // Get form data
        $vote_id = $_POST['vote_id'];
        $election_name = $_POST['election_name']; // Selected election name from dropdown
        
        // SQL query to increment votes for the selected candidate
        $sql_update = "UPDATE $election_name SET votes = votes + 1 WHERE id = $vote_id";
        
        // Execute query to update votes
        if ($conn->query($sql_update) === TRUE) {
            echo "Vote registered successfully";
        } else {
            echo "Error voting: " . $conn->error;
        }
    }
    ?>
</center>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
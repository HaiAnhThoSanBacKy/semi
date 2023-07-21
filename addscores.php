<?php
// Replace 'your_database_host', 'your_database_user', 'your_database_password', and 'your_database_name' with your actual database credentials
$host = 'your_database_host';
$user = 'your_database_user';
$password = 'your_database_password';
$database = 'your_database_name';

// Establish a database connection
$connection = mysqli_connect($host, $user, $password, $database);

// Check the connection
if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Function to add student scores to the database
function addStudentScores($name, $mathScore, $physicsScore, $chemistryScore, $connection) {
    $name = mysqli_real_escape_string($connection, $name);
    $query = "INSERT INTO students (name, math_score, physics_score, chemistry_score) VALUES ('$name', $mathScore, $physicsScore, $chemistryScore)";

    if (mysqli_query($connection, $query)) {
        echo "Student scores added successfully.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
    }
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all fields are set in the POST request
    if (
        isset($_POST['name']) && !empty($_POST['name']) &&
        isset($_POST['math_score']) && !empty($_POST['math_score']) &&
        isset($_POST['physics_score']) && !empty($_POST['physics_score']) &&
        isset($_POST['chemistry_score']) && !empty($_POST['chemistry_score'])
    ) {
        $name = $_POST['name'];
        $mathScore = $_POST['math_score'];
        $physicsScore = $_POST['physics_score'];
        $chemistryScore = $_POST['chemistry_score'];

        addStudentScores($name, $mathScore, $physicsScore, $chemistryScore, $connection);
    } else {
        echo "Please fill in all fields.";
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Scores Form</title>
</head>
<body>
    <h1>Student Scores Form</h1>
    <form method="post" action="">
        <label for="name">Student Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="math_score">Math Score:</label>
        <input type="number" id="math_score" name="math_score" required><br>

        <label for="physics_score">Physics Score:</label>
        <input type="number" id="physics_score" name="physics_score" required><br>

        <label for="chemistry_score">Chemistry Score:</label>
        <input type="number" id="chemistry_score" name="chemistry_score" required><br>

        <input type="submit" value="Add Student Scores">
    </form>
</body>
</html>
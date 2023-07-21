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

// Function to add a subject to the database
function addSubject($name, $connection) {
    $name = mysqli_real_escape_string($connection, $name);
    $query = "INSERT INTO subjects (name) VALUES ('$name')";

    if (mysqli_query($connection, $query)) {
        echo "Subject added successfully.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
    }
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the 'subject_name' field is set in the POST request
    if (isset($_POST['subject_name']) && !empty($_POST['subject_name'])) {
        $subjectName = $_POST['subject_name'];
        addSubject($subjectName, $connection);
    } else {
        echo "Please enter a valid subject name.";
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Subject</title>
</head>
<body>
    <h1>Add Subject</h1>
    <form method="post" action="">
        <label for="subject_name">Subject Name:</label>
        <input type="text" id="subject_name" name="subject_name" required>
        <input type="submit" value="Add">
    </form>
</body>
</html>
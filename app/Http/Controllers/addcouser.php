<!DOCTYPE html>
<html>
<head>
    <title>Addcouser </title>
</head>
<body>
    <h2>add couser </h2>
    <form action="process_form.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="email">time:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <input type="submit" value="Add">
    </form>
</body>
</html>
<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST["name"];
    $email = $_POST["email"];

    // Perform any necessary data validation here
    // ...

    // Assuming you have a database connection established
    // Replace the following variables with your database credentials
    $db_host = "your_database_host";
    $db_user = "your_database_username";
    $db_pass = "your_database_password";
    $db_name = "your_database_name";

    // Create a database connection
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query to insert data into the database
    $sql = "INSERT INTO your_table_name (name, email) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $email);
    $stmt->execute();

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Redirect to a success page or back to the form
    header("Location: success_page.php");
    exit();
}
?>

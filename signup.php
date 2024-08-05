<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        <form action="signup.php" method="POST">
            <div class="form-group">
                <label for="name">userName:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="userType">User Type:</label>
                <select id="userType" name="userType" required>
                    <option value="">Select User Type</option>
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Sign Up" name="create">
            </div>
        </form>
        <p>Already have an account? <a href="login.php">Log in</a></p>
    </div>
</body>
<?php

if(isset($_POST['create'])){
    require "db.php";

    $username = $_POST['name'];
   
    $password = $_POST['password'];
    
    $email= $_POST['email'];
    $usertype = $_POST['userType'];

    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
 // Prepare the SQL statement
    $stmt = $conn-> prepare("INSERT INTO registration(username, password, email, userType)
    VALUES(?,?,?,?)");
    
    $stmt->bind_param("ssss", $username , $hashedpassword, $email, $usertype);

     // Execute the statement
    $stmt -> execute();
    echo" REISTRATION SUCCESSFUL....";
    $stmt->close();
    $conn->close();
    header("./signup.html");
    exit();



}
?>
</html>
<?php
if(isset($_POST['log'])){
    require "db.php";
    $username = $_POST['name'];
   
    $password = $_POST['password'];
    
    
    $usertype = $_POST['userType'];

    if(!isset($username, $password, $usertype)){
        header("Location: ./index.html?error=fields cannot be empty");
        exit();
    }
    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM registration WHERE username = ? ");
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows !== 1) {
        header("Location: ./index.html?error=incorrect email or password");
        exit();
    } 
    // User found, return the user data
    $user = $result->fetch_assoc();

    $passwordCheck = password_verify($password, $user[0]['password']);
    if(!$passwordCheck){
        header("Location: ./index.html?error=incorrect password or email");
        exit();
    }

    session_start();
    $_SESSION['email'] = $user[0]['email']; 

    
     // User found, perform appropriate actions based on user type
    $userType = $user[0]['userType'];

    if ($userType === 'student') {
        // Redirect to student dashboard or perform student-specific actions
        header("Location: student_dashboard.php");
        exit();
    } 
    if ($userType === 'teacher') {
        // Redirect to teacher dashboard or perform teacher-specific actions
        header("Location: teacher_dashboard.php");
        exit();
    } 
    
    // Redirect to admin dashboard or perform admin-specific actions
    header("Location: admin_dashboard.php");
    exit();
    
} 


<!DOCTYPE html>
<html>
<head>
    <title>Student Join Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 800px;
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
        .form-group input[type="text"] {
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
        .form-group .result-list {
            margin-top: 20px;
        }
        .form-group .result-list ul {
            list-style-type: none;
            padding: 0;
        }
        .form-group .result-list ul li {
            margin-bottom: 10px;
        }
    </style>
    <script>
        function joinAssignment() {
            // Code to join assignment room
            alert("Successfully joined the assignment room!");
        }

        function submitAnswers() {
            // Code to submit answers
            alert("Answers submitted successfully!");
        }

        
    </script>
</head>
<body>
    <div class="container">
    <h2>Hi, Welcome Back USER<span><h5>we missed you</h5></span></h2>
        <div class="form-group">
            <label for="assignmentCode">Assignment Code:</label>
            <input type="text" id="assignmentCode" required name="Assignment">
        </div>
        <div class="form-group">
            <input type="submit" value="Join Assignment" onclick="joinAssignment()" name="Join">
        </div>
        <div class="form-group">
            <label for="answers">Answers:</label>
            <textarea id="answers" rows="4" required name="answers"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Submit Answers" onclick="submitAnswers()" name="submit">
            <div>
        </div>
        <div class="form-group">
        <div class="container">
        <h2>view Results</h2>
        <form method="post">
            <div class="form-group">
                <label for="studentName">Student Name:</label>
                <input type="text" id="studentName" name="studentName" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" required>
            </div>
            <input type="submit" value="View Results" onclick="viewResults()" name="view">
        </div>
        <div class="form-group result-list">
           
           <?php
           echo" <h3>Your Results:</h3>";
           ?>
        </div>
    </div>
</body>
<?php
if(isset($_POST['Join'])){
    require"db.student.php";
    $assignment =$_POST['Assignment'];
    
    $stmt = $conn->prepare("SELECT * FROM teacher WHERE assignment = ? ");
    $stmt->bind_param("s", $assignment);

    $stmt->execute();

    $result = $stmt->get_result();

    // Check if the code exists
    if ($result->num_rows !== 1) {
        header("Location: student.php?error=incorrect  code");
        exit();
    } 
    //  code found, return the  code data
    $user = $result->fetch_assoc();


    session_start();
    $_SESSION['Assignment'] = $user[0]['assignment']; 


    // if code match upload the questions


}
?>
<?php
if(isset($_POST['submit'])){
    require "db.student.php";

    $submit = $_POST['submit'];
   
    
 // Prepare the SQL statement
    $stmt = $conn-> prepare("INSERT INTO student(submit)
    VALUES(?)");
    
    $stmt->bind_param("ssss", $submit);

     // Execute the statement
    $stmt -> execute();
    echo" REISTRATION SUCCESSFUL....";
    $stmt->close();
    $conn->close();
    header("Location: student.php");
    exit();

}
?>
<?php
if(isset($_POST['view'])){
    require"db.publish.php";
    $studentname =$_POST['studentName'];
    $subject=$_POST['subject'];
    
    $stmt = $conn->prepare("SELECT * FROM publish WHERE studentName = ?  AND subjects= ?" );
    $stmt->bind_param("ss", $studentName, $subject);

    $stmt->execute();

    $result = $stmt->get_result();

    // Check if the code exists
    if ($result->num_rows !== 1) {
        header("Location: student.php?error= name not found , check for spelling errors");
        exit();
    } 
    //  code found, return the  code data
    $users = $result->fetch_assoc();
  


    session_start();
    $_SESSION['marks'] = $users[0]['marks']; 
    


    // if  name matches , view  your results


}
?>

</html>
<!DOCTYPE html>
<html>
<head>
    <title>Enter Results</title>
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
        .form-group input[type="number"] {
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
        <h2>Enter Results</h2>
        <form  method="POST">
            <div class="form-group">
                <label for="studentName">Student Name:</label>
                <input type="text" id="studentName" name="studentName" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" required>
            </div>
            <div class="form-group">
                <label for="marks">Marks:</label>
                <input type="number" id="marks" name="marks" min="0" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Save Results" name="publish">
            </div>
        </form>
    </div>
</body>
<?php

if(isset($_POST['publish'])){
    require "db.publish.php";

    $studentname =$_POST['studentName'];
    $subject =$_POST['subject'];
    
    $mark= $_POST['marks'];

 // Prepare the SQL statement
    $stmt = $conn-> prepare("INSERT INTO publish(studentName, subjects , marks)
    VALUES(?,?,?)");
    
    $stmt->bind_param("sss",  $studentname, $subject, $mark);

     // Execute the statement
    $stmt -> execute();
    echo" REDISTRATION SUCCESSFUL....";
    $stmt->close();
    $conn->close();
    header("Location: teacher.php");
        exit();


}
?>
</html>
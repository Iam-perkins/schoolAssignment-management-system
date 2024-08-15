<!DOCTYPE html>
<html>
<head>
    <title>Teacher Page</title>
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
        .form-group input[type="text"],
        .form-group textarea {
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
        h5{
            font-weight:light;
            font-style:"sans-serif";
        }
    </style>
    <script>
        
        function uploadQuestions() {
            // Code to upload questions
            alert("Questions uploaded successfully!");
        }

        function markResults() {
            // Code to mark results
            alert("Results marked successfully!");
        }
       
    </script>
</head>
<body>
    <div class="container">
        <h2>Hi, Welcome Back USER<span><h5>we missed you</h5></span></h2>
        <p> create an assignment room for your fellow students to interact and answer questions below</p>
        <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="assignmentName">Assignment Name:</label>
            <input type="text" id="assignmentName" required name="Assignment">
        </div>
        <div class="form-group">
            <label for="questions">Summary:</label>
            <textarea id="questions" rows="4"  placeholder="give a brief summary about the room your creating"required name="summary"></textarea>
        </div>
       
        <div class="form-group">
            <label for="assignmentCode">Assignment Code:</label>
            <input type="text" id="assignmentCode" placeholder="create a code to identify the room" required name="Code">
        </div>
        <div class="form-group">
        <label for="assignmentName">Upload Questions:</label>
            <input type="file" value="Upload Questions" name="uploadQuestions"  >
        </div>
        <div class="form-group">
            <input type="submit" value="Create Assignment" onclick="createAssignment()" name="create">
        </div>
        </form>
        <div>
            
        </div>

        <a href="publish.php">publish results</a>
    </div>
 
</body>
<?php
if(isset($_POST['create'])){
    require "db.teacher.php";
    $assignment= $_POST['Assignment'];
    $summary= $_POST['summary'];
    $code= $_POST['Code'];
    

    $stmt = $conn-> prepare("INSERT INTO teacher(Assignment, summary, Code)
    VALUES(?,?,?)");
     
    $stmt->bind_param("sss", $assignment , $summary, $code);

     // Execute the statement
    $stmt -> execute();
    echo" REISTRATION SUCCESSFUL....";
    $stmt->close();
    $conn->close();
    header("Location: teacher.php");
        exit();

}
?>
<?php

if(isset($_POST['create'])){
    require"db.teacher.php";
$targetDir= "images/";
$targetFile = $targetDir. basename($_FILES['uploadQuestions']['name']);
$uploadOk= 1;
    if(file_exists($targetFile)){
        echo " sorry file already exists";
        $uploadOk = 0;
    }

    if($uploadOk==0){
        echo "fsorry, your fie was not uploaded";
    }else{
        if(move_uploaded_file($_FILES['uploadQuestions']['tmp_name'],$targetFile)){
            echo " the file ". basename($_FILES['uploadQuestions']['name']). "has been uploaded.";
        }else{
            echo " sorry, there was an error uploading  your file";
        }
    }
       
    $stmt = $conn->prepare("INSERT INTO teacher(uploasQuestion)
    VALUES(?) ");
    $stmt->bind_param("s", $targetFile);

    // Execute the statement
   $stmt -> execute();
   echo" ROOM CREATED SUCCESSFULLY";
   $stmt->close();
   $conn->close();
   header("Location: teacher.php");
       exit();

}

?>
</html>
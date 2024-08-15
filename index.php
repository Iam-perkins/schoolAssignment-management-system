<!DOCTYPE html>
<?php require 'db.php';?>
<html>
<head>
    <title>Admin Page</title>
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
        .form-group .pending-list {
            margin-top: 20px;
        }
        .form-group .pending-list ul {
            list-style-type: none;
            padding: 0;
        }
        .form-group .pending-list ul li {
            margin-bottom: 10px;
        }
        td{
    justify-content: space-between;
    margin-left: 3px;
        }
        tr:nth-child(even){
    background-color:#D6EEEE;
        }
        .delete{
            background-color: red;
            color: white;
            border-radius: 3px;
        }
        .accept{
            background-color: greenyellow;
            color: black;
            border-radius: 3px;
        }
    </style>
    
</head>
<body>
    <div class="container">
        <h2>Admin Page</h2>
        <div class="form-group">
            <label for="pendingUsers">Pending Users:</label>
            <div class="pending-list">
            <table style="width:100%">
          
            <tr>
                       <th>ID</th>               
                       <th>USERNAME</th>
                       <th>USERTYPE</th>
                       <th colspan ='2'>ACTION</th>
                    </tr>
            <?php
         
              $sql= " SELECT ID, name , userType FROM signup";
                $result= $conn->query($sql);
                 if(!$result){
                     die("Invalid query".$conn->error);
}
                        while($row = $result->fetch_assoc()){
                            ?>
                       
                       <tr>
                       <th id="strike"><span><form method="post">
                        
                        </form>
                    </span><p id="task" class="child"><?php echo $row["ID"]?></p></th>
                       <th id="time"><?php echo $row["name"]?></th>
                       <th id="to"><?php echo $row["userType"]?></th>
                       
                       
                       <th colspan ='2'><form method="post">
                       <button id ='two' class="accept" type='submit' name='accept' value=>ACCEPT</button>
                       <button id ='two' class="delete" type='submit' name='delete' value=<?php echo $row['ID']?>>DELETE</button>
                       </form>
                       </th>
                    </tr>
                    <?php
                         
                     
}
            ?>
                 
            </table>
          
                        
            </div>
        </div>
    </div>
</body>
<?php
if(isset($_POST['delete'])){
    

        $id= $_POST['delete'];
        
        $stmt = $conn-> prepare("DELETE FROM signup  WHERE ID=?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        echo "<script> alert('user deleted successfully')</script>";
        $conn->close();
    }
?>
</html>
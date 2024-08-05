<!DOCTYPE html>
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
    </style>
    <script>
        function acceptUser(userId) {
            // Code to accept user
            alert("User with ID " + userId + " has been accepted!");
        }

        function declineUser(userId) {
            // Code to decline user
            alert("User with ID " + userId + " has been declined!");
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Admin Page</h2>
        <div class="form-group">
            <label for="pendingUsers">Pending Users:</label>
            <div class="pending-list">
                <ul>
                    <li>
                        Student: John Doe (ID: 123)
                        <input type="submit" value="Accept" onclick="acceptUser(123)">
                        <input type="submit" value="Decline" onclick="declineUser(123)">
                    </li>
                    <li>
                        Teacher: Jane Smith (ID: 456)
                        <input type="submit" value="Accept" onclick="acceptUser(456)">
                        <input type="submit" value="Decline" onclick="declineUser(456)">
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
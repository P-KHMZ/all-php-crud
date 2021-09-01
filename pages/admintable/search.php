<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../include/include.css">
    <title>Search form</title>
</head>
<body>
    <div id="container">
        <?php include('../login/admin-header.php')?>
        <div id="content">
            <h2>Search a record</h2>
            <h3>Both fields are required</h3>
            <form action="temp_view.php" method="POST">
                <p>
                    <label for="fname" class="label">Frist Name:</label>
                    <input type="text" name="fname" id="fname" 
                    value="<?php if(isset($_POST['fname'])) echo $_POST['fname']?>">
                </p>
                <p>
                    <label for="lname" classe="label">Last Name:</label>
                    <input type="text" name="lname" id="lname"
                    value="<?php if(isset($_POST['lname'])) $_POST['lname']?>">
                </p>
                <p>
                    <input type="submit" id="submit" value="Submit" name="submit">
                </p>
            </form>
        </div>
    </div>
</body>
</html>
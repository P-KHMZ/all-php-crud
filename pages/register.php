<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8" content="ie=edge">
    <title>user registration</title>
    <link rel="stylesheet" href="./style/styles.css">
    <style>
        label 
        { 
            float:left; 
            width:210px; 
            text-align:right; 
            clear:left; 
            margin-right:5px;
        }
        #submit 
        { 
            margin-left:215px;
        }
    </style>
</head>
<body>
    <div class="container" id="container">
        
        <?php include('../_header.php')?>
        <?php include('../_nav.php')?>
        <?php include('../_info-col.php')?>

        <div class="content" id="content">
            <p>
                <?php
                    require('../config/config.php');
                    if($_SERVER['REQUEST_METHOD'] == 'POST')
                    {
                        $errors = array();
                        if(empty($_POST['first_name']))
                        {
                            $errors [] = 'Fill in the first name field';
                        }
                        else
                        {
                            $fn = mysqli_real_escape_string($dbcon, trim($_POST['first_name']));
                        }
                        if(empty($_POST['last_name']))
                        {
                            $errors [] = 'Fill in the last name field';
                        }
                        else
                        {
                            $ln = mysqli_real_escape_string($dbcon, trim($_POST['last_name']));
                        }
                        if(empty($_POST['email']))
                        {
                            $errors [] = 'Fill the email field';
                        }
                        else
                        {
                            $email = trim($_POST['email']);
                        }
                        if(!empty($_POST['password_1']))
                        {
                            if($_POST['password_1'] != $_POST['password_2'])
                            {
                                $errors [] = 'Your passwords do not match, please check it and try again';
                            }
                            else
                            {
                                $pwd = trim($_POST['password_1']);
                            }
                        }
                        else
                        {
                            $errors [] = 'Fill in the password field';
                        }
                        if(empty($errors))
                        {
                            // require('../config/config.php');
                            $query = "INSERT INTO users_table(userId, firstName, lastName, email, password, registration_date)
                            VALUES('', '$fn', '$ln', '$email', SHA1('$pwd'), NOW())";
                            $result = @mysqli_query($dbcon, $query);//
                            if($result)
                            {
                                header("location: registered-thanks.php");
                                exit();
                            }
                            else
                            {
                                echo'<h2>System Error</h2>
                                <p class="error">You could not be registered due to the system error
                                    we appologize for any incovenience
                                </p>';
                                echo'<p>'.mysqli_error($dbcon).'<br><br>Query'.$q.'</p>';
                            }
                            mysqli_close($dbcon);
                            include('footer.php');
                            exit();
                        }
                        else
                        {
                            echo'<h2>Error</h2>
                            <p class ="error">The following errors occured:<br>';
                                foreach($errors as $msg)
                                {
                                    echo"*$msg<br>\n";
                                }
                                echo'<p class="error"><h3>Please try again ... </h3></p>
                            </p>';
                        }
                    }
                ?>
            </p>
            <h2>Register</h2>
            <form action="register.php" method="POST">
                <p>
                    <label class = "label" for="fname">First Name:</label>
                    <input type="text" name="first_name" id="fname" size="30" maxlength="30" 
                    value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name'];?>">
                </p>
                <p>
                    <label for="lname" class="label">Last Name:</label>
                    <input type="text" id="lname" name="last_name" size = "30" maxlength="30"
                    value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name'];?>">
                </p>
                <p>
                    <label for="email"  class="label">Email:</label>
                    <input type="text" id="email" name="email" size="30" maxlength="30"
                    value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>">
                </p>
                <p>
                    <label for="pwd" class="label">Enter your password:</label>
                    <input type="text" id="pwd" name="password_1" size="30" maxlength="30"
                    value="<?php if(isset($_POST['password_1'])) echo $_POST['password_1']?>">

                </p>
                <p>
                    <label for="pwd2" class="label">Confirm the password:</label>
                    <input type="text" name="password_2" id="pwd2" size = "30" maxlength="30"
                    value = "<?php if(isset($_POST['password_2'])) echo $_POST['password_2']?>">
                </p>
                <p>
                    <input type="submit" id="submit" value="Register">
                </p>
            </form>
            <?php include('../_footer.php')?>
        </div>
        
    </div>

</body>
</html>
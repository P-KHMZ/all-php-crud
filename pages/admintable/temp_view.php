<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset=UTF-8>
    <title>Search page</title>
    <link rel="stylesheet" href="../include/include.css">
</head>
<body>
    <div id="container">
        <?php include('../login/admin-header.php')?>
        <div id="content">
            <h2>Search Result</h2>
            <p>
                <?php
                    require('mysqli_connect.php');
                    echo'<p>if no record is shown this is because you had an incorrect or missing
                        entry in the search form<br/>Click on the back button on the browser and try again</p>';
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];
                    $query = " SELECT lname, fname, email, DATE_FORMAT(registration_date, '%M %d, %Y') AS regdate,
                    user_Id FROM users WHERE lname = '$lname' AND fname='$fname' ORDER BY registration_date DESC";
                    $result=@mysqli_query($con, $query);
                    
                        if($result)
                        {
                            echo'<table>
                                    <thead>
                                        <tr>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                            <th>Last Name</th>
                                            <th>First Namr</th>
                                            <th>Email</th>
                                            <th>Registration Date</th>
                                        </tr>
                                    </thead>';
                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                            {
                                echo'<tbody>
                                        <tr>
                                            <td><a href="edit_user.php?id='.$row['user_Id'].'">Edit</a></td>
                                            <td><a href="delete_user.php?id='.$row['user_Id'].'">Delete</a></td>
                                            <td>'. $row['fname'] .   '</td>
                                            <td>'. $row['lname'] .   '</td>
                                            <td>'. $row['email'] .   '</td>
                                            <td>'. $row['regdate'] . '</td>

                                        </tr>
                                    </tbody>';
                            }
                            echo'</table>';
                            mysqli_free_result($result);
                        }
                        else
                        {
                            echo'<p class="error">The current users could not be retrieved <br/>
                            We apologize for any incovenience</p>';
                            echo'<p class="error">'.mysqli_error($result).'</p>';
                        }
                    $query = "SELECT COUNT('user_Id') FROM users";
                    $result = @mysqli_query($con, $query);
                    $row = mysqli_fetch_array($result, MYSQLI_NUM);
                    $members = $row[0];
                    mysqli_close($con);
                    echo'<p>Total members:'.$members.'</p>';
                ?>
            </p>
        </div>
    </div>
</body>
</html>
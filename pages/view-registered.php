<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/styles.css">
    <title>view users</title>
</head>
<body>
    <div class="container">
        <?php include('../_header.php'); ?>
        <?php include('../_nav.php'); ?>
        <p>
            <?php 
                require('../config/config.php');
                $query = "SELECT CONCAT(lastName, ' ', firstName) AS name, 
                DATE_FORMAT(registration_date, '%M' '%d', '%Y') AS regdate FROM users_table";
                $result = @mysqli_query($dbcon, $query);
                if($result)
                {
                    echo'<table>
                            <thead>
                                <tr>
                                    <th>Names</th>
                                    <th>Registration Date</th>
                                <tr>
                            </thead>';
                                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                                {
                                    echo'<tbody>
                                            <tr>
                                                <td>'.$row['name'].'</td>
                                                <td>'.$row['regdate'].'</td>
                                            </td>
                                        </tbody>';
                                }
                    echo'</table>';
                }
                else
                {
                    echo'<p class="error">The current users could not be retrieved
                    we apologize for any incovenience</p>';
                    echo'<p>'.mysqli_error($dbcon).'<br><br>Query:'.$query.'</p>';
                }
                mysqli_close($dbcon);
            ?>
        </p>
    </div>
</body>
</html>
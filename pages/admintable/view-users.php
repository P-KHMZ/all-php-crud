
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset=UTF-8>
    <link rel="stylesheet" href="../include/include.css">
    <title>view users</title>
    <style>
        p
        {
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="container">
        <?php include('../login/admin-header.php')?>
        <div id="content">
            <h2>Registered users</h2>
            <p>
                <?php
                    require('mysqli_connect.php');
                    // $query = "SELECT lname, fname, email, DATE_FORMAT(registration_date, '%M %d', '%Y') 
                    // AS regdate, user_Id FROM users ORDER BY registration_date ASC";
                    // $result = @mysqli_query($con, $query);
                    $pagerows = 4; // numbers of record per page
                    if(isset($_GET['p']) && is_numeric($_GET['p']))
                    {
                        $pages=$_GET['p'];
                    }
                    else
                    {
                        $query = "SELECT COUNT(user_Id) FROM users";//it counts the numbers of user_Ids from users
                        $result = @mysqli_query($con, $query);
                        $row = mysqli_fetch_array($result, MYSQLI_NUM);
                        $records = $row[0];
                        if($records > $pagerows) //if the number of records will fill more than one page
                        ///Calculate the number of pages and round the result up to the nearest integer
                        {
                             $pages = ceil($records/$pagerows);// ceil() means set the ceiling or set to an integer
                             // above the actual count
                             //If the number of records is greater than the number 
                            // of records displayed per page, round up the number of pages to a whole number 
                            //e.g: 18/4 = 4.5 ~ 5 
                             
                        }
                        else
                        {
                            $pages = 1;

                        }
                    }//page check finished
                    if(isset($_GET['s']) && is_numeric($_GET['s']))//ensures that the variables 's' is an int
                    {
                        $start = $_GET['s'];
                    }
                    else
                    {
                        $start = 0;// the count starts from 0
                    }
                    //the query select the column to be displayed, the numbers of rows/page and the start with the record number zero 
                    $query = "SELECT lname, fname, email, DATE_FORMAT(registration_date, '%d %M, %Y')
                    AS regdate, user_Id FROM users ORDER BY registration_date ASC LIMIT $start, $pagerows";
                    $result = @mysqli_query($con, $query);
                    $members = mysqli_num_rows($result);
                    if($result)
                    {
                        echo'<table>
                            <thead>
                                <tr>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Email</th>
                                    <th>Registration Date</th>
                                <tr>
                            </thead>';
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                        {
                            echo'<tbody>
                                            <tr>
                                                <td><a href="edit.php?id='.$row['user_Id'].'">Edit</a></td>
                                                <td><a href="delete.php?id='.$row['user_Id'].'">Delete</a></td>
                                                <td>' .$row['lname']. '</td>
                                                <td>' .$row['fname']. '</td>
                                                <td>' .$row['email']. '</td>
                                                <td>' .$row['regdate'].'</td>
                                            </td>
                                        </tbody>';
                        }
                        echo'</table>';
                        mysqli_free_result($result);

                    }
                    else
                    {
                        echo'<p class="error">The current data could not be retrieved <br/>
                        We apologize for any incovience!!</p>';
                        echo'<p>'.mysqli_error($con).'<br/><br/>Query:'.$query.'</p>';
                    }
                    $query = "SELECT COUNT(user_Id) FROM users";
                    $result = @mysqli_query($con, $query);
                    $row =@mysqli_fetch_array($result, MYSQLI_NUM);
                    $members = $row[0];
                    mysqli_close($con);
                    echo"<p>Total membership: $members</p>";
                    if($pages >1)
                    {
                        echo'<p>';
                        $current_page = ($start/$pagerows)+1;// if the page is not the first page, print previous
                        if($current_page!=1)
                        {
                            echo'<a href="view-users.php?s='.($start - $pagerows).'&p='.$pages.'">Previous</a>';
                        }
                        if($current_page!=$pages)
                        {
                            echo'<a href="view-users.php?s='.($start+$pagerows).'&p='.$pages.'">Next</a>';
                        }
                        echo'</p>';
                    }
                ?>
            </p>
        </div>
        <?php include('../login/_footer.php')?>
    </div>
</body>
</html>
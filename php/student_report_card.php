<?php

  session_start();
    if(!isset($_SESSION['user']))
    {
      header("Location: vit.php");
    }
    if($_SESSION['user']=='admin')
    {
      header("Location: index_admin.php");
    }
    
    // if($_SESSION['user']=='student_int' )
    // {
    //   header("Location: index_student_intern.php");
    // }
    if($_SESSION['user']=='company')
    {
      header("Location: index_company.php");
    }

?>

<?php

$vari=$_SESSION['student_id'];
$db = mysqli_connect('localhost', 'root', '', 'database1');
  $user_check_query = "SELECT * FROM student WHERE STUDENT_ID='$vari' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  //The mysqli_fetch_assoc() function fetches a result row as an associative array.
  $user = mysqli_fetch_assoc($result);
$student_id=$user['STUDENT_ID'];
$student_name=$user['STUDENT_NAME'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Report of student</title>
  <link rel="stylesheet" type="text/css" href="1.css">
  <link rel="shortcut icon" type="image/png" href="vit.png">
  <link rel="stylesheet" type="text/css" href="stl.css">
</head>
<center>
<body>
<div class="container" style="width:50%;border:solid;border-radius:5px;position:relative;top:50px">
  <br>
<p style="padding-right:40px;"><b>Student Name :</b> <?php echo $student_name; ?></p>
  <br>
  <p style="padding-right:40px;"><b>Student Id :</b> <?php echo $student_id; ?></p>
  <br>
</div>
</body>

<body>
    <div>
    <br>
    <br>
    <br>
    <?php 
    $varie=$_SESSION['student_id'];
    $db1 = mysqli_connect('localhost', 'root', '', 'database1');
    $user_check_query = "SELECT PDF FROM student WHERE STUDENT_ID='$varie' ";
    $result = mysqli_query($db1, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    echo'<img src="data:pdf/jpeg;base64,'.base64_encode($user['PDF'] ).'" height="600" width="600" class="img-thumnail" style="margin-top:20px;margin-bottom:-30px" />' ; 
    ?>
    </div>
</center>
</body>
</html>



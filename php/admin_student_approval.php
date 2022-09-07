<?php

	session_start();
		if(!isset($_SESSION['user']))
		{
			header("Location: vit.php");
		}
		if($_SESSION['user']=='student_int' )
    {
      header("Location: index_student_intern.php");
    }
    if($_SESSION['user']=='student_place' )
    {
      header("Location: index_student_placement.php");
    }
		if($_SESSION['user']=='student')
		{
			header("Location: index_student.php");
		}

?>
<?php
$dob="";
$gender="";
$st_email="";
$address1="";
$contact_num="";
$branch="";
$tenth_per="";
$tenth_pass="";
$twelfth_per="";
$twelfth_pass="";
$cgpa="";
$pass="";
$backlogs="";
$errors = array();
$positives=array();
$db = mysqli_connect('localhost', 'root', '', 'database1');
if (isset($_POST['approve_student'])) 
{
  // receive all input values from the form
  $student_name = mysqli_real_escape_string($db, $_POST['student_name']);

   if ($student_name=='Student Name') 
  { 
    array_push($errors, "Select student or No student with Pending Approval"); 
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) 
  {
    $query = "update student set APPROVAL='approved' where student_name='$student_name'";
    mysqli_query($db, $query);

//if we want to empty all the entered details   then again initialize all the$variable_name to ""; 

    array_push($positives, "Successfully approved the student");
    //header('location: index_student.php');
  }
  
}

if (isset($_POST['disapprove_student'])) //??????????????//
{
  // receive all input values from the form
  $student_name = mysqli_real_escape_string($db, $_POST['student_name']);

   if ($student_name=='Student name') 
  { 
    array_push($errors, "Select student or No student to reject"); 
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) 
  {
    $query = "update student set APPROVAL='rejected' where student_name='$student_name'";
    mysqli_query($db, $query);

    $query = "delete from student where student_name='$student_name'";
    mysqli_query($db, $query);
    array_push($positives, "Successfully rejected the student");
    
  }
  
}

?>


<!DOCTYPE html>
<html>
<head>
  <title>Admin approve student</title>
  <link rel="stylesheet" type="text/css" href="1.css">
  <link rel="shortcut icon" type="image/png" href="vit.jpg">
  <link rel="stylesheet" type="text/css" href="stl.css">
</head>
<body>
  <div class="list-unstyled3" >
          <ul>
            <li><a href="vit.php"><img src="vit.jpg" alt="KLEIT Hubli"  class="logo2" height="40"  align="left"/></a></li>
              <li style="float:right"><a  href="logout.php" title="<?php echo $_SESSION['student_name']; ?> ">Log Out</a></li> 
  
            <div class="para">
            <p> Training &amp; Placement,KLEIT Hubli</p>
                </div>  
                   </ul>
          
        </div>
  <div class="header">
    <h2>Student Approval</h2>
  </div>
<!--/*The PHP superglobals $_GET and $_POST are used to collect form-data.-->  

  <form method="post" action="admin_student_approval.php">
  <?php include('wrong.php'); ?>
  <?php include('positive.php'); ?>
 <div class="input-group">
      <label>Select Student</label>
      <!-- <input type="text" name="gender" value="<?php echo $gender; ?>"> -->
    <select name="student_name" >
    	<option>Student name</option>
      <?php
      $db1 = mysqli_connect('localhost', 'root', '', 'database1');
       $user_check_query1 = " SELECT student_name FROM student where STATUS='NS' and APPROVAL='not approved' and APPROVAL<>'rejected'";
       $result1 = mysqli_query($db1, $user_check_query1);
        //The mysqli_fetch_assoc() function fetches a result row as an associative array.
       // $count=mysql_num_rows($result);

       while($count=mysqli_fetch_array($result1))
       {
         // $user = mysqli_fetch_assoc($result);
        //  $ans=$user['student_name'] ;
        //  $count--;
        ?>
              <option> <?php echo $count["student_name"];  ?> </option>
      <?php

      }

      ?>

     </select>
    </div>

    <div class="input-group">
      <button type="submit" class="btn" name="approve_student">Approve</button>
      <button type="submit" class="btn" name="disapprove_student">Reject</button>
    </div>
    <p>
      Approved the student? <a href="index_admin.php">Go Back</a>
    </p> 
  </form>
</body>
</html>
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
		if($_SESSION['user']=='company')
		{
			header("Location: index_company.php");
		}

?>


<!DOCTYPE html>
<html>
<head>
  <title>Registration form for Student</title>
  <link rel="stylesheet" type="text/css" href="1.css"> 
  <link rel="shortcut icon" type="image/png" href="vit.jpg">
  <link rel="stylesheet" type="text/css" href="stl.css">
</head>
<body >
  <div class="list-unstyled3" >
          <ul>
            <li><a href="vit.php"><img src="vit.jpg" alt="KLEIT Hubli"  class="logo2" height="40"  align="left"/></a></li>
             <!-- <li style="float:right"><a  href="logout.php">Log Out</a></li> -->
  
            <div class="para">
            <p> Training &amp; Placement,KLEIT Hubli</p>
                </div>  
                   </ul>
          
        </div>
  <div class="header">
  	<h2>Select Student</h2>
  </div>
	
  <form method="post" action="student_register.php" enctype="multipart/form-data">
  	<?php include('wrong.php'); ?>
  	<div class="input-group">
  	  <label>Student id</label>
  	  <input type="text" name="student_id" value="<?php echo $student_id; ?>">
  	</div>

    </form>

    </body>
    </html>
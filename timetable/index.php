<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<html lang="en">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Debrecen University Scheduler</title>
    
    <style>
	a{margin-left:15px;text-decoration:none; font-size:20px}
	a:hover{background:#FF0000;color:#FFFFFF;}
	.carousel-inner > .item > img,
	.carousel-inner > .item > a > 
	img { margin:auto;}
</style>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="css/animate.min.css" type="text/css">
    <script src="js/jquery-2.1.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>


    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/creative.css" type="text/css">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">
    <link href="css/owl.transitions.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <!-- [endif]-->

</head>
    <body>
    
      <!-- /.navbar -->
    
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand"><font color="#FFFFFF">Debrecen University Scheduler</font></a>
    </div>
    <ul class="nav navbar-nav">
    
      <li class="active"><a href="#">Home</a></li>
      
      <li><a class="page-scroll" href="#about">About</a></li> 
      <li><a class="page-scroll" href="#registration">Registration</a></li> 
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Login
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          
          <li><a href="../timetable/staff/index.php">Staff Login</a></li>
          <li><a href="../timetable/student/index.php">Student Login</a></li> 
        </ul>
      </li> 
    </ul>
  </div>
</nav>

   <!-- /.navbar-end -->
   
        <!-- /.slider -->

<header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 style = "position:relative; top:-100px;">Debrecen University Scheduler</h1>
				
                <hr>
               
                <a href="#about" class="btn btn-primary btn-xl page-scroll">Find Out More</a>
            </div>
        </div>
    </header>

<!--container-->


  <section class="about" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12 text-center">
                        <h2 class="section-heading">About Us</h2>
                        <hr class="primary">
                    </div>
                    
                  
                    
                    <div class="row mb90">
                        <div class="col-md-12 text-justify">
                        <h2 class="section-heading">Meet the Team</h2>
                            <p>

							Ahmed Imam - Founder and PHP Developer

							Hello, I'm Ahmed Imam, the driving force behind the Debrecehn University Time Scheduling System. As a student of computer science and a passionate problem solver, I embarked on this journey to simplify the scheduling process for our university using PHP. I believe that efficient time management is crucial for students and staff, and this project is my way of contributing to a more organized and productive learning environment.


						<h2 class="section-heading">My Project</h2>
						<p>
						The Debrecehn University Time Scheduling System is a web-based platform designed to automate the generation of schedules for our university, and it's all powered by PHP. With the ever-increasing complexity of course offerings and the diverse needs of students and faculty, scheduling can become a daunting task. Our system, crafted in PHP, aims to streamline this process, making it easier for everyone involved.

						Why We Created This Project

						We understand the challenges that come with manually creating schedules for an institution as diverse and dynamic as Debrecehn University. Our project, developed in PHP, was born out of the desire to address these challenges and provide a user-friendly, efficient solution. We believe that by automating this process with PHP, we can free up time and resources for more important academic and administrative tasks.

						</p>
						<h2 class="section-heading">My Vision</h2>
						<p>
						
						Our vision is simple: to make life easier for Debrecehn University's students and faculty by offering a reliable and intuitive scheduling system, all powered by PHP. We are committed to continuous improvement and welcome feedback from our users to enhance the system's functionality and user experience.</p>

						</p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-">
                            <div class="st-member">
                                
                                </div>
                                </div></div></div></div>
                                

    <!--registration-->
    
    <br/><br/>
             <section id="registration">
             <div class="">
             <h2 class="section-heading" align="center">Registration Form</h2>
                        <hr class="primary">
               

   
<?php 
include('config.php');

extract($_POST);
if(isset($save))
{
$que=mysqli_query($con,"select * from student where eid='$eid' and mob='$mobile'");


	
$row=mysqli_num_rows($que);
	if($row)
	{
	$err="<font color='red'>This user already exists</font>";
	}
	else
	{
	$image=$_FILES['pic']['name'];	
		
       mysqli_query($con,"insert into student               values('','$stname','$eid','$p','$mobile','$address','$courseid','$s','$dob','$image','$gen','$status',now())");	

    mkdir("../student/image/$eid");
     move_uploaded_file($_FILES['pic']['tmp_name'],"../student/image/$eid/".$_FILES['pic']['name']);


	$err="<font color='blue'>Congrats Your Data Saved!!!</font>";
	}
	
}

?>
<script>
function showSemester(str)
{
if (str=="")
{
document.getElementById("txtHint").innerHTML="";
return;
}

if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}



xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("semester").innerHTML=xmlhttp.responseText;
}
}
//alert(str);
xmlhttp.open("GET","semester_ajax.php?id="+str,true);
xmlhttp.send();
}
</script>

<script>
function showcourse(str)
{
if (str=="")
{
document.getElementById("txtHint").innerHTML="";
return;
}

if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}



xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("department").innerHTML=xmlhttp.responseText;
}
}
//alert(str);
xmlhttp.open("GET","course_ajax.php?id="+str,true);
xmlhttp.send();
}
</script>






<div class="">
<div class="col-md-12">

<h2>Add Student</h2>
<form method="POST" enctype="multipart/form-data">
<div class="row" style="margin-bottom: 10px;">
<?php echo @$err; ?>
</div>
	<div class="row" style="margin-bottom: 10px;"> 
	<select name="courseid" class="form-control" onchange="showSemester(this.value)" id="courseid"/>
    <option disabled selected >Select Department</option>
	<?php 
	$dep=mysqli_query($con,"select * from department");
	while($dp=mysqli_fetch_array($dep))
	{
	$dp_id=$dp[0];
	echo "<option value='$dp_id'>".$dp[1]."</option>";
	}
	?>
	
    </select>
	</div>
   
    <div class="row" style="margin-bottom: 10px;">
	<select name="s" id="semester" onchange="showsemester(this.value)" class="form-control"/>
    <option disabled selected >Select Semester</option>
    
    <?php
	$sub=mysqli_query($con,"select * from semester");
	while($s=mysqli_fetch_array($sub))
	{
		$s_id=$s[0];
		echo "<option value='$s_id'>".$s[1]."</option>";
	}
	
	?>
	
	</select>
	</div>
   
   <div class="row" style="margin-bottom: 10px;">
        <input type="text" class="form-control" placeholder="Name" name="stname"/>
    </div>
  
   <div class="row" style="margin-bottom: 10px;">
        <input type="email" class="form-control" placeholder="Email" name="eid"/>
    </div>
  
   <div class="row" style="margin-bottom: 10px;">
        <input type="password" class="form-control" placeholder="Password" name="p"/>
    </div>
  
   <div class="row" style="margin-bottom: 10px;">
        <input type="number" class="form-control" placeholder="Mobile" name="mobile"/>
    </div>
  
   <div class="row" style="margin-bottom: 10px;">
        <input type="text" class="form-control" placeholder="Address" name="address"/>
    </div>
  
   <div class="row" style="margin-bottom: 10px;">
        <input type="date" class="form-control" placeholder="D.O.B" name="dob"/>
    </div>
  
   <div class="row" style="margin-bottom: 10px;">
        <input type="file" class="form-control" placeholder="Pic" name="pic"/>
    </div>
  
     <div class="row" style="margin-bottom: 10px;">
    <select name="status" class="form-control" placeholder="Status" name="status"/>
	<option value="" selected="selected" disabled="disabled">Select Status</option>
	<option>ON</option>
	<option>OFF</option>
	</select>
	</div>
    
    <div class="row" style="margin-bottom: 10px;">
  male<input type="radio"value="m" id="gen" name="gen"/>
		female<input type="radio"value="f" id="gen" name="gen"/>
</div>
  
 <div class="row" style="margin-bottom: 10px;">
	<input type="submit" value="Add Student" name="save" class="btn btn-success" />
	<input type="reset" value="Reset" class="btn btn-success"/>
</div>
</form>
</div>
</div>    </div>
</div>


                </div>
                </section>
           </div>
        </div> 
        	
        
       
        																		
    
    
    <!--end registration-->
    
    <!--slider-->
    
      <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugin JavaScript -->
    
    <script src="js/owl.carousel.js"></script>
                         

    </body>
</html>
<?php 
session_start();
include('../config.php');
if($_SESSION['admin']=="")
{
$que=mysqli_query($con,"select * from admin where  user_name='".$_SESSION['admin']."'");
$res=mysqli_fetch_array($que);
$_SESSION=$res;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css"> 
	<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato"> -->
   

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                
              <p> <span style="color:#FFF" >Welcome Admin</span>
<span style="margin-left:1200px" class="glyphicon-glyphicon-off" aria-hidden="true">
<a href="logout.php"><font color="#FFFFFF">Logout</font></a></span>
</p>
            </div>
            
            <!-- Top Menu Items -->
           
                   
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav" style="background-color:#000">
                    <li>
                        <!--<a href="admindashboard.php?info=course"><i class="fa fa-fw fa-dashboard"></i>Department</a>-->
                    </li>

                    <li>
                        <a href="admindashboard.php?info=subject"><i class="fa fa-fw fa-table"></i>Subjects</a>
                    </li>
                    <li>
                        <a href="admindashboard.php?info=student"><i class="fa fa-fw fa-edit"></i>Students</a>
                    </li>
                    <li>
                        <a href="admindashboard.php?info=teacher"><i class="fa fa-fw fa-desktop"></i>Lecturers</a>
                    </li>
                    <li>
                        <a href="admindashboard.php?info=room"><i class="fa fa-fw fa-desktop"></i>Rooms</a>
                    </li>
                    <li>
                        <a href="admindashboard.php?info=add_timetable"><i class="fa fa-fw fa-wrench"></i>Timetable</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                   <div class="col-lg-12" style="height:1000px; width:1100px;"  align="center" margin-top="20px">
                   
               
                
                <?php 
				@$info=$_REQUEST['info'];
				if($info!="")
				{
				if($info=="course")
				{
					include('course.php');
					}
				elseif($info=="semester")
				{
					include('semester.php');
					}
				elseif($info=="subject")
				{
					include('subject.php');
				     }
					 
			    elseif($info=="student")
				{
					include('student.php');
					}
				elseif($info=="teacher")
				{
					include('teacher.php');
					}
				elseif($info=="room")
				{
					include('room.php');
					}
				elseif($info=="timetable")
				{
					include('timetable.php');
					}
					
				elseif($info=="add_course")
				{
					include('add_course.php');
					}
					
			    elseif($info=="add_subject")
				{
					include('add_subject.php');
					}
					
				elseif($info=="add_semester")
				{
					include('add_semester.php');
					}
					
				elseif($info=="add_teacher")
				{
					include('add_teacher.php');
					}
					
				elseif($info=="add_student")
				{
					include('add_student.php');
					}
				elseif($info=="add_room")
				{
					include('add_room.php');
					}	
					
				elseif($info=="add_timetable")
				{
					include('add_timetable.php');
					}

                elseif($info=="updatecourse")
				{
					include('updatecourse.php');
				     }
              
                elseif($info=="updatesemester")
				{
					include('updatesemester.php');
				     }

                elseif($info=="updatesubject")
				{
					include('updatesubject.php');
				     }					 
					
				elseif($info=="updatestudent")
				{
					include('updatestudent.php');
				     }

                elseif($info=="updateteacher")
				{
					include('updateteacher.php');
				     }
				elseif($info=="updateroom")
				{
					include('updateroom.php');
					}	

                elseif($info=="updatetimetable")
				{
					include('update_timetable.php');
				     }
					 
				elseif($info=="deleteteacher")
				{
					include('deleteteacher.php');
				     }
				
				elseif($info=="deletestudent")
				{
					include('deletestudent.php');
				     }
				elseif($info=="deletesemester")
				{
					include('deletesemester.php');
				     }
					 
				elseif($info=="deletesubject")
				{
					include('deletesubject.php');
				     } 
				elseif($info=="deleteroom")
				{
					include('deleteroom.php');
					}	
				}
				else
				{
				?>
                  
                   <font color="#000000" size="+6" face="">Control Panel</font><br/>
                        <img src="img/online-practice-exams.jpg" class="img-responsive" alt="Cinque Terre" width="600" height="600" style="                          margin-top: 70px; margin-left: 23px;">
                <?php }?>
                
                
                
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

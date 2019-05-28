<?php require_once('DB_CONNECTION/DB_Connection.php'); ?>
<?php  session_start();?>
<?php if (!isset($_SESSION["curuser"])|| !isset($_SESSION["cracid"])){
header('Location: index.php');
}?>
 <?php if(isset($_POST['sign_out'])){
          //Clearing all session variables
          session_unset();
          Header('Location: index.php');
          
         
        }?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0">
	        <meta http-equiv="x-UA-Compatible" content="id=edge">
	<title>Admin</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="admin.css">
</head>
<body>
	<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
		<a href="#" class="navbar-brand col-sm-3 col-md-2 mr-0 p-3 "><h2>STUDENT MANAGEMENT SYSTEM</h2></a>
		<!-- <input type="text" class="form-control form-control-dark w-100" placeholder="search" aria-lable="Search"> -->
		<ul class="navbar-nav px-3">
			<li class="nav-item text-nowrap">
<?php echo  '<div class="navbar-brand col-sm-3 col-md-2 mr-0 p-3 "><h6>WELCOME '.$_SESSION["curuser"].' ! <h6/><div/>';?>
				<!--<a href="index.php" class="nav-link">Sign out</a>-->
        <form action="home.php" method="post">
        <!--<a action="home.php" method="post" name="so" class="nav-link">Sign out</a>--->
        <button  type="submit" name="sign_out" onmouseover="this.style.color='rgba(255, 255, 255, 0.75)'" onmouseout="this.style.color='rgba(255, 255, 255, 0.5)'" style="color: rgba(255, 255, 255, 0.5); background-color: transparent; border: none; " >SIGN OUT</button>
      </form>
       
			</li>
		</ul>
		</nav>

		<div class="container-fluid">
			<div class="row">
				<nav class="col-md-2 d-none d-md-block bg-dark sidebar"><br/>
					<div class="sidebar-sticky">
						<ul class="nav flex-column">
							<!--<li class="nav-item">
								<a href="#" class="nav-link text-white mt-5">
									<span data-feather="home"></span>
									Dashboard<span class="sr-only ">(current</span>
								</a>
							</li>---->
  <form action="home.php" method="post">
              <?php 
              //this is occur for create autherized buttons(Left side menu buttons)
              //fetching acc_id
              $ACC_ID = $_SESSION["cracid"];
              //Fetching function id for acc_id
              $sqlq = "SELECT FUNC_ID FROM ACC_ACCESS WHERE ACC_ID=?";
              $para = array($ACC_ID);
              $stmt = sqlsrv_query($con,$sqlq,$para);
          //    $res = sqlsrv_execute($stmt);
              if($stmt){
                while($rec = sqlsrv_fetch_array($stmt)){
                   $FUNC_ID = $rec['FUNC_ID'];
                   //Getting link and info for FUNC_ID
                   $sqlac = "SELECT PAGE_LINK,INFO,IMG FROM ACC_ACCESS_DEF WHERE FUNC_ID=?";
                   $paraac = array($FUNC_ID);
                   $stmtac = sqlsrv_prepare($con,$sqlac,$paraac);
                   $res1 = sqlsrv_execute($stmtac);
                   while ($recl = sqlsrv_fetch_array($stmtac)) {
                     # code...
                    //Output with new line and new link
               /* echo '<li class="nav-item">
                <a href="'.$recl['PAGE_LINK'].'" class="nav-link text-white mt-5">
                  <span data-feather="file"></span>'
                  .$recl['INFO'].
                  '
                </a>
              </li>';*/

              echo '<li >
                <button type="submit" name="'.$recl['PAGE_LINK'].'"  class="nav-link text-light mt-3" style="background-color: transparent; border: none;">'.$recl['IMG'].'

                  <span data-feather="file"></span>'
                  .$recl['INFO'].
                  '
                </button></a>
              </li>';
                   }

//$sql = "UPDATE Table_1 SET data = ? WHERE id = ?";

//$params = array("updated data", 1);

//$stmt = sqlsrv_query( $conn, $sql, $params);


                }
              }else{
                $acc_er = "You have no any access! Please contact system adimn..";
              }
              ?>
</form>

				<!--			<li class="nav-item">
								<a href="#" class="nav-link text-white mt-5">
									<span data-feather="file"></span>
									Orders
								</a>
							</li>

							<li class="nav-item">
								<a href="#" class="nav-link text-white mt-5">
									<span data-feather="Shopping-cart"></span>
									Product
								</a>
							</li>

							<li class="nav-item">
								<a href="#" class="nav-link text-white mt-5">
									<span data-feather="file"></span>
									Custmers
								</a>
							</li>

							<li class="nav-item">
								<a href="#" class="nav-link text-white mt-5">
									<span data-feather="file"></span>
									Reportes
								</a>
							</li>

							<li class="nav-item">
								<a href="#" class="nav-link text-white mt-5">
									<span data-feather="file"></span>
									Integration
								</a>
							</li>
						</ul>

						<h6 class="sidebar-haeding d-flex justify-content-between align-items-center px-3 mt-4 mb-1 texxt-muted">
							<span class="nav-link text-white mt-5">Saved reports</span>
							<a href="#" class="d-flex align-items-center text-muted">
								<span data-feather="plus-circle"></span>
							</a>
						</h6>
						<ul class="nav flex-column mb-2 ">
							<li class="nav-item">
								<a href="#" class="nav-link text-white mt-5">
									<span data-feather="file-text"></span>Current month
								</a>
							</li>
							
							<li class="nav-item">
								<a href="#" class="nav-link text-white mt-5">
									<span data-feather="file-text"></span>Last quarter
								</a>
							</li>

							<li class="nav-item">
								<a href="#" class="nav-link text-white mt-5">
									<span data-feather="file-text"></span>Social engagement
								</a>
							</li>

							<li class="nav-item">
								<a href="#" class="nav-link text-white mt-5">
									<span data-feather="file-text"></span>Year-end sale
								</a>
							</li>---->
						</ul>
						
					</div>
					
				</nav>

				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

					<!--	<h1 class="h2 mt-5">Dashboard</h1>-->
                       <!--   <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                             <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                            </div>
                            --> <!--<button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                             <span data-feather="calendar"></span>
                            This week
                               </button>
                              </div>
						 -->
					</div>

				<!--	<canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>--->
<?php 
function mkhead($shed){
$newhed = '<h1 class="h2 mt-5">'.$shed.'</h1><hr/><div class="mb-2 mb-md-0">';
return $newhed;
}
/*function exsql($q,$para){
//  $result = array();
  $stmt = sqlsrv_prepare($con,$q,$para);
  $exe = sqlsrv_execute($stmt);
  return $stmt;

}*/
/***********MAIN SCREEN*************/
//when click create new user on user mangement
if(isset($_POST['crt_user'])){
  echo '<form action="home.php" method="post">';

  echo mkhead('Create User');

  
  echo ' <input name="user_id_crt" type="text" id="inputEmail" class="form-control rd" placeholder="User Id" required autofocus><br>
   <input name="pwd_crt" type="Password" id="inputEmail" class="form-control rd" placeholder="Password" required><br>';
   //*********************************
 //  echo '<label id="inputEmail" class="rd">Password</label>';
          echo '<SELECT class="form-control" name="selected_acc_lvl">';
  $sqlac_lvl = "SELECT ACC_ID,INFO FROM ACC_LEVEL_DEF";
  $stmtac_lvl = sqlsrv_prepare($con,$sqlac_lvl,null);
  $res0 = sqlsrv_execute($stmtac_lvl);
  while ($recac_lvl = sqlsrv_fetch_array($stmtac_lvl)) {
    # code...
    echo '<option value="'.$recac_lvl['ACC_ID'].'">'.$recac_lvl['INFO'].'</option>';

  }
  echo '</SELECT></br>';
  //**********************************************






   echo '<input name="fnme_crt" type="text" id="inputEmail" class="form-control rd" placeholder="First Name" required ><br>
     <input name="lnme_crt" type="text" id="inputEmail" class="form-control rd" placeholder="Last Name" required ><br>
      <input name="phnn_crt" type="text" id="inputEmail" class="form-control rd" placeholder="Phone Number"  ><br>
       <input name="email_crt" type="text" id="inputEmail" class="form-control rd" placeholder="Email" required ><br/>
      <button type="submit" name="crt_user_save" class="btn btn-primary btn-block" style=" border: none;">
  Save</button> ';
   







  echo '</form></div>';

}
//when clicking save on create user
if(isset($_POST['crt_user_save'])){
  echo mkhead('Create User');
$sql_crt = "INSERT INTO USER_ACC VALUES(?,?,?,?,?,?,?)";
$hashed_pass=password_hash($_POST['pwd_crt'], PASSWORD_DEFAULT);
$sql_crt_para = array($_POST['user_id_crt'],$hashed_pass,$_POST['fnme_crt'],$_POST['lnme_crt'],$_POST['phnn_crt'],$_POST['email_crt'],$_POST['selected_acc_lvl']);
$stmt_crt = sqlsrv_query($con,$sql_crt,$sql_crt_para);
if($stmt_crt){
  echo 'saved';
}else{
  echo 'Fail'.$stmt_crt;
}







  
}
//when click User user management on side menu
if(isset($_POST['user_mng'])){//
  echo mkhead('Users');
  $user_list='';

  echo '<div class="table-responsive"><table class="table table-striped table-sm"><thead><th>User ID</th><th>Access Level</th><th>First Name</th><th>Last Name</th><th>Phone Number</th><th>Email</th>';
  $sqlq = 'SELECT * FROM USER_ACC';
  $stmt = sqlsrv_query($con,$sqlq,null);
  while ($rec = sqlsrv_fetch_array($stmt)) {
    # code...
    $user_list .='<tr>';
    $user_list .='<td>'.$rec['USER_ID'].'</td>';
    $ssql = 'SELECT INFO FROM ACC_LEVEL_DEF WHERE ACC_ID=?';
        $sspara =array($rec['ACC_ID']);
        $ssprep = sqlsrv_prepare($con,$ssql,$sspara);
        $ssexe = sqlsrv_execute($ssprep);
        while($srec = sqlsrv_fetch_array($ssprep)){
          $user_list .='<td>'.$srec['INFO'].'</td>';
        }
    $user_list .='<td>'.$rec['FNAME'].'</td>';
    $user_list .='<td>'.$rec['LNAME'].'</td>';
    $user_list .='<td>'.$rec['PHONE_NUMBER'].'</td>';
    $user_list .='<td>'.$rec['EMAIL'].'</td>';
  }
  echo $user_list;
  echo '</thead></table></div></div>';
   echo '<form action="home.php" method="post">';
    echo '<div class="btn-group mr-2" style="float:right">
                            <button name="crt_user" type="submit" class="btn btn-sm btn-outline-secondary">Create new User</button>
                            
                            </div></form>';
}


function lvls($con){
   echo '<SELECT name="selected_acc_lvl" class="form-control">';
  $sqlac_lvl = "SELECT ACC_ID,INFO FROM ACC_LEVEL_DEF";
  $stmtac_lvl = sqlsrv_prepare($con,$sqlac_lvl,null);
  $res0 = sqlsrv_execute($stmtac_lvl);
  while ($recac_lvl = sqlsrv_fetch_array($stmtac_lvl)) {
    # code...
    if(isset($_POST['selected_acc_lvl']) && $_POST['selected_acc_lvl'] == $recac_lvl['ACC_ID']){
      echo '<option selected disabled value="'.$recac_lvl['ACC_ID'].'">'.$recac_lvl['INFO'].'</option>';
    }else if($recac_lvl['ACC_ID'] == 1){
    echo '<option selected value="'.$recac_lvl['ACC_ID'].'">'.$recac_lvl['INFO'].'</option>';
  }else{
    echo '<option value="'.$recac_lvl['ACC_ID'].'">'.$recac_lvl['INFO'].'</option>';
  }

}
 echo '</SELECT>';
}

//***************When click Create Access Level on side menu
if(isset($_POST['acc_lvl'])){
//  echo '<h1 class="h2 mt-5">Create Access Level</h1><hr/><div class="mb-2 mb-md-0">';
   echo mkhead('Access Levels');
  echo '<form action="home.php" method="post">';
  lvls($con);
/*  echo $ACC_LEVELS;
 foreach ($ACC_LEVELS as $ACC_LEVEL) {
   # code...
  echo $ACC_LEVEL;

 }
  $sqlac_lvl = "SELECT ACC_ID,INFO FROM ACC_LEVEL_DEF";
  $stmtac_lvl = sqlsrv_query($con,$sqlac_lvl,null);
  while ($recac_lvl = sqlsrv_fetch_array($stmtac_lvl)) {
    # code...
    echo '<option value="'.$recac_lvl['ACC_ID'].'">'.$recac_lvl['INFO'].'</option>';

  }*/
  echo '<br/><button type="submit" name="def_acc" class="btn btn-primary btn-block" style=" border: none;">
  Find</button></form></div>';
//$curlevl=$_POST['selected_acc_lvl'];
}
//selected_acc_lvl is drop down value, for find button in user access level,when submit setted value to this select variable
if(isset($_POST['def_acc'])){
  //print_r($_POST);
echo mkhead('Access Levels');
  /*********************************************************/
    //echo '<h1 class="h2 mt-5">Create Access Level</h1><hr/><div class="mb-2 mb-md-0">';
  echo '<form action="home.php" method="post">';
   lvls($con);
  echo '<br/><button type="submit" name="def_acc" class="btn btn-primary btn-block" style=" border: none;">
  Find</button></form>';
  /*************************************************************/
  if(isset($_POST['selected_acc_lvl'])){
  echo '<div class="table-responsive"><table class="table table-striped table-sm"><thead><tr><th>Function ID</th><th>Description</th></tr>';
  $sqlac_acc= "SELECT FUNC_ID FROM ACC_ACCESS WHERE ACC_ID=?";
  $paraac_acc=array($_POST['selected_acc_lvl']);
  $stmtac_acc=sqlsrv_query($con,$sqlac_acc,$paraac_acc);
  while ($recac_acc = sqlsrv_fetch_array($stmtac_acc)) {
    # code...
    $FUNC_ID_func = array($recac_acc['FUNC_ID']);
    $sqlfunc = "SELECT INFO FROM ACC_ACCESS_DEF WHERE FUNC_ID=?";
    $stmtac_func = sqlsrv_prepare($con,$sqlfunc,$FUNC_ID_func);
    $res_FUNC = sqlsrv_execute($stmtac_func);
    while ($rec_acc_func = sqlsrv_fetch_array($stmtac_func)) {
      # code...
      echo '<tr><td>'.$recac_acc['FUNC_ID'].'</td><td>'.$rec_acc_func['INFO'].'</td></tr>';
    }
  }
  echo '</thead></table></div></div>';
}
}
function pro_mng($con){
  echo mkhead('Programs');
    echo '<div class="table-responsive"><table class="table table-striped table-sm"><thead><tr><th>Programe ID</th><th>Description</th><th>Allocated Course ID</th><th>Allocated Course Description</th></tr>';
  $sqlq = 'SELECT PROGRAME_TITLE AS P_ID, INFO, CRSE_ID FROM PROGRAMS_DEF';
  $stmt = sqlsrv_query($con,$sqlq,null);
  while($rec = sqlsrv_fetch_array($stmt)){
      echo '<tr><td>'.$rec['P_ID'].'</td><td>'.$rec['INFO'].'</td>';
      $ssql = 'SELECT TITLE,INFO FROM COURSES_DEF WHERE CRSE_ID=?';
      $spara = array($rec['CRSE_ID']);
      $sprep = sqlsrv_prepare($con,$ssql,$spara);
      $sres = sqlsrv_execute($sprep);
      while($srec = sqlsrv_fetch_array($sprep)){
        echo '<td>'.$srec['TITLE'].'</td><td>'.$srec['INFO'].'</td></tr>';
      }

  }

   echo '</thead></table></div></div>';
    echo '<form action="home.php" method="post"><div class="btn-group mr-2" style="float:right">
                              <button name="vw_subs" type="submit" class="btn btn-sm btn-outline-secondary">Subjects</button>
                              <button name="vw_crses" type="submit" class="btn btn-sm btn-outline-secondary">Courses</button>
                            <button name="crt_prog" type="submit" class="btn btn-sm btn-outline-secondary">New programe</button>
                            
                            </div></form>';

}
//when click Programe Management on side menu
if(isset($_POST['pro_mng'])){
pro_mng($con);
/*echo mkhead('Programs');
    echo '<div class="table-responsive"><table class="table table-striped table-sm"><thead><tr><th>Programe ID</th><th>Description</th><th>Allocated Course ID</th><th>Allocated Course Description</th></tr>';
  $sqlq = 'SELECT PROGRAME_TITLE AS P_ID, INFO, CRSE_ID FROM PROGRAMS_DEF';
  $stmt = sqlsrv_query($con,$sqlq,null);
  while($rec = sqlsrv_fetch_array($stmt)){
      echo '<tr><td>'.$rec['P_ID'].'</td><td>'.$rec['INFO'].'</td>';
      $ssql = 'SELECT TITLE,INFO FROM COURSES_DEF WHERE CRSE_ID=?';
      $spara = array($rec['CRSE_ID']);
      $sprep = sqlsrv_prepare($con,$ssql,$spara);
      $sres = sqlsrv_execute($sprep);
      while($srec = sqlsrv_fetch_array($sprep)){
        echo '<td>'.$srec['TITLE'].'</td><td>'.$srec['INFO'].'</td></tr>';
      }

  }

   echo '</thead></table></div></div>';
    echo '<div class="btn-group mr-2" style="float:right"><form action="home.php" method="post">
                              <button name="vw_subs" type="submit" class="btn btn-sm btn-outline-secondary">Subjects</button>
                              <button name="vw_crses" type="submit" class="btn btn-sm btn-outline-secondary">Courses</button>
                            <button name="crt_prog" type="submit" class="btn btn-sm btn-outline-secondary">New programe</button>
                            
                            </form></div>';**/
}
//Subjects on programe management
if(isset($_POST['vw_subs'])){
  pro_mng($con);
   echo mkhead('Subjects');

  $sub_sql = 'SELECT SUB_ID AS NUM,TITLE AS SUB_ID,INFO,COMMENTS FROM SUBJECTS_DEF';
  $sub_qu = sqlsrv_query($con,$sub_sql,null);
  echo '<div class="table-responsive"><table class="table table-striped table-sm"><thead><tr><th>#</th><th>Subject ID</th><th>Description</th><th>Comments</th></tr>';
  $count = 1;
  while($sub_rec = sqlsrv_fetch_array($sub_qu)){
    echo '<tr><td>'.$count.'</td><td>'.$sub_rec['SUB_ID'].'</td><td>'.$sub_rec['INFO'].'</td><td>'.$sub_rec['COMMENTS'].'</td></tr>';
    $count++;
  }
  echo '</table></div>';
 echo '<div class="btn-group mr-2"><form action="home.php" method="post">
                              <button name="new_subs" type="submit" class="btn btn-sm btn-outline-secondary">Add Subject</button>
                            </form></div>';
}
//Courses on programe management
if(isset($_POST['vw_crses'])){
   pro_mng($con);
   echo mkhead('Courses');
  $crse_sql = 'SELECT CRSE_ID,TITLE,INFO FROM COURSES_DEF';
  $crse_stm = sqlsrv_query($con,$crse_sql,null);
    echo '<div class="table-responsive"><table class="table table-striped table-sm"><thead><tr><th>#</th><th>Course ID</th><th>Description</th></tr>';
  while ($crse_rec = sqlsrv_fetch_array($crse_stm)) {
    echo '<tr><td>'.$crse_rec['CRSE_ID'].'</td><td>'.$crse_rec['TITLE'].'</td><td>'.$crse_rec['INFO'].'</td></tr>';
    # code...
  }
  echo '</table></div>';
   echo '<div class="btn-group mr-2"><form action="home.php" method="post">
                              <button name="new_crse" type="submit" class="btn btn-sm btn-outline-secondary">Add Course</button>
                            </form></div>';
}
//Add Subject on programe mng->sujects
function nw_sub(){
   echo '<div class="btn-group mr-2"  style="float:right"><form action="home.php" method="post">
                              <button name="vw_subs" type="submit" class="btn btn-sm btn-outline-secondary">Back</button>
                            </form></div>';
   echo mkhead('New Subject');
  echo '<form action="home.php" method="post">';//also has get method $_get
    echo '<input name="ad_sub_id" style="text-transform:uppercase;" type="text" id="inputEmail" class="form-control rd" placeholder="Subject ID (6 Charactors) Eg:HNDISE" required ><br>
     <input name="ad_sub_desc" style="text-transform:uppercase;" type="text" id="inputEmail" class="form-control rd" placeholder="Title" required ><br>
      <input name="ad_sub_com" style="text-transform:uppercase;" type="text" id="inputEmail" class="form-control rd" placeholder="Description"><br>
       
      <button type="submit" name="ad_sub_save" class="btn btn-primary btn-block" style=" border: none;">
  Save</button> ';
  echo '</form></div>';
}
if(isset($_POST['new_subs'])){
  nw_sub();
   /*echo '<div class="btn-group mr-2"><form action="home.php" method="post">
                              <button name="nw_prog_bk" type="submit" class="btn btn-sm btn-outline-secondary">Back</button>
                            </form></div>';*/
 /* echo mkhead('New Subject');
  echo '<form action="home.php" method="post">';//also has get method $_get
    echo '<input name="ad_sub_id" style="text-transform:uppercase;" type="text" id="inputEmail" class="form-control rd" placeholder="Subject ID (6 Charactors) Eg:HNDISE" required ><br>
     <input name="ad_sub_desc" style="text-transform:uppercase;" type="text" id="inputEmail" class="form-control rd" placeholder="Title" required ><br>
      <input name="ad_sub_com" style="text-transform:uppercase;" type="text" id="inputEmail" class="form-control rd" placeholder="Description"><br>
       
      <button type="submit" name="ad_sub_save" class="btn btn-primary btn-block" style=" border: none;">
  Save</button> ';
  echo '</form></div>';*/
}
if(isset($_POST['ad_sub_save'])){
  nw_sub();
  $sqlq = 'INSERT INTO SUBJECTS_DEF VALUES(?,?,?)';
  $spara = array(strtoupper($_POST['ad_sub_id']),strtoupper($_POST['ad_sub_desc']),strtoupper($_POST['ad_sub_com']));
  $stmt = sqlsrv_query($con,$sqlq,$spara);
  if($stmt){
    echo '<h4>Succesfully saved!<h4>';
   //  sleep(5);
   

    $_POST['pro_mng'] = true;
  }else{
    echo '<h4>Fail!<h4>';
  }
}

if(isset($_POST['stu_mng'])){
     echo '<form action="home.php" method="post">';
       
     addbtn('add_student');
     //$_POST['stu_count']= $cnt;
     echo '</form>';
   echo mkhead('Students');
   echo '<label for="inputZip" >Student count :'.stu_count($con).'</label>';
echo '<form action="home.php" method="post" style="padding:0px; margin:0px"><div class="form-group col-3" style="padding:0px; margin:0px">
      '.deletebtn('stu_delete').editbtn('stu_edit').'
      <input name="stu_id" type="text" class="form-control" id="inputID" placeholder="HNDS01" style="text-transform:uppercase; width:60%; margin: 0 0 0 0;" required>
    </div> </form>';
  $sqlq = 'SELECT STUDENT_DIS_ID,PREF_NAME,PROGRM1,PROGRM2,GENDER,STATUS,FULL_NAME,NIC,ADDRESS FROM VW_STU_DTLV1 ORDER BY STUDENT_DIS_ID';
  $stmt = sqlsrv_query($con,$sqlq,null);
  //$rws = sqlsrv_affected_rows($con);
  $stu_cnt = 1;
  echo '<div class="table-responsive" ><table class="table table-striped table-sm"><thead><tr><th>#</th><th>Student ID</th><th>Calling Name</th><th>Programe(s)</th><th>Gender</th><th>Status</th><th>Full Name</th><th>NIC</th><th>Address</th></tr>';
  while ($rec = sqlsrv_fetch_array($stmt)) {
    # code...
    echo '<tr><td>'.$stu_cnt.'</td><td>'.$rec['STUDENT_DIS_ID'].'</td><td>'.$rec['PREF_NAME'].'</td><td>'.$rec['PROGRM1'].','.$rec['PROGRM2'].'</td><td>'.$rec['GENDER'].'</td><td>'.$rec['STATUS'].'</td><td>'.$rec['FULL_NAME'].'</td><td>'.$rec['NIC'].'</td><td>'.$rec['ADDRESS'].'</td></tr>';
    $stu_cnt++;

  }
   echo '</table></div>';
   
}
//Delete Student details
if(isset($_POST['stu_delete'])){
  //header("Refresh: 0; url=home.php");
     echo mkhead('Students');
   echo '<label for="inputZip" >Student count :'.stu_count($con).'</label><br/>';
  echo '
  <form action="home.php" method="post" style="padding:0px; margin:0px"><div class="form-group col-3" style="padding:0px; margin:0px">'.bkbtn('stu_mng');

  $sqlq = 'DELETE FROM STUDENT WHERE STUDENT_DIS_ID=?';
  $spara = array($_POST['stu_id']);
  $stmt = sqlsrv_query($con,$sqlq,$spara);
  if(sqlsrv_rows_affected($stmt)>=1){
  echo 'Deleted Succesfully!</form></div></div>';

}else{
   echo 'Student id not found!</form></div></div>';
   //Student id not found!,Deleting failed!
}
}
//Edit Student details
if(isset($_POST['stu_edit'])){
    echo mkhead('Students');
     echo '</div>
  <form action="home.php" method="post" style="float:Left; padding:0px; margin:0px; width:auto;">

    <form action="home.php" method="post" style="float:Left; padding:0px; margin:0px; width:auto;">
    <div class="form-group col-3" style="padding:0 0 0 55%; margin:0px; width:auto; float:Left;">'.bkbtn('stu_mng').'</br></form>

    <form action="home.php" method="post">
    <button type="submit" name="sve_e_student" class="btn btn-primary" style="float:right; height:55px;width:47px; padding:0px;">Save</button></div>';
  $sqlq = 'SELECT STUDENT_DIS_ID,PREF_NAME,PROGRM1,PROGRM2,GENDER,STATUS,FULL_NAME,FNAME,LNAME,FULL_NAME,AGE,DOB,JOIN_DATE,NIC,ADDRESS FROM VW_STU_DTLV1 WHERE STUDENT_DIS_ID=?';
  $spara = array($_POST['stu_id']);
  $stmt = sqlsrv_query($con,$sqlq,$spara);
  echo '<div class="form-group col-3" style="padding:0px; margin:0px; width:10%; float:Left;">
  <label for="inputAddress" style="margin-bottom: 30px; margin-top: 7px;" >Student ID </label></br>
    <label for="inputAddress" style="margin-bottom: 30px;">Preferred Name </label><br/>
  <label for="inputAddress" style="margin-bottom: 30px; ">Program 1 </label></br>
  <label for="inputAddress" style="margin-bottom: 30px; ">Program 2 </label></br>
  <label for="inputAddress" style="margin-bottom: 30px; ">Gender </label></br>
  <label for="inputAddress" style="margin-bottom: 30px; ">Status </label></br>
  <label for="inputAddress" style="margin-bottom: 30px; ">First Name </label></br>
  <label for="inputAddress" style="margin-bottom: 30px; ">Last Name </label></br>
  <label for="inputAddress" style="margin-bottom: 30px; ">Full Name </label></br>
  <label for="inputAddress" style="margin-bottom: 30px; ">Age  </label></br>
  <label for="inputAddress" style="margin-bottom: 30px; ">Date of Birth  </label><br/>
  <label for="inputAddress" style="margin-bottom: 30px; ">Join Date  </label></br>
  <label for="inputAddress" style="margin-bottom: 30px; ">NIC </label></br>
  <label for="inputAddress" style="margin-bottom: 30px; ">Address </label></div>
  <divclass="form-group col-3" style="padding:0px; margin:0px; width:80%; float:Left;">
  ';

 /* while ($rec = sqlsrv_fetch_array($stmt)) {
echo 
'<label for="inputAddress">'.$rec['STUDENT_DIS_ID'].'</label></br>'
.'<label for="inputAddress">'.$rec['PREF_NAME'].'</label></br>'
.'<label for="inputAddress">'.$rec['PROGRM1'].'</label></br>'
.'<label for="inputAddress">'.$rec['PROGRM2'].'</label></br>'
.'<label for="inputAddress">'.$rec['GENDER'].'</label></br>'
.'<label for="inputAddress">'.$rec['STATUS'].'</label></br>'
.'<label for="inputAddress">'.$rec['FNAME'].'</label></br>'
.'<label for="inputAddress">'.$rec['LNAME'].'</label></br>'
.'<label for="inputAddress">'.$rec['FULL_NAME'].'</label></br>'
.'<label for="inputAddress">'.$rec['AGE'].'</label></br>'
.'<label for="inputAddress">'.$rec['DOB']->format('Y-m-d').'</label></br>'
.'<label for="inputAddress">'.$rec['JOIN_DATE']->format('Y-m-d').'</label></br>'
.'<label for="inputAddress">'.$rec['NIC'].'</label></br>'
.'<label for="inputAddress">'.$rec['ADDRESS'].'</label></br>'

;*/
$STU_E_ID;
$STU_E_PN;
$STU_E_P1;
$STU_E_P2;
$STU_E_GEN;
$STU_E_STS;
$STU_E_FN;
$STU_E_LN;
$STU_E_FIN;
$STU_E_AG;
$STU_E_DOB;
$STU_E_JOD;
$STU_E_NIC;
$STU_E_ADD;
  while ($rec = sqlsrv_fetch_array($stmt)) {
$STU_E_ID = $rec['STUDENT_DIS_ID'];
$STU_E_PN = $rec['PREF_NAME'];
$STU_E_P1 = $rec['PROGRM1'];
$STU_E_P2 = $rec['PROGRM2'];
$STU_E_GEN = $rec['GENDER'];
$STU_E_STS = $rec['STATUS'];
$STU_E_FN = $rec['FNAME'];
$STU_E_LN = $rec['LNAME'];
$STU_E_FIN = $rec['FULL_NAME'];
$STU_E_AG = $rec['AGE'];
$STU_E_DOB = $rec['DOB']->format('Y-m-d');
$STU_E_JOD = $rec['JOIN_DATE']->format('Y-m-d');
$STU_E_NIC = $rec['NIC'];
$STU_E_ADD = $rec['ADDRESS'];
}

/*
----
.sprintf($rec['DOB']).'</br>'
.print_r($rec['JOIN_DATE'],true).'</br>'
.$rec['JOIN_DATE']->format('Y-m-d-H-i-s').'</br>'----------
.var_dump($rec['DOB']).'</br>'
print_r($rec['DOB'],true).'</br>'
.print_r($rec['JOIN_DATE'],true).'</br>'
  }*/
//echo '<form action="home.php" method="post">';
echo '     <div class="form-group">
      
      <input name="stu_id" type="text" class="form-control" id="inputID" VALUE="'.$STU_E_ID.'" style="text-transform:uppercase;" readonly>
    </div>   
      <div class="form-group">
    
    <input name="stu_pref_name" type="text" style="text-transform:uppercase;" class="form-control" id="inputAddress2" value="'.$STU_E_PN.'" required>
  </div>
    

';
    $sqlq = 'SELECT PRO_ID,PROGRAME_TITLE FROM PROGRAMS_DEF';
    $stmt = sqlsrv_query($con,$sqlq,NULL);
    echo '<div class="form-group col-3" style="padding:0px;"><select Name="stu_pro_id1" id="selectgender" class="form-control" required>
      <option selected disabled>Choose...</option>';
      //<option>Male</option>
      //<option>Female</option>
    //</select>
    while($rec = sqlsrv_fetch_array($stmt)){
      IF($STU_E_P1 == $rec['PROGRAME_TITLE']){
        echo ' <option value="'.$rec['PRO_ID'].'" selected>'.$rec['PROGRAME_TITLE'].'</option>';
      }
      echo ' <option value="'.$rec['PRO_ID'].'">'.$rec['PROGRAME_TITLE'].'</option>';
    }
    echo '</SELECT></div>';

        echo ' <div class="form-group col-3" style="padding:0px;"><select Name="stu_pro_id2" id="selectgender" 
    class="form-control" required>
      <option value="0" selected>Choose...</option>';
       $stmt = sqlsrv_query($con,$sqlq,NULL);
     while($rec = sqlsrv_fetch_array($stmt)){
         IF($STU_E_P2 == $rec['PROGRAME_TITLE']){
        echo ' <option value="'.$rec['PRO_ID'].'" selected>'.$rec['PROGRAME_TITLE'].'</option>';
      }
      echo ' <option value="'.$rec['PRO_ID'].'">'.$rec['PROGRAME_TITLE'].'</option>';
    }
    echo '</SELECT></div>';
    //<label for="inputAddress2">Program ID</label>
   // <input type="text" class="form-control" id="inputAddress2" placeholder="1234">
 // </div>
   
   echo ' 
       <div class="form-group col-3" style="padding:0px;">
    
   
    <select name="stu_gender" id="selectgender" class="form-control" required>
      <option value="'.$STU_E_GEN.'" selected >'.$STU_E_GEN.'</option>
      ';
      if($STU_E_GEN=="MALE"){
      echo '<option value="FEMALE">FEMALE</option>';}
      ELSE{
       echo '<option value="MALE">MALE</option>';
        }
  echo '
      
    </select>
    
  </div>
        <div class="form-group col-3" style="padding:0px;">
    
       <select name="stu_status" id="selectgender" class="form-control" required>
      <option VALUE="'.$STU_E_STS.'" selected>'.$STU_E_STS.'</option>';
      if($STU_E_STS == "SINGLE"){
        echo '
      <option value="MARRIED">MARRIED</option>
      <option value="DIVORCED">DIVORCED</option>';
      }
        else if($STU_E_STS == "MARRIED"){
            echo '<option value="SINGLE">SINGLE</option>
      
      <option value="DIVORCED">DIVORCED</option>';
        }
          else{
              echo '<option value="SINGLE">SINGLE</option>
      <option value="MARRIED">MARRIED</option>
      ';
          }

    echo '</select>
  </div>
     
    <div class="form-group">
    
    <input name="stu_fname" type="text" style="text-transform:uppercase;" class="form-control" id="inputAddress2" value="'.$STU_E_FN.'" required>
      </div>
      <div class="form-group">
    
    <input name="stu_lname" type="text" style="text-transform:uppercase;" class="form-control" id="inputAddress2" value="'.$STU_E_LN.'" required>
  </div>
    
  

  <div class="form-group">
    
    <input name="stu_fullname" type="text" style="text-transform:uppercase;" class="form-control" id="inputAddress" value="'.$STU_E_FIN.'">
  </div>


  
    <div class="form-group col-3" style="padding:0px;">
    
      <input name="stu_age" type="Number" class="form-control" id="inputage" value="'.$STU_E_AG.'" required>
    </div>
    <div class="form-group col-3" style="padding:0px;">
    
      <input name="stu_bday" type="date" class="form-control" id="inpputdob" value="'.$STU_E_DOB.'" required>
     
    </div>
    <div class="form-group col-3" style="padding:0px;">
    
      <input name="stu_jday" type="date" class="form-control" id="inputage" value="'.$STU_E_JOD.'" required>
    </div>

  
    <div class="form-group col-3" style="padding:0px;">
    
    <input name="stu_nic" type="text" style="text-transform:uppercase;" class="form-control" id="inputAddress2" value="'.$STU_E_NIC.'" required>
      </div>

   <div class="form-group">
    
    <input name="stu_address" style="text-transform:uppercase;" type="text" class="form-control" id="inputAddress2" value="'.$STU_E_ADD.'" required>
  
  </div></form>';
//echo '</form></div>';
 //echo '</div></form>';
}

//save edit student
if(isset($_POST['sve_e_student'])){
 // echo 'sadgggggggggggggggggggggggggggggggggggggggggggggggggggg';
 echo mkhead('Student');
 echo stu_save($con,$_POST['stu_id']);
 //$_POST['stu_id']=$tmp;
 echo '</div><form action="home.php" method="post"><div style="float:left; padding:90px 0 0 0;">'.bkbtn('stu_mng').'</div></form>';

}
if(isset($_POST['add_student'])){
  //  echo savebtn('sve_student');

  echo '<form action="home.php" method="post">'.bkbtn('stu_mng').'</form>';
    
  echo mkhead('Add Students');
echo '<label for="inputZip" >Student count :'.stu_count($con).'</label>';
  echo '    <div class="card ml-auto mr-auto mb-5" style="width: 60%;"> 
   <div class="card-header bg-dark"> 
       <!--    //<h5 class="text-white">Add Student</h5>--->
   
     
      </div>
      <div class="card-body">

        <form action"home.php" method="post">
        '.savebtn('sve_student').'

  <div class="form row">
    <div class="form-group col-3">
      <label for="inputZip" >Student ID</label>
      <input name="stu_id" type="text" class="form-control" id="inputID" placeholder="HNDS01(10)" style="text-transform:uppercase;" required>
    </div>   
    <div class="form-group col-3">
    <label for="inputAddress2">Program ID 1</label>

';
    $sqlq = 'SELECT PRO_ID,PROGRAME_TITLE FROM PROGRAMS_DEF';
    $stmt = sqlsrv_query($con,$sqlq,NULL);
    echo '<select Name="stu_pro_id1" id="selectgender" class="form-control" required>
      <option selected disabled>Choose...</option>';
      //<option>Male</option>
      //<option>Female</option>
    //</select>
    while($rec = sqlsrv_fetch_array($stmt)){
      echo ' <option value="'.$rec['PRO_ID'].'">'.$rec['PROGRAME_TITLE'].'</option>';
    }
    echo '</SELECT></div>';

        echo ' <div class="form-group col-3">
    <label for="inputAddress2">Program ID 2</label><select Name="stu_pro_id2" id="selectgender" class="form-control" required>
      <option value="0" selected>Choose...</option>';
       $stmt = sqlsrv_query($con,$sqlq,NULL);
     while($rec = sqlsrv_fetch_array($stmt)){
      echo ' <option value="'.$rec['PRO_ID'].'">'.$rec['PROGRAME_TITLE'].'</option>';
    }
    echo '</SELECT></div>';
    //<label for="inputAddress2">Program ID</label>
   // <input type="text" class="form-control" id="inputAddress2" placeholder="1234">
 // </div>
   echo '   
   
  </div>
  <div class="form-group">
    <label for="inputAddress">Full Name</label>
    <input name="stu_fullname" type="text" style="text-transform:uppercase;" class="form-control" id="inputAddress" placeholder="Eg :HEETHAWAKAGE NIPUN SUBHASHANA DE SERAM">
  </div>
  <div class="form-row">
    <div class="form-group col-6">
      <label for="inputAddress2">First Name</label>
    <input name="stu_fname" type="text" style="text-transform:uppercase;" class="form-control" id="inputAddress2" placeholder="Eg :NIPUN(50)" required>
      </div>
      <div class="form-group col-md-6">
    <label for="inputAddress2">Last Name</label>
    <input name="stu_lname" type="text" style="text-transform:uppercase;" class="form-control" id="inputAddress2" placeholder="Eg :SUBHASHANA(50)" required>
  </div>
    
  </div>
  <div class="form-group">
    <label for="inputAddress2">Preferred Name</label>
    <input name="stu_pref_name" type="text" style="text-transform:uppercase;" class="form-control" id="inputAddress2" placeholder="Eg :NIPUN SUBHASHANA(20)" required>
  </div>
  <div class="form-row">
    <div class="form-group col-md-2">
      <label for="inputCity">Age</label>
      <input name="stu_age" type="Number" class="form-control" id="inputage" placeholder="24" required>
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Date of Birth</label>
      <input name="stu_bday" type="date" class="form-control" id="inpputdob" required>
     
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip">Join Date</label>
      <input name="stu_jday" type="date" class="form-control" id="inputage" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-6">
      <label for="inputAddress2">National ID Number</label>
    <input name="stu_nic" type="text" style="text-transform:uppercase;" class="form-control" id="inputAddress2" placeholder="123456789V(15)" required>
      </div>
      <div class="form-group col-md-6">
    <label for="inputAddress2">Gender</label>
   
    <select name="stu_gender" id="selectgender" class="form-control" required>
      <option selected disabled>Choose...</option>
      <option value="MALE">MALE</option>
      <option value="FEMALE">FEMALE</option>
    </select>
    
  </div>
    
  </div>
   <div class="form-group">
    <label for="inputAddress2">Status</label>
       <select name="stu_status" id="selectgender" class="form-control" required>
      <option selected disabled>Choose...</option>
      <option value="SINGLE">SINGLE</option>
      <option value="MARRIED">MARRIED</option>
      <option value="DIVORCED">DIVORCED</option>
    </select>
  </div>
   <div class="form-group">
    <label for="inputAddress2">Address</label>
    <input name="stu_address" style="text-transform:uppercase;" type="text" class="form-control" id="inputAddress2" placeholder="Address(200)" required>
  
  </div>
    
</form>
</div></div>';

}
if(isset($_POST['sve_student'])){
    echo '<label for="inputZip" >Student count :'.stu_count($con).'</label>';
 echo mkhead('Add Students');
  echo '<div class="card ml-auto mr-auto mb-5" style="width: 60%;"> 
   <div class="card-header bg-dark" style="height:47px; padding:0 0 0 0;"><b><label class="nav-link text-light mt-3">';
  
  
$sqlq = 'INSERT INTO STUDENT VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
$spara =array(strtoupper($_POST['stu_id']),strtoupper($_POST['stu_pref_name']),strtoupper($_POST['stu_fname']),strtoupper($_POST['stu_lname']),strtoupper($_POST['stu_fullname']),$_POST['stu_age'],$_POST['stu_bday'],$_POST['stu_jday'],strtoupper($_POST['stu_nic']),$_POST['stu_gender'],$_POST['stu_status'],strtoupper($_POST['stu_address']),$_POST['stu_pro_id1'],  $_POST['stu_pro_id2']);
$stmt = sqlsrv_query($con,$sqlq,$spara);
if($stmt){
echo 'Saved Succesfully!';
}else{
  die( print_r(sqlsrv_errors(),true));
}



   echo '</label></b></div><form action="home.php" method="post"> <div class="card-body" style="padding: 0 20px 0 0;">';
  echo bkbtn('add_student').'</div></form></div></div>';
}
function stu_save($con,$stu_id){
  $stmt;
  if($stu_id == ''){
    $sqlq = 'INSERT INTO STUDENT VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
    $spara =array(strtoupper($_POST['stu_id']),strtoupper($_POST['stu_pref_name']),strtoupper($_POST['stu_fname']),strtoupper($_POST['stu_lname']),strtoupper($_POST['stu_fullname']),$_POST['stu_age'],$_POST['stu_bday'],$_POST['stu_jday'],strtoupper($_POST['stu_nic']),$_POST['stu_gender'],$_POST['stu_status'],strtoupper($_POST['stu_address']),$_POST['stu_pro_id1'],  $_POST['stu_pro_id2']);
  }else{
   /*  $sqlq = 'UPDATE STUDENT SET 
    PREF_NAME =:stu_pref_name,
    FNAME =:stu_fname,
    LNAME =:stu_lname
    FULL_NAME =:stu_fullname
    AGE =:stu_age
    DOB =:stu_bday
    JOIN_DATE =:stu_jday
    NIC =:stu_nic
    GENDER =:stu_gender
    STATUS =:stu_status
    ADDRESS =:stu_address
    PRO_ID1 =:stu_pro_id1
    PRO_ID2 =:stu_pro_id2
    WHERE STUDENT_DIS_ID=:STU_ID';
   $stmt->bindParam(':stu_pref_name', strtoupper($_POST['stu_pref_name']));
    $stmt->bindParam(':stu_fname', strtoupper($_POST['stu_fname']));
    $stmt->bindParam(':stu_lname', strtoupper($_POST['stu_lname']));
    $stmt->bindParam(':stu_fullname', strtoupper($_POST['stu_fullname']));
    $stmt->bindParam(':stu_age', $_POST['stu_age']);
    $stmt->bindParam(':stu_bday', $_POST['stu_bday']);
    $stmt->bindParam(':stu_jday', $_POST['stu_jday']);
    $stmt->bindParam(':stu_nic', strtoupper($_POST['stu_nic']));
    $stmt->bindParam(':stu_gender', $_POST['stu_gender']);
    $stmt->bindParam(':stu_status', $_POST['stu_status']);
    $stmt->bindParam(':stu_address', strtoupper($_POST['stu_address']));
    $stmt->bindParam(':stu_pro_id1', $_POST['stu_pro_id1']);
    $stmt->bindParam(':stu_pro_id2', $_POST['stu_pro_id2']);
   */
    $sqlq = 'UPDATE STUDENT SET 
    PREF_NAME =?,
    FNAME =?,
    LNAME =?,
    FULL_NAME =?,
    AGE =?,
    DOB =?,
    JOIN_DATE =?,
    NIC =?,
    GENDER =?,
    STATUS =?,
    ADDRESS =?,
    PRO_ID1 =?,
    PRO_ID2 =?
    WHERE STUDENT_DIS_ID=?';
        $spara =array(strtoupper($_POST['stu_pref_name']),strtoupper($_POST['stu_fname']),strtoupper($_POST['stu_lname']),strtoupper($_POST['stu_fullname']),$_POST['stu_age'],$_POST['stu_bday'],$_POST['stu_jday'],strtoupper($_POST['stu_nic']),$_POST['stu_gender'],$_POST['stu_status'],strtoupper($_POST['stu_address']),$_POST['stu_pro_id1'],  $_POST['stu_pro_id2'],strtoupper($_POST['stu_id']));
  }

  $stmt = sqlsrv_query($con,$sqlq,$spara);
if($stmt){
return 'Saved Succesfully!';
}else{
  return die( print_r(sqlsrv_errors(),true));
}
}
function savebtn($btnnme){return '<button type="submit" name="'.$btnnme.'" class="btn btn-primary" style="float:right; ">Save</button>';}
function addbtn($btnnme){
  echo '<button type="submit" name="'.$btnnme.'" class="btn btn-sm btn-primary float-right mb-5"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
width="25" height="27"
viewBox="0 0 192 192"
style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,192v-192h192v192z" fill="none"></path><g fill="#ffffff"><path d="M96,7.68c-48.73231,0 -88.32,39.58769 -88.32,88.32c0,48.73231 39.58769,88.32 88.32,88.32c48.73231,0 88.32,-39.58769 88.32,-88.32c0,-48.73231 -39.58769,-88.32 -88.32,-88.32zM96,15.36c44.58172,0 80.64,36.05828 80.64,80.64c0,44.58172 -36.05828,80.64 -80.64,80.64c-44.58172,0 -80.64,-36.05828 -80.64,-80.64c0,-44.58172 36.05828,-80.64 80.64,-80.64zM92.16,49.92v42.24h-42.24v7.68h42.24v42.24h7.68v-42.24h42.24v-7.68h-42.24v-42.24z"></path></g></g></svg>ADD</button>';
}
function bkbtn($btnnme){
  return '<button type="submit" name="'.$btnnme.'" class="btn btn-sm btn-primary float-right mb-5"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
width="25" height="25"
viewBox="0 0 192 192"
style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,192v-192h192v192z" fill="none"></path><g fill="#ffffff"><g id="surface1"><path d="M96,7.68c-48.735,0 -88.32,39.585 -88.32,88.32c0,48.735 39.585,88.32 88.32,88.32c48.735,0 88.32,-39.585 88.32,-88.32c0,-48.735 -39.585,-88.32 -88.32,-88.32zM96,15.36c44.58,0 80.64,36.06 80.64,80.64c0,44.58 -36.06,80.64 -80.64,80.64c-44.58,0 -80.64,-36.06 -80.64,-80.64c0,-44.58 36.06,-80.64 80.64,-80.64zM80.16,61.44c-0.855,0.09 -1.665,0.48 -2.28,1.08l-30.12,30.24l-0.36,0.12c-0.09,0.075 -0.165,0.15 -0.24,0.24v0.12c-0.09,0.075 -0.165,0.15 -0.24,0.24c-0.09,0.075 -0.165,0.15 -0.24,0.24c0,0.045 0,0.075 0,0.12c-0.09,0.075 -0.165,0.15 -0.24,0.24c0,0.045 0,0.075 0,0.12c-0.24,0.405 -0.405,0.855 -0.48,1.32c0,0.045 0,0.075 0,0.12c0,0.12 0,0.24 0,0.36c0,0.075 0,0.165 0,0.24c0,0.045 0,0.075 0,0.12c0.06,0.51 0.225,0.99 0.48,1.44c0.03,0.075 0.075,0.165 0.12,0.24c0.045,0.045 0.075,0.075 0.12,0.12c0.03,0.075 0.075,0.165 0.12,0.24c0.045,0.045 0.075,0.075 0.12,0.12c0.045,0.045 0.075,0.075 0.12,0.12c0.045,0.045 0.075,0.075 0.12,0.12c0.21,0.225 0.45,0.435 0.72,0.6l30,30.12c1.53,1.53 3.99,1.53 5.52,0c1.53,-1.53 1.53,-3.99 0,-5.52l-24.12,-24.12h82.8c1.38,0.015 2.67,-0.705 3.375,-1.905c0.69,-1.2 0.69,-2.67 0,-3.87c-0.705,-1.2 -1.995,-1.92 -3.375,-1.905h-82.8l24.12,-24.12c1.245,-1.155 1.575,-2.985 0.825,-4.5c-0.735,-1.53 -2.4,-2.37 -4.065,-2.1z"></path></g></g></g></svg>Back</button>';
}
function stu_count($con){
  $STU_COUNT = '';
  $sqlq = 'SELECT COUNT(STUDENT_ID) AS STU_COUNT FROM STUDENT';
  $stmt = sqlsrv_query($con,$sqlq,NULL);
  while($rec = sqlsrv_fetch_array($stmt)){
    $STU_COUNT = $rec['STU_COUNT'];
  }
  return $STU_COUNT;
}

function editbtn($btnnme){
  return '<button style="margin: 5px 5px 5px 5px;" type="submit" name="'.$btnnme.'" class="btn btn-sm btn-primary float-right mb-5 btn-success">
  <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
width="18" height="18"
viewBox="0 0 192 192"
style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,192v-192h192v192z" fill="none"></path><g fill="#ffffff"><g id="surface1"><path d="M164.76,11.16c-4.05,0 -8.1,1.5 -11.16,4.56l-3.24,3.12c-0.78,-0.405 -1.665,-0.525 -2.52,-0.36c-0.735,0.165 -1.395,0.54 -1.92,1.08l-120.6,120.6c-0.375,0.375 -0.66,0.825 -0.84,1.32l-12.72,33.84c-0.51,1.395 -0.165,2.97 0.9,4.02c1.05,1.065 2.625,1.41 4.02,0.9l33.84,-12.72c0.495,-0.18 0.945,-0.465 1.32,-0.84l120.6,-120.6c1.29,-1.335 1.455,-3.405 0.36,-4.92l3.12,-3.12c6.12,-6.12 6.12,-16.2 0,-22.32c-3.06,-3.06 -7.11,-4.56 -11.16,-4.56zM164.76,18.84c2.1,0 4.215,0.735 5.76,2.28c3.105,3.105 3.105,8.415 0,11.52l-3,3.12l-11.52,-11.52l3,-3.12c1.545,-1.545 3.66,-2.28 5.76,-2.28zM148.56,27.6l15.84,15.84l-10.56,10.44l-15.72,-15.72zM132.6,43.56l15.84,15.84l-99.48,99.36l-2.88,-3v-6c0,-2.115 -1.725,-3.84 -3.84,-3.84h-6l-3,-2.88zM29.4,150.12l2.4,2.4c0.735,0.72 1.74,1.11 2.76,1.08h3.84v3.84c-0.03,1.02 0.36,2.025 1.08,2.76l2.4,2.4l-14.64,5.52l-3.36,-3.36z"></path></g></g></g></svg></button>';
}
function deletebtn($btnnme){
  return '<button type="submit" style="margin: 5px;" name="'.$btnnme.'" class="btn btn-sm btn-primary float-right mb-5 btn-danger">
  <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
width="18" height="18"
viewBox="0 0 192 192"
style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,192v-192h192v192z" fill="none"></path><g fill="#ffffff"><g id="surface1"><path d="M80.64,0c-6.315,0 -11.52,5.205 -11.52,11.52v7.68h-30c-0.48,-0.09 -0.96,-0.09 -1.44,0h-6.96c-0.12,0 -0.24,0 -0.36,0c-2.115,0.105 -3.765,1.905 -3.66,4.02c0.105,2.115 1.905,3.765 4.02,3.66h4.2l13.8,155.52c0.48,5.37 5.055,9.6 10.44,9.6h73.68c5.385,0 9.96,-4.23 10.44,-9.6l13.8,-155.52h4.2c1.38,0.015 2.67,-0.705 3.375,-1.905c0.69,-1.2 0.69,-2.67 0,-3.87c-0.705,-1.2 -1.995,-1.92 -3.375,-1.905h-38.4v-7.68c0,-6.315 -5.205,-11.52 -11.52,-11.52zM80.64,7.68h30.72c2.16,0 3.84,1.68 3.84,3.84v7.68h-38.4v-7.68c0,-2.16 1.68,-3.84 3.84,-3.84zM42.6,26.88h106.8l-13.8,154.92c-0.12,1.335 -1.545,2.52 -2.76,2.52h-73.68c-1.215,0 -2.64,-1.185 -2.76,-2.52zM72.6,38.28c-0.165,0.03 -0.33,0.075 -0.48,0.12c-1.785,0.405 -3.045,2.01 -3,3.84v126.72c-0.015,1.38 0.705,2.67 1.905,3.375c1.2,0.69 2.67,0.69 3.87,0c1.2,-0.705 1.92,-1.995 1.905,-3.375v-126.72c0.045,-1.11 -0.405,-2.175 -1.2,-2.925c-0.81,-0.765 -1.905,-1.14 -3,-1.035zM95.64,38.28c-0.165,0.03 -0.33,0.075 -0.48,0.12c-1.785,0.405 -3.045,2.01 -3,3.84v126.72c-0.015,1.38 0.705,2.67 1.905,3.375c1.2,0.69 2.67,0.69 3.87,0c1.2,-0.705 1.92,-1.995 1.905,-3.375v-126.72c0.045,-1.11 -0.405,-2.175 -1.2,-2.925c-0.81,-0.765 -1.905,-1.14 -3,-1.035zM118.68,38.28c-0.165,0.03 -0.33,0.075 -0.48,0.12c-1.785,0.405 -3.045,2.01 -3,3.84v126.72c-0.015,1.38 0.705,2.67 1.905,3.375c1.2,0.69 2.67,0.69 3.87,0c1.2,-0.705 1.92,-1.995 1.905,-3.375v-126.72c0.045,-1.11 -0.405,-2.175 -1.2,-2.925c-0.81,-0.765 -1.905,-1.14 -3,-1.035z"></path></g></g></g></svg></button>';
}
?>


		<!---			<h2>Section title</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Header</th>
              <th>Header</th>
              <th>Header</th>
              <th>Header</th>
            </tr>
            <tr>
              <td>1,001</td>
              <td>Lorem</td>
              <td>ipsum</td>
              <td>dolor</td>
              <td>sit</td>
            </tr>
            <tr>
              <td>1,002</td>
              <td>amet</td>
              <td>consectetur</td>
              <td>adipiscing</td>
              <td>elit</td>
            </tr>
            <tr>
              <td>1,003</td>
              <td>Integer</td>
              <td>nec</td>
              <td>odio</td>
              <td>Praesent</td>
            </tr>
            <tr>
              <td>1,003</td>
              <td>libero</td>
              <td>Sed</td>
              <td>cursus</td>
              <td>ante</td>
            </tr>
            <tr>
              <td>1,004</td>
              <td>dapibus</td>
              <td>diam</td>
              <td>Sed</td>
              <td>nisi</td>
            </tr>
            <tr>
              <td>1,005</td>
              <td>Nulla</td>
              <td>quis</td>
              <td>sem</td>
              <td>at</td>
            </tr>
            <tr>
              <td>1,006</td>
              <td>nibh</td>
              <td>elementum</td>
              <td>imperdiet</td>
              <td>Duis</td>
            </tr>
            <tr>
              <td>1,007</td>
              <td>sagittis</td>
              <td>ipsum</td>
              <td>Praesent</td>
              <td>mauris</td>
            </tr>
            <tr>
              <td>1,008</td>
              <td>Fusce</td>
              <td>nec</td>
              <td>tellus</td>
              <td>sed</td>
            </tr>
            <tr>
              <td>1,009</td>
              <td>augue</td>
              <td>semper</td>
              <td>porta</td>
              <td>Mauris</td>
            </tr>
            <tr>
              <td>1,010</td>
              <td>massa</td>
              <td>Vestibulum</td>
              <td>lacinia</td>
              <td>arcu</td>
            </tr>
            <tr>
              <td>1,011</td>
              <td>eget</td>
              <td>nulla</td>
              <td>Class</td>
              <td>aptent</td>
            </tr>
            <tr>
              <td>1,012</td>
              <td>taciti</td>
              <td>sociosqu</td>
              <td>ad</td>
              <td>litora</td>
            </tr>
            <tr>
              <td>1,013</td>
              <td>torquent</td>
              <td>per</td>
              <td>conubia</td>
              <td>nostra</td>
            </tr>
            <tr>
              <td>1,014</td>
              <td>per</td>
              <td>inceptos</td>
              <td>himenaeos</td>
              <td>Curabitur</td>
            </tr>
            <tr>
              <td>1,015</td>
              <td>sodales</td>
              <td>ligula</td>
              <td>in</td>
              <td>libero</td>
            </tr>
          </thead>
          <tbody>
					
				</main>
			</div>
		</div>----->
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
<?php sqlsrv_close($con);?>
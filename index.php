<?php
session_start();
require ('db.php');
$created    = date('Y-m-d H:i:s');
$Msg='';
date_default_timezone_set('Asia/Calcutta');
// $con = mysqli_connect ($servername, $username, $password, $dbname );
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>StuDPoint</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- favicon -->
	<link rel="apple-touch-icon" sizes="57x57" href="images/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/favicon/apple-icon-114x114.png">
	<link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png">
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon/favicon.ico">
	<!-- Tell the browser to be responsive to screen width -->
	<link rel="stylesheet" href="bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="ionicons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="dataTables.bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="AdminLTE.min.css">
	<link rel="stylesheet" href="_all-skins.min.css">
	<link rel="stylesheet" href="login_page.css">
	<!-- bootstrap wysihtml5 - text editor -->
	<!-- <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->
	<!-- Google Font -->
	<link rel="stylesheet" href="google_fonts.css">
	<style>
		.error {
			color: #ff0303b8 !important;
		}

		/* .login-page, .register-page{
      background-color: #ffeb3b61;
      height: auto;
    } */
	</style>
</head>

<body class="hold-transition login-page">
	<div class="page_content">
		<div class="login_content">
			<div class="shop_detail">
				<div class="shop_logo">
					<img src="images/logo_vj.png" width="50" height="50">
					<h3>StuDPoint</h3>
				</div>
				<!-- /.shop_logo -->
				<!-- <div class="shop_name">
				</div> -->
				<!-- /.shop_name -->
			</div>
			<!-- /.shop_detail -->
			<div class="page_title">
				<h2>Welcome Back</h2>
			</div>
			<!-- /.page_title -->
			<?php 
				if(!isset($_SESSION['user_name'])){  
					if(isset($_GET['login_error']))
					{
						$Msg="<div class='alert alert-block alert-danger' id='alert'>
								<button type='button' class='close' data-dismiss='alert' id='close'>
									<i class='ace-icon fa fa-times' ></i>
								</button>
								<h5> <i class='icon fa fa-ban'></i> Please avoid this Kind of illegal access...!</h5>
							</div>
							<script>
					  			// window.setTimeout(function() { $('.alert').fadeTo(500, 0).slideUp(200, function(){ $(this).remove(); }); }, 2000);
							</script> ";
					} //include all pages end
			  		if(isset($_POST['login'])){
						$user	= trim($_REQUEST['user_name']);
						$pass	= trim($_REQUEST['pass']);
						$pass	= MD5($pass);
						
						$sql = mysqli_query($connection, "SELECT * FROM `inv_user` WHERE `invUserId`='$user' AND `userPass`='$pass'");
					
						//$f_sql = mysqli_query($connection,"SELECT * FROM `financial_year` WHERE `status` ='1'");
						//$c_sql = mysqli_query($connection,"SELECT `com_name` FROM `company_details`");
						// echo $sql;die;
						if(mysqli_num_rows($sql) == 0){
							
					  		$Msg= "<div class='alert alert-block alert-danger' id='alert'>
					  				<button type='button' class='close' data-dismiss='alert' id='close'>
										<i class='ace-icon fa fa-times' ></i>
									</button>
									<h5> <i class='icon fa fa-ban'></i> Invalid User Name and Password..!</h5>
								</div>
								<script>
									// window.setTimeout(function() { $('.alert').fadeTo(500, 0).slideUp(200, function(){ $(this).remove(); }); }, 2000);
								</script> ";
								
						}else{
							$row = mysqli_fetch_assoc($sql);
							$row1 = mysqli_fetch_assoc($f_sql);
							$row2 = mysqli_fetch_assoc($c_sql);
							$_SESSION['user_name']=$row['invUserId'];
							$_SESSION['name']=$row['userName'];
							$_SESSION['role'] = $row['userRole'];
							$_SESSION['company_name']=$row2['com_name'];
							$_SESSION['financial_year']=$row1['financial_year'];
							$_SESSION['from_date']=$row1['from_date'];
							$_SESSION['to_date']=$row1['to_date'];

							//header("Location:dashboarxd/index.php");
							
							echo"window.open('./dashboard/index.php')";

						}	
					}
			  	}
			?>
			<div class="error_msg"><?php echo $Msg??'';?></div>
			<div class="login_form">
				<form method="POST">
					<div class="form-group has-feedback">
						<!-- <label>User Id</label> -->
						<input type="text" name="user_name" class="form-control" tabindex="1" placeholder=" User Name"
							autofocus>
						<div id="user_name"><span class="glyphicon glyphicon-envelope form-control-feedback"></span></div>
					</div>
					<div class="form-group has-feedback">
						<input type="password" name="pass" class="form-control" id="pass" tabindex="2" placeholder="Password">
						<div id="pass"><span class="glyphicon glyphicon-lock form-control-feedback"></span></div>
					</div>
					<div class="row">
						<div class="col-xs-12" align="center">
							<div class="checkbox ">
								<label>
									<input type="checkbox" tabindex="3"> Remember Me
								</label>
							</div>
						</div>
						<!-- /.col -->
						<!-- <div class="col-xs-5">
							<div class="checkbox ">
	 							<a href="#">Forgot Password ?</a>
							</div>
						</div> -->
						<!-- /.col -->
						<div class="col-xs-12">
							<button type="submit" name="login" tabindex="4" class="btn btn-primary btn-block">Sign
								In</button>
						</div>
						<!-- /.col -->
					</div>
				</form>
			</div>
			<!-- ./login_form -->
		</div>

		<!-- /.enquiry -->
	</div>
	<!-- /.content -->
	<!-- <footer>
		<h2>STU Innovations Pvt. Ltd.</h2>
	</footer> -->
</body>
<!-- jQuery 3 -->
<script src="jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bootstrap.min.js"></script>

<script src="jquery.validate.min.js"></script>

<script>
	// ------------form Validation-----------

	$(document).ready(function () {
		$("#login_form").validate({
			rules: {

				user_name: {
					required: true,
					minlength: 4
				},
				pass: {
					required: true,
					minlength: 3
				}
			},
			messages: {
				user_name: {
					required: "Please Enter User Name",
					minlength: "User Name must consist of at least 4 characters"
				},
				pass: {
					required: "Please Provide a Password",
					minlength: "Password must be at least 5 characters long"
				}

			},
			submitHandler: function (form) {
				form.submit();
			}
		});

	});
</script>

</html>
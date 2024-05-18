<!--Server side code to handle  sign up-->
<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['pat_sup']))
		{
			$pat_fname=$_POST['pat_fname'];
			$pat_lname=$_POST['pat_lname'];
			$pat_email=$_POST['pat_email'];
			$pat_pwd=sha1(md5($_POST['pat_pwd']));//double encrypt to increase security
            //sql to insert captured values
			$query="insert into his_patients (pat_fname, pat_lname, pat_email, pat_pwd) values(?,?,?,?)";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('ssss', $pat_fname, $pat_lname, $pat_email, $pat_pwd);
			$stmt->execute();
			/*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/ 
			//declare a varible which will be passed to alert function
			if($stmt)
			{
				$success = "Created Account Proceed To Log In";
			}
			else {
				$err = "Please Try Again Or Try Later";
			}
			
			
		}
?>
<!--End Server Side-->
<!--End Login-->
<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8" />
        <title>TeleHealth Village</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.png">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <!--Load Sweet Alert Javascript-->
        <script src="assets/js/swal.js"></script>
        <!--Inject SWAL-->
        <?php if(isset($success)) {?>
        <!--This code for injecting an alert-->
                <script>
                            setTimeout(function () 
                            { 
                                swal("Success","<?php echo $success;?>","success");
                            },
                                100);
                </script>

        <?php } ?>

        <?php if(isset($err)) {?>
        <!--This code for injecting an alert-->
                <script>
                            setTimeout(function () 
                            { 
                                swal("Failed","<?php echo $err;?>","Failed");
                            },
                                100);
                </script>

        <?php } ?>

    </head>

    <body class="authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <a href="admin_register.php">
                                        <span><img src="assets/images/logo-dark.png" alt="" height="22"></span>
                                    </a>
                                    <h3 class="text-black mb-4 mt-3">Create Patient Account</h3>
                                </div>

                                <form  method='post'>

                                    <div class="form-group">
                                        <label for="fullname">First Name</label>
                                        <input class="form-control" type="text"  name = "pat_fname" id="fullname" placeholder="Enter your name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fullname">Last Name</label>
                                        <input class="form-control" type="text" name="pat_lname" id="fullname" placeholder="Enter your name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="emailaddress">Email address</label>
                                        <input class="form-control" name="pat_email" type="email" id="emailaddress" required placeholder="Enter your email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input class="form-control" name="pat_pwd" type="password" required id="password" placeholder="Enter your password">
                                    </div>
                                    
                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" name="pat_sup" type="submit"> Sign Up </button>
                                    </div>

                                </form>
                                

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-white-50">Already have account?  <a href="index.php" class="text-white ml-1"><b>Sign In</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!--Footer-->
            <?php include("assets/inc/footer1.php");?>
        <!-- End Footer-->

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>

</html>
<?php
    session_start();
    include('assets/inc/config.php');//get configuration file
    if(isset($_POST['doc_login']))
    {
        $doc_number = $_POST['doc_email'];
        //$doc_email = $_POST['doc_ea']
        $doc_pwd = sha1(md5($_POST['doc_pwd']));//double encrypt to increase security
        $stmt=$mysqli->prepare("SELECT doc_email, doc_pwd, doc_id FROM his_docs WHERE  doc_email=? AND doc_pwd=? ");//sql to log in user
        $stmt->bind_param('ss', $doc_number, $doc_pwd);//bind fetched parameters
        $stmt->execute();//execute bind
        $stmt -> bind_result($doc_number, $doc_pwd ,$doc_id);//bind result
        $rs=$stmt->fetch();
        $_SESSION['doc_id'] = $doc_id;
        $_SESSION['doc_email'] = $doc_number;//Assign session to doc_number id
        //$uip=$_SERVER['REMOTE_ADDR'];
        //$ldate=date('d/m/Y h:i:s', time());
        if($rs)
            {//if its sucessfull
                header("location:doc_dashboard.php");
            }

        else
            {
            #echo "<script>alert('Access Denied Please Check Your Credentials');</script>";
                $err = "Access Denied Please Check Your Credentials";
            }
    }
?>
<!--End Login-->
<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8" />
        <title>TeleHealth Village</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="MartDevelopers" />
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
                                swal("Failed","<?php echo $err;?>","error");
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
                                    <a href="index.php">
                                        <span><img src="assets/images/login logo.png" alt="" height="30"></span>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">Login to access Doctor panel.</p>
                                </div>

                                <form method='post' >

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">Doctor Email</label>
                                        <input class="form-control" name="doc_email" type="text" id="emailaddress" required="" placeholder="Enter your email">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input class="form-control" name="doc_pwd" type="password" required="" id="password" placeholder="Enter your password">
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-success btn-block" name="doc_login" type="submit"> Log In </button>
                                    </div>

                                </form>

                                <div class="text-center">
                                    <h5 class="mt-3 text-muted">Don't have an account?</h5>
                                    <a href="register_doctor.php" class="text-black ml-1"><b>Sign Up</b></a>

                                    <!-- <ul class="social-list list-inline mt-3 mb-0">
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github-circle"></i></a>
                                        </li>
                                    </ul> -->
                                </div> 
                               

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-white-50">Back to <a href="../../index.php" class="text-white ml-1"><b>HomePage</b></a></p>
                            </div>
                        </fiv>

                        <!-- <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p> <a href="his_admin_pwd_reset.php" class="text-white-50 ml-1">Forgot your password?</a></p>
                               <p class="text-white-50">Don't have an account? <a href="his_admin_register.php" class="text-white ml-1"><b>Sign Up</b></a></p>
                            </div> end col
                        </div> -->
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <?php include ("assets/inc/footer1.php");?>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>

</html>
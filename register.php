<?php require_once 'App/inti.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css"> 
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="register.js"></script>   -->
</head>
<body>
<div class="form-bg">
    <div class="container">
        <div class="row">
            <div class="offset-md-4 col-md-4 offset-sm-3 col-sm-6">
                <div id="errorDiv">

                </div>
                <div class="form-container">
                <?php
                if(isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn'] == TRUE){
                    header("Location: dashboard/index.php");
                }else{
                ?>
                    <form class="form-horizontal" id="userForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <h3 class="title">Register Form</h3>
                        <div class="mb-3">
                        <?php
                        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['register'])){
                            $user->setInputForRegister($_POST['firstname'] , $_POST['lastname'] , $_POST['uid'],  $_POST['email'] , $_POST['password1'] , $_POST['password2']);
                            $user->DisplayMsgInRegister();
                            
                            
                        }
                        ?>
                        </div>
                        <div class="d-flex">
                            <div class="mb-3 me-2">
                                <div class="form-group">
                                    <span class="input-icon"><i class="fas fa-user"></i></span>
                                    <label for="fname"></label>
                                    <input class="form-control" type="text" id="fname" name="firstname" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname']: null; ?>" placeholder="Firstname">
                                </div>
                                <span class="errorFeedback errorSpan" id="fnameError">Firstname is required</span>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <span class="input-icon"><i class="fas fa-user"></i></span>
                                    <label for="lname"></label>
                                    <input class="form-control" type="text" id="lname" name="lastname" value="<?php echo isset($_POST['lastname']) ? $_POST['lastname']: null; ?>" placeholder="Lastname">
                                </div>
                                <span class="errorFeedback errorSpan" id="lnameError">Lastame is required</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <span class="input-icon"><i class="fas fa-id-card"></i></span>
                                <label for="uid"></label>
                                <input class="form-control" type="text" id="uid" name="uid" value="<?php echo isset($_POST['uid']) ? $_POST['uid']: null; ?>" placeholder="ID">       
                            </div>
                            <span class="errorFeedback errorSpan" id="idError">ID is required</span>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <span class="input-icon"><i class="fas fa-at"></i></span>
                                <label for="email"></label>
                                <input class="form-control" type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email']: null; ?>" placeholder="Email">       
                            </div>
                            <span class="errorFeedback errorSpan" id="emailError">Email is required</span>
                        </div>
                        <!-- <div class="mb-3">
                            <div class="form-group">
                                <span class="input-icon"><i class="fas fa-phone"></i></span>
                                <label for="phone"></label>
                                <input class="form-control" type="text" id="phone" name="phone" placeholder="Phone Number">    
                            </div>
                            <span class="errorFeedback errorSpan" id="phoneError">Format: xxx-xxx-xxx</span>
                        </div> -->
                        <div class="mb-3">
                            <div class="form-group">
                                <span class="input-icon"><i class="fa fa-lock"></i></span>
                                <label for="password1"></label>
                                <input class="form-control" type="password" id="password1" name="password1" value="<?php echo isset($_POST['password1']) ? $_POST['password1']: null; ?>" placeholder="Password">    
                            </div>
                            <span class="errorFeedback errorSpan" id="password1Error">password is required</span>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <span class="input-icon"><i class="fa fa-lock"></i></span>
                                <label for="password2"></label>
                                <input class="form-control" type="password" id="password2" name="password2" value="<?php echo isset($_POST['password2']) ? $_POST['password2']: null; ?>" placeholder="Confirm Password">    
                            </div> 
                            <span class="errorFeedback errorSpan" id="password2Error">password is not match</span>
                        </div>
                        
                        <button class="btn signup" type="submit" id="submit" name="register">Sign up</button>
                        <span class="register"><a href="login.php">Login / Signin</a></span>
                    </form>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/bootstrap.js"></script>
</body>
</html>
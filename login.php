<?php require_once 'App/inti.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css"> 
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
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
                    <form class="form-horizontal" id="loginForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
                        <h3 class="title">Login Form</h3>   
                        <div class="mb-3">
                            <?php
                            if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['login'])){
                                $user->setInputForLogin($_POST['email'], $_POST['password']);
                                $user->DisplayMsgInLogin();
                            }
                            ?>
                        </div>                     
                        <div class="mb-3">
                            <div class="form-group">
                                <span class="input-icon"><i class="fas fa-at"></i></span>
                                <label for="email"></label>
                                <input class="form-control" type="email" id="email" name="email" placeholder="Email">       
                            </div>
                            <span class="errorFeedback errorSpan" id="emailError">Email is required</span>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <span class="input-icon"><i class="fa fa-lock"></i></span>
                                <label for="password"></label>
                                <input class="form-control" type="password" id="password" name="password" placeholder="Password">    
                            </div>
                            <span class="errorFeedback errorSpan" id="passwordError">password is required</span>
                        </div>                        
                        <button class="btn signin" type="submit" id="submit" name="login">Login</button>
                        <span class="register"><a href="register.php">Register / Signup</a></span>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/bootstrap.js"></script>
</body>
</html>
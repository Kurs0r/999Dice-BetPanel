<!DOCTYPE html>
<html>
<head>
    <title>Login | DogeDice</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
  <script src="jquery.js"> </script>
  <script src="bootstrap.min.js"></script>
  <link rel="stylesheet" href="bootstrap.min.css" type="text/css" />

<nav class="navbar navbar-default" style="background-color:#333333;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">DogeDice</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
    </ul>
  </div>
</nav>

<?php
session_start();

$key = 'ytqi487ty7824ty92yru8ewyr01ogvbcscxzlihfouwehrq308rw09urlhfvjbcbvkjdbvusdh=';
echo "<script>console.log('STARTING SESSION NOW');</script>";

if (isset($_SESSION['name'])) {
    /*If SESSION still contains variables stored. Clear it*/
    echo "<script>console.log('SESSION CONTAINS STORED VARIABLES');</script>";
    echo '<script> console.log("' . $_SESSION['name'] . '"); </script>';
} else {
    echo "<script>console.log('SESSION VARIABLE are EMPTY');</script>";
}

$error = null;
//check if form is submitted
if (isset($_POST['signup'])) {
    $name     = $_POST['name'];
    $password = $_POST['password'];
    
    if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        //name can contain only alpha characters and space
        $error      = true;
        $name_error = "Name must contain only alphabets and space";
    }
    
    if (strlen($password) < 6) {
        //Check if password is not less than 6 characters
        $error          = true;
        $password_error = "Password must be of minimum 6 characters";
    }
    
    
    if (!$error) {
        $_SESSION['name']        = $name;
        $_SESSION['pwd']         = $password;
        $_SESSION['flag']        = "1"; //Work is not yet done. Hence, Flag is set to 1.
        $_SESSION['hash']        = password_hash($password, PASSWORD_DEFAULT);
        $_SESSION['register']    = 3;
        $_SESSION['wageramount'] = "";
        
        if (isset($_POST['register'])) {
            $_SESSION['register'] = $_POST['register'];
        } else
            $_SESSION['register'] = null;
        echo '<script> console.log("' . $_SESSION['name'] . '"); </script>';
        echo '<script> console.log("' . $_SESSION['email'] . '"); </script>';
        
        header("Location: panel.php");
        // echo '<script> console.log("'.$_SESSION['pwd'].'"); </script>';
    } //if loop ends here
} //end of SignUp if loop



//echo "<script>console.log('DESTROYING SESSION NOW');</script>";
?>


</head>
<body style="background-color:#505050;>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
            <form role="form" action="<?php
echo $_SERVER['PHP_SELF'];
?>" method="post" name="signupform">
                <fieldset>
                    <legend><center>Register or Log in</center></legend>

    <div class="form-group">
      <label for="name">Username</label>
      <input type="text" name="name" placeholder="Username" required value="<?php
if ($error)
    echo $name;
?>" class="form-control" />
      <span class="text-danger"><?php
if (isset($name_error))
    echo $name_error;
?></span>
    </div>

    <div class="form-group">
      <label for="name">Password</label>
      <input type="password" name="password" placeholder="Password" required class="form-control" />
      <span class="text-danger"><?php
if (isset($password_error))
    echo $password_error;
?></span>
    </div>
    
     <div class="form-group"><center>
      <label for="name">Register?</label>
      <input type="checkbox" name="register" placeholder="Register?" value="1" />
      </center>
    </div>

    <div class="form-group">
      <input type="submit" name="signup" value="Register or Login" class="btn btn-success" style="width:100%"/>
    </div>
  </fieldset>
  </form>
  </div>
</div>
</div>
</body>
</html>
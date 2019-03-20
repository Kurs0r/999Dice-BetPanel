<!DOCTYPE html>
<html>
<head>
  <title>Panel | DogeDice</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
  <script src="jquery.js"> </script>
  <script src="bootstrap.min.js"></script>
  <script src="jquery.min.js"></script>
  <link rel="stylesheet" href="bootstrap.min.css" type="text/css" />
  <style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 50%;
  padding-left: 15%;
  padding-right: 15%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
</style>
 <nav class="navbar navbar-default" style="background-color:#333333;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">DogeDice</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="#">Home</a></li>
    </ul>
  </div>
</nav>
<body style="background-color:#505050"></body>
<?php
session_start();
$name = $_SESSION['name'];
if (isset($_POST['signout'])) {
    $page = 'index.php';
    session_destroy();
    header("Refresh: 0; url=$page");
}

if (password_verify($_SESSION['pwd'], $_SESSION['hash']) == 1) {
    $password = $_SESSION['pwd'];
    $page     = $_SERVER['PHP_SELF'];
    include 'functions.php'; //import '/include/functions.php'//
    if (isset($_SESSION['register'])) {
        CreateAccount();
        CreateUser();
        
        //echo $_SESSION['sessioncookie'];
        //echo $_SESSION['accountid'];
        //header("Refresh: 5; url=$page");
        //session_destroy();     //This will destroy the Session
    } elseif (isset($_SESSION['register']) == FALSE) {
        //Do Login(); here
        Login();
        $password = $_SESSION['pwd'];
        $name     = $_SESSION['name'];
        echo '
</head>
<body>
<div class="container-fluid" style="display: inline-block;">
<ul class="nav navbar-nav" style="float: center;">
      <li><form method="POST" action="/panel.php"><input type="submit"  name="page" value="Doge" class="btn btn-success"/></form><br></li>
      <li><form method="POST" action="/panel.php"><input type="submit"  name="page" value="LTC" class="btn btn-success"/></form><br></li>
      <li><form method="POST" action="/panel.php"><input type="submit"  name="page" value="BTC" class="btn btn-success"/></form><br></li>
      <li><form method="POST" action="/"><input type="submit"  name="signout" value="Sign Out" class="btn btn-success"/></form><br></li>
      </ul>
      
      <br>
</div>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4 well"><center><P>
      ';
        echo '<br>Username: ', $_SESSION['name'], '</center><P>
    ';
        if (isset($_SESSION['btcbalance'])) {
            if (isset($_POST['submit']) and isset($_POST['placebets'])) {
                PlaceBet();
                
            }
            echo '</div></center>
      </div>
    </div>
  </div>
</body>
</html>
';
            
        }
    } else
        echo '<center> an unknows error occurred.</center>';
    
    if ((isset($_POST['page']) and isset($_SESSION['accountid']))) {
        
        if ($_POST['page'] == 'Doge') {
            echo "<center>";
            //$data_ = "a=PlaceBets&s=" . $_SESSION['sessioncookie'] . "&PayIn=1&Low=499999&High=999999&ClientSeed=1235235&Currency=btc";
            //echo $data_;
            echo '<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body style="background-color:#505050">
 <div class="container">
 <div class="row">';
            #$dogebalance = $_SESSION['DOGE'][0]['Balance'] * 0.00000001;
            echo '
 <div class="col-md-4 col-md-offset-4 well">
        <center>Balance: <script>var dogebalance = "' . $_SESSION['DOGE'][0]['Balance'] * 0.00000001 . '";document.write(dogebalance);</script> Doge.<br><br></center><br></div><center>
    <div class="col-md-4 col-md-offset-4 well">';
            
            echo '<form method="POST" action="', $_SERVER['PHP_SELF'], '">
<br> number of bets<br><input type="text" name="numbets" value="1"></input><br>
<br> basebet amount<br><input type="text" name="payin" value="0.0001"></input><br><br>';
            
            echo '
<input type="hidden" name="low" value="';
$lowww = rand(0, 250000);
echo $lowww;
echo '"></input>
<input type="hidden" name="high" value="';
echo ($lowww + 750000);
echo '
"></input>
<input type="hidden" name="clientseed" value="', rand(111111, 999999), '"></input>
<input type="hidden" name="currency" value="doge"></input>
<input type="hidden" name="placebets" value="1"></input>
<input type="textbox" name="inconloss" value="multiplier on loss"></input><br><br>



<input type="checkbox" name="5c" value="1"> 5%c random range<br><br> (Defaults to 75%c, 20x increase on loss)<br><br></input>
<input type="submit"  name="submit" value="Place Bets!" class="btn btn-success"/></form>

</div>
</div>
</div>


</body>
</html>
';
            
            echo '</center>
            
            ';
        }
        if ($_POST['page'] == 'LTC') {
            echo "<center>";
            //$data_ = "a=PlaceBets&s=" . $_SESSION['sessioncookie'] . "&PayIn=1&Low=499999&High=999999&ClientSeed=1235235&Currency=btc";
            //echo $data_;
            echo '<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body style="background-color:#505050">
 <div class="container">
 <div class="row">';
            #$dogebalance = $_SESSION['DOGE'][0]['Balance'] * 0.00000001;
            echo '
 <div class="col-md-4 col-md-offset-4 well">
        <center>Balance: <script>var dogebalance = "' . $_SESSION['LTC'][0]['Balance'] * 0.00000001 . '";document.write(dogebalance);</script> LTC.<br><br></center><br><center></div>
    <div class="col-md-4 col-md-offset-4 well">';
            
            echo '<form method="POST" action="', $_SERVER['PHP_SELF'], '">
<br> number of bets<br><input type="text" name="numbets" value="1"></input><br>
<br> basebet amount<br><input type="text" name="payin" value="0.0001"></input><br><br>';
            
            echo '
<input type="hidden" name="low" value="';
$lowww = rand(0, 250000);
echo $lowww;
echo '"></input>
<input type="hidden" name="high" value="';
echo ($lowww + 750000);
echo '
"></input>
<input type="hidden" name="clientseed" value="', rand(111111, 999999), '"></input>
<input type="hidden" name="currency" value="ltc"></input>
<input type="hidden" name="placebets" value="1"></input>
<input type="textbox" name="inconloss" value="multiplier on loss"></input><br><br>



<input type="checkbox" name="5c" value="1"> 5%c random range<br><br> (Defaults to 75%c, 20x increase on loss)<br><br></input>
<input type="submit"  name="submit" value="Place Bets!" class="btn btn-success"/></form>

</div>
</div>
</div>


</body>
</html>
';
            
            echo '</center>
            
            ';
            
        }
        if ($_POST['page'] == 'BTC') {
            echo "<center>";
            //$data_ = "a=PlaceBets&s=" . $_SESSION['sessioncookie'] . "&PayIn=1&Low=499999&High=999999&ClientSeed=1235235&Currency=btc";
            //echo $data_;
            echo '<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body style="background-color:#505050">
 <div class="container">
 <div class="row">';
            #$dogebalance = $_SESSION['DOGE'][0]['Balance'] * 0.00000001;
            echo '
 <div class="col-md-4 col-md-offset-4 well">
        <center>Balance: <script>var dogebalance = "' . $_SESSION['btcbalance'] * 0.00000001 . '";document.write(dogebalance);</script> BTC.<br><br></center></div><br><center>
    <div class="col-md-4 col-md-offset-4 well">';
            
            echo '<form method="POST" action="', $_SERVER['PHP_SELF'], '">
<br> number of bets<br><input type="text" name="numbets" value="1"></input><br>
<br> basebet amount<br><input type="text" name="payin" value="0.0001"></input><br><br>';
            
            echo '
<input type="hidden" name="low" value="';
$lowww = rand(0, 250000);
echo $lowww;
echo '"></input>
<input type="hidden" name="high" value="';
echo ($lowww + 750000);
echo '
"></input>
<input type="hidden" name="clientseed" value="', rand(111111, 999999), '"></input>
<input type="hidden" name="currency" value="btc"></input>
<input type="hidden" name="placebets" value="1"></input>
<input type="textbox" name="inconloss" value="multiplier on loss"></input><br><br>



<input type="checkbox" name="5c" value="1"> 5%c random range<br><br> (Defaults to 75%c, 20x increase on loss)<br><br></input>
<input type="submit"  name="submit" value="Place Bets!" class="btn btn-success"/></form>

</div>
</div>
</div>


</body>
</html>
';
            
            echo '</center>
            
            ';
        }
    }
    
}


?>
<?php
// Start the session
session_start();

$name = $_SESSION['name'];
$email = $_SESSION['email'];
$username = $_SESSION['username'];

$UserN = $_COOKIE['usern'];
$UserE = $_COOKIE['usere'];
$UserUn = $_COOKIE['userun'];
$UserP = $_COOKIE['userp'];


?>

<html lang="en">


<?php 
    include('temps/header.php');

    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>'; 
    }

    phpAlert('Successful');

    
?>
    
    <section class="center blue-text text-darken-2"></section>

    <div class="row">
      <div class="col s12"><span class="flow-text blue-text text-darken-2"><?php echo "Welcome $name "; ?></span></div>
      <div class="col s12"><span class="flow-text blue-text text-darken-2"><?php echo "Your Email is $email"; ?></span></div>
      <div class="col s12"><span class="flow-text blue-text text-darken-2"><?php echo "Your Username is $username"; ?></span></div>
      <div class="col s12"><span class="flow-text error">Do NOT share this info with anyone or your account could be compromised. Thank You</span></div>
      <div class="col s6 offset-s6"><span class="flow-text"><a href="/phpstuff/Week2/login.php" class="btn right">Logout</a></div>
    </div>
</body>
</html>
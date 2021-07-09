<?php
  require('userValidator.php');

  if(isset($_POST['submit'])){
    // validate entries
    $validation = new UserValidator($_POST);
    $errors = $validation->validateForm();
    
  }

  $err2 = '';

  if (isset($_POST['submit'])) {
    if ($_POST['name'] !== '' && $_POST['email'] !== '' && $_POST['username'] !== '' && $_POST['password'] != '') {
      session_start();

      $_SESSION['name'] = $_POST['name'];
      $_SESSION['email'] = $_POST['email'];
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['password'] = $_POST['password'];
      setcookie('usern', $_POST['name'], strtotime('1 day'), '/');
      setcookie('usere', $_POST['email'], strtotime('1 day'), '/');
      setcookie('userun', $_POST['username'], strtotime('1 day'), '/');
      setcookie('userp', $_POST['password'], strtotime('1 day'), '/');

      if (isset($_COOKIE['usern'])) {
        $UserN = $_COOKIE['usern'];
        $UserE = $_COOKIE['usere'];
        $UserUn = $_COOKIE['userun'];
        $UserP = $_COOKIE['userp'];
        if($UserE == $_POST['email'] || $UserUn == $_POST['username']){
          $err2 = 'Email or Username is already Taken';
        }else {
          setcookie('usern', $_POST['name'], strtotime('1 day'), '/');
          setcookie('usere', $_POST['email'], strtotime('1 day'), '/');
          setcookie('userun', $_POST['username'], strtotime('1 day'), '/');
          setcookie('userp', $_POST['password'], strtotime('1 day'), '/');

          header('location: home.php');
        }
      }

     
    }
  }

?>



<html lang="en">
<head>
    <title>Sign Up</title>
</head>
<body>

<?php include('temps/header.php'); ?>

<section class="container grey-text">
    <h4 class="center">Create Account</h4>
    <p><span class="error">* required field</span></p>
    <p><span class="error"><?php echo $err2 ?></span></p>
    <form class="white" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
      <label>Your Name:</label>
      <span class="error">* <?php echo $errors['name']?? '' ?></span>
      <input type="text" name="name" value="<?php echo htmlspecialchars($_POST['name']?? '') ?>">
      <label>Your Email:</label>
      <span class="error">* <?php echo $errors['email']?? '' ?></span>
      <input type="text" name="email" value="<?php echo htmlspecialchars($_POST['email']?? '') ?>">
      <label>Username:</label>
      <span class="error">* <?php echo $errors['username']?? '' ?></span>
      <input type="text" name="username" value="<?php echo htmlspecialchars($_POST['username']?? '') ?>">
      <label>Password:</label>
      <span class="error">* <?php echo $errors['password']?? '' ?></span>
      <input type="password" name="password">
      <div class="center">
        <input type="submit" name="submit" value="Sign Up" class="btn">
      </div>
    </form>
</section>


</body>
</html>
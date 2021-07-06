<?php
  $name = $email = $username = $password = '';
  $nameErr = $emailErr = $usernameErr = $passwordErr = $err2 = '';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['name'])) {
      $nameErr = 'Name is required';
    } else{
      $name = test_input($_POST['name']);

      if (!preg_match("/^[a-zA-Z-' ]*$/", $name)){
        $nameErr = "Only letters and white space allowed";
      }
    }

    if (empty($_POST['email'])) {
      $emailErr = 'Email is required';
    } else {
      $email = test_input($_POST['email']);

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailErr = "Invalid email format";
      }
    }

    if (empty($_POST['username'])) {
      $usernameErr = 'Username is Required';
    } else {
      $username = test_input($_POST['username']);

      if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
        $nameErr = "Only letters and white space allowed";
      }
    }

    if (empty($_POST['password'])) {
      $passwordErr = 'Password is required';
    } else {
      $password = test_input($_POST['password']);

      if (strlen($_POST["password"]) <= '6') {
        $passwordErr = "Your Password Must Contain At Least 6 Characters!";
      }
    }
  }

  function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if (isset($_POST['submit'])) {
    if ($_POST['name'] !== '' && $_POST['email'] !== '' && $_POST['username'] !== '' && $_POST['password'] !== '') {
      session_start();

      $_SESSION['name'] = $_POST['name'];
      $_SESSION['email'] = $_POST['email'];
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['password'] = $_POST['password'];

      

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
      <span class="error">* <?php echo $nameErr ?></span>
      <input type="text" name="name" value="<?php echo $name; ?>">
      <label>Your Email:</label>
      <span class="error">* <?php echo $emailErr ?></span>
      <input type="text" name="email" value="<?php echo $email ?>">
      <label>Username:</label>
      <span class="error">* <?php echo $usernameErr ?></span>
      <input type="text" name="username" value="<?php echo $username ?>">
      <label>Password:</label>
      <span class="error">* <?php echo $passwordErr ?></span>
      <input type="password" name="password">
      <div class="center">
        <input type="submit" name="submit" value="Sign Up" class="btn">
      </div>
    </form>
</section>


</body>
</html>
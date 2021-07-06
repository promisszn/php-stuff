<?php
    session_start();

    $name = $_SESSION['name'];

    $username = $password = $UserN = $UserE = $UserUn = $UserP = '';
    $usernameErr = $passwordErr = $err2 = '';


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['username'])) {
            $usernameErr = 'Username is Required';
        }  else {
                $username = test_input($_POST['username']);
      
                if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
                    $nameErr = "Only letters and white space allowed";
                }
            }

        if (empty($_POST['password'])) {
            $passwordErr = 'Password is required';
        }   else {
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
        if ($_POST['username'] !== '' && $_POST['password'] !== '') {
          $_SESSION['username'] = $_POST['username'];
          $_SESSION['password'] = $_POST['password'];
  
          
          
          if (isset($_COOKIE['usern'])) {
              $UserN = $_COOKIE['usern'];
              $UserE = $_COOKIE['usere'];
              $UserUn = $_COOKIE['userun'];
              $UserP = $_COOKIE['userp'];
            if($UserUn === $_POST['username'] && $UserP === $_POST['password']) {
              header('location: home.php');
            } else if (empty($_COOKIE) || $UserUn !== $_POST['username'] || $UserP !== $_POST['password']) {
              $err2 = 'Invalid Username or Password. Signup to create account';
            }
          } else {
            $err2 = 'Invalid Username or Password. Signup to create account';
          }
          }
          
      }
        
        
      
?>

<html lang="en">

<?php include('temps/header.php'); ?>

<section class="container grey-text">
    <h4 class="center">Log In</h4>
    <p><span class="error">* required field</span></p>
    <p><span class="error"><?php echo $err2 ?></span></p>
    <form class="white" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
      <label>Username:</label>
      <span class="error">* <?php echo $usernameErr ?></span>
      <input type="text" name="username" value="<?php echo $username ?>">
      <label>Password:</label>
      <span class="error">* <?php echo $passwordErr ?></span>
      <input type="password" name="password">
      <div class="center">
        <input type="submit" name="submit" value="Login" class="btn">
      </div>
    </form>
</section>
    
</body>
</html>
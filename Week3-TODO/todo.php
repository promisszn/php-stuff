<?php
    require('config/dbConnect.php');
    $title = '';
    $titleErr = '';
    

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['title'])) {
            $titleErr = 'Title is required';
          } else{
            $title = test_input($_POST['title']);
      
            if (!preg_match("/^[a-zA-Z-' ]*$/", $title)){
              $titleErr = "Only letters and white space allowed";
            }
          }
    }

    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
   

    if(isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        
        //make sql
        $sql = "SELECT * FROM todo WHERE id = $id";
        
        //get the query result
        $result = mysqli_query($conn, $sql);
    
        //fetch result in array format
        $todos = mysqli_fetch_assoc($result);
        
        $title = $todos['title'];
        $id = $todos['id'];

        mysqli_free_result($result); 
        mysqli_close($conn);

    }

    if(isset($_POST['submit'])){
        $id = mysqli_real_escape_string($conn, $_POST['idToEdit']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);

        $sql = "UPDATE todo SET title = '$title' WHERE id = $id";


        if(mysqli_query($conn, $sql)){
            //success
            header('Location: index.php');
        }else {
            echo 'query error: ' . mysqli_error($conn);
        }
    }

    
?> 

<html lang="en">
    <?php include('templates/header.php'); ?>

    <section class="container grey-text">
		<h4 class="center brand-text">Edit To-do list</h4>
		<form class="white" action="todo.php" method="POST">
			<label></label>
			<input type="text" name="title" placeholder="This field is required" value="<?php echo $title; ?>">
            <div class="red-text"><?php echo $titleErr ?></div>
			<div class="center brand-text">
                <input type="hidden" name="idToEdit" value="<?php echo $todos['id']; ?>">
	            <input type="submit" name="submit" value="Update" class="btn">
			</div>
		</form>
	</section>

</html>
<?php

    require('config/dbConnect.php');
    // include('todo.php');
   
    $sql = "SELECT * FROM todo";
    $result = mysqli_query($conn, $sql);
    $todos = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $rev = array_reverse($todos);

    $title = '';
    $id = 0;
    $errors = array('title' => '');
    

    if(isset($_POST['submit'])) {
        //check title
        if(empty($_POST['title'])){
            $errors['title'] = 'A title is required';
		} else{
			$title = $_POST['title'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
				$errors['title'] = 'Title must be letters and spaces only';
			}
		}

        if(array_filter($errors)){
			//echo 'errors in form';
		} else {

            $title = mysqli_real_escape_string($conn, $_POST['title']);

            $sql = "INSERT INTO todo(title) VALUES('$title')";
            

            if(mysqli_query($conn, $sql)){
                //sucess
                header('Location: index.php');
                $_SESSION['title'] = $_POST['title'];
        
            } else {
                echo 'query error: ' . mysqli_error($conn);
            }

		}
    }


    if(isset($_GET['del'])){
        $id = mysqli_real_escape_string($conn, $_GET['del']);
        $sql = "DELETE FROM todo WHERE id = $id";
        
        if(mysqli_query($conn, $sql)){
            header('Location: index.php');
        }else {
            echo 'query error: ' . mysqli_error($conn);
        }
    }

    if(isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        
        //make sql
        $sql = "SELECT * FROM todo WHERE id = $id";
    
        //get the query result
        $result = mysqli_query($conn, $sql);
    
        //fetch result in array format
        $todos = mysqli_fetch_assoc($result);
        $rev = array_reverse($todos);

        mysqli_free_result($result); 
        mysqli_close($conn);
    }


    mysqli_free_result($result);
    mysqli_close($conn);
?>




<html lang="en">


<?php include('templates/header.php'); ?>

<section class="container grey-text">
		<h4 class="center brand-text">Create To-do List</h4>
		<form class="white" action="index.php" method="POST">
			<label></label>
			<input type="text" name="title" placeholder="This field is required">
			<div class="red-text"><?php echo $errors['title']; ?></div>
			<div class="center">
	            <input type="submit" name="submit" value="Add" class="btn">
			</div>
		</form>
	</section>


    <h4 class="center grey-text">Things To Do</h4>
    <div class="container">
        <div class="row">
            <?php
                foreach($rev as $r){ ?>

                    <div class="col s6 md3">
                        <div class="card">
                            <div class="card-content center">
                                <h6><?php echo htmlspecialchars($r['title']) ?></h6>
                                <p>Created at: <?php echo date($r['created_at']); ?></p>
                            </div>
                                <form action="todo.php" method="POST" class="card-action center">
                                    <a class="btn" href="todo.php?id=<?php echo $r['id'] ?>">Edit</a>
                                    <a class="btn" href="index.php?del=<?php echo $r['id'] ?>">Delete</a>
                                </form>
                        </div>
                    </div>

                <?php  }  ?>

        </div>
    </div>


</html>
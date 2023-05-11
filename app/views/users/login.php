<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css?id=123';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/login.css?id=123';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body>
<?php require_once APPROOT . '/views/users/navbar.php';?>

    <div id="container_main" class="container_main">
        <div id="forms" class="form" style="margin-top: 20vh;">
        <?php 
            flash('register_success');
            flash('login_fail');
            flash('email_message');
            flash('email_err');
            flash('password_message');
            flash('session_expired');
        ?>
            <h1>Login</h1>
            <!-- <?php if(isset($_SESSION['url'])){
                echo $_SESSION['url'];
            }?> -->
            <?php
                if(!empty($data['email_err']) || !empty($data['password_err']) || !empty($data['email_not_activated_err'])  ){
                    echo '<div class="error">';
                        if(!empty($data['email_err'])){
                            echo '*'.$data['email_err'].'<br>';
                        }
                        if(!empty($data['password_err'])){
                            echo '*'.$data['password_err'].'<br>';
                        }
                        if(!empty($data['email_not_activated_err'])){
                            echo '*'.$data['email_not_activated_err'].'<br>';
                        }
                    echo '</div>';
                }
            ?>

            <form action="<?php echo URLROOT . '/users/login';?>" method="post" >
                <div class="input">
                    <label for="">Email</label>
                    <input type="email" name="email" placeholder="Enter email" value="<?php echo $data['email']?>" >
                </div>
                <div class="input">
                    <label for="">Password</label>
                    <input type="password" name="password" placeholder="Enter password" value="<?php echo $data['password']?>" >
                </div>
                <div class="reg_now">
                    <p>Do not have an account?&nbsp&nbsp</p>
                    <a href="<?php echo URLROOT . '/users/register';?>"> Register now</a>
                </div>
                <a onclick="openModal(); return false;"class="forgot">Forgot password</a>
                <div class="submit">
                    <input type="submit" name="submit" value="Login" class="button">
                </div>
            </form>
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <div id="floating-panel">
                    
                    </div>
                    <span class="close" onclick="closeModal()">&times;</span>
                    <form action="<?php echo URLROOT . '/users/enterEmail';?>" method="post" style="margin-top: 2vh;">
                        <div >
                        <div class="input">
                            <label for="">Enter email</label>
                            <input type="email" name="email" placeholder="Enter email"  >
                        </div>
                        </div>
                        <div class="submit">
                            <input type="submit" name="submit" value="Next" class="button">
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

</body>
<script>
    function openModal() {
			var modal = document.getElementById("myModal");
			modal.style.display = "block";
            initMap();
           
    }

    function closeModal() {
			var modal = document.getElementById("myModal");
			modal.style.display = "none";
	}
    // When the user clicks anywhere outside of the modal, close it
	var modal = document.getElementById("myModal");

    window.addEventListener("click", function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    });
</script>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>
<!-- Closing the connection
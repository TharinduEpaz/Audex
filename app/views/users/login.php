<?php require_once APPROOT.'/views/includes/header.php'; ?>
<nav>
    <input type="checkbox" name="check" id="check" onchange="docheck()">
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
    <img src="<?php echo URLROOT . '/public/img/image 1.png';?>" alt="">
    <ul>
        <li><a href="home.php" class="nav_tags">Home</a></li>
        <li><a href="#" class="nav_tags">Shop</a></li>
        <li><a href="#" class="nav_tags">Sound Engineers</a></li>
        <li><a href="#" class="nav_tags">Events</a></li>
        <li><a href="<?php echo URLROOT . '/users/register';?>" class="nav_tags">Sign up</a></li>
    </ul>
</nav>
<div class="container">
    <div id="forms" class="form">
    <?php 
    if(flash('register_success')){
        echo '<div class="alert">';
            flash('register_success');
        echo '</div>';

    }  
        ?>
        <h1>Login</h1>
        <?php
            if(!empty($data['email_err']) || !empty($data['password_err'])  ){
                echo '<div class="error">';
                    if(!empty($data['email_err'])){
                        echo '*'.$data['email_err'].'<br>';
                    }
                    if(!empty($data['password_err'])){
                        echo '*'.$data['password_err'].'<br>';
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
            <a href="register.html" class="forgot">Forgot password</a>
            <div class="submit">
                <input type="submit" name="submit" value="Login" class="button">
            </div>
        </form>
    </div>
</div>
<?php require_once APPROOT.'/views/includes/footer.php'; ?>
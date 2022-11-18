<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sELL_ITEM.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Sell Item</title>
</head>
<body>
    <nav>
        <input type="checkbox" name="check" id="check" onchange="docheck()">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <img src="<?php echo URLROOT . '/public/img/image 1.png';?>" alt="logo">
        <ul>
            <li><a href="home.php" class="nav_tags">Home</a></li>
            <li><a href="#" class="nav_tags">Shop</a></li>
            <li><a href="#" class="nav_tags">Sound Engineers</a></li>
            <li><a href="#" class="nav_tags">Events</a></li>
            <?php if(isset($_SESSION['user_id'])){
                echo '<div class="dropdown">';
                    echo '<button onclick="myFunction()" class="dropbtn">Hi '.$_SESSION['user_name']. ' &nbsp<i class="fa-solid fa-caret-down"></i></button>';
                    echo '<div id="myDropdown" class="dropdown-content">';
                        echo '<a href="'.URLROOT . '/sellers/advertisements" class="nav_tags">Profile</a>';
                        echo '<a href="'.URLROOT . '/users/logout" class="nav_tags">Logout</a>';
                    echo '</div>';
                echo '</div> ';
            }
            else{
                echo '<li><a href="'.URLROOT . '/users/login" class="nav_tags">Login</a></li>';
                echo '<li><a href="'.URLROOT.'/users/register" class="nav_tags">Signup</a></li>';
            }
             ?>
        </ul>
    </nav>
    <div class="container_add">
        <div class="sidebar">
                <a href="#"><i class="fas fa-qrcode"></i> <span>Dashboard</span></a>
                <a href="#"> <i class="fa fa-cog" aria-hidden="true"></i><span>Profile Settings</span></a>
                <a href="<?php echo URLROOT;?>/sellers/advertisements"> <i class="fa fa-ad" aria-hidden="true"></i><span>Advertisements</span></a>
                <a class="current" href="<?php echo URLROOT;?>/sellers/advertise"><i class="fa-solid fa-dollar-sign" aria-hidden="true"></i><span>Sell Item</span></a>
                <a href="#"> <i class="fa fa-comments"></i><span>Messages</span></a>       
        </div>
        <div class="container">
        <div class="advertisement">
            <div class="add">
                <div id="forms" class="form_seller">
                    <form action="sell_item.php" method="post">
                        <div class="input">
                            <label for="">Title&nbsp</label>
                            <input class="title" type="text" name="title"  required>
                        </div>
                        <div class="input">
                            <label for="">Price</label>
                            <input class="price" type="text" name="price"  required>
                        </div>
                        <div class="input">
                            <label for="check_au" >Auction(optional)</label>
                            <input type="checkbox"   name="check_au" id="check_au" >
                            <label class="date" for="date">Ending Date</label>
                            <input class="date" type="date" name="date"  >
                        </div>
                        <div class="input">
                            <div class="image">
                                <label for="image1">Image1:</label>
                                <input type="image" name="image1"  class="fa-solid" alt="&#xf03e" >
                            </div>
                            <div class="image">
                                <label for="image2">Image2:</label>
                                <input type="image" name="image2"  class="fa-solid" alt="&#xf03e">
                            </div>
                            <div class="image">
                                <label for="image3">Image3:</label>
                                <input type="image" name="image3" class="fa-solid " alt="&#xf03e">
                            </div>
                        </div>
                        <div class="input">
                            <label class="condition" for="">Condition</label>
                            <input class="condition" type="text" name="condition"  required>
                        </div>
                        <div class="input">
                            <label class="category" for="category">Catagory&nbsp</label>
                            <select name="category" id="category">
                              <option value="microphone">Microphone</option>
                              <option value="dj">DJ</option>
                              <option value="mixer">Mixer</option>
                              <option value="amplifier">Amplifier</option>                         
                            </select>
                        </div>
                        <div class="input">
                            <label class="descriptionl" for="">Description</label>
                            <input class="description" type="text" name="description"  required>
                        </div>
                        <div class="submit">
                            <input type="submit" name="submit" value="Post" class="post">
                            <a class="cancel" href="<?php echo URLROOT;?>/sellers/advertisements">Cancel</a>

                        </div>
                    </form>
                </div>
            </div>
        </div>

            
        </div>
    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>


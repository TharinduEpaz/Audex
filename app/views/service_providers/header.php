<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css?id=1425';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/service_provider.css?id=25';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/style.css?id=1445';?>">
  

    
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Audex</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- TINY MCE TEXT EDITOR  -->
    <script>
      tinymce.init({
        selector: '#add-post-text',
        plugins: [
          'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
          'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
          'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
        ],
        toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
          'alignleft aligncenter alignright alignjustify | ' +
          'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
      });
    </script>

    <!-- JQUERY LIBRARY -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>
<body>
<div class="navbar">
<nav>
    <input type="checkbox" name="check" id="check" onchange="docheck()">
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
    <div class="switch">
            <a href="<?php echo URLROOT;?>/users/index"><img src="<?php echo URLROOT . '/public/img/image 1.png';?>" alt="logo"></a>
            <?php if(isLoggedIn()){
                    if($_SESSION['user_type']!='seller'){?>
                    <div class="switch_container">
                        <div class="toggle">
                            <!-- <h1>Toggle Switch</h1> -->
                            <label class="toggle_switch">
                                <input type="checkbox" id="example">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="toggle_a">
                            <div>
                            <?php if($_SESSION['user_type']=='service_provider'){?>
                                    <span>Service<br>Provider</span>
                                <?php }else{?>
                                <span><?php echo ucwords($_SESSION['user_type']);?></span>
                                <?php }?>
                            </div>
                            <div>
                                <span>Seller</span>
                            </div>
                        </div>
                        <!-- <span class="toggle_a">Switch <br>to <br>Selling</span> -->

                    </div>
                        <!-- <span class="toggle_a">Switch <br>to <br>Selling</span> -->
                        <!-- <a  href="<?php echo URLROOT;?>/users/switch_user"> switch to <br>selling</a> -->
            <?php }elseif($_SESSION['user_type']=='seller' && $_SESSION['prev_user_type']!=''){ ?>
                        
                        <div class="switch_container">
                        <div class="toggle">
                            <!-- <h1>Toggle Switch</h1> -->
                            <label class="toggle_switch">
                                <input type="checkbox" id="example" checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="toggle_a">
                            <div>
                                <?php if($_SESSION['prev_user_type']=='service_provider'){?>
                                    <span>Service<br>Provider</span>
                                    <?php }else{?>
                                        <span><?php echo ucwords($_SESSION['prev_user_type']);?></span>
                                        <?php }?>
                                    </div>
                                    <div>
                                        <span>Seller</span>
                                    </div>
                        </div>
                        <!-- <span class="toggle_a">Switch <br>to <br>Selling</span> -->

                    </div>
                        <!-- <span class="toggle_a">Switch <br>to <br><?php echo ucwords($_SESSION['prev_user_type']);?></span> -->
                        <!-- <a href="<?php echo URLROOT;?>/users/switch_user"> switch to <?php echo ucwords($_SESSION['prev_user_type']);?></a> -->
            <?php }}?> 
                <script>
                    document.getElementById("example").addEventListener("change", function() {
                      // code to run when checkbox is checked
                      console.log("Checkbox checked!");
                      window.location.href = "<?php echo URLROOT;?>/users/switch_user";
                    });
                </script>
            </div>
    <ul>
        <li><a href="<?php echo URLROOT .'/users/index'?>" class="nav_tags">Home</a></li>
        <li><a href="<?php echo URLROOT.'/users/shop'; ?>" class="nav_tags">Shop</a></li>
        <li><a href="<?php echo URLROOT.'/users/sound_engineers'; ?>" class="nav_tags">Sound Engineers</a></li>
        <li><a href="#" class="nav_tags">Events</a></li>
        <?php if(isset($_SESSION['user_id'])){
                echo '<div class="dropdown">';
                    echo '<button onclick="myFunction()" class="dropbtn">Hi '.$_SESSION['user_name']. ' &nbsp<i class="fa-solid fa-caret-down"></i></button>';
                    echo '<div id="myDropdown" class="dropdown-content">';
                        echo '<a href="'.URLROOT . '/service_providers/profile" class="nav_tags">Profile</a>';
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
</div>
<div class="sidebar">
        <a href="<?php echo URLROOT . '/service_providers/dashboard';?>" id="dashboard"><i class="fas fa-qrcode" ></i> <span>Dashboard</span></a>
        <a href="<?php echo URLROOT . '/service_providers/profile';?>" id="profile-settings"> <i class="fa fa-cog" aria-hidden="true"></i><span>Profile</span></a>
        <a href="<?php echo URLROOT .'/service_providers/feed'?>" id="feed"> <i class="fa fa-ad" aria-hidden="true"></i><span>Feed</span></a>
        <a href="<?php echo URLROOT .'/service_providers/eventCalander?month=current'?>" id="calender"> <i class="fa fa-calendar" aria-hidden="true"></i><span>Calender</span></a>
        <a href="<?php echo URLROOT .'/users/chat'?>" id="messages"> <i class="fa fa-comments"></i><span>Messages</span></a>       
</div>
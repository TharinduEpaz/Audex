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
            <li><a href="<?php echo URLROOT;?>/users/index" class="nav_tags">Home</a></li>
            <li><a href="<?php echo URLROOT.'/users/shop'; ?>" class="nav_tags">Shop</a></li>
            <li><a href="<?php echo URLROOT.'/users/sound_engineers'; ?>" class="nav_tags">Sound Engineers</a></li>
            <li><a href="#" class="nav_tags">Events</a></li>
            <li><a href="<?php echo URLROOT.'/users/sound_engineers'; ?>" class="nav_tags">Event Calendar</a></li>
            <?php if(isset($_SESSION['user_id'])){
                echo '<div class="dropdown">';
                echo '<button onclick="myFunction()" class="dropbtn">Hi '.$_SESSION['user_name']. ' &nbsp<i class="fa-solid fa-caret-down"></i></button>';
                echo '<div id="myDropdown" class="dropdown-content">';
                    echo '<a href="'.URLROOT . '/admins/profiletest/'.$_SESSION['user_id'].'" class="nav_tags">Profile</a>';
                    echo '<a href="#" class="nav_tags">Dashboard</a>';
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
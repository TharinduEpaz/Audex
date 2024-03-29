<?php if(!isset($_SESSION['user_id'])){?> 
<style>
    @media (max-width: 862px){
        nav ul{
          height: 61vh;
        }
    }
</style>
<?php } ?>

<nav>
        <input type="checkbox" name="check" id="check" onchange="docheck()">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <div class="switch">
            <a href="<?php echo URLROOT;?>/users/index"><img src="<?php echo URLROOT . '/public/img/image 1.png';?>" alt="logo"></a>
        <?php if(isLoggedIn() && $_SESSION['user_type']!='admin'){
                    if($_SESSION['user_type']!='seller'  && $_SESSION['user_type']!='admin'){?>
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
            <li><a href="<?php echo URLROOT.'/users/index'; ?>" class="nav_tags">Home</a></li>
            <li><a href="<?php echo URLROOT.'/users/shop'; ?>" class="nav_tags">Shop</a></li>
            <li><a href="<?php echo URLROOT.'/users/sound_engineers'; ?>" class="nav_tags">Sound Engineers</a></li>
            <!-- <li><a href="<?php echo URLROOT.'/users/eventCalendar'; ?>" class="nav_tags">Events</a></li> -->
            <li><a href="<?php echo URLROOT.'/users/events'; ?>" class="nav_tags">Events</a></li>
            <?php if(isset($_SESSION['user_id'])){
                echo '<div class="dropdown">';
                echo '<button onclick="myFunction()" class="dropbtn">Hi '.$_SESSION['user_name']. ' &nbsp<i class="fa-solid fa-caret-down"></i></button>';
                echo '<div id="myDropdown" class="dropdown-content">';
                    // echo '<a href="'.URLROOT . '/'.$_SESSION['user_type'].'s/dashboard" class="nav_tags">Dashboard</a>';
                    if($_SESSION['user_type']=='service_provider'){
                    echo '<a href="'.URLROOT . '/service_providers/profile/'.$_SESSION['user_id'].'" class="nav_tags">Profile</a>';
                    echo '<a href="'.URLROOT . '/service_providers/dashboard" id="dashboard"><span>Dashboard</span></a>';
                    // echo '<a href="'.URLROOT . '/service_providers/profile" id="profile-settings"> <i class="fa fa-cog" aria-hidden="true"></i><span>Profile</span></a>';
                    echo '<a href="'.URLROOT .'/service_providers/feed" id="feed"><span>Feed</span></a>';
                    echo '<a href="'.URLROOT .'/service_providers/eventCalander?month=current" id="calender"> <span>Calender</span></a>';
                    echo '<a href="'.URLROOT .'/users/chat" id="messages"> <span>Messages</span></a>';

                    }else if($_SESSION['user_type']=='buyer'){
                        echo '<a href="'.URLROOT . '/buyers/getProfile/'.$_SESSION['user_id'].'" class="nav_tags">Profile</a>';
                        echo '<a href="'.URLROOT . '/buyers/watchlist" class="nav_tags">Watchlist</a>';
                        echo '<a href=" '.URLROOT . '/buyers/feedback " class="nav_tags">Feedback</a>';
                        echo '<a href="'.URLROOT . '/buyers/reactions" class="nav_tags">Reactions</a>';
                        echo '<a href="'.URLROOT . '/users/chat" class="nav_tags">Messages</a>';}
                    else if($_SESSION['user_type']=='admin'){
                            echo '<a href="'.URLROOT . '/admins/profiletest/'.$_SESSION['user_id'].'" class="nav_tags">Profile</a>';
                            echo '<a href="'.URLROOT . '/admins/admindashboard" class="nav_tags">Dashboard</a>';
                            echo '<a href="'.URLROOT . '/admins/manageuser" class="nav_tags">Manage Users</a>';
                            echo '<a href="'.URLROOT . '/admins/reports" class="nav_tags">Reports</a>';
                            echo '<a href="'.URLROOT . '/admins/approval" class="nav_tags">Approvals</a>';
                            
                    }else if($_SESSION['user_type']=='seller'){
                        echo '<a href="'.URLROOT . '/sellers/dashboard" class="nav_tags">Dashboard</a>';
                        echo '<a href="'.URLROOT . '/'.$_SESSION['user_type'].'s/getProfile/'.$_SESSION['user_id'].'" class="nav_tags">Profile</a>';
                        echo '<a href="'.URLROOT . '/sellers/advertisements" class="nav_tags">Advertisements</a>';
                        echo '<a href="'.URLROOT . '/sellers/advertise" class="nav_tags">Advertise</a>';
                        echo '<a href="'.URLROOT . '/users/chat" class="nav_tags">Messages</a>';
                    }
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
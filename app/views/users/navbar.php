<nav>
        <input type="checkbox" name="check" id="check" onchange="docheck()">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <a href="<?php echo URLROOT;?>/users/index"><img src="<?php echo URLROOT . '/public/img/image 1.png';?>" alt="logo"></a>
        <ul>
            <!-- <li><a href="<?php echo URLROOT;?>/pages/index" class="nav_tags">Home</a></li> -->
            <?php 
                    echo '<li><a href="'.URLROOT.'/'.'users/index" class="nav_tags">Home</a></li>';
                
             ?>
            <li><a href="<?php echo URLROOT.'/users/shop'; ?>" class="nav_tags">Shop</a></li>
            <li><a href="<?php echo URLROOT.'/users/sound_engineers'; ?>" class="nav_tags">Sound Engineers</a></li>
            <li><a href="<?php echo URLROOT.'/users/eventCalendar'; ?>" class="nav_tags">Events</a></li>
            <?php if(isset($_SESSION['user_id'])){
                echo '<div class="dropdown">';
                echo '<button onclick="myFunction()" class="dropbtn">Hi '.$_SESSION['user_name']. ' &nbsp<i class="fa-solid fa-caret-down"></i></button>';
                echo '<div id="myDropdown" class="dropdown-content">';
                    // echo '<a href="'.URLROOT . '/'.$_SESSION['user_type'].'s/dashboard" class="nav_tags">Dashboard</a>';
                    if($_SESSION['user_type']=='service_provider'){
                    echo '<a href="'.URLROOT . '/service_providers/profile/'.$_SESSION['user_id'].'" class="nav_tags">Profile</a>';

                    }else if($_SESSION['user_type']=='buyer'){
                        echo '<a href="'.URLROOT . '/buyers/getProfile/'.$_SESSION['user_id'].'" class="nav_tags">Profile</a>';
                        echo '<a href="'.URLROOT . '/'.$_SESSION['user_type'].'s/watchlist/'.$_SESSION['user_id'].'" class="nav_tags">Watchlist</a>';
                        echo '<a href="#" class="nav_tags">Feedback</a>';
                        echo '<a href="#" class="nav_tags">Reactions</a>';
                        echo '<a href="#" class="nav_tags">Messages</a>';
                    }else if($_SESSION['user_type']=='seller'){
                        echo '<a href="'.URLROOT . '/sellers/dashboard" class="nav_tags">Dashboard</a>';
                        echo '<a href="'.URLROOT . '/'.$_SESSION['user_type'].'s/getProfile/'.$_SESSION['user_id'].'" class="nav_tags">Profile</a>';
                        echo '<a href="'.URLROOT . '/sellers/advertisements" class="nav_tags">Advertisements</a>';
                        echo '<a href="'.URLROOT . '/sellers/advertise" class="nav_tags">Advertise</a>';
                        echo '<a href="#" class="nav_tags">Messages</a>';
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
<?php require_once APPROOT.'/views/includes/header.php'; ?>
<nav>
    <input type="checkbox" name="check" id="check" onchange="docheck()">
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
    <img src="<?php echo URLROOT . '/public/img/image 1.png';?>" alt="logo">
    <ul>
        <li><a href="#" class="nav_tags">Home</a></li>
        <li><a href="<?php echo URLROOT . '/buyers/index';?>" class="nav_tags">Shop</a></li>
        <li><a href="#" class="nav_tags">Sound Engineers</a></li>
        <li><a href="#" class="nav_tags">Events</a></li>
        <?php if(isset($_SESSION['user_id'])){
            echo '<div class="dropdown">';
                echo '<button onclick="myFunction()" class="dropbtn">Hi '.$_SESSION['user_name']. ' &nbsp<i class="fa-solid fa-caret-down"></i></button>';
                echo '<div id="myDropdown" class="dropdown-content">';
                    if ($_SESSION['user_type']=='seller') {
                        echo '<a href="'.URLROOT . '/sellers/advertisements" class="nav_tags">Profile</a>';
                    }
                    if ($_SESSION['user_type']=='buyer') {
                        echo '<a href="'.URLROOT . '/buyers/getProfile" class="nav_tags">Profile</a>';
                    }
                    if ($_SESSION['user_type']=='service_provider') {
                        echo '<a href="'.URLROOT . '/buyers" class="nav_tags">Profile</a>';
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
<div class="container">
    <div class="search">
        <div class="heading">
            <h1>Find the best <br>Audio Equipment</h1>
        </div>
        <div class="search-bar">
            <input type="search" name="search-item" placeholder="|">
            <button type="button" class="btn-search"><img src="<?php echo URLROOT . '/public/img/icons/bxs_search-alt-2.png';?>" alt="search"></input></button>
        </div>
    </div>
        <div class="explore">
            <div class="explore-line">
                <h3>Explore Popular Categories</h3>
            </div>
            <div class="explore-btn">
                <button><img src="<?php echo URLROOT . '/public/img/icons/bi_speaker.png';?>" alt="sp"></button>
                <button><img src="<?php echo URLROOT . '/public/img/icons/bxs_guitar-amp.png';?>" alt="am"></button>
                <button><img src="<?php echo URLROOT . '/public/img/icons/nimbus_guitar.png';?>" alt="gu"></button>
                <button><img src="<?php echo URLROOT . '/public/img/icons/jam_dj.png';?>" alt="dj"></button>
                <button><img src="<?php echo URLROOT . '/public/img/icons/Group.png';?>" alt="grp"></button>
            </div>
        </div>
    </div>
</div>
<?php require_once APPROOT.'/views/includes/footer.php'; ?>
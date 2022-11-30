<?php require_once APPROOT.'/views/includes/header.php'; ?>
<style>
    body{
        background-image: none;
        background-color: rgb(214, 214, 239);
    }
</style> 
<nav>
    <input type="checkbox" name="check" id="check" onchange="docheck()">
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
    <img src="<?php echo URLROOT . '/public/img/image 1.png';?>" alt="logo">
    <ul>
        <li><a href="#" class="nav_tags">Home</a></li>
        <li><a href="#" class="nav_tags">Shop</a></li>
        <li><a href="#" class="nav_tags">Sound Engineers</a></li>
        <li><a href="#" class="nav_tags">Events</a></li>
        <?php if(isset($_SESSION['user_id'])){
            echo '<div class="dropdown">';
                echo '<button onclick="myFunction()" class="dropbtn">Hi '.$_SESSION['user_name']. ' &nbsp<i class="fa-solid fa-caret-down"></i></button>';
                echo '<div id="myDropdown" class="dropdown-content">';
                    echo '<a href="'.URLROOT . '/buyers/getProfile/'.$_SESSION['user_id'].'" class="nav_tags">Profile</a>';
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
    <div class="header">
        <h1>New Arrivals</h1>
    </div>
    <div class="container-data">
        <?php foreach($data['ads'] as $ads) : ?>
            <div class="container-ad">
                <div class="container-img">
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($ads->img); ?>" /> 
                </div>
                <div class="title">
                    <a href="<?php echo URLROOT . '/buyers/advertiesmentDetails/'.$ads->product_id;?>">
                    <h4><?php echo $ads->product_title ; ?></h4></a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="header">
        <h1>Popular Engineers</h1>
    </div>
</div>
<?php require_once APPROOT.'/views/includes/footer.php'; ?>
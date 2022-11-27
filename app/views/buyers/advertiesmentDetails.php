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

<div class="container">
    <div class="ad-search" >
        <input type="search" name="search"> 
        <a href="#"><button type="submit" value="search" name="submit">Search</button></a>
    </div>
    <div class="container-main">
        <div class="container-product-img">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($data['ad']->img); ?>" />
            <div class="container-product-description">
                <h4>Product Description</h4>
                <?php echo $data['ad']->p_description ; ?>
            </div>
        </div>
        <div class="container-product-attributes">
            <div class="title">
                <h3><?php echo $data['ad']->product_title ; ?></h3>
            </div>
            <div class="category">
                <h4><?php echo $data['ad']->product_category ; ?></h4>
            </div>
            <div class="condition">
                <h4><?php echo $data['ad']->product_condition ; ?></h4>
            </div>
            <div class="brand">
                <h4><?php echo $data['ad']->brand ; ?></h4>
            </div>            
            <div class="price">
                <button ><?php echo 'RS.'.$data['ad']->price ; ?></button>
            </div>
            <button type="submit" class="msg">Message</button>
            <button type="submit" class="watch">Add To Watchlist</button>
        </div>
    </div>
</div>
<?php require_once APPROOT.'/views/includes/footer.php'; ?>
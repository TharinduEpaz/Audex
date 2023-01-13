<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/main.css'; ?>">
    

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>
        <?php echo SITENAME; ?>
    </title>
</head>

<body>
    <nav>
        <input type="checkbox" name="check" id="check" onchange="docheck()">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <img src="<?php echo URLROOT . '/public/img/image 1.png'; ?>" alt="logo">
        <ul>
            <li><a href="<?php echo URLROOT; ?>/buyers/index" class="nav_tags">Home</a></li>
            <li><a href="#" class="nav_tags">Shop</a></li>
            <li><a href="#" class="nav_tags">Sound Engineers</a></li>
            <li><a href="#" class="nav_tags">Events</a></li>
            <?php if (isset($_SESSION['user_id'])) {
                echo '<div class="dropdown">';
                echo '<button onclick="myFunction()" class="dropbtn">Hi ' . $_SESSION['user_name'] . ' &nbsp<i class="fa-solid fa-caret-down"></i></button>';
                echo '<div id="myDropdown" class="dropdown-content">';
                echo '<a href="' . URLROOT . '/' . $_SESSION['user_type'] . 's/getProfile/' . $_SESSION['user_id'] . '" class="nav_tags">Profile</a>';
                echo '<a href="' . URLROOT . '/' . $_SESSION['user_type'] . 's/watchlist/' . $_SESSION['user_id'] . '" class="nav_tags">Watchlist</a>';
                echo '<a href="#" class="nav_tags">Feedback</a>';
                echo '<a href="#" class="nav_tags">Reactions</a>';
                echo '<a href="#" class="nav_tags">Messages</a>';
                echo '<a href="' . URLROOT . '/users/logout" class="nav_tags">Logout</a>';
                echo '</div>';
                echo '</div> ';
            } else {
                echo '<li><a href="' . URLROOT . '/users/login" class="nav_tags">Login</a></li>';
                echo '<li><a href="' . URLROOT . '/users/register" class="nav_tags">Signup</a></li>';
            }
            ?>

        </ul>
    </nav>
    <div class="sidebar">
        <ol>
            <li>Price</li>
            <li>
                <ul type="none">
                    <li>Min</li>
                    <li>Max</li>
                </ul>
            </li>
            <li>Category</li>
            <li>Location</li>
            <li>Condition</li>
        </ol>       
    </div>

    <div class="container">
        <div class="search-container">
            <input type="search" name="search" placeholder="Search for anything">
            <a href="#"><button type="submit" value="search" name="submit">Search</button></a>
        </div>


</body>
<script src="<?php echo URLROOT . '/public/js/form.js'; ?>"></script>

</html>
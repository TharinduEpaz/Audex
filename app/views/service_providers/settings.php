<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css?id=1234';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/service_provider.css?id=1234';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/style.css?id=1234';?>">


    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Audex</title>
</head>

<body>

    <nav>
        <input type="checkbox" name="check" id="check" onchange="docheck()">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <img src="../img/image 1.png" alt="">
        <ul>
            <li><a href="#" class="nav_tags">Home</a></li>
            <li><a href="#" class="nav_tags">Shop</a></li>
            <li><a href="#" class="nav_tags">Sound Engineers</a></li>
            <li><a href="#" class="nav_tags">Events</a></li>
            <li><a href="#" class="nav_tags">Login</a></li>
        </ul>
    </nav>
    <div class="sidebar">
        <a href="#"><i class="fas fa-qrcode" id="dashboard"></i> <span>Dashboard</span></a>
        <a href="<?php echo URLROOT . '/service_providers/profile';?>" id="profile-settings"> <i class="fa fa-cog" aria-hidden="true"></i><span>Profile</span></a>
        <a href="#" id="advertisements"> <i class="fa fa-ad" aria-hidden="true"></i><span>Advertisements</span></a>
        <a href="#" id="calender"> <i class="fa fa-calendar" aria-hidden="true"></i><span>Calender</span></a>
        <a href="#" id="messages"> <i class="fa fa-comments"></i><span>Messages</span></a>
    </div>

    <div class="service-provider-profile">
        <div class="white-box">
            <h1>Edit Profile</h1>
            <div class="info-settings">

                <div class="info-titles">
                    <span>First Name : </span>
                    <span>Last Name : </span>
                    <span>Address Line 1 : </span>
                    <span>Address Line 2 : </span>
                    <span>Mobile : </span>
                    <span>Profession : </span>
                    <span>Qualifications : </span>
                    <span>Achivements : </span>
                    <span>Edit Description : </span>
                </div>
                <div class="info-items">
                    <form action= "<?php echo URLROOT . '/service_providers/setDetails/' ?>" method="post">
                         <input type="text" name="first-name"  placeholder="<?php echo $data['details']->first_name?>">
                        <input type="text" name="last-name" placeholder="<?php echo $data['details']->second_name?>">
                        <input type="text" name="address1" placeholder="<?php echo $data['details']->address_line_one?>">
                       <input type="text" name="address2" placeholder="<?php echo $data['details']->address_line_two?>">
                        <input type="number" name="mobile" placeholder="<?php echo $data['details']->mobile?>" disabled>
                        <input type="text" name="profession" placeholder="<?php echo $data['details']->profession?>">
                        <input type="text" name="qualifications" placeholder="<?php echo $data['details']->qualifications?>">
                        <input type="text" name="achievements" placeholder="<?php echo $data['details']->achievements?>">
                        <textarea name="description" cols="30" rows="10" placeholder="<?php echo $data['details']->description?>"></textarea>
                        <section class="buttons">
          
                        <button id="save" type="submit">Save</button>
                        <button id="cancel" type="reset">Cancel</button>
                    </section>
          </div>
                    </form>
                </div>
                <div class="profile-pic-settings">
                    <img src="profile.jpg" alt="">
                    <p>Edit Profile Image</p>
                    <input type="file" name="Edit" id="" placeholder="Edit Image">
                </div>
            </div>

         
    

    </div>

    <script>
        //keeping the sidebar button clicked at the page

        link = document.querySelector('#profile-settings');
        link.style.background = "#E5E9F7";
        link.style.color = "red";

    </script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css?id=1425'; ?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/service_provider.css?id=325'; ?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/style.css?id=1445'; ?>">




    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Audex</title>
    <style>
        .service-provider-profile {
            margin: auto;
            padding-left: 10vw;
            padding-right: 10vw;
        }

        .white-box {
            margin: 0;

        }
    </style>
</head>

<body>
    <?php require_once APPROOT . '/views/users/navbar.php'; ?>

    <!-- <div class="navbar">
        <nav>
            <input type="checkbox" name="check" id="check" onchange="docheck()">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>
            <img src="<?php echo URLROOT . '/public/img/image 1.png'; ?>" alt="">
            <ul>
            <li><a href="<?php echo URLROOT; ?>/users/index" class="nav_tags">Home</a></li>
            <li><a href="<?php echo URLROOT . '/users/shop'; ?>" class="nav_tags">Shop</a></li>
            <li><a href="<?php echo URLROOT . '/users/sound_engineers'; ?>" class="nav_tags">Sound Engineers</a></li>
            <li><a href="#" class="nav_tags">Events</a></li>
            <li><a href="<?php echo URLROOT . '/users/sound_engineers'; ?>" class="nav_tags">Event Calendar</a></li>


                <li><a href="#" class="nav_tags">Events</a></li>
                <?php if (isset($_SESSION['user_id'])) {
                    echo '<div class="dropdown">';
                    echo '<button onclick="myFunction()" class="dropbtn">Hi ' . $_SESSION['user_name'] . ' &nbsp<i class="fa-solid fa-caret-down"></i></button>';
                    echo '<div id="myDropdown" class="dropdown-content">';
                    echo '<a href="' . URLROOT . '/service_providers/profile" class="nav_tags">Profile</a>';
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
    </div> -->

    <div class="service-provider-profile">
        <div class="white-box">
            <h1 style="text-align:center;font-weight:200;">Public Events on AUDEX</h1>
        <div class="profile-events" style="margin:0;justify-content:center;">
                    <?php foreach ($data['events'] as $event) : ?>
                        <div class="event-display" style="width:20vw;">
                       

                        
                            <img src="<?php echo URLROOT . '/public/uploads/' . $event->image; ?>" alt="">
                            <div class="overlay" data-event-target="#event" class="text" onclick="loadevent(<?php echo $event->event_id ?>)">
                                <div data-event-target="#event" class="text" style="font-size:20px;font-weight:600"><?php echo $event->name ?></div>
                            </div>
                        </div>
                        
                    <?php endforeach; ?>
                </div>

    </div>
    <div class="event" id="event">
    <div class="event-left">
        <div class="event-header">
            <div class="title"></div>
            <div class="event-date"></div>
            <div class="event-time"></div>

            <button data-close-button class="close-button">&times;</button>

        </div>
        <div class="wrapper-for-event">
            <div class="event-publisher">
                <div class="event-owenr-image">
                    <img src="" alt="">
                </div>
                <span class="owner-name">John Doe</span>
            </div>
            <div class="event-buttons">
                <button class="like-button" data-id="<?php ?>"><i class="fas fa-thumbs-up"></i>&nbsp&nbsp<span id="likes"></span></button>
                <!-- <button class="dislike-button"><i class="fas fa-thumbs-down"></i>&nbsp&nbsp<span id="dislikes"></span></button> -->
            </div>

        </div>
        <div class="event-body">
        </div>

        <button class="add-event-btn" id="edit-delete-event" onclick="">Edit / Delete Event</button>

    </div>


    <div class="event-right">
        <img src="" alt="" id="event-img">
    </div>

</div>

<div id="overlay"></div>






    <script>
        //keeping the sidebar button clicked at the page


//other functions for loading pages

function gotoSettings() {
    window.open('http://localhost/Audex/service_providers/settings', '_self');

}

function addMoreEvents() {
    window.open('http://localhost/Audex/service_providers/eventCalander?month=current', '_self')
}

function editEvent(id) {

    window.open(`http://localhost/Audex/service_providers/editEvent?id=${id}`, '_self')
}

function addMorePosts() {
    window.open('http://localhost/Audex/service_providers/addNewPost', '_self')
}

function openPost(id){
    window.location.href = 'http://localhost/Audex/service_providers/feedPost?id='+id;
}


const openEventButtons = document.querySelectorAll("[data-event-target]");
const closeEventButtons = document.querySelectorAll("[data-close-button]");
const overlay = document.getElementById("overlay");
console.log(openEventButtons);
console.log(closeEventButtons);

openEventButtons.forEach((button) => {
  button.addEventListener("click", () => {
    const event = document.querySelector(button.dataset.eventTarget);
    openEvent(event);
  });
});

closeEventButtons.forEach((button) => {
  button.addEventListener("click", () => {
    const event = button.closest(".event");
    closeEvent(event);
  });
});

overlay.addEventListener("click", () => {
  const events = document.querySelectorAll(".event.active");
  events.forEach((event) => {
    closeEvent(event);
  });
});

function openEvent(event) {
  if (event == null) {
    console.log("null");
    return;
  }
  event.classList.add("active");
  overlay.classList.add("active");
}

function closeEvent(event) {
  if (event == null) return;
  event.classList.remove("active");
  overlay.classList.remove("active");
}



//////////////////////////////////////////////////////////
//////// LOAD EVENT USING AJAX //////////
//////////////////////////////////////////////////////////

function loadevent(event_id) {
    
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var event = JSON.parse(this.responseText);
        console.log(event);
        
        document.querySelector('#edit-delete-event').setAttribute('onclick', `editDeleteEvent(${event.event.event_id})`);
        
        document.querySelector(".event-date").innerHTML = '<i class="fa fa-calendar" aria-hidden="true"></i>  &nbsp  ' + event.event.date + '<br>';
        document.querySelector(".event-time").innerHTML = '<i class="fa fa-clock-o" aria-hidden="true"></i>  &nbsp   ' + event.event.time;
        document.querySelector(".title").innerHTML = event.event.name;
        document.querySelector(".event-body").innerHTML = event.event.description;
        document.querySelector(
          ".owner-name"
        ).innerHTML = `${event.name.first_name} ${event.name.second_name}`;
        document.querySelector("#likes").innerHTML = event.event.likes;
        // document.querySelector("#dislikes").innerHTML = event.event.dislikes;
        document.querySelector(
          "#event-img"
        ).src = `http://localhost/Audex/public/uploads/${event.event.image}`;
      }
    };
  
    xhttp.open(
      "GET",
      "http://localhost/Audex/users/getEvent?id=" + event_id,
      true
    );
  
    xhttp.send();

    like_button = document.querySelector(".like-button");
    // dislike_button = document.querySelector(".dislike-button");
    
    like_button.addEventListener("click", () => {
       var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function () {
              if (this.readyState == 4 && this.status == 200) {
                  var res = JSON.parse(this.responseText);
                  console.log(this.responseText); 
                  document.querySelector("#likes").innerHTML = res.reactions.likes;
                  like_button.disabled = true;
                  // document.querySelector("#dislikes").innerHTML = event.event.dislikes;
              }
              } 
          xhttp.open("GET", "http://localhost/Audex/service_providers/likeDislike?id=" + event_id + '&type=like', true);
          xhttp.send();
  
    });
  



    }
  </script>
        
    <script src="<?php echo URLROOT . '/public/js/form.js'; ?>"></script>
    

</body>

</html>
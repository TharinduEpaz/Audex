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

//show event js code

const addEventButtons = document.querySelectorAll("[data-add-event]");

addEventButtons.forEach((button) => {
  button.addEventListener("click", () => {
    const event = document.querySelector(button.dataset.addEvent);
    eventDate = button.parentElement.firstChild.innerText; //this date will be used later in the add event function to add the event to the perticular date
    addEventDisplay(event);
  });
});

function addEventDisplay(event) {
  if (event == null) {
    console.log("null");
    return;
  }
  event.classList.add("active");
  overlay.classList.add("active");
}

overlay.addEventListener("click", () => {
  const events = document.querySelectorAll(".add-event.active");
  events.forEach((event) => {
    closeEventDisplay(event);
  });
});

function closeEventDisplay(event) {
  if (event == null) return;
  event.classList.remove("active");
  overlay.classList.remove("active");
  document.getElementById("add-event-form").reset(); //reset the form after closing the pop up
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
      
      
      document.querySelector(".date").innerHTML = '<i class="fa fa-calendar" aria-hidden="true"></i>  &nbsp  ' + event.event.date;
      document.querySelector(".time").innerHTML = '<i class="fa fa-clock-o" aria-hidden="true"></i>  &nbsp   ' + event.event.time;
      document.querySelector(".title").innerHTML = event.event.name;
      document.querySelector(".event-body").innerHTML = event.event.description;
      document.querySelector(
        ".owner-name"
      ).innerHTML = `${event.name.first_name} ${event.name.second_name}`;
      document.querySelector("#likes").innerHTML = event.event.likes;
      document.querySelector("#dislikes").innerHTML = event.event.dislikes;
      document.querySelector(
        "#event-img"
      ).src = `http://localhost/Audex/public/uploads/events/${event.event.image}`;
    }
  };

  xhttp.open(
    "GET",
    "http://localhost/Audex/users/getEvent?id=" + event_id,
    true
  );

  xhttp.send();

  //set the date to today

  let eventForm = document.querySelector("#eventForm");

  like_button = document.querySelector(".like-button");
  dislike_button = document.querySelector(".dislike-button");
  
  like_button.addEventListener("click", () => {
     var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var res = JSON.parse(this.responseText);
                // console.log(this.responseText); 
                document.querySelector("#likes").innerHTML = res.reactions.likes;
                like_button.disabled = true;
                // document.querySelector("#dislikes").innerHTML = event.event.dislikes;
            }
            } 
        xhttp.open("GET", "http://localhost/Audex/service_providers/likeDislike?id=" + event_id + '&type=like', true);
        xhttp.send();

  });
  dislike_button.addEventListener("click", () => {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var res = JSON.parse(this.responseText);
            // console.log(this.responseText); 
            document.querySelector("#dislikes").innerHTML = res.reactions.dislikes;
            dislike_button.disabled = true;
            
        }
        } 
    xhttp.open("GET", "http://localhost/Audex/service_providers/likeDislike?id=" + event_id + '&type=dislike', true);
    xhttp.send();
    
  });
}



//////////////////////////////////////////////////////////
//////// SUBMIT THE ADD EVENT FORM USING JQUERY //////////
//////////////////////////////////////////////////////////

let eventYear = document.querySelector(".month-display").innerText;

$(document).ready(function () {
  // Listen for form submit event
  $("#add-event-form").submit(function (event) {
    // Prevent default form submission
    event.preventDefault();
    console.log("form submitted");

    // Serialize form data
    //   var formData = $(this).serialize();
    var formData = new FormData(this);

    //get the date
    let date = eventDate + " " + eventYear;

    // Send AJAX request

    $.ajax({
      type: "POST",
      url: `http://localhost/Audex/service_providers/addEvent?date=${date}`, // URL of PHP file
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        // Handle success response
   
        window.location.href =
          "http://localhost/Audex/service_providers/eventCalander";
      },
      error: function (jqXHR, textStatus, errorThrown) {
        // Handle error response
        console.error(textStatus, errorThrown);
      },
    });
  });
});



    


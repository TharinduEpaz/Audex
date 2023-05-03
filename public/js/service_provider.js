const openEventButtons = document.querySelectorAll('[data-event-target]')
const closeEventButtons = document.querySelectorAll('[data-close-button]')
const overlay = document.getElementById('overlay')


openEventButtons.forEach(button => {
    button.addEventListener('click',() => {
        const event = document.querySelector(button.dataset.eventTarget)
        openEvent(event)
    })
});

closeEventButtons.forEach(button => {
    button.addEventListener('click', () => {
        const event = button.closest('.event')
        closeEvent(event)
    })
});

overlay.addEventListener('click', () =>{
    const events = document.querySelectorAll('.event.active')
    events.forEach( event => {
        closeEvent(event);
    })
})

function openEvent(event){
    if(event == null){ console.log('null'); return}
    event.classList.add('active');
    overlay.classList.add('active');
}

function closeEvent(event){
    if(event == null) return
    event.classList.remove('active');
    overlay.classList.remove('active');
}

//add event pop up js code


const addEventButtons = document.querySelectorAll('[data-add-event]')




addEventButtons.forEach(button => {
    
    button.addEventListener('click',() => {
        const event = document.querySelector(button.dataset.addEvent)
        eventDate = button.parentElement.firstChild.innerText;
        addEventDisplay(event)
    })
});

function addEventDisplay(event){
    if(event == null){ console.log('null'); return}
    event.classList.add('active');
    overlay.classList.add('active');
    
}

overlay.addEventListener('click', () =>{
    const events = document.querySelectorAll('.add-event.active')
    events.forEach( event => {
        closeEventDisplay(event);
    })
})

function closeEventDisplay(event){
    if(event == null) return
    event.classList.remove('active');
    overlay.classList.remove('active');
    document.getElementById("add-event-form").reset(); //reset the form after closing the pop up
}


//////////////////////////////////////////////////////////
//////// SUBMIT THE ADD EVENT FORM USING JQUERY //////////
//////////////////////////////////////////////////////////

let eventYear = document.querySelector('.month-display').innerText;


$(document).ready(function() {
    // Listen for form submit event
    $('#add-event-form').submit(function(event) {

      // Prevent default form submission
      event.preventDefault();
        console.log('form submitted');
  
      // Serialize form data
    //   var formData = $(this).serialize();
      var formData = new FormData(this);
        
      //get the date
      let date  = eventDate + " " + eventYear;
      console.log(formData)
      // Send AJAX request

      $.ajax({
        type: 'POST',
        url: `http://localhost/Audex/service_providers/addEvent?date=${date}`, // URL of PHP file
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          // Handle success response
          console.log(response);
          //window.location.href = 'http://localhost/Audex/service_providers/eventCalander'
        },
        error: function(jqXHR, textStatus, errorThrown) {
          // Handle error response
          console.error(textStatus, errorThrown);
        }
      });
      
      
    });
  });

// const form = document.forms.namedItem("add-event");
// form.addEventListener(
//   "submit",
//   (event) => {
//     const output = document.querySelector("#output");
//     const formData = new FormData(form);
//     console.log(formData);
//     // formData.append("CustomField", "This is some extra data");

//     const request = new XMLHttpRequest();
//     request.open("POST",`http://localhost/Audex/service_providers/addEvent?date=${date}`, true);

//     // request.onload = (progress) => {
//     //   output.innerHTML =
//     //     request.status === 200
//     //       ? "Uploaded!"
//     //       : `Error ${request.status} occurred when trying to upload your file.<br />`;
//     // };

//     request.send(formData);
//     event.preventDefault();
//   },
//   false
<<<<<<< HEAD
// );


//////////////////////////////////////////////////////////
//////// EVENT LISTNERS FOR THE SERVICE PROVIDER PROFILE /
//////////////////////////////////////////////////////////

=======
// );
>>>>>>> d00d131a1cb95d7cc77576e211e727c845f3d554

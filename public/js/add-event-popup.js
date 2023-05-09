
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
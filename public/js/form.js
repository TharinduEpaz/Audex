
// function docheck() {
//     if (document.getElementById("check").checked) {
//         document.getElementById("forms").style.zIndex = "-1";
//         document.getElementById("forms").style.transition = "all -1.5s";
//         document.getElementById("explore").style.zIndex = "-1";
//         document.getElementById("explore").style.transition = "all -1.5s";
//         document.getElementById("search").style.zIndex = "-1";
//         document.getElementById("search").style.transition = "all -1.5s";
//         document.getElementById("container_main").style.zIndex = "-1";
//         document.getElementById("container_main").style.transition = "all 1.5s";

//     } else {
//         document.getElementById("forms").style.zIndex = "1";
//         document.getElementById("forms").style.transition = "all 1.5s";
//         document.getElementById("explore").style.zIndex = "1";
//         document.getElementById("explore").style.transition = "all 1.5s";
//         document.getElementById("search").style.zIndex = "1";
//         document.getElementById("search").style.transition = "all 1.5s";
//     }
// }
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }
    
    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }

// for add item to watch list--------------------------------------------------------------------
const addToWatchListForm = document.getElementById('add_watch_list_form');

addToWatchListForm.addEventListener("submit",async (e)=>{
  e.preventDefault();
  
  //get the form data/sumitted data
  const formData = new FormData(addToWatchListForm);
  formData.append("add",1);
  //console.log(formData.get('user_id'));
  // for (const pair of formData.entries()) {
  //   console.log(`${pair[0]}, ${pair[1]}`);
  // }

  //check user is logged in or not
  const value = formData.get('user_id').trim();
  if(value == 0){
    //user is not logged in 
    window.location.href = 'http://localhost/Audex/users/login/';
  }
  else{
    //user is logged in 

    document.getElementById("add-to-watchlist").value = "Please Wait..";

    //remove white spaces in user id
    const url = 'http://localhost/Audex/buyers/addToWatchList/' + formData.get('product_id')+'/'+ formData.get('user_id').trim();
    
    console.log(url);
    const data = await fetch(url, {
      method: "POST",
      body: formData,
    });
    const responce = await data.text();
    alert("added");
    document.getElementById("add-to-watchlist").value = "Remove From List";
    document.getElementById("add-to-watchlist").style.backgroundColor = "RED";
    addToWatchListForm.reset();
  }
  // console.log((addToWatchListForm.elements['user_id'].value.trim() == 0) ? "yes":"NO");
});

// end add item to watch list----------------------------------------------------------------------------------------------------------


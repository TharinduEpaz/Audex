
function docheck() {
    if (document.getElementById("check").checked) {
        document.getElementById("forms").style.display = "none";
    } else {
        document.getElementById("forms").style.display = "block";
    }
}
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


const addToWatchListForm = document.getElementById('add_watch_list_form');

addToWatchListForm.addEventListener("submit",async (e)=>{
  e.preventDefault();
  

  //get the form data/sumitted data
  const formData = new FormData(addToWatchListForm);
  formData.append("add",1);
  //console.log(formData.get('product_id'));
  // for (const pair of formData.entries()) {
  //   console.log(`${pair[0]}, ${pair[1]}`);
  // }
  //e.stopPropagation();
  //console.log(addToWatchListForm.elements['product_id'].value);
  document.getElementById("add-to-watchlist").value = "Please Wait..";
  const url = 'http://localhost/Audex/buyers/addToWatchList/' + formData.get('product_id');
  //console.log(url);
  const data = await fetch(url, {
    method: "POST",
    body: formData,
  });
  const responce = await data.text();
  document.getElementById("add-to-watchlist").value = "Remove From List";
  addForm.reset();
});
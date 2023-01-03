
function docheck() {
    if (document.getElementById("check").checked) {
        document.getElementById("container").style.display = "none";
    } else {
        document.getElementById("container").style.display = "block";
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
    const ans = "Yes";
    // const ans = dialogBoxFunction();
    // console.log(ans);
    if(ans == "Yes"){
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

  }
  // console.log((addToWatchListForm.elements['user_id'].value.trim() == 0) ? "yes":"NO");
});

// end add item to watch list----------------------------------------------------------------------------------------------------------

function dialogBoxFunction(){

  let ans = "chass";
  const modal = document.querySelector("dialog");
  const continueBtn = document.querySelector(".continue");
  const closeBtn = document.querySelector(".close");
  const dialog = document.querySelector("dialog");

  document.getElementById("add-to-watchlist").addEventListener("click", () => {
    modal.showModal();
    document.querySelector('body').classList.add("blur")
  });

  document.querySelector(".btn_close").addEventListener("click", () => {
    ans = "No";
    console.log(`You clicked ${ans} button inside the modal.`);
    document.querySelector('body').classList.remove("blur");
    modal.close();
    
  });

  continueBtn.addEventListener("click", () => {

      ans = "Yes";
      console.log(`You clicked ${ans} button inside the modal.`);
      document.querySelector('body').classList.remove("blur");
      modal.close();
      return ans;
      
  });

  closeBtn.addEventListener("click", () => {
      ans = "No";
      console.log(`You clicked ${ans} button inside the modal.`);
      document.querySelector('body').classList.remove("blur");
      modal.close();
     
  });

  // Close dialog
  dialog.addEventListener("click", ( event ) => {
    if (event.target === dialog) {
      console.log("you clicked outside the modal so closing");
      modal.close();
      document.querySelector('body').classList.remove("blur");
    }

  });
  // console.log(ans);
   return ans;
}


// Remove item from watch list-------------------------------------

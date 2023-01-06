
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

  if(addToWatchListForm.getAttribute("data-op") === "add"){
    const modal = document.querySelector("dialog");
    modal.showModal();
    document.querySelector('body').classList.add("blur")

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

      const continueBtn = document.querySelector(".continue"); 

      continueBtn.addEventListener("click", async (event) => {
        event.preventDefault()
        modal.close();
        console.log(`You clicked yes button inside the modal.`);
        document.querySelector('body').classList.remove("blur");
        document.getElementById("add-to-watchlist").value = "Please Wait..";

        //remove white spaces in user id
        const url = 'http://localhost/Audex/buyers/addToWatchList/' + formData.get('product_id')+'/'+ formData.get('user_id').trim();

        console.log(url);
        const data = await fetch(url, {
          method: "POST",
          body: formData,
        });
        const responce = await data.text();
        // alert("added");
        document.getElementById("add-to-watchlist").value = "Remove From List";
        addToWatchListForm.setAttribute("data-op", "remove")
        document.getElementById("add-to-watchlist").style.backgroundColor = "RED";
        addToWatchListForm.reset(); 
      });

      document.querySelector(".btn_close").addEventListener("click", (event) => {
        event.preventDefault();
        modal.close()
        console.log(`You clicked btn_close button inside the modal.`);
        document.querySelector('body').classList.remove("blur");

      });

      const closeBtn = document.querySelector(".close");
      closeBtn.addEventListener("click", (event) => {
        event.preventDefault()
        modal.close();
        console.log(`You clicked no button inside the modal.`);
        document.querySelector('body').classList.remove("blur");
      });

      modal.addEventListener("click", ( event ) => {
        if (event.target === modal) {
          console.log("you clicked outside the modal so closing");
          console.log(modal)
          modal.close();
          document.querySelector('body').classList.remove("blur");
        }
      });

    }
  }
  else{
    // Remove items in watch List being advertiesment details page

    const modal = document.querySelector("dialog");
    modal.showModal();
    document.querySelector('body').classList.add("blur")

    //get the form data/sumitted data
    const formData = new FormData(addToWatchListForm);
    formData.append("remove",1);
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

      const continueBtn = document.querySelector(".continue"); 

      continueBtn.addEventListener("click", async (event) => {
        event.preventDefault()
        modal.close();
        console.log(`You clicked yes button inside the modal.`);
        document.querySelector('body').classList.remove("blur");
        document.getElementById("add-to-watchlist").value = "Please Wait..";

        //remove white spaces in user id
        const url = 'http://localhost/Audex/buyers/removeItemFromWatchList/' + formData.get('product_id')+'/'+ formData.get('user_id').trim();

        console.log(url);
        const data = await fetch(url, {
          method: "POST",
          body: formData,
        });
        const responce = await data.text();
        // alert("added");
        document.getElementById("add-to-watchlist").value = "Add To Watchlist";
        addToWatchListForm.setAttribute("data-op", "add")
        document.getElementById("add-to-watchlist").style.backgroundColor = "Black";
        addToWatchListForm.reset(); 
      });

      document.querySelector(".btn_close").addEventListener("click", (event) => {
        event.preventDefault();
        modal.close()
        console.log(`You clicked btn_close button inside the modal.`);
        document.querySelector('body').classList.remove("blur");

      });

      const closeBtn = document.querySelector(".close");
      closeBtn.addEventListener("click", (event) => {
        event.preventDefault()
        modal.close();
        console.log(`You clicked no button inside the modal.`);
        document.querySelector('body').classList.remove("blur");
      });

      modal.addEventListener("click", ( event ) => {
        if (event.target === modal) {
          console.log("you clicked outside the modal so closing");
          console.log(modal)
          modal.close();
          document.querySelector('body').classList.remove("blur");
        }
      });

    }
  }

});

// end add item to watch list----------------------------------------------------------------------------------------------------------


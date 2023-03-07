const URLROOT = 'http://localhost/Audex';

// Remove watchlist item being watchlist page

const removeItemFromWatchListForm = document.querySelectorAll(".remove_item");
// console.log(removeItemFromWatchListForm);

removeItemFromWatchListForm.forEach((form)=>{
  form.addEventListener("submit", async (e)=>{
    e.preventDefault();

    // const formData = new formData(form);
    const formData = new FormData(form);

    formData.append("remove",1);
    console.log(formData.get('user_id'));
    for (const pair of formData.entries()) {
      console.log(`${pair[0]}, ${pair[1]}`);
    }

    // check user is logged in or not
    const value = formData.get('user_id').trim();
    if(value == 0){
      //user is not logged in 
      window.location.href = URLROOT+'/users/login/';
    }
    else{
      //user is logged in 
      // document.getElementById("remove-item-from-watchlist").value = "Please Wait..";

      //remove white spaces in user id
      const url = URLROOT+'/users/removeOneItemFromWatchList/' + formData.get('product_id')+'/'+ formData.get('user_id').trim();

      console.log(url);
      const data = await fetch(url, {
        method: "POST",
        body: formData,
      });
      const responce = await data.text();
      alert("Removed");
      // form.reset();
      window.location.href = URLROOT+'/users/watchlist/' + formData.get('user_id').trim() ;

    }

  });

});

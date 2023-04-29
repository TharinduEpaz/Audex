// const URLROOT = 'http://localhost/Audex';

// Remove watchlist item being watchlist page

const removeServiceProviderFromWatchListForm = document.querySelectorAll(".remove_watch_service_provider");
// console.log(removeServiceProviderFromWatchListForm);

removeServiceProviderFromWatchListForm.forEach((form)=>{
  form.addEventListener("submit", (e)=>{
    e.preventDefault();

    // const formData = new formData(form);
    const formData = new FormData(form);

    formData.append("remove",1);
    console.log(formData.get('user_id'));

    // for (const pair of formData.entries()) {
    //   console.log(`${pair[0]}, ${pair[1]}`);
    // }

    // check user is logged in or not
    const value = formData.get('user_id').trim();
    if(value == 0){
      //user is not logged in 
      window.location.href = URLROOT+'/users/login/';
    }
    else
    {
      //user is logged in 
      // document.getElementById("remove-item-from-watchlist").value = "Please Wait..";


      const url = URLROOT+'/buyers/removeServiceProviderFromWatchList';

      console.log(url);

      fetch(url, {
        method: "POST",
        body: formData,
      })
      .then( (responce)=>{
        return responce.json();
      })
      .then((data)=>{
        alert("Removed");
        // form.reset();
        window.location.href = URLROOT+'/buyers/watchlist/' + formData.get('user_id').trim()+'/#partTwoServiceProvidrs' ;

      })
      .catch( (error)=>{
          console.log("Error:", error);
      });
      
      

    }

  });

});

const URLROOT = 'http://localhost/Audex';

// for add item to watch list--------------------------------------------------------------------
const addServiceProviderToWatchListForm = document.getElementById('add_watch_list_service_provider');

window.addEventListener("DOMContentLoaded",(e)=>{
  // add even listner to check status of like when load liked or not liked
  if(addServiceProviderToWatchListForm.getAttribute("data-watchLoad") === "watched"){
    addServiceProviderToWatchListForm.setAttribute("data-op", "remove")
      document.getElementById("add-service-provider-to-watchlist").style.backgroundColor = "greenyellow";
      document.getElementById('add-service-provider-to-watchlist').value = "Remove From List";
  }
});

addServiceProviderToWatchListForm.addEventListener("submit", (e) =>{
  e.preventDefault();

  if(addServiceProviderToWatchListForm.getAttribute("data-op") == "add" ){

    const data = new FormData(addServiceProviderToWatchListForm);
    data.append("add",1);
    const url = URLROOT+'/buyers/addServiceProviderToWatchList';
  
    // console.log(url);
  
    // for (const pair of data.entries()) {
    //   console.log(`${pair[0]}, ${pair[1]}`);
    // }
    //check user is logged in or not
    const value = data.get('user_id').trim();
    if(value == 0){
      //user is not logged in 
      window.location.href = URLROOT+'/users/login/';
    }
    else
    {
      //user is logged in
      fetch(url,{
          method : "POST",
          body : data
    
      })
      .then((responce)=>{
          // console.log(responce);
          return responce.json();
      })
      .then((data)=>{
        if(data.message == "Added to the list" || data.message == "Alredy in the list"){
          addServiceProviderToWatchListForm.setAttribute("data-op", "remove");
          document.getElementById('add-service-provider-to-watchlist').style.background = "greenyellow";
          document.getElementById('add-service-provider-to-watchlist').style.color = "white";
          document.getElementById('add-service-provider-to-watchlist').value = "Remove From List";
          
        }
    
      })
      .catch( (error)=>{
          console.log("Error:", error);
      });
  
    }


  }
  else{

    const data = new FormData(addServiceProviderToWatchListForm);
    data.append("remove",1);
    const url = URLROOT+'/buyers/removeServiceProviderFromWatchList';
  
    // console.log(url);
  
    // for (const pair of data.entries()) {
    //   console.log(`${pair[0]}, ${pair[1]}`);
    // }
    //check user is logged in or not
    const value = data.get('user_id').trim();
    if(value == 0){
      //user is not logged in 
      window.location.href = URLROOT+'/users/login/';
    }
    else
    {
      //user is logged in
      fetch(url,{
          method : "POST",
          body : data
    
      })
      .then((responce)=>{
          // console.log(responce);
          return responce.json();
      })
      .then((data)=>{
        if(data.message == "Removed from list" ){
          addServiceProviderToWatchListForm.setAttribute("data-op", "add");
          document.getElementById('add-service-provider-to-watchlist').style.background = 'gray';
          document.getElementById('add-service-provider-to-watchlist').style.color = 'white';
          document.getElementById('add-service-provider-to-watchlist').value = "Add To Watchlist";
          
        }
    
      })
      .catch( (error)=>{
          console.log("Error:", error);
      });
  
    }

  }


});
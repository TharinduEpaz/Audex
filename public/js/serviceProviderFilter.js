
//this is for shop pages sidebar filter

// const URLROOT = 'http://localhost/Audex';


// Define the debounce function
function debounce(func, delay) {
    let timeout;
    return function(...args) {
      const context = this;
      clearTimeout(timeout);
      timeout = setTimeout(() => func.apply(context, args), delay);
    };
  }
  
  // Define the handleFilterChange function with debounce
  const handleFilterChangeDebounced = debounce(handleFilterChange, 500);
  
  const filterForm = document.getElementById('service-provider-filter-form');
  
  // Listen for changes to radio buttons
  const radioButtons = filterForm.querySelectorAll('input[type="radio"]');
  radioButtons.forEach(radioButton => {
      radioButton.addEventListener('change', handleFilterChange);
  });
  
//   // Listen for changes to checkbox buttons
//   const checkBoxButtons = filterForm.querySelectorAll('input[type="checkbox"]');
//   checkBoxButtons.forEach(checkboxButton => {
//       checkboxButton.addEventListener('change', handleFilterChange);
//   });
  
//   // Listen for changes to number inputs
//   const numberInputs = filterForm.querySelectorAll('input[type="number"]');
//   numberInputs.forEach(numberInput => {
//       numberInput.addEventListener('input', handleFilterChangeDebounced );
//   });
  
  // Listen for changes to select inputs
  const selectInputs = filterForm.querySelectorAll('select[name="district"]');
  selectInputs.forEach(selectInput => {
      selectInput.addEventListener('change', handleFilterChange);
  });
  
  // Define the handleFilterChange function
  function handleFilterChange() {
      // Get the form data
      const formData = new FormData(filterForm);
  
      for (const pair of formData.entries()) {
        console.log(`${pair[0]}, ${pair[1]}`);
      }
      
      // Send a fetch request with the form data
      const url = URLROOT+'/users/serviceProviderFilter';
  
      fetch(url, {
          method: 'POST',
          body: formData
      })
      .then(response => response.json())
      .then((data) => {
          // Update the filtered data on the shop page
          if( (data.results.length > 0) && (data.message == 'filters')){
              // console.log(data.results.length, data.message,'come here to if');
              var htmlLast = "";
              for (var i = 0; i < data.results.length; i++) {
                  // console.log('come here to loop',i);
                  var result = data.results[i];
                  var imgLink = "<img src=" + URLROOT+"/public/uploads/Profile/"+ result.image1 +">";

                  var link = "<a href ="+ URLROOT+"/users/serviceProviderPublic/?id="+result.user_id+ " >";

                    // to display full stars
                    let strarsFull = '';
                    for(var j = 0; j< Math.floor(result.Rating); j++ ){
                        strarsFull += "<i class='fa fa-star'></i>";
                    }

                    // to display half stars
                    let halfStars = '';
                    if (result.Rating.indexOf('.') !== -1) {
                        halfStars = '<i class="fa fa-star-half-o"></i>';
                    }

                    var html = "<div class = 'sound-eng-profiles'>"+ 
                                "<div class = 'profile-image'>"+ link+imgLink +"</a></div>"+
                                "<div class ='profile-data'>"+ result.first_name+" "+result.second_name +"<br>"+"<p id ='profession'>"+result.profession+"<br></p></div>"+
                                "<div class = 'rating-stars'><span class ='rate'>"+result.Rating+ strarsFull+halfStars+"</span>"+"</div>"+
                            "</div>" ;

                  // console.log(html);
                  htmlLast = htmlLast + html;
                  
                                  
              }
              // check if is there any unexpired values are there
              if(!(htmlLast === "" ) ){
                  // document.getElementById("shop-page-search-result-area").innerHTML = '';
                  // document.getElementById("shop-container-data").innerHTML = htmlLast;
  
              }
              console.log(htmlLast);
          }
          else{
              // filters applied but no matching items
              if(data.results.length == 0 && data.message == 'filters'){
                  // console.log(data.results.length, data.message);
                  var html = "<div class = 'header'> <h1>Filter Results:Not Found !</h1> </div>";
                  // document.getElementById("shop-page-search-result-area").innerHTML = html;
                  // document.getElementById("shop-container-data").innerHTML = '';
              }
              else{
                  // no filters applied so redirect to sound engineers page
                  console.log(data.results.length, data.message);
                  // window.location.href = URLROOT+'/users/sound_engineers/';
              }
          }
   
  
          // data.forEach(function(result){
          //     console.log(result.product_title,result.price,result.product_category);
          // })
          // for (const pair of data.entries()) {
          //     console.log(`${pair[0]}, ${pair[1]}`);
          // }
      })
      .catch(error => {
          console.error(error);
      });
  }
  

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
const handleFilterChangeDebounced = debounce(handleFilterChange, 400);

const filterForm = document.getElementById('shop-filter-form');

// Listen for changes to radio buttons
const radioButtons = filterForm.querySelectorAll('input[type="radio"]');
radioButtons.forEach(radioButton => {
    radioButton.addEventListener('change', handleFilterChange);
});

// Listen for changes to checkbox buttons
const checkBoxButtons = filterForm.querySelectorAll('input[type="checkbox"]');
checkBoxButtons.forEach(checkboxButton => {
    checkboxButton.addEventListener('change', handleFilterChange);
});

// Listen for changes to number inputs
const numberInputs = filterForm.querySelectorAll('input[type="number"]');
numberInputs.forEach(numberInput => {
    numberInput.addEventListener('input', function() {
        if (isNaN(this.value)) {
            // Display an error message or take other appropriate action
            console.log("Please enter a valid number.");
        } else {
            // Call the handleFilterChangeDebounced function or take other appropriate action
            // check if number is grater than 0
            if( this.value<0 ){
                this.classList.add("input-error"); // add error class
                console.log("Please enter a valid number.");
            }
            else{
                handleFilterChangeDebounced();
                this.classList.remove("input-error");
            }
        }
    });
    // numberInput.addEventListener('input', handleFilterChangeDebounced );
});

// Listen for changes to select inputs
const selectInputs = filterForm.querySelectorAll('select');
selectInputs.forEach(selectInput => {
    selectInput.addEventListener('change', handleFilterChange);
});

// Define the handleFilterChange function
function handleFilterChange() {
    // Get the form data
    const formData = new FormData(filterForm);

    for (const pair of formData.entries()) {
        console.log("This is for validations");
      console.log(`${pair[0]}, ${pair[1]}`);
    }
    
    // Send a fetch request with the form data
    const url = URLROOT+'/users/shopFilter';

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then((data) => {
        // Update the filtered data on the shop page
        if( (data.results.length > 0) && (data.message == 'filters') && (data.errors == 'no errors')){
            // console.log(data.results.length, data.message,'come here');
            var htmlLast = "";
            for (var i = 0; i < data.results.length; i++) {
    
                var result = data.results[i];
                var imgLink = "<img src=" + URLROOT+"/public/uploads/"+ result.image1 +">";

                // check item type
                if(result.product_type == 'auction'){
                    console.log('come here')
                    // item type is auction
                    if((result.is_active == '1') && (result.is_finished == '0') && (result.is_paid == '1')){
                        var link = "<a href ="+ URLROOT+"/users/auction/"+result.product_id+ " >";
    
                        html = "<div class='container-ad'> <div class='container-img'> "+
                                link+imgLink +"</a></div>"+
                                "<div class = 'title'> <h3>"+link+result.product_title+"</a> </h3> <h6>"+result.p_description+"</h6> </div>"+
                                "<div class = 'price'> <label>Auction</label> <label for= 'price' >LKR:"+result.price+"</label>"+link+"<button type = 'submit'>View</button></a></div>"+
                                "</div>";
                        console.log(html);
                        htmlLast = htmlLast + html;
                    }
                            
                }
                else{
                    // item type is fixed_price
                    if( (result.is_deleted == '0') && (result.is_paid == '1') ){
                        var link = "<a href ="+ URLROOT+"/users/advertiesmentDetails/"+result.product_id+ " >";
    
                        html = "<div class='container-ad'> <div class='container-img'> "+
                                link+imgLink +"</a></div>"+
                                "<div class = 'title'><h3>"+link+result.product_title+"</a></h3><h6>"+result.p_description+"</h6></div>"+
                                "<div class = 'price'><label for= 'price' >LKR:"+result.price+"</label>"+link+"<button type = 'submit'>View</button></a></div>"+
                                "</div>";

                        htmlLast = htmlLast + html;
                    }
                }
                
            }
            // check if is there any unexpired values are there
            if(!(htmlLast === "" ) ){
                document.getElementById("shop-page-search-result-area").innerHTML = '';
                document.getElementById("shop-container-data").innerHTML = htmlLast;

            }
            else{
                // htmlLast value is empty because no active items
                var html = "<div class = 'header'> <h1>Filter Results:Not Found !</h1> </div>";
                document.getElementById("shop-page-search-result-area").innerHTML = html;
                document.getElementById("shop-container-data").innerHTML = '';
            }
            console.log(htmlLast);
        }
        else if( (data.errors == 'no errors') ){
            // no errors
            // filters applied but no matching items
            if(data.results.length == 0 && data.message == 'filters'){
                console.log(data.results.length, data.message);
                var html = "<div class = 'header'> <h1>Filter Results:Not Found !</h1> </div>";
                document.getElementById("shop-page-search-result-area").innerHTML = html;
                document.getElementById("shop-container-data").innerHTML = '';
            }
            else{
                console.log(data.results.length, data.message);
                window.location.href = URLROOT+'/users/shop/';
            }
        }
        else{
            // there is errors
            if((data.errors == 'min price error')){
                document.getElementById('max-price').classList.remove("input-error");
                document.getElementById('min-price').classList.add("input-error");
            }
            else{
                document.getElementById('min-price').classList.remove("input-error");
                document.getElementById('max-price').classList.add("input-error");
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

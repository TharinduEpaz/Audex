
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

const filterForm = document.getElementById('shop-filter-form');

// Listen for changes to radio buttons
const radioButtons = filterForm.querySelectorAll('input[type="radio"]');
radioButtons.forEach(radioButton => {
    radioButton.addEventListener('change', handleFilterChange);
});

// Listen for changes to number inputs
const numberInputs = filterForm.querySelectorAll('input[type="number"]');
numberInputs.forEach(numberInput => {
    numberInput.addEventListener('input', handleFilterChangeDebounced );
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
        if(data.length >0){
            var htmlLast = "";
            for (var i = 0; i < data.length; i++) {
    
                var result = data[i];
                var imgLink = "<img src=" + URLROOT+"/public/uploads/"+ result.image1 +">";

                // check item type
                if(result.product_type == 'auction'){
                    // item type is auction
                    var link = "<a href ="+ URLROOT+"/users/auction/"+result.product_id+ " >";

                    html = "<div class='container-ad'> <div class='container-img'> "+
                            link+imgLink +"</a></div>"+
                            "<div class = 'title'> <h3>"+link+result.product_title+"</a> </h3> <h6>"+result.p_description+"</h6> </div>"+
                            "<div class = 'price'> <label>Auction</label> <label for= 'price' >LKR:"+result.price+"</label>"+link+"<button type = 'submit'>View</button></a></div>"+
                            "</div>";
                            
                }
                else{
                    // item type is fixed_price
                    var link = "<a href ="+ URLROOT+"/users/advertiesmentDetails/"+result.product_id+ " >";

                    html = "<div class='container-ad'> <div class='container-img'> "+
                            link+imgLink +"</a></div>"+
                            "<div class = 'title'><h3>"+link+result.product_title+"</a></h3><h6>"+result.p_description+"</h6></div>"+
                            "<div class = 'price'><label for= 'price' >LKR:"+result.price+"</label>"+link+"<button type = 'submit'>View</button></a></div>"+
                            "</div>";
                }
                htmlLast = htmlLast + html;
            }
            document.getElementById("shop-container-data").innerHTML = htmlLast;
            console.log(htmlLast);
        }
        else{
            window.location.href = URLROOT+'/users/shop/';
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

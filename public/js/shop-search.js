// this is for search bar in the shop 

const URLROOT = 'http://localhost/Audex';

const resultTable = document.getElementById("shop-search-results");
const shopSearchForm = document.getElementById("shop-search-form");
const inputField = document.getElementById("shop-search-item-term");

const shopResultArea = document.getElementById("shop-page-search-result-area");



inputField.addEventListener("keyup", (e) =>{
    e.preventDefault();
    resultTable.style.display = 'block';

    

    const searchItemTerm = document.getElementById("shop-search-item-term").value;

    const data = new FormData(shopSearchForm);
    const url = URLROOT+'/users/searchItems';

    fetch(url,{
        method : "POST",
        body : data

    })
    .then((responce)=>{
        // console.log(responce);
        return responce.json()
    })
    .then((data)=>{
        
        var html = "<table class='table' id='search-results-table'><tbody>";
        for (var i = 0; i < data.length; i++) {

            var result = data[i];
            var imgLink = "<img src=" + URLROOT+"/public/uploads/"+ result.image1 +">";

            var link = "<a href ="+ URLROOT+"/users/advertiesmentDetails/"+result.product_id+ " >";
            html += "<tr>"+
                            "<td>"+link+"<div class ='search-result-row-content'><div class ='image-pop-up'>" +imgLink+ "</div> <div class='title-and-price'>" + result.product_title + "</br>Price: "+result.price+ "</div></div>"+"</a>"+  "</td>" + 
                    "</tr>";
        }
        html = html + "</tbody> </table>";
        console.log(html);
        // resultTable.style.visibility = "visible";
        resultTable.innerHTML = html;
        
        // data.forEach(function(result){
        //     console.log(result.product_title,result.price,result.product_category);
        // })
        // inputField.reset();
        
    })
    .catch( (error)=>{
        console.log("Error:", error);
    });
});

shopSearchForm.addEventListener("submit", (e) =>{
    e.preventDefault();
    const searchItemTerm = document.getElementById("shop-search-item-term").value;

    if(searchItemTerm){
        const data = new FormData(shopSearchForm);
        data.append("submit",1);
        const url = URLROOT+'/users/searchItems';
    
        fetch(url,{
            method : "POST",
            body : data
    
        })
        .then((responce)=>{
            // console.log(responce);
            return responce.json();
        })
        .then((data)=>{
            // console.log(data);
            // redirect to the "shop" page and pass the data as a parameter in the URL
    
            // window.location.href = URLROOT+"/users/shop";
            if(data.length !== 0 ){
                var html = "<div class = 'header'> <h1>Search Results</h1> </div>";
                for (var i = 0; i < data.length; i++) {
                    var result = data[i];
                    var imgLink = "<img src=" + "http://localhost/Audex/public/uploads/"+ result.image1 +">";
        
                    // check whether product is an auction or not
                    if(result.product_type == 'auction'){
                        var link = "<a href ="+"http://localhost/Audex/users/auction/"+result.product_id+ " >";
                        var auction_label = "<label>Auction</label>"
                    }
                    else{
                        var link = "<a href ="+"http://localhost/Audex/users/advertiesmentDetails/"+result.product_id+ " >";
                        var auction_label = ""
                    }
        
                    html += "<div class = 'result-container' >"+ 
                                "<div class = 'result-container-img' >"+ link+ imgLink+ "</a> </div>" +
                                "<div class = 'result-title' >" 
                                    +link +
                                        "<div class='top-part'>"+
                                            '<h3>'+ result.product_title+'</h3>' +
                                            "<h4>" +result.product_condition+ "</h4> "+
                                            "<h5>" +result.p_description+"</h5>" +
                                        "</div>"+
                                        "<div class='bottom-part'>"+
                                            "<h6><label>LKR:"+result.price+ "</label>"+auction_label+"</h6>"+
                                            "<button type ='submit'>View Product</button>"+
                                        "</div>"+
                                    "</a>"+
                                "</div>"+
                            "</div>";
                        
                }

            }
            else{
                var html = "<div class = 'header'> <h1>Search Results:Not Found !</h1> </div>";
            }
            
            // console.log("Pressed Enter");
            console.log(html);
            shopResultArea.innerHTML = html;
    
            // resultTable.style.visibility = "hidden"
            document.getElementById('shop-search-results').innerHTML = '';
            document.getElementById('search-result-area').innerHTML = '';
            resultTable.style.display = 'none';
            
            // shopSearchForm.reset();
            
    
    
    
        })
        .catch( (error)=>{
            console.log("Error:", error);
        });

    }
});


window.addEventListener("click", function(event) {
    if (event.target != inputField) {
        resultTable.style.display = 'none';
    }
});
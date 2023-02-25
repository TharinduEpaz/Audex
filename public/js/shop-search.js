const URLROOT = 'http://localhost/Audex';

const resultTable = document.getElementById("search-results-table");
const shopSearchForm = document.getElementById("shop-search-form");
const inputField = document.getElementById("shop-search-item-term");
const resultsToShop = document.getElementById("shop-search-results");
const shopResultArea = document.getElementById("shop-page-search-result-area");
// console.log(resultsToShop);


inputField.addEventListener("keyup", (e) =>{
    e.preventDefault();
    const searchItemTerm = document.getElementById("shop-search-item-term").value;

    const data = new FormData(shopSearchForm);
    const url = URLROOT+'/users/shopSearchItems';

    fetch(url,{
        method : "POST",
        body : data

    })
    .then((responce)=>{
        // console.log(responce);
        return responce.json()
    })
    .then((data)=>{
        
        var html = "<tbody>";
        for (var i = 0; i < data.length; i++) {
            var result = data[i];
            var imgLink = "<img src=" + URLROOT+"/public/uploads/"+ result.image1 +">";

            var link = "<a href ="+ URLROOT+"/users/advertiesmentDetails/"+result.product_id+ " >";
            html += "<tr>"+
                            "<td>"+link+"<div class ='search-result-row-content'><div class ='image-pop-up'>" +imgLink+ "</div> <div class='title-and-price'>" + result.product_title + "</br>Price: "+result.price+ "</div></div>"+"</a>"+  "</td>" + 
                    "</tr>";
        }
        html = html + "<tbody>";
        // console.log(html);
        resultTable.innerHTML = html;
        
        // data.forEach(function(result){
        //     console.log(result.product_title,result.price,result.product_category);
        // })
    })
    .catch( (error)=>{
        console.log("Error:", error);
    });
});

shopSearchForm.addEventListener("submit", (e) =>{
    e.preventDefault();
    const searchItemTerm = document.getElementById("shop-search-item-term").value;

    const data = new FormData(shopSearchForm);
    data.append("submit",1);
    const url = URLROOT+'/users/shopSearchItems';

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
        
        var html = "";
        for (var i = 0; i < data.length; i++) {
            var result = data[i];
            var imgLink = "<img src=" + "http://localhost/Audex/public/uploads/"+ result.image1 +">";

            var link = "<a href ="+"http://localhost/Audex/users/advertiesmentDetails/"+result.product_id+ " >";

            html += "<div class = 'container-ad' >"+ 
                        "<div class = 'container-img' >"+ link+ imgLink+ "</a> </div>" +
                        "<div class = title >" + link + result.product_title +" "+ result.product_condition+ " " +result.price+ "</a> </div>"+
                    "</div>";
                
        }
        // console.log("Pressed Enter");
        console.log(html);
        shopResultArea.innerHTML = html;
        // resultsToShop.innerHTML= html;
        resultTable.style.visibility = "hidden"
        resultTable.innerHTML = 'Hell';
        document.getElementById('shop-search-results').innerHTML = '';
        document.getElementById('search-result-area').innerHTML = '';

        



    })
    .catch( (error)=>{
        console.log("Error:", error);
    });
});
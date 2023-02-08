const URLROOT = 'http://localhost/Audex';

const resultTable = document.getElementById("search-results-table");
const mainSearchForm = document.getElementById("main-search-bar");
const inputField = document.getElementById("search-item-term");
const resultsToShop = document.getElementById("search-result-area");
// console.log(resultsToShop);





inputField.addEventListener("keyup", (e) =>{
    e.preventDefault();
    const searchItemTerm = document.getElementById("search-item-term").value;

    const data = new FormData(mainSearchForm);
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
mainSearchForm.addEventListener("submit", (e) =>{
    e.preventDefault();
    const searchItemTerm = document.getElementById("search-item-term").value;

    const data = new FormData(mainSearchForm);
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
        // redirect to the "shop" page and pass the data as a parameter in the URL

        window.location.href = URLROOT+"/users/shop";
        
        // var html = "";
        // for (var i = 0; i < data.length; i++) {
        //     var result = data[i];
        //     var imgLink = "<img src=" + "http://localhost/Audex/public/uploads/"+ result.image1 +">";

        //     var link = "<a href ="+"http://localhost/Audex/buyers/advertiesmentDetails/"+result.product_id+ " >";

        //     html += "<div class = 'search-result-all' >"+ 
        //                 "<div class = 'search-result-image' >"+ link+ imgLink+ "</a> </div>" +
        //                 "<div class = search-result-description >" + link + result.product_title +" "+ result.product_condition+ " " +result.price+ "</a> </div>"+
        //             "</div>";
                
        // }
        // console.log("Pressed Enter");
        // console.log(html);
        // resultsToShop.innerHTML= html;
        // data.forEach(function(result){
        //     console.log(result.product_title,result.price,result.product_category);
        // })



    })
    .catch( (error)=>{
        console.log("Error:", error);
    });
});
// this is for search bar in the shop 

const URLROOT = 'http://localhost/Audex';

const soundEngineersSearchForm = document.getElementById("sound-engineers-search-form");
const inputField = document.getElementById("search-service-provider");

const resultTable = document.getElementById("sound-engineer-search-results");
const soundEngineersResultArea = document.getElementById("sound-engineers-page-search-result-area");



inputField.addEventListener("keyup", (e) =>{
    e.preventDefault();
    resultTable.style.display = 'block';

    

    const searchTerm = inputField.value;

    const data = new FormData(soundEngineersSearchForm);
    const url = URLROOT+'/users/searchServiceProviders';

    fetch(url,{
        method : "POST",
        body : data

    })
    .then((responce)=>{
        // console.log(responce);
        return responce.json()
    })
    .then((data)=>{
        
        var html = "<table class='table' id='sound-engineer-search-results-table'><tbody>";
        for (var i = 0; i < data.results.length; i++) {

            var result = data.results[i];
            var profile_img = result.profile_pic ;
            var imgLink = "<img src=" + URLROOT+"/public/uploads/"+profile_img +">";

            var link = "<a href ="+ URLROOT+"/users/serviceProviderPublic/?id="+result.user_id+ " >";
            html += "<tr>"+
                        "<td>"+link+"<div class ='search-result-row-content'><div class ='image-pop-up'>" +imgLink+ "</div> <div class='title'>" + result.first_name+" "+result.second_name + "</br>Professional : " +result.profession+" </div></div>"+"</a>"+  "</td>" + 
                    "</tr>";
            // console.log(imgLink);
        }

        html = html + "</tbody> </table>";
        // console.log(data.message);
        resultTable.innerHTML = html;
        
        // data.results.forEach(function(result){
        //     console.log(result.first_name,result.second_name,result.user_id);
        // })
        // inputField.reset();
        
    })
    .catch( (error)=>{
        console.log("Error:", error);
    });
});

soundEngineersSearchForm.addEventListener("submit", (e) =>{
    e.preventDefault();
    const searchServiceProviderTerm = inputField.value;

    if(searchServiceProviderTerm){
        const data = new FormData(soundEngineersSearchForm);
        data.append("submit",1);
        const url = URLROOT+'/users/searchServiceProviders';
    
        fetch(url,{
            method : "POST",
            body : data
    
        })
        .then((responce)=>{
            // console.log(responce);
            return responce.json();
        })
        .then((data)=>{
            console.log(data.message);
            let html = '';

            if(data.results.length > 0 ){
                html = "<div class = 'header'> <h1>Search Results</h1> </div><div class = 'sound-eng'>";
                for (var i = 0; i < data.results.length; i++) {

                    var result = data.results[i];

                    // var profile_image = result.profile_pic ;
                    var imgLink = "<img src=" + URLROOT+"/public/uploads/Profile/"+result.profile_image +">";

                    var link = "<a href ="+ URLROOT+"/users/serviceProviderPublic/?id="+result.user_id+ " >";

                    // to display full stars
                    let strarsFull = '';
                    for(var i = 0; i< Math.floor(result.Rating); i++ ){
                        strarsFull += "<i class='fa fa-star'></i>";
                    }

                    // to display half stars
                    let halfStars = '';
                    if (result.Rating.indexOf('.') !== -1) {
                        halfStars = '<i class="fa fa-star-half-o"></i>';
                    }

                    html += "<div class = 'sound-eng-profiles'>"+ 
                                "<div class = 'profile-image'>"+ link+imgLink +"</a></div>"+
                                "<div class ='profile-data'>"+ result.first_name+" "+result.second_name +"<br>"+"<p id ='profession'>"+result.profession+"</p></div>"+
                                "<div class = 'rating-stars'><span class ='rate'>"+result.Rating+ strarsFull+halfStars+"</span>"+"</div>"+
                            "</div>" ;
                        
                }
                html+="</div>";
                console.log(html);

            }
            else{
                html = "<div class = 'header'> <h1>Search Results:Not Found !</h1> </div>";
            }
            
            // console.log("Pressed Enter");
            console.log(html);
            soundEngineersResultArea.innerHTML = html;
    
            // resultTable.style.visibility = "hidden"
            document.getElementById('sound-engineer-search-results').innerHTML = '';
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sell_item.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo MAPS_API;?>&callback=init1&libraries=placesMap&v=weekly"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>


    <title>Advertise</title>
</head>
<body onload="initMap();init1()">
<?php require_once APPROOT . '/views/sellers/navbar.php';?>
    
    <div class="container_add">
    <?php require_once APPROOT . '/views/sellers/sidebar.php';?>        

        <div class="container">
        <div class="advertisement">
            <div class="add">
                <div id="forms" class="form_seller">
            <h1 style="text-align: center;">Post Advertisement</h1>
                <!-- <?php echo '<pre>'; print_r($data); echo '</pre>';?> -->

                    <form action="<?php echo URLROOT . '/sellers/advertise';?>" method="post" enctype="multipart/form-data">
                        <?php
                                    if(!empty($data['title_err'])){
                                    echo '<div class="error">';
                                        echo '*'.$data['title_err'].'<br>';
                                    echo '</div>';
                                    }
                                ?> 
                        <div class="input">
                <!-- <?php echo '<pre>'; print_r($data); echo '</pre>';?> -->

                            <label for="">Title&nbsp</label>
                            <input class="title" type="text" name="title"  value="<?php echo $data['title']?>" maxlength="80">
                        </div>
                        <?php
                                    if(!empty($data['price_err'])){
                                    echo '<div class="error">';
                                        echo '*'.$data['price_err'].'<br>';
                                    echo '</div>';
                                    }
                                ?> 
                        <div class="input">
                            <label for="">Price</label>
                            <input class="price" step="0.01" type="number" name="price"  placeholder="xxxx.xx" value="<?php echo $data['price']?>"  >
                        </div>
                        <div class="input">
                            <label for="check_au" >Auction(optional)</label>
                            <input type="checkbox"   name="check_au" class="check_au" <?php if($data['type']=='auction') echo 'checked';?>>
                            <?php if($data['type']=='auction') {?>
                            <label class="date" style="display:block" for="date">Ending Date</label>

                            <?php }else{?>
                                <label class="date" style="display:none" for="date">Ending Date</label>

                            <?php }?>
                            <!-- <label class="date" for="date">Ending Date</label> -->
                            <select name="date" id="category" class="date">
                              <option value="1">1day</option>
                              <option value="3">3day</option>
                              <option value="5">5day</option>
                              <option value="7">7day</option>

                            </select>
                        </div>
                                <?php
                                    if(!empty($data['image1_err']) || !empty($data['image2_err']) || !empty($data['image3_err'])){
                                        echo '<div class="error" style="margin-bottom:5px">';
                                        if(!empty($data['image1_err'])){
                                            echo '*'.$data['image1_err'].'<br>';
                                        echo '</div>';
                                        }
                                        if(!empty($data['image2_err'])){
                                                echo '*'.$data['image2_err'].'<br>';
                                            echo '</div>';
                                        }
                                        if(!empty($data['image3_err'])){
                                                echo '*'.$data['image3_err'].'<br>';
                                            }
                                            echo '</div>';
                                    }
                                ?> 
                                <h3 style="text-align: center;margin-bottom:2vh">Images</h3><br>
                        <div class="input_image">
                            <div class="image" id="img1">
                                    <img id="image_1" src="" alt="Picture">
                                    <p id="add_image1">Add image:</p>
                                    <div class="cancel" id="cancel1" style="display:none;">
                                        <i class="fa fa-times" id="cancel1"></i>
                                    </div>
                                    <div class="img_input">
                                        <input type="file" name="image1" id="image1" class="custom-file-input">
                                        <i class = "fa fa-camera"></i>
                                    </div>
                            </div>
                            <div class="image" id="img2" style="display : none;">
                                    <img id="image_2" src="" alt="Picture">
                                    <p id="add_image2">Add image:</p>
                                    <div class="cancel" id="cancel2" style="display:none;">
                                        <i class="fa fa-times" id="cancel1"></i>
                                    </div>
                                    <div class="img_input">
                                        <input type="file" name="image2" id="image2" class="custom-file-input">
                                        <i class = "fa fa-camera"></i>
                                    </div>
                            </div>
                            <div class="image" id="img3" style="display:none">
                                    <img id="image_3" src="" alt="Picture">
                                    <p id="add_image3">Add image:</p>
                                    <div class="cancel" id="cancel3" style="display:none;">
                                        <i class="fa fa-times" id="cancel1"></i>
                                    </div>
                                    <div class="img_input">
                                        <input type="file" name="image3" id="image3" class="custom-file-input">
                                        <i class = "fa fa-camera"></i>
                                    </div>
                            </div>
                            <div class="image" id="img4" style="display:none">
                                    <img id="image_4" src="" alt="Picture">
                                    <p id="add_image4">Add image:</p>
                                    <div class="cancel" id="cancel4" style="display:none;">
                                        <i class="fa fa-times" id="cancel1"></i>
                                    </div>
                                    <div class="img_input">
                                        <input type="file" name="image4" id="image4" class="custom-file-input">
                                        <i class = "fa fa-camera"></i>
                                    </div>
                            </div>
                            <div class="image" id="img5" style="display:none">
                                    <img id="image_5" src="" alt="Picture">
                                    <p id="add_image5">Add image:</p>
                                    <div class="cancel" id="cancel5" style="display:none;">
                                        <i class="fa fa-times" id="cancel1"></i>
                                    </div>
                                    <div class="img_input">
                                        <input type="file" name="image5" id="image5" class="custom-file-input">
                                        <i class = "fa fa-camera"></i>
                                    </div>
                            </div>
                            <div class="image" id="img6" style="display:none">
                                    <img id="image_6" src="" alt="Picture">
                                    <p id="add_image6">Add image:</p>
                                    <div class="cancel" id="cancel6" style="display:none;">
                                        <i class="fa fa-times" id="cancel1"></i>
                                    </div>
                                    <div class="img_input">
                                        <input type="file" name="image6" id="image6" class="custom-file-input">
                                        <i class = "fa fa-camera"></i>
                                    </div>
                            </div>
                        </div>
                        <?php
                                    if(!empty($data['condition_err'])){
                                    echo '<div class="error">';
                                        echo '*'.$data['condition_err'].'<br>';
                                    echo '</div>';
                                    }
                                ?> 
                        <div class="input">
                            <label class="condition" for="condition">Condition</label>
                            <select name="condition" id="category" class="category">
                              <option value="Used">Used</option>
                              <option value="New">New</option>
                            </select>
                            <!-- <input class="condition" type="text" name="condition"   value="<?php echo $data['condition']?>" > -->
                        </div>
                        <?php
                                    if(!empty($data['category_err'])){
                                    echo '<div class="error">';
                                        echo '*'.$data['category_err'].'<br>';
                                    echo '</div>';
                                    }
                                ?> 
                        <div class="input" style="flex-wrap: wrap;">
                        <label>Category:</label>
                        <div class="input">
                            <input type="checkbox" name="category[]" value="microphone" id="chkMicrophone">
                            <label for="chkMicrophone">Microphone</label>

                            <input type="checkbox" name="category[]" value="speaker" id="chkMixer">
                            <label for="chkMixer">Speaker</label>

                            <input type="checkbox" name="category[]" value="dj/mixer" id="chkDJ">
                            <label for="chkDJ">DJ/Mixer</label>

                            
                            <input type="checkbox" name="category[]" value="percussion/drums" id="chkMixer">
                            <label for="chkMixer">Percussion/Drums</label>
                        </div>
                            <div class="input">
                                <input type="checkbox" name="category[]" value="amplifier" id="chkAmplifier">
                                <label for="chkAmplifier">Amplifier</label>
    
                                <input type="checkbox" name="category[]" value="guitar" id="chkGuitar">
                                <label for="chkGuitar">Guitar</label>
    
                                <input type="checkbox" name="category[]" value="keyboard" id="chkKeyboard">
                                <label for="chkKeyboard">Keyboard</label>
    
                                <input type="checkbox" name="category[]" value="other" id="chkDrumset">
                                <label for="chkDrumset">Other</label>
                            </div>
                        </div>

                        <div class="input">
                            <label class="district" for="district">Select a district&nbsp</label>
                            <select name="district" id="category">
                                <option value="Ampara">Ampara</option>
                                <option value="Anuradhapura">Anuradhapura</option>
                                <option value="Badulla">Badulla</option>
                                <option value="Batticaloa">Batticaloa</option>
                                <option value="Colombo">Colombo</option>
                                <option value="Galle">Galle</option>
                                <option value="Gampaha">Gampaha</option>
                                <option value="Hambantota">Hambantota</option>
                                <option value="Jaffna">Jaffna</option>
                                <option value="Kalutara">Kalutara</option>
                                <option value="Kandy">Kandy</option>
                                <option value="Kegalle">Kegalle</option>
                                <option value="Kilinochchi">Kilinochchi</option>
                                <option value="Kurunegala">Kurunegala</option>
                                <option value="Mannar">Mannar</option>
                                <option value="Matale">Matale</option>
                                <option value="Matara">Matara</option>
                                <option value="Monaragala">Monaragala</option>
                                <option value="Mullaitivu">Mullaitivu</option>
                                <option value="Nuwara Eliya">Nuwara Eliya</option>
                                <option value="Polonnaruwa">Polonnaruwa</option>
                                <option value="Puttalam">Puttalam</option>
                                <option value="Ratnapura">Ratnapura</option>
                                <option value="Trincomalee">Trincomalee</option>
                                <option value="Vavuniya">Vavuniya</option>

                            </select>
                        </div>


                        <?php
                                    if(!empty($data['model_err'])){
                                    echo '<div class="error">';
                                        echo '*'.$data['model_err'].'<br>';
                                    
                                    echo '</div>';
                                    }
                                ?> 
                        <div class="input">
                            <label class="model" for="">Model No.</label>
                            <input class="model" type="text" name="model"   value="<?php echo $data['model']?>" >
                        </div>
                        <?php
                                    if(!empty($data['brand_err'])){
                                    echo '<div class="error">';
                                        echo '*'.$data['brand_err'].'<br>';
                                    echo '</div>';
                                    }
                                ?> 
                        <div class="input">
                            <label class="brand" for="">Brand Name</label>
                            <input class="brand" type="text" name="brand"   value="<?php echo $data['brand']?>" >
                        </div>
                        <?php
                                    if(!empty($data['description_err'])){
                                    echo '<div class="error">';
                                        echo '*'.$data['description_err'].'<br>';
                                    echo '</div>';
                                    }
                                ?> 
                        <div class="input">
                            <label class="descriptionl" for="">Description</label>
                            <textarea name="description" id="description" class="description" cols="30" rows="15"  value="<?php echo $data['description']?>" ></textarea>
                            
                        </div>
                        <?php
                                    if(!empty($data['error_geocode'])){
                                    echo '<div class="error">';
                                        echo '*'.$data['error_geocode'].'<br>';
                                    echo '</div>';
                                    }
                                ?> 
                        <div class="input">
                            <label for="show-map" >Location(optional)</label>
                            <input type="checkbox" id="show_map"  name="show_map" class="show_map" <?php if(!empty($data['longitude'])) echo 'checked';?>>
                        </div>
                        <!-- <script>
                            
                                if(<?php echo !empty($data['longitude'])?>){
                                    document.getElementById("html_content").style.display = "block";
                                }
                            
                        </script> -->
                        <?php if(!empty($data['longitude'])) {?>
                            <div id="html_content" style="display:block">
                        <?php }else{?>
                            <div id="html_content" style="display:none">
                        <?php }?>
                                <!-- When spot the place in the map, takes the longitude and latitude and takes the address also -->
                        <div class="input">
                            <a href="" class="post" onclick="openModal1(); return false;">Check on map</a>
                        </div>
                        <div id="myModal1" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeModal1()">&times;</span>
                                <div id="map" style="width: 100%; height: 90%;">
                                    <script>
                                        var geocoder;
                                        var map;
                                        var longitude;
                                        var latitude;
                                        var position;
                                        function initMap() {
                                            var colombo = {lat: 6.9271, lng: 79.8612};
                                               var map = new google.maps.Map(document.getElementById('map'), {
                                                   zoom: 12,
                                                   center: colombo
                                            
                                               });
                                               var marker = new google.maps.Marker({
                                                   position: colombo,
                                                   map: map,
                                                   draggable: true
                                               });
                                               google.maps.event.addListener(marker, 'dragend', function(event) {
                                                   console.log(event.latLng.lat());
                                                   console.log(event.latLng.lng());
                                                   longitude = event.latLng.lng();
                                                   latitude = event.latLng.lat();
                                                   var position = marker.getPosition();
                                                   geocoder = new google.maps.Geocoder();

                                                   geocoder.geocode({ location: position }).then((response) => {
                                                       if (response.results[0]) {

                                                         console.log("ADDEREES:-"+response.results[0].formatted_address);
                                                         document.getElementById("address").value = response.results[0].formatted_address;
                                                         document.getElementById("address1").innerHTML = "Address: "+response.results[0].formatted_address;
                                                         document.getElementById("latitude").value = latitude;
                                                         document.getElementById("longitude").value = longitude;
                                                        //  document.getElementById("p_longi").innerHTML="Longitude: "+longitude;
                                                        //  document.getElementById("p_lati").innerHTML="Latitude: "+latitude;
                                                       } else {
                                                         window.alert("No results found");
                                                         document.getElementById("error_geocode").value = 'No results found';

                                                       }
                                                     })
                                                     .catch((e) => document.getElementById("error_geocode").value = 'Geocoder failed due to: ' + e);
                                               });
                                        }

                                    </script>
                                </div>
                                <!-- <a href="" class="post" onclick="closeModal1(); return false;">Submit</a> -->
                            </div>
                        </div>
                                    

                        
                        <!-- When entered address, gets longitude and latitude -->
                        <div class="input">
                            <a href="" class="post" onclick="openModal2(); return false;">Add address</a>
                        </div>
                        <div id="myModal2" class="modal">
                            <div class="modal-content">
                                <div id="floating-panel">
                                  <input id="addressInput" type="text" value="UCSC,Sri Lanka" />
                                  <a href="" onclick="codeAddress(); return false;">Adress</a>
                                </div>
                                <span class="close" onclick="closeModal2()">&times;</span>
                                <div id="map2" style="width: 100%; height: 90%; margin-bottom:10px">
                                    
                                    <script>
                                        var geocoder2;
                                        var map2;

                                        function init1(){
                                            map2 = new google.maps.Map(document.getElementById("map2"), {
                                                zoom: 8,
                                                center: { lat: 6.9271, lng: 79.8612 },
                                            });
                                        }

                                        function codeAddress() {
                                            geocoder2 = new google.maps.Geocoder();
                                            var address = document.getElementById('addressInput').value;
                                            geocoder2.geocode( { 'address': address}, function(results, status) {
                                            if (status == 'OK') {
                                                console.log("lati:"+results[0].geometry.location.lat());
                                                console.log("longi:"+results[0].geometry.location.lng());
                                                document.getElementById("address").value = document.getElementById("addressInput").value;
                                                document.getElementById("address1").innerHTML = "Address: "+document.getElementById("addressInput").value;
                                                document.getElementById("latitude").value = results[0].geometry.location.lat();
                                                document.getElementById("longitude").value = results[0].geometry.location.lng();
                                                // document.getElementById("p_longi").innerHTML="Longitude: "+results[0].geometry.location.lng();
                                                // document.getElementById("p_lati").innerHTML="Latitude: "+results[0].geometry.location.lat();

                                                map2.setCenter(results[0].geometry.location);
                                                var marker = new google.maps.Marker({
                                                  map: map2,
                                                  position: results[0].geometry.location
                                              });
                                            } else {
                                              document.getElementById("error_geocode").value = 'Geocode was not successful for the following reason: ' + status;
                                              alert('Geocode was not successful for the following reason: ' + status);
                                            }
                                            });
                                        }
                                </script>
                                </div>
                                <!-- <a href="" class="post" style="padding-top:0px" onclick="closeModal2(); return false;">Submit</a> -->
                            </div>
                        </div>
                        
                        
                                    
                        <div class="input">
                            <label id="p_longi" style="display: none;">Longitude: <?php echo $data['longitude']?></label><br>
                            <label id="p_lati" style="display: none;">Latitude: <?php echo $data['latitude']?></label>
                            <label id="address1" class="brand" for="" >Address: <?php echo $data['address']?></label>
                        </div>
                        <div class="input" style="height:0vh;">
                            <input id="address" class="address" type="hidden" name="address"  >
                            <input id="error_geocode" class="error_geocode" type="hidden" name="error_geocode"  >
                        </div>
                        <div class="input" style="height:0vh;">
                            <input type="hidden" id="latitude" name="latitude"  value="<?php echo $data['latitude']?>"><br>
                            <input type="hidden" id="longitude" name="longitude"  value="<?php echo $data['longitude']?>"><br>
                            
                        </div>
                    </div>
                       <div class="submit">
                            <input type="submit" name="submit" value="Post(Checkout)" class="post">
                            <a class="cancel" href="<?php echo URLROOT;?>/sellers/advertisements">Cancel</a>

                        </div>
                    </form>
                </div>
            </div>
        </div>

            
        </div>
    </div>
</body>
<script>
    //Map check button
    document.addEventListener('DOMContentLoaded', function() {
        var checkbox = document.getElementById('show_map');
        var htmlContent = document.getElementById('html_content');
        
        if (checkbox && htmlContent) {
            
            checkbox.addEventListener('change', function() {
                if (checkbox.checked) {
                    htmlContent.style.display = 'block';
                } else {
                    console.log("notchecked");
                    
                    htmlContent.style.display = 'none';
                }
            });
        }
    });
		function openModal1() {
			var modal = document.getElementById("myModal1");
			modal.style.display = "block";
            // <?php if(empty($data['longitude'])){?>
            //     document.getElementById("longitude").value = '79.8612';
            //     document.getElementById("latitude").value = '6.9271';
            //     document.getElementById("p_longi").innerHTML="Longitude: 79.8612";
            //     document.getElementById("p_lati").innerHTML="Latitude: 6.9271";
            //     document.getElementById("address1").innerHTML = "Address: Colombo, Sri Lanka";

            
            // <?php }?>
           
		}
        
        function openModal2() {
            var modal = document.getElementById("myModal2");
            modal.style.display = "block";
            // console.log(map2);
            // <?php if(empty($data['longitude'])){?>
            //     document.getElementById("longitude").value = '79.8612';
            //     document.getElementById("latitude").value = '6.9271';
            //     document.getElementById("p_longi").innerHTML="Longitude: 79.8612";
            //     document.getElementById("p_lati").innerHTML="Latitude: 6.9271";
            //     document.getElementById("address1").innerHTML = "Address: Colombo, Sri Lanka";
            
            // <?php }?>
            
        }


		function closeModal1() {
			var modal = document.getElementById("myModal1");
			modal.style.display = "none";
		}
        function closeModal2() {
			var modal = document.getElementById("myModal2");
			modal.style.display = "none";
		}

        // When the user clicks anywhere outside of the modal, close it
	var modal = document.getElementById("myModal1");
	var modal2 = document.getElementById("myModal2");

    window.addEventListener("click", function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    });

    window.addEventListener("click", function(event) {
      if (event.target == modal2) {
        modal2.style.display = "none";
      }
    });

    //make sidebar button background clicked
    link = document.querySelector('#advertise');
    link.style.background = "#E5E9F7";
    link.style.color = "red";

    //keeping the sidebar button clicked at the page
    link = document.querySelector('#advertise');
    link.style.background = "#E5E9F7";
    link.style.color = "red";
    link.style.fontWeight = "800";


    //Image preview
    document.getElementById("image1").onchange = function(){
        url=URL.createObjectURL(image1.files[0]); // Preview new image
        if(url!=null){
            document.getElementById("image_1").style.display = "inherit";
            document.getElementById("cancel1").style.display = "inherit";
            document.getElementById("image_1").src = url;
            var file=document.getElementById("image1");
            console.log(file.value);
            document.getElementById("img2").style.display = "inherit";
            document.getElementById("add_image1").innerHTML = "Change image";
        }
    }
    document.getElementById("image2").onchange = function(){
        url=URL.createObjectURL(image2.files[0]); // Preview new image
        if(url!=null){
            document.getElementById("image_2").style.display = "inherit";
            document.getElementById("cancel1").style.display = "none";
            document.getElementById("cancel2").style.display = "inherit";

            document.getElementById("image_2").src = url;
            document.getElementById("img3").style.display = "inherit";
            document.getElementById("add_image2").innerHTML = "Change image";
        }
    }
    document.getElementById("image3").onchange = function(){
        url=URL.createObjectURL(image3.files[0]); // Preview new image
        if(url!=null){
            document.getElementById("image_3").style.display = "inherit";
            document.getElementById("cancel2").style.display = "none";
            document.getElementById("cancel3").style.display = "inherit";

            document.getElementById("image_3").src = url;
            document.getElementById("img4").style.display = "inherit";
            document.getElementById("add_image3").innerHTML = "Change image";
        }
    }
    document.getElementById("image4").onchange = function(){
        url=URL.createObjectURL(image4.files[0]); // Preview new image
        if(url!=null){
            document.getElementById("image_4").style.display = "inherit";
            document.getElementById("cancel3").style.display = "none";
            document.getElementById("cancel4").style.display = "inherit";

            document.getElementById("image_4").src = url;
            document.getElementById("img5").style.display = "inherit";
            document.getElementById("add_image4").innerHTML = "Change image";
        }
    }
    document.getElementById("image5").onchange = function(){
        url=URL.createObjectURL(image5.files[0]); // Preview new image
        if(url!=null){
            document.getElementById("image_5").style.display = "inherit";
            document.getElementById("cancel4").style.display = "none";
            document.getElementById("cancel5").style.display = "inherit";

            document.getElementById("image_5").src = url;
            document.getElementById("img6").style.display = "inherit";
            document.getElementById("add_image5").innerHTML = "Change image";
        }
    }
    document.getElementById("image6").onchange = function(){
        url=URL.createObjectURL(image6.files[0]); // Preview new image
        if(url!=null){
            document.getElementById("image_6").style.display = "inherit";
            document.getElementById("cancel5").style.display = "none";
            document.getElementById("cancel6").style.display = "inherit";

            document.getElementById("image_6").src = url;
            document.getElementById("add_image6").innerHTML = "Change image";
        }
    }
    document.getElementById("cancel1").onclick = function(){
        document.getElementById("image_1").src = ''; // Back to previous image
        var file=document.getElementById("image1");
        file.value = null; // Reset file input to null(removing the inputed file)
        document.getElementById("cancel1").style.display = "none";
        document.getElementById("image_1").style.display = "none";
        document.getElementById("img2").style.display = "none";
        document.getElementById("add_image1").innerHTML = "Add image";
        
    }
    document.getElementById("cancel2").onclick = function(){
        document.getElementById("image_2").src = ''; // Back to previous image
        var file=document.getElementById("image2");
        file.value = null; // Reset file input to null(removing the inputed file)
        document.getElementById("cancel2").style.display = "none";
        document.getElementById("cancel1").style.display = "inherit";
        document.getElementById("image_2").style.display = "none";
        document.getElementById("img3").style.display = "none";
        document.getElementById("add_image2").innerHTML = "Add image";
        
    }
    document.getElementById("cancel3").onclick = function(){
        document.getElementById("image_3").src = ''; // Back to previous image
        var file=document.getElementById("image3");
        file.value = null; // Reset file input to null(removing the inputed file)
        document.getElementById("cancel3").style.display = "none";
        document.getElementById("cancel2").style.display = "inherit";
        document.getElementById("image_3").style.display = "none";
        document.getElementById("img4").style.display = "none";
        document.getElementById("add_image3").innerHTML = "Add image";
        
    }
    document.getElementById("cancel4").onclick = function(){
        document.getElementById("image_4").src = ''; // Back to previous image
        var file=document.getElementById("image4");
        file.value = null; // Reset file input to null(removing the inputed file)
        document.getElementById("cancel3").style.display = "inherit";
        document.getElementById("cancel4").style.display = "none";
        document.getElementById("image_4").style.display = "none";
        document.getElementById("img5").style.display = "none";
        document.getElementById("add_image4").innerHTML = "Add image";
        
    }
    document.getElementById("cancel5").onclick = function(){
        document.getElementById("image_5").src = ''; // Back to previous image
        var file=document.getElementById("image5");
        file.value = null; // Reset file input to null(removing the inputed file)
        document.getElementById("cancel4").style.display = "inherit";
        document.getElementById("cancel5").style.display = "none";
        document.getElementById("image_5").style.display = "none";
        document.getElementById("img6").style.display = "none";
        document.getElementById("add_image5").innerHTML = "Add image";
        
    }
    document.getElementById("cancel6").onclick = function(){
        document.getElementById("image_6").src = ''; // Back to previous image
        var file=document.getElementById("image6");
        file.value = null; // Reset file input to null(removing the inputed file)
        document.getElementById("cancel6").style.display = "none";
        document.getElementById("cancel5").style.display = "inherit";
        document.getElementById("image_6").style.display = "none";
        document.getElementById("add_image6").innerHTML = "Add image";
        
    }

	</script>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>


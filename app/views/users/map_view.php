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
        <div class="sidebar">
                <a href="#"><i class="fas fa-qrcode"></i> <span>Dashboard</span></a>
                <a href="<?php echo URLROOT.'/sellers/getProfile/'.$_SESSION['user_id']?>"> <i class="fa fa-cog" aria-hidden="true"></i><span>Profile Settings</span></a>
                <a href="<?php echo URLROOT;?>/sellers/advertisements"> <i class="fa fa-ad" aria-hidden="true"></i><span>Advertisements</span></a>
                <a class="current" href="<?php echo URLROOT;?>/sellers/advertise"><i class="fa-solid fa-dollar-sign" aria-hidden="true"></i><span>Advertise</span></a>
                <a href="#"> <i class="fa fa-comments"></i><span>Messages</span></a>       
        </div>
        <div class="container">
        <div class="advertisement">
            <div class="add">
                <div id="forms" class="form_seller">
                <?php
                // if(!empty($data['title_err']) || !empty($data['description_err']) || !empty($data['price_err'])  || !empty($data['condition_err']) || !empty($data['image1_err']) || !empty($data['image2_err']) || !empty($data['image3_err']) || !empty($data['brand_err']) || !empty($data['model_err']) ){
                //     echo '<div class="error">';
                //         if(!empty($data['title_err'])){
                //             echo '*'.$data['title_err'].'<br>';
                //         }
                //         if(!empty($data['description_err'])){
                //             echo '*'.$data['description_err'].'<br>';
                //         }
                //         if(!empty($data['price_err'])){
                //             echo '*'.$data['price_err'].'<br>';
                //         }
                //         if(!empty($data['condition_err'])){
                //             echo '*'.$data['condition_err'].'<br>';
                //         }
                //         if(!empty($data['image1_err'])){
                //             echo '*'.$data['image1_err'].'<br>';
                //         }
                //         if(!empty($data['image2_err'])){
                //             echo '*'.$data['image2_err'].'<br>';
                //         }
                //         if(!empty($data['image3_err'])){
                //             echo '*'.$data['image3_err'].'<br>';
                //         }
                //         if(!empty($data['brand_err'])){
                //             echo '*'.$data['brand_err'].'<br>';
                //         }
                //         if(!empty($data['model_err'])){
                //             echo '*'.$data['model_err'].'<br>';
                //         }

                //     echo '</div>';
                // }

            ?>
                    <form action="<?php echo URLROOT . '/users/map_view';?>" method="post" enctype="multipart/form-data">
                        <?php
                                    if(!empty($data['title_err'])){
                                    echo '<div class="error">';
                                        echo '*'.$data['title_err'].'<br>';
                                    echo '</div>';
                                    }
                                ?> 
                        <div class="input">
                            <label for="">Title&nbsp</label>
                            <input class="title" type="text" name="title"  value="<?php echo $data['title']?>" >
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
                            <input class="price" type="text" name="price"  placeholder="xxxx.xx" value="<?php echo $data['price']?>"  >
                        </div>
                        <div class="input">
                            <label for="check_au" >Auction(optional)</label>
                            <input type="checkbox"   name="check_au" class="check_au" >
                            <label class="date" for="date">Ending Date</label>
                            <select name="date" id="date" class="date">
                              <option value="1">1day</option>
                              <option value="3">3day</option>
                              <option value="5">5day</option>
                              <option value="7">7day</option>

                            </select>
                        </div>
                                <?php
                                    if(!empty($data['image1_err']) || !empty($data['image2_err']) || !empty($data['image3_err'])){
                                        echo '<div class="error">';
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
                        <div class="input_image">
                            <div class="file-input">
                                <input type="file" name="image1" id="file" class="custom-file-input">
                                <!-- <label for="image1">Choose an image<p class="file-name"></p></label> -->
                            <!-- <?php
                                    if(!empty($data['image2_err'])){
                                    echo '<div class="error">';
                                        echo '*'.$data['image2_err'].'<br>';
                                    echo '</div>';
                                    }
                                ?>  -->
                            </div>
                            <div class="image">
                                <input type="file" name="image2" class="custom-file-input" >
                                <!-- <label for="image2">Choose an image</label> -->
                            </div>
                            <!-- <?php
                                    if(!empty($data['image3_err'])){
                                    echo '<div class="error">';
                                        echo '*'.$data['image3_err'].'<br>';
                                    echo '</div>';
                                    }
                                ?>  -->
                            <div class="image">
                                <input type="file" name="image3"  class="custom-file-input">
                                <!-- <label for="image3">Choose an image</label> -->
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
                            <label class="condition" for="">Condition</label>
                            <input class="condition" type="text" name="condition"   value="<?php echo $data['condition']?>" >
                        </div>
                        <div class="input">
                            <label class="category" for="category">Category&nbsp</label>
                            <select name="category" id="category">
                              <option value="microphone">Microphone</option>
                              <option value="dj">DJ</option>
                              <option value="mixer">Mixer</option>
                              <option value="amplifier">Amplifier</option>  
                              <option value="guitar">Guitar</option>
                              <option value="keyboard">Keyboard</option>

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

                        <!-- <button onclick="openModal()">Open Modal</button> -->
                        <a href="" onclick="openModal1(); return false;">Check on map</a>
                                    <!-- When spot the place in the map, takes the longitude and latitude and takes the address also -->
	                    <div id="myModal1" class="modal">
	                    	<div class="modal-content">
	                    		<span class="close" onclick="closeModal1()">&times;</span>
	                    		<div id="map" style="width: 100%; height: 90%;">
                                    <!-- <script src="<?php echo GEOCODE;?>"></script> -->
                                    <script>
                                        var geocoder;
                                        var map;
                                        var infowindow;
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
                                                         
                                                         // infowindow.setContent(response.results[0].formatted_address);
                                                         console.log("ADDEREES:-"+response.results[0].formatted_address);
                                                         document.getElementById("address").value = response.results[0].formatted_address;
                                                         document.getElementById("latitude").value = latitude;
                                                         document.getElementById("longitude").value = longitude;
                                                       } else {
                                                         window.alert("No results found");
                                                       }
                                                     })
                                                     .catch((e) => window.alert("Geocoder failed due to: " + e));
                                               });
                                        }
                                        
                                    </script>
                                </div>
                                <a href="" onclick="closeModal1(); return false;">Submit</a>
	                    	</div>
	                    </div>

                        <a href="" onclick="openModal2(); return false;">Add address</a>
                                            <!-- When entered address, gets longitude and latitude -->
	                    <div id="myModal2" class="modal">
	                    	<div class="modal-content">
                                <div id="floating-panel">
                                  <input id="addressInput" type="text" value="UCSC,Sri Lanka" />
                                  <a href="" onclick="codeAddress(); return false;">Adress</a>
                                </div>
	                    		<span class="close" onclick="closeModal2()">&times;</span>
	                    		<div id="map2" style="width: 100%; height: 90%;">

                                    <script>
                                        var geocoder2;
                                        var map2;
                                        var infowindow2;
                                        
                                        function init1(){
                                            
                                            map2 = new google.maps.Map(document.getElementById("map2"), {
                                                zoom: 8,
                                                center: { lat: 6.9271, lng: 79.8612 },
                                            });
                                        }
                                        
                                        
                                        
                                        
                                        
                                        function codeAddress() {
                                            
                                            
                                            geocoder2 = new google.maps.Geocoder();
                                            infowindow2 = new google.maps.InfoWindow();
                                        var address = document.getElementById('addressInput').value;
                                        geocoder2.geocode( { 'address': address}, function(results, status) {
                                        if (status == 'OK') {
                                            console.log("lati:"+results[0].geometry.location.lat());
                                            console.log("longi:"+results[0].geometry.location.lng());
                                            document.getElementById("latitude").value = results[0].geometry.location.lat();
                                            document.getElementById("longitude").value = results[0].geometry.location.lng();
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
                                        //   initMap();
                                        }
                                </script>
                                </div>
                                <a href="" onclick="closeModal2(); return false;">Submit</a>
	                    	</div>
	                    </div>


                        <div class="input">
                            <label class="brand" for="">Adress:</label>
                            <input id="address" class="brand" type="text" name="brand" disabled >
                        </div>
                        <div class="input">
                            <input type="text" id="latitude" name="latitude"><br>
                            <input type="text" id="longitude" name="longitude"><br>
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
		function openModal1() {
			var modal = document.getElementById("myModal1");
			modal.style.display = "block";
		}
        
        function openModal2() {
                                            var modal = document.getElementById("myModal2");
                                            modal.style.display = "block";
                                            // console.log(map2);
                                            
                                        }


		function closeModal1() {
			var modal = document.getElementById("myModal1");
			modal.style.display = "none";
		}
        function closeModal2() {
			var modal = document.getElementById("myModal2");
			modal.style.display = "none";
		}
	</script>

<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>


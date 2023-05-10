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
    <title>Edit Advertisement</title>
</head>
<body>
<?php require_once APPROOT . '/views/sellers/navbar.php';?>

    <div class="container_add">
    <?php require_once APPROOT . '/views/sellers/sidebar.php';?>        

        <div class="container">
        <div class="advertisement">
            <div class="add">
                <div id="forms" class="form_seller">
                <!-- <?php
                if(!empty($data['title_err']) || !empty($data['description_err']) || !empty($data['price_err'])  || !empty($data['condition_err']) || !empty($data['image1_err']) || !empty($data['image2_err']) || !empty($data['image3_err']) || !empty($data['brand_err']) || !empty($data['model_err']) ){
                    echo '<div class="error">';
                        if(!empty($data['title_err'])){
                            echo '*'.$data['title_err'].'<br>';
                        }
                        if(!empty($data['description_err'])){
                            echo '*'.$data['description_err'].'<br>';
                        }
                        if(!empty($data['price_err'])){
                            echo '*'.$data['price_err'].'<br>';
                        }
                        if(!empty($data['condition_err'])){
                            echo '*'.$data['condition_err'].'<br>';
                        }
                        if(!empty($data['image1_err'])){
                            echo '*'.$data['image1_err'].'<br>';
                        }
                        if(!empty($data['image2_err'])){
                            echo '*'.$data['image2_err'].'<br>';
                        }
                        if(!empty($data['image3_err'])){
                            echo '*'.$data['image3_err'].'<br>';
                        }
                        if(!empty($data['brand_err'])){
                            echo '*'.$data['brand_err'].'<br>';
                        }
                        if(!empty($data['model_err'])){
                            echo '*'.$data['model_err'].'<br>';
                        }

                    echo '</div>';
                }

            ?> -->
                    <form action="<?php echo URLROOT . '/sellers/edit_advertisement/'.$data['id'];?>" method="post" enctype="multipart/form-data">
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
                        <?php if($data['product_type']!='auction'){
                                    if(!empty($data['price_err'])){
                                    echo '<div class="error">';
                                        echo '*'.$data['price_err'].'<br>';
                                    echo '</div>';
                                    }
                                ?> 
                        <div class="input">
                            <label for="">Price</label>
                            <input class="price" type="number" name="price"  value="<?php echo $data['price']?>"  >
                        </div>
                        <?php }?>
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

                            <input type="checkbox" name="category[]" value="dj" id="chkDJ">
                            <label for="chkDJ">DJ</label>

                            <input type="checkbox" name="category[]" value="mixer" id="chkMixer">
                            <label for="chkMixer">Mixer</label>
                            
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
                            <textarea name="description" id="description" class="description" cols="30" rows="15"  value="" ><?php echo $data['description']?></textarea>
                            
                        </div>
                        <div class="submit">
                            <input type="submit" name="submit" value="Edit" class="post">
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
    var img1 = <?php echo json_encode($data['image1']); ?>;
    var img2 = <?php echo json_encode($data['image2']); ?>;
    var img3 = <?php echo json_encode($data['image3']); ?>;
    var img4 = <?php echo json_encode($data['image4']); ?>;
    var img5 = <?php echo json_encode($data['image5']); ?>;
    var img6 = <?php echo json_encode($data['image6']); ?>;

    if(img1!=""){
            document.getElementById("image_1").style.display = "inherit";
            // document.getElementById("cancel1").style.display = "inherit";
            var link=<?php echo json_encode(URLROOT.'/public/uploads/');?>+img1;
            document.getElementById("image_1").src = link;
            var file=document.getElementById("image1");
            document.getElementById("img2").style.display = "inherit";
            document.getElementById("add_image1").innerHTML = "Change image";
    }

    if(img2!=""){
        document.getElementById("image_2").style.display = "inherit";
        // document.getElementById("cancel2").style.display = "inherit";
        // document.getElementById("cancel1").style.display = "none";
        var link=<?php echo json_encode(URLROOT.'/public/uploads/');?>+img2;
        document.getElementById("image_2").src = link;
        var file=document.getElementById("image2");
        document.getElementById("img3").style.display = "inherit";
        document.getElementById("add_image2").innerHTML = "Change image";
    }
    if(img3!=""){
        document.getElementById("image_3").style.display = "inherit";
        // document.getElementById("cancel3").style.display = "inherit";
        // document.getElementById("cancel2").style.display = "none";
        var link=<?php echo json_encode(URLROOT.'/public/uploads/');?>+img3;
        document.getElementById("image_3").src = link;
        var file=document.getElementById("image3");
        document.getElementById("img4").style.display = "inherit";
        document.getElementById("add_image3").innerHTML = "Change image";

    }

    if(img4!=""){
        document.getElementById("image_4").style.display = "inherit";
        // document.getElementById("cancel3").style.display = "none";
        // document.getElementById("cancel4").style.display = "inherit";
        var link=<?php echo json_encode(URLROOT.'/public/uploads/');?>+img4;
        document.getElementById("image_4").src = link;
        var file=document.getElementById("image4");
        document.getElementById("img5").style.display = "inherit";
        document.getElementById("add_image4").innerHTML = "Change image";
    }

    if(img5!=""){
        document.getElementById("image_5").style.display = "inherit";
        // document.getElementById("cancel4").style.display = "none";
        // document.getElementById("cancel5").style.display = "inherit";
        var link=<?php echo json_encode(URLROOT.'/public/uploads/');?>+img5;
        document.getElementById("image_5").src = link;
        var file=document.getElementById("image5");
        document.getElementById("img6").style.display = "inherit";
        document.getElementById("add_image5").innerHTML = "Change image";
    }

    if(img6!=""){
            document.getElementById("image_6").style.display = "inherit";
            // document.getElementById("cancel6").style.display = "inherit";
            // document.getElementById("cancel5").style.display = "none";
            var link=<?php echo json_encode(URLROOT.'/public/uploads/');?>+img6;
            document.getElementById("image_6").src = link;
            var file=document.getElementById("image6");
            document.getElementById("add_image6").innerHTML = "Change image";
    }

        //Image input part. If a image is changed, it will be previewed.
    document.getElementById("image1").onchange = function(){
        url=URL.createObjectURL(image1.files[0]); // Preview new image

        if(url!=null){
            document.getElementById("image_1").style.display = "inherit";
            // document.getElementById("cancel1").style.display = "inherit";
            document.getElementById("image_1").src = url;
            var file=document.getElementById("image1");
            document.getElementById("img2").style.display = "inherit";
            document.getElementById("add_image1").innerHTML = "Change image";
        }
    }
    document.getElementById("image2").onchange = function(){
        url=URL.createObjectURL(image2.files[0]); // Preview new image
        if(url!=null){
            document.getElementById("image_2").style.display = "inherit";
            // document.getElementById("cancel1").style.display = "none";
            // document.getElementById("cancel2").style.display = "inherit";

            document.getElementById("image_2").src = url;
            document.getElementById("img3").style.display = "inherit";
            document.getElementById("add_image2").innerHTML = "Change image";
        }
    }
    document.getElementById("image3").onchange = function(){
        url=URL.createObjectURL(image3.files[0]); // Preview new image
        if(url!=null){
            document.getElementById("image_3").style.display = "inherit";
            // document.getElementById("cancel2").style.display = "none";
            // document.getElementById("cancel3").style.display = "inherit";

            document.getElementById("image_3").src = url;
            document.getElementById("img4").style.display = "inherit";
            document.getElementById("add_image3").innerHTML = "Change image";
        }
    }
    document.getElementById("image4").onchange = function(){
        url=URL.createObjectURL(image4.files[0]); // Preview new image
        if(url!=null){
            document.getElementById("image_4").style.display = "inherit";
            // document.getElementById("cancel3").style.display = "none";
            // document.getElementById("cancel4").style.display = "inherit";

            document.getElementById("image_4").src = url;
            document.getElementById("img5").style.display = "inherit";
            document.getElementById("add_image4").innerHTML = "Change image";
        }
    }
    document.getElementById("image5").onchange = function(){
        url=URL.createObjectURL(image5.files[0]); // Preview new image
        if(url!=null){
            document.getElementById("image_5").style.display = "inherit";
            // document.getElementById("cancel4").style.display = "none";
            // document.getElementById("cancel5").style.display = "inherit";

            document.getElementById("image_5").src = url;
            document.getElementById("img6").style.display = "inherit";
            document.getElementById("add_image5").innerHTML = "Change image";
        }
    }
    document.getElementById("image6").onchange = function(){
        url=URL.createObjectURL(image6.files[0]); // Preview new image
        if(url!=null){
            document.getElementById("image_6").style.display = "inherit";
            // document.getElementById("cancel5").style.display = "none";
            // document.getElementById("cancel6").style.display = "inherit";

            document.getElementById("image_6").src = url;
            document.getElementById("add_image6").innerHTML = "Change image";
        }
    }
        //Cancel button part. If a image is canceled, it will remove the input image.
    // document.getElementById("cancel1").onclick = function(){
    //     document.getElementById("image_1").src = ''; // Back to previous image
    //     var file=document.getElementById("image1");
    //     file.value = null; // Reset file input to null(removing the inputed file)
    //     document.getElementById("cancel1").style.display = "none";
    //     document.getElementById("image_1").style.display = "none";
    //     document.getElementById("img2").style.display = "none";
    //     document.getElementById("add_image1").innerHTML = "Add image";
        
    // }
    // document.getElementById("cancel2").onclick = function(){
    //     document.getElementById("image_2").src = ''; // Back to previous image
    //     var file=document.getElementById("image2");
    //     file.value = null; // Reset file input to null(removing the inputed file)
    //     document.getElementById("cancel2").style.display = "none";
    //     document.getElementById("cancel1").style.display = "inherit";
    //     document.getElementById("image_2").style.display = "none";
    //     document.getElementById("img3").style.display = "none";
    //     document.getElementById("add_image2").innerHTML = "Add image";
        
    // }
    // document.getElementById("cancel3").onclick = function(){
    //     document.getElementById("image_3").src = ''; // Back to previous image
    //     var file=document.getElementById("image3");
    //     file.value = null; // Reset file input to null(removing the inputed file)
    //     document.getElementById("cancel3").style.display = "none";
    //     document.getElementById("cancel2").style.display = "inherit";
    //     document.getElementById("image_3").style.display = "none";
    //     document.getElementById("img4").style.display = "none";
    //     document.getElementById("add_image3").innerHTML = "Add image";
        
    // }
    // document.getElementById("cancel4").onclick = function(){
    //     document.getElementById("image_4").src = ''; // Back to previous image
    //     var file=document.getElementById("image4");
    //     file.value = null; // Reset file input to null(removing the inputed file)
    //     document.getElementById("cancel3").style.display = "inherit";
    //     document.getElementById("cancel4").style.display = "none";
    //     document.getElementById("image_4").style.display = "none";
    //     document.getElementById("img5").style.display = "none";
    //     document.getElementById("add_image4").innerHTML = "Add image";
        
    // }
    // document.getElementById("cancel5").onclick = function(){
    //     document.getElementById("image_5").src = ''; // Back to previous image
    //     var file=document.getElementById("image5");
    //     file.value = null; // Reset file input to null(removing the inputed file)
    //     document.getElementById("cancel4").style.display = "inherit";
    //     document.getElementById("cancel5").style.display = "none";
    //     document.getElementById("image_5").style.display = "none";
    //     document.getElementById("img6").style.display = "none";
    //     document.getElementById("add_image5").innerHTML = "Add image";
        
    // }
    // document.getElementById("cancel6").onclick = function(){
    //     document.getElementById("image_6").src = ''; // Back to previous image
    //     var file=document.getElementById("image6");
    //     file.value = null; // Reset file input to null(removing the inputed file)
    //     document.getElementById("cancel6").style.display = "none";
    //     document.getElementById("cancel5").style.display = "inherit";
    //     document.getElementById("image_6").style.display = "none";
    //     document.getElementById("add_image6").innerHTML = "Add image";
        
    // }

    //keeping the sidebar button clicked at the page
    link = document.querySelector('#advertise');
    link.style.background = "#E5E9F7";
    link.style.color = "red";
    link.style.fontWeight = "800";
    link.innerHTML="<i class='fa-solid fa-dollar-sign' aria-hidden='true'></i>Edit Item";

</script>

<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/edit_picture.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">

    <title>Document</title>
</head>
<body>
    <div class="img">
        <form style="margin-top: 50vh; margin-left:40%;" action="<?php URLROOT.'users/edit_profile_picture/'.$data['id']?>" method="post" enctype="multipart/form-data">
        <?php
                if(!empty($data['image1_err'])  ){
                    echo '<div class="error">';
                        if(!empty($data['image1_err'])){
                            echo '*'.$data['image1_err'].'<br>';
                        }
                    echo '</div>';
                    }
        ?>
        <input type="file" name="image1" id="file" class="custom-file-input">
            <input type="submit" value="Upload">
            <a href="<?php echo URLROOT.'/'.$_SESSION['user_type'].'s/getProfile/'.$data['id']?>">Cancel</a>
        </form>
    </div>
</body>
</html>
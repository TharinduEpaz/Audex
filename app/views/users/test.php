<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>

    <?php
    $data1=[
        'product_id'=>'Hello',
        'title' => 'Hao',
        'image1' => 'Mko',
    ];

    echo '<pre>'; print_r($data1); echo '</pre>';
    $data1=urlencode(base64_encode($data1['product_id']));
    echo '<pre>'; print_r($data1); echo '</pre>';
    
    // foreach($data as $loc=>$data1){

        $data['product_id'] = base64_decode(urldecode($data1['product_id']));
    // }


    ?>


    <?php echo '<pre>'; print_r($data); echo '</pre>';?>
    <h1></h1><?php echo $data;?></h1>
    </div>
</body>
</html>
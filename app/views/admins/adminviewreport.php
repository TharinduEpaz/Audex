<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/manageuser.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/admindashboard.css';?>">
    
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/seller_advertisement.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    

    <title>Manage User</title>
</head>
<body>
<style>

@media print{
            .sidebar, nav{
                display: none;
            }
            .main{
                width: 100vw;
                left: 0;
            }
            .whitebox1{
                position: absolute;
               margin: 0;
                top: 0vh;
                left: 0vw;
                
            }
            .print-btn{
                display: none;
            }
            .poster_advertisements{
                padding: 0;
                margin: 0;
            }

            .container{
                margin: 0;
                padding: 0;
            }

        }

</style>
<?php require_once APPROOT . '/views/admins/navbar.php';?>
   
    <div class="container">
    <?php require_once APPROOT . '/views/admins/sidebar.php';?>        

    <div class="poster_advertisements">
        <div class="whitebox1">

                <div class="print-button-area">

                <button id="btn_print" class="print-btn">Print</button>

                </div>
            
                <table id="payment_detail_table" class="payment-detail">
                        <thead>
                            <tr>
                            
                            <th>Payment ID</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Product ID</th>
                            <th>Profile ID</th>
                            <th>Payment Intent</th>
                            <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        
                        <?php foreach ($data['details'] as $detail) : ?>

                                <tr>                                   
                                    <td><?php echo $detail->payment_id?></td>
                                    <td><?php echo $detail->amount?></td>
                                    <td> <?php echo $detail->date?></td>
                                    <td> <?php echo $detail->product_id?></td>
                                    <td> <?php echo $detail->service_provider_user_id?></td>
                                    <td> <?php echo $detail->payment_intent?></td>
                                    <td> <?php echo $detail->redirect_status?></td>
                                    
                                    
                                </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td>Total</td>
                            <td><?php echo $data['total']?></td>
                        </tr>
                            
                        
                            
                        </tbody>
                    </table>
                
                
            


        
        </div>        
            
        

    </div>
</body>

<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
<script>

        //Print button
    window.onload = function() {
        document.getElementById("btn_print").onclick = function() {
            window.print();
        }
    }
     //keeping the sidebar button clicked at the page
     link = document.querySelector('#reports');
    link.style.background = "#E5E9F7";
    link.style.color = "red";
    link.style.fontWeight = "800";

</script>


</html>
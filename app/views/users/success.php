<!DOCTYPE html>
<html>
<head>
  <title>Thanks for your order!</title>
  <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/payment.css';?>">
</head>
<body>
  <section>
    <p>
      We appreciate your business! If you have any questions, please email
      <a href="mailto:audexlk@gamil.com">audexlk@gmail.com</a>.
    </p>
        <!-- <?php echo '<pre>'; print_r($data); echo '</pre>';?> -->
        <?php if($_SESSION['user_type'] == 'seller'){?>
            <a class="to_advertisements" href="<?php echo URLROOT;?>/sellers/advertisements">Back To Advertisements</a>
        <?php }else if($_SESSION['user_type'] == 'service_provider'){?>
            <a class="to_advertisements" href="<?php echo URLROOT;?>/service_providers/profile/<?php echo $_SESSION['user_id']?>">Back To Profile</a>
        <?php }?>

  </section>
</body>
</html>
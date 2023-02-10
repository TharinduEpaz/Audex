<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT.'/public/css/rate.css'?>">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Document</title>
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<body>


    <form action=""></form>
    <input id="rating" name="rating" type="hidden" value="">
    <h1 id="head"></h1>
    <div class="rating">
      <i class="star fa fa-star" data-rating="5" style='order:5'></i>
      <i class="star fa fa-star" data-rating="4" style='order:4'></i>
      <i class="star fa fa-star" data-rating="3" style='order:3'></i>
      <i class="star fa fa-star" data-rating="2" style='order:2'></i>
      <i class="star fa fa-star" data-rating="1" style='order:1'></i>
    </div>
    
</body>
<script> 
$('.rating').on('click', '.star', function() {
  let point = $(this).index();
  $('.star').each(function(index) {
    return index >= point ? $(this).addClass('selected') : 
    $(this).removeClass('selected'); //A
  });
  $('#rating').val($(this).data('rating'));
  console.log($('#rating').val());
  window.location.href = "<?php echo URLROOT.'/users/rate/'?>"+$('#rating').val();
});
</script>
</html>
<!DOCTYPE html>
<html lang="en">
<html>
	<head>
		<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Event Calendar</title>
		<link href="<?php echo URLROOT?>/public/css/calendar.css" rel="stylesheet" >
		<link href="<?php echo URLROOT?>/public/css/form.css" rel="stylesheet" >
	</head>
	<body>
        <!-- <h1>HEllo</h1> -->
	    <nav class="navtop">
            <!-- <?php echo $data;?> -->
	    	<div>
                <h1>Event Calendar</h1>
	    	</div>
	    </nav>
        <h1><?php echo date('m+1')?></h1>
<?php require_once APPROOT . '/views/users/navbar.php';?>

		<div class="content home">
			<?=$data?>
		</div>
	</body>
</html>

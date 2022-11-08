<?php

//require must be used instead of include because the router is essential for the framwork
require '../Core/router.php';

$r = new router;
echo get_class($r); 
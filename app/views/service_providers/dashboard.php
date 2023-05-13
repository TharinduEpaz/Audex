<div class="service-provider-profile">
    <div class="white-box">
        <!-- <?php print_r($data); ?> -->

    <div class="dashboard-title">
        <p>Welcome </p>
        <p>This is your dashboard</p>
    </div>
    <div class="dashboard-container">

    <div class="dashboard-item" id="">
        <h1 id="profile-views"><?php echo $data['post_count']->count?></h1>
        <p>Posts Published</p>
    </div>

    <div class="dashboard-item" id="">
        <h1 id="Likes"><?php echo $data['likes']->sum?></h1>
        <p>Total Likes</p>
    </div>

    <div class="dashboard-item" id="">
        <h1 id="Events"><?php echo $data['event_count']->count?></h1>
        <p>Events This Month</p>
    </div>
    <!-- <div class="dashboard-item" id="">
        <h1 id="Flags">0</h1>
        <p>Flags</p>
    </div> -->
    <div class="dashboard-item" id="">
        <h1 id="profile"><?php echo $data['profile_completion']?>%</h1>
        <p>Profile Complete</p>
    </div>

    </div>
</div>
</div>

<script>
    //make sidebar button background clicked
    link = document.querySelector('#dashboard');
    link.style.background = "#E5E9F7";
    link.style.color = "red";


    

</script>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>


</body>

</html>
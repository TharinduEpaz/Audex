<div class="service-provider-profile">
    <div class="white-box">

    <div class="dashboard-title">
        <p>Welcome Mevan !!</p>
        <p>This is your dashboard</p>
    </div>
    <div class="dashboard-container">

    <div class="dashboard-item" id="">
        <h1 id="msg-count">2</h1>
        <p>Unread Messages</p>
    </div>

    <div class="dashboard-item" id="">
        <h1 id="profile-views">122</h1>
        <p>Profile Views</p>
    </div>

    <div class="dashboard-item" id="">
        <h1 id="Likes">2</h1>
        <p>Total Likes</p>
    </div>

    <div class="dashboard-item" id="">
        <h1 id="Events">2</h1>
        <p>Events This Month</p>
    </div>
    <div class="dashboard-item" id="">
        <h1 id="Flags">0</h1>
        <p>Flags</p>
    </div>
    <div class="dashboard-item" id="">
        <h1 id="profile">100%</h1>
        <p>Profile Complete</p>
    </div>

    </div>
</div>
</div>

<script>
    //make unread messages number color red
    var msgCount = document.getElementById("msg-count");
    if(msgCount.innerHTML > 0){
        msgCount.style.color = "red";
    }
    //make sidebar button background clicked
    link = document.querySelector('#dashboard');
    link.style.background = "#E5E9F7";
    link.style.color = "red";


    

</script>

</body>

</html>
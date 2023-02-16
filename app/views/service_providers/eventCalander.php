<div class="service-provider-profile">
    <h2 style="margin-top:70px"> Event Calander </h2>

    <div class="header-section">
    <div class="previous-button">
    <i class="fa fa-chevron-left" aria-hidden="true"></i></div>

    <div class="month-display">
        <span>January</span>
    </div>
    <div class="next-button">
        <i class="fa fa-chevron-right" aria-hidden="true"></i>
    </div>
</div>

<div class="white-box">
<div class="calendar">

  <div class="calendar-days">

    <div class="calendar-date">1
        <div class="calender-event">
            <span>DJ fest FX</span>
        </div>
    </div>
    <div class="calendar-date">2</div>
    <div class="calendar-date">3</div>
    <div class="calendar-date">4</div>
    <div class="calendar-date">5</div>
    <div class="calendar-date">6
    <div class="calender-event">
            <span>Millenium Night</span>
        </div>
        <div class="calender-event">
            <span>DJ fest FX</span>
        </div>
    </div>
    <div class="calendar-date">7</div>
    <div class="calendar-date">8</div>
    <div class="calendar-date">9</div>
    <div class="calendar-date">10</div>
    <div class="calendar-date">11
    <div class="calender-event">
            <span>Edu Session</span>
        </div>
    </div>
    <div class="calendar-date">12</div>
    <div class="calendar-date">13</div>
    <div class="calendar-date">14</div>
    <div class="calendar-date">15</div>
    <div class="calendar-date">16</div>
    <div class="calendar-date">17</div>
    <div class="calendar-date">18
    <div class="calender-event">
            <span>DJ Night</span>
        </div>
        <div class="calender-event">
            <span>PDR vibes</span>
        </div>
    </div>
    <div class="calendar-date">19</div>
    <div class="calendar-date">20</div>
    <div class="calendar-date">21</div>
    <div class="calendar-date">22
    <div class="calender-event">
            <span>DJ Night</span>
        </div>
        <div class="calender-event">
            <span>Visiting Lecture</span>
        </div>
    </div>
    <div class="calendar-date">23</div>
    <div class="calendar-date">24</div>
    <div class="calendar-date">25</div>
    <div class="calendar-date">26</div>
    <div class="calendar-date">27
    <div class="calender-event">
            <span>DJ fest FX</span>
        </div>
    </div>
    <div class="calendar-date">28</div>
    <div class="calendar-date">29</div>
    <div class="calendar-date">30</div>
    <div class="calendar-date">31
    <div class="calender-event">
            <span>DJ fest FX</span>
        </div>
    </div>
  </div>
</div>




</div>



</div>

<script src="<?php echo URLROOT . '/public/js/form.js'; ?>"></script>

<script>
    //keeping the sidebar button clicked at the page

    link = document.querySelector('#calender');
    link.style.background = "#E5E9F7";
    link.style.color = "red";

    error = document.querySelector('.red-alert');
    error.style.color = "#FF0000"

    editButton = document.querySelector('.btn');

    if (error) {

        editButton.style.animation = "alert 2s ease 0s infinite normal forwards"
        editButton.style.color = "#FF0000"
        editButton.style.background = "#E5E9F7"

    }
</script>

</body>

</html>
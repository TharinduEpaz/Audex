<div class="service-provider-profile">

    <div class="header-section">
        <div class="previous-button">
            <a href="<?php echo URLROOT . '/service_providers/eventCalander?month=previous' ?>">
                <i class="fa fa-chevron-left" aria-hidden="true"></i> </a>
        </div>

        <div class="month-display">
            <span><?php echo $data['month'] ?></span>
        </div>
        <div class="next-button">
            <a href="<?php echo URLROOT . '/service_providers/eventCalander?month=next' ?>">
                <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
        </div>
    </div>

    <div class="white-box" style="margin-top:2vh">
        <div class="calendar">

            <div class="calendar-days">
                <?php $days_in_month = cal_days_in_month(CAL_GREGORIAN, $data['no'], date('Y')); ?>

                <?php for ($i = 1; $i <= $days_in_month; $i++) : ?>
                    <div class="calendar-date"><?php echo $i; ?>

                        <div class="calender-event">
                            <?php $currentMonth = $data['no']; ?>
                            <?php str_pad($currentMonth, 2, "0", STR_PAD_LEFT); ?>

                            <?php foreach ($data['events'] as $event) : ?>
                                <?php $eventMonth = date('m', strtotime($event->date)); ?>
                                <?php $eventDay = date('d', strtotime($event->date)); ?>

                                <?php if ($eventMonth == $currentMonth && $eventDay == $i) : ?>
                                    <span>
                                        <div data-event-target="#event" id="event-button" onclick="loadevent(<?php echo $event->event_id ?>)"><?php echo $event->name ?></div>
                                    </span>
                                <?php else : ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>


<div class="event" id="event">
    <div class="event-left">
        <div class="event-header">
            <div class="title"></div>
            <button data-close-button class="close-button">&times;</button>
        </div>
        <div class="wrapper-for-event">
        <div class="event-publisher">
            <div class="event-owenr-image">
                <img src="" alt="">
            </div>
            <span class="owner-name">John Doe</span>
            
        </div>

        <div class="event-buttons">
            <div class="like-button"><i class="fas fa-thumbs-down"></i>&nbsp&nbsp<span id="likes"></span></div>
            <div class="dislike-button"><i class="fas fa-thumbs-up"></i>&nbsp&nbsp<span id="dislikes"></span></div>
        </div>

        </div>
        
       

        <div class="event-body">

        </div>



    </div>

    <div class="event-right">
        <img src="https://images.pexels.com/photos/9493230/pexels-photo-9493230.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="">
    </div>

</div>

<div id="overlay"></div>

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

    function loadevent(event_id) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var event = JSON.parse(this.responseText);

                document.querySelector(".title").innerHTML = event.event.name;
                document.querySelector(".event-body").innerHTML = event.event.description;
                document.querySelector(".owner-name").innerHTML = `${event.name.first_name} ${event.name.second_name}`;
                document.querySelector('#likes').innerHTML = event.event.likes;
                document.querySelector('#dislikes').innerHTML = event.event.dislikes;

            }
        };

        xhttp.open("GET", "http://localhost/Audex/service_providers/getEvent?id=" + event_id, true);
        xhttp.send();

    }
</script>

</body>

</html>
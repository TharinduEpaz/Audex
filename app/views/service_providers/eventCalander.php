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
                        <span><button data-event-target = "#event" id="event-button"><?php echo $event->name ?></button></span>
                        
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
    <div class="event-header">
        <div class="title">Event Name</div>
        <button data-close-button class="close-button">&times;</button>                  
    </div>
    <div class="event-body">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Velit harum v/Audex/service_providers/eventCalanderel molestias laudantium nam magni, cum nisi consequuntur commodi id aliquam voluptate cupiditate voluptas quam, laboriosam aut, quidem debitis! Ducimus?
        Atque hic odio iste laboriosam possimus alias culpa similique fuga obcaecati, perspiciatis aliquam repellat, molestiae voluptatem molestias quibusdam rem quis ullam maxime laborum voluptas vitae tempore quisquam laudantium perferendis. Facere?
        Aperiam tempora assumenda eius facere, dolorem et esse ullam omnis eaque, cupiditate minima sed voluptas beatae velit maiores obcaecati at officia nihil ut, itaque iure animi expedita commodi! Distinctio, eligendi?
        Error in provident possimus voluptatibus? Quae reprehenderit voluptatibus expedita eum et accusamus vero omnis provident sequi non repellendus ea nisi maiores dolorum pariatur, doloribus obcaecati minus odio architecto voluptas modi.
        Quis commodi cupiditate officiis praesentium nisi eligendi ipsa sit atque architecto consectetur excepturi, quisquam repellat id nesciunt pariatur! Natus exercitationem animi itaque voluptas molestias cumque illo enim explicabo maxime deserunt!
    </div>

</div>

<div id="overlay" ></div>

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
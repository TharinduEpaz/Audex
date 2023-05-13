<div class="service-provider-profile">

    <div class="header-section">
        <div class="previous-button">
            <a href="<?php echo URLROOT . '/service_providers/eventCalander?month=previous' ?>">
                <i class="fa fa-chevron-left" aria-hidden="true"></i> </a>
        </div>
        <div class="month-display">
            <span><?php echo $data['month'] . ' ' . $data['year'] ?></span>
        </div>
        <div class="next-button">
            <a href="<?php echo URLROOT . '/service_providers/eventCalander?month=next' ?>">
                <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
        </div>
    </div>

    <div class="white-box" style="margin-top:2vh">
        <div class="calendar">

            <div class="calendar-days">
                <?php $days_in_month = cal_days_in_month(CAL_GREGORIAN, $data['month_no'], date('Y')); ?>
                <?php for ($i = 1; $i <= $days_in_month; $i++) : ?>
                    <div class="calendar-date"><span><?php echo $i; ?></span>
            
                        <button data-add-event=".add-event"> +  </button>
                        <div class="calender-event">
                            <?php $currentMonth = $data['month_no']; ?>
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
            <div class="date">2020 01 21</div>
            <div class="time">12 PM</div>
            
       
            
        </div>
        <div class="wrapper-for-event">
            <div class="event-publisher">
                <div class="event-owenr-image">
                    <img src="" alt="">
                </div>
                <span class="owner-name">John Doe</span>

            </div>

            <div class="event-buttons">
                <button class="like-button"><i class="fas fa-thumbs-up"></i>&nbsp&nbsp<span id="likes"></span></button>
                <!-- <div class="dislike-button"><i class="fas fa-thumbs-down"></i>&nbsp&nbsp<span id="dislikes"></div> -->
            </div>

        </div>



        <div class="event-body">

        </div>
        <button class="add-event-btn" id="edit-delete-event" onclick="">Edit / Delete Event</button>




    </div>

    <div class="event-right">
        <img id='event-image' src="" alt="">
    </div>

</div>

<div class="add-event">
<?php if (!empty($data['errors'])) : ?>
      <?php foreach ($data['errors'] as $error) : ?>
        <p id="error-text-box"><?php echo $error ?></p>
      <?php endforeach; ?>
    <?php endif; ?>
<div class="formbold-main-wrapper">
  
  <div class="formbold-form-wrapper">
    <form id="add-event-form" name="add-event" method="POST" enctype="multipart/form-data">
        <div class="formbold-input-flex">
          <div>
              <label for="eventname" class="formbold-form-label"> Event Name </label>
              <input
              type="text"
              name="eventname"
              id="eventname"
              placeholder="DJ Festival"
              class="formbold-form-input"
              required
              />
          </div>
          <div>
              <label for="location" class="formbold-form-label"> Location/Platform </label>
              <input
              type="text"
              name="location"
              id="lastname"
              placeholder="Nelum Pokuna"
              class="formbold-form-input"
              required
              />
          </div>
        </div>

        <div class="formbold-input-flex">
          <div>
              <label for="time" class="formbold-form-label"> Time </label>
              <input
              type="time"
              name="time"
              id="time"
              placeholder="12:00 PM"
              class="formbold-form-input"
              required
              />
          </div>
          <div>
              <label for="ticket-link" class="formbold-form-label"> Ticket Link (Optional)</label>
              <input
              type="text"
              name="ticket-link"
              id="phone"
              placeholder="www.ticketlink.com"
              class="formbold-form-input"
              />
          </div>
        </div>

        <div class="formbold-input-radio-wrapper">
            <label for="event-type" class="formbold-form-label"> Event Type </label>

            <div class="formbold-radio-flex">
              <div class="formbold-radio-group">
                <label class="formbold-radio-label">
                  <input class="formbold-input-radio" type="radio" name="event-type" id="event-type" value="public" checked>
                  Public Event
                  <span class="formbold-radio-checkmark"></span>
                </label>
              </div>

              <div class="formbold-radio-group">
                <label class="formbold-radio-label">
                  <input class="formbold-input-radio" type="radio" name="event-type" id="event-type" value="private">
                  Private Event
                  <span class="formbold-radio-checkmark"></span>
                </label>
              </div>
            
            </div>
        </div>

        <div>
            <label for="description" class="formbold-form-label"> Event Description </label>
            <textarea
                rows="6"
                name="description"
                id="description"
                placeholder="Type description here..."
                class="formbold-form-input"
            ></textarea>
        </div>
        <div>
            <label for="event-img" class="formbold-form-label"> Image </label>
            <input type="file" name="event-img" id="event-img" class="formbold-form-input" required>
        </div>

        <input type="submit" name="submit" class="formbold-btn" value="Add Event">
            
        
    </form>
    <span id="output"></span>
  </div>
</div>

</div>



<div id="overlay"></div>

<script src="<?php echo URLROOT . '/public/js/form.js'; ?>"></script>
<script src="<?php echo URLROOT . '/public/js/calander.js'; ?>"></script>


<script>
    //keeping the sidebar button clicked at the page

    link = document.querySelector('#calender');
    link.style.background = "#E5E9F7";
    link.style.color = "red";

    



</script>

</body>

</html>
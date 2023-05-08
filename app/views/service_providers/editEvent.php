<div class="service-provider-profile">
    <div class="white-box">
        <div class="edit-event">
            <div class="formbold-main-wrapper">

                <div class="formbold-form-wrapper">
                    <form id="add-event-form" name="add-event" method="POST" enctype="multipart/form-data" action="<?php echo URLROOT . '/service_providers/editEventDetails?id=' . $data['id']; ?>">
                        <div class="formbold-input-flex">
                            <div>
                                <label for="eventname" class="formbold-form-label"> Event Name </label>
                                <input type="text" name="eventname" id="eventname" placeholder="<?php echo $data['event']->name ?>" class="formbold-form-input" />
                            </div>
                            <div>
                                <label for="location" class="formbold-form-label"> Location </label>
                                <input type="text" name="location" id="lastname" placeholder="<?php echo $data['event']->location ?>" class="formbold-form-input" />
                            </div>
                        </div>

                        <div class="formbold-input-flex">
                            <div>
                                <label for="time" class="formbold-form-label"> Time </label>
                                <input type="time" name="time" id="time" class="formbold-form-input" />
                            </div>
                            <div>
                                <label for="ticket-link" class="formbold-form-label"> Ticket Link (Optional)</label>
                                <input type="text" name="ticket-link" id="phone" placeholder="<?php echo $data['event']->ticket_link ?>" class="formbold-form-input" />
                            </div>
                        </div>

                        <div class="formbold-input-radio-wrapper">
                            <label for="event-type" class="formbold-form-label"> Event Type </label>

                            <div class="formbold-radio-flex">
                                <?php if ($data['event']->event_type == 1) : ?>
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
                                <?php else : ?>
                                    <div class="formbold-radio-group">
                                        <label class="formbold-radio-label">
                                            <input class="formbold-input-radio" type="radio" name="event-type" id="event-type" value="public">
                                            Public Event
                                            <span class="formbold-radio-checkmark"></span>
                                        </label>
                                    </div>

                                    <div class="formbold-radio-group">
                                        <label class="formbold-radio-label">
                                            <input class="formbold-input-radio" type="radio" name="event-type" id="event-type" value="private" checked>
                                            Private Event
                                            <span class="formbold-radio-checkmark"></span>
                                        </label>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div>
                            <label for="description" class="formbold-form-label"> Event Description </label>
                            <textarea rows="6" name="description" id="description" placeholder="<?php echo $data['event']->description ?>" class="formbold-form-input"></textarea>
                        </div>
                        <div>
                            <label for="event-img" class="formbold-form-label"> Image </label>
                            <input type="file" name="event-img" id="event-img" class="formbold-form-input">
                        </div>
                        <div class="buttons" style="margin-top:30px">
                            <input type="submit" class="add-event-btn" id="edit-event-btn" value="Add Event">
                            <button class="cancel delete-event" id="edit-event-btn">Delete Event</button>
                        </div>




                    </form>
                    <span id="output"></span>
                </div>
            </div>

        </div>


    </div>
</div>

<script>
    //make unread messages number color red
    var msgCount = document.getElementById("msg-count");
    if (msgCount.innerHTML > 0) {
        msgCount.style.color = "red";
    }
    //make sidebar button background clicked
    link = document.querySelector('#profile-settings');
    link.style.background = "#E5E9F7";
    link.style.color = "red";


    function deleteEvent(id) {
        var r = confirm("Are you sure you want to delete this event?");
        if (r == true) {
            window.location.href = `http://localhost/Audex/service_providers/deleteEvent?id=${id}`;
        } else {
            
        }
    }
</script>

</body>

</html>
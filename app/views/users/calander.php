<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css?id=1425'; ?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/service_provider.css?id=25'; ?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/style.css?id=1445'; ?>">



    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Audex</title>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


    <!-- JQUERY LIBRARY -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .service-provider-profile {
            margin: auto;
            padding-left: 10vw;
            padding-right: 10vw;
        }

        .white-box {
            margin: 0;

        }
    </style>
</head>
<?php require_once APPROOT . '/views/users/navbar.php'; ?>



<body>
    <div class="service-provider-profile">

        <div class="header-section">
            <div class="previous-button">
                <a href="<?php echo URLROOT . '/users/calanderPublic?month=previous' ?>">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i> </a>
            </div>

            <div class="month-display">
                <span>
                    <?php echo $data['month'] . ' ' . $data['year'] ?>
                </span>
            </div>
            <div class="next-button">
                <a href="<?php echo URLROOT . '/users/calanderPublic?month=next' ?>">
                    <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
            </div>
        </div>

        <div class="white-box" style="margin-top:2vh">
            <div class="calendar">

                <div class="calendar-days">
                    <?php $days_in_month = cal_days_in_month(CAL_GREGORIAN, $data['month_no'], date('Y')); ?>
                    <?php for ($i = 1; $i <= $days_in_month; $i++): ?>
                        <div class="calendar-date"><span>
                                <?php echo $i; ?>
                            </span>

                            <div class="calender-event">
                                <?php $currentMonth = $data['month_no']; ?>
                                <?php str_pad($currentMonth, 2, "0", STR_PAD_LEFT); ?>

                                <?php foreach ($data['events'] as $event): ?>
                                    <?php $eventMonth = date('m', strtotime($event->date)); ?>
                                    <?php $eventDay = date('d', strtotime($event->date)); ?>

                                    <?php if ($eventMonth == $currentMonth && $eventDay == $i): ?>
                                        <span>
                                            <div data-event-target="#event" id="event-button"
                                                onclick="loadevent(<?php echo $event->event_id ?>)"><?php echo $event->name ?></div>
                                        </span>
                                    <?php else: ?>
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

                <!-- <button data-close-button class="close-button">&times;</button> -->

            </div>
            <div class="wrapper-for-event">
                
                   
                    <span class="owner-name">John Doe</span>

               

                <div class="event-buttons">
                    <div class="like-button"><i class="fas fa-thumbs-up"></i>&nbsp&nbsp<span id="likes"></span></div>
                    <div class="dislike-button"><i class="fas fa-thumbs-down"></i>&nbsp&nbsp<span id="dislikes"></span>
                    </div>
                </div>

            </div>
            <div class="event-body">

            </div>



        </div>

        <div class="event-right">
            <img src="" alt="" id="event-img">
        </div>

    </div>

    <div id="overlay"></div>

    <script src="<?php echo URLROOT . '/public/js/form.js'; ?>"></script>
    <script src="<?php echo URLROOT . '/public/js/calander_public.js'; ?>"></script>
</body>

</html>
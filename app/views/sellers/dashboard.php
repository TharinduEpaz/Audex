<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/advertise.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/service_provider.css?id=25';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script type="text/javascript" src="<?php echo URLROOT . '/public/js/moment.min.js';?>"></script>
    <script type="text/javascript" src="<?php echo URLROOT . '/public/js/moment-timezone-with-data.js';?>"></script>
    <title>Advertisement</title>
</head>
<body>
    <style>
        p{
            color: black;
            font-weight: 700;
        }
        .service-provider-profile {
          width: calc(100vw - 240px);
        }
        .service-provider-profile .white-box .dashboard-item {
            width: 30%;
            height: 28vh;
        }
        @media (max-width: 860px){
          .service-provider-profile{
          width: calc(100vw - 70px);
          margin-left: 70px;
        
          }
        }

        /* @media print{
            .sidebar, nav{
                display: none;
            }
            .main{
                width: 100vw;
                left: 0;
            }
            .service-provider-profile{
                width: 100vw;
                left: 0;
                padding: auto;
            }
            .white-box{
                width: 95vw;
                left: 0;
            }
            .stat{
                width: 90vw;
                left: 0;
            }


        } */
    </style>
<?php require_once APPROOT . '/views/sellers/navbar.php';?>
<?php require_once APPROOT . '/views/sellers/sidebar.php';?>
<div class="service-provider-profile">
    <div class="white-box" style="margin-left: 5%;width:72vw">

    <div class="dashboard-title" id="dashboard_seller">
        <p>Welcome <?php echo $_SESSION['user_name'];?> !!</p>
        <p>This is your dashboard</p>
                <!-- <?php echo '<pre>'; print_r($data); echo '</pre>';?> -->

    </div>
        <div class="stat">
            <div class="graph1" style="margin-bottom: 2vh;">
                <canvas id="graph1" width="20px" height="20px"></canvas>
            </div>
            <div class="graph2" style="margin-bottom: 2vh;">
                <canvas id="graph2" width="20px" height="20px"></canvas>
            </div>
            <div class="graph3" style="margin-bottom: 2vh;">
                <canvas id="graph3" width="20px" height="20px"></canvas>
            </div>
            <div class="graph4" style="width: 49%;">
                <canvas id="graph4" width="20px" height="20px"></canvas>
            </div>
            <div class="graph5" style="width: 49%;">
                <canvas id="graph5" width="20px" height="20px"></canvas>
            </div>
        </div>
        <!-- <button class="btn_print" id="btn_print">Print</button> -->

        <script>
            //Graph1-Pie chart 1(No of auctions and the fixed prices of the seller)
            const auctionCount = <?php echo $data['no_auctions']->count ;?>;
            const fixedPriceCount = <?php echo $data['no_fixed_ads']->count ;?>;

            const data1 = {
                labels: ['Live Auctions('+auctionCount+')', 'Fixed Prices('+fixedPriceCount+')'],
                datasets: [
                  {
                    data: [auctionCount, fixedPriceCount],
                    backgroundColor: ['#ff6384', '#36a2eb'],
                    borderWidth: 1
                  }
                ]
            };
        
            const config1 = {
              type: 'pie',
              data: data1,
              options: {
                responsive: true,
                plugins: {
                  legend: {
                    position: 'top',
                  },
                  title: {
                    display: true,
                    text: 'Auctions vs Fixed Prices',
                        color: 'black',
                        font: {
                          size: 14
                        }
                  }
                }
              },
            };
            var myChart1 = new Chart(
                document.getElementById('graph1'),
                config1
            );
            
            //Graph2-Bar chart for the total advertisements views per day
            var data = <?php echo json_encode($data['view_count']); ?>;
            // Extract the dates and counts from the data
            var view_dates = data.map(function(item) {
                return item.date;
            });
            var view_counts = data.map(function(item) {
                return item.count;
            });
            const data2 = {
                labels: view_dates,
                datasets: [
                  {
                    data:  view_counts,
                    label: 'View count',
                    borderColor: "rgba(0, 123, 255, 1)",
                    backgroundColor: "rgba(0, 123, 255, 0.7)",
                    fill: true,
                    tension: 1,
                  }
                ]
            };
            const config2 = {
              type: 'bar',
              data: data2,
              options: {
                responsive: true,
                plugins: {
                  legend: {
                    position: 'top',
                  },
                  title: {
                    display: true,
                    text: 'Total advertisements views per day',
                        color: 'black',
                        font: {
                          size: 14
                        }
                  }
                },
                scales: {
                    x: {
                      beginAtZero: true,
                      grid: {
                        display: false
                      },
                      ticks: {
                        color: 'black',
                        font: {
                          size: 14
                        }
                      },
                      title: {
                        display: true,
                        text: 'Date',
                        color: 'black',
                        font: {
                          size: 14
                        }
                      }
                    },
                    y: {
                      beginAtZero: true, //y-axis starts from 0
                      precision: 0,   //Removes decimals from the y-axis values
                      grid: {
                        display: true
                      },
                      ticks: {
                        stepSize: 1, // Forces the y-axis to display only integer values
                        color: 'black',
                        font: {
                          size: 14
                        }
                      },
                      title: {
                        display: true,
                        text: 'View count',
                        color: 'black',
                        font: {
                          size: 14
                        }
                      }
                    }
                }
              },
            };
            var myChart = new Chart(
                document.getElementById('graph2'),
                config2
            );
            //Graph3-Bar chart for the rates
            var feedbacks_rate = <?php echo json_encode($data['feedbacks_rate']); ?>;
            // Extract the dates and counts from the data
            var feedbacks_rate = feedbacks_rate.map(function(item) {
                return item;
            });
            const data3 = {
                labels: ["1", "2", "3", "4", "5"],
                datasets: [
                  {
                    data:  feedbacks_rate,
                    label: 'Rate count('+<?php echo $data['feedbackcount'];?>+")",
                    borderColor: "rgba(255, 239, 0, 0.42)",
                    backgroundColor: "rgba(185, 28, 243, 0.99)",
                    fill: true,
                    tension: 1,
                  }
                ]
            };
            const config3 = {
              type: 'bar',
              data: data3,
              options: {
                responsive: true,
                plugins: {
                  legend: {
                    position: 'top',
                  },
                  title: {
                    display: true,
                    text: 'Total rates',
                        color: 'black',
                        font: {
                          size: 14
                        }
                  }
                },
                scales: {
                    x: {
                      beginAtZero: true,
                      grid: {
                        display: false
                      },
                      ticks: {
                        color: 'black',
                        font: {
                          size: 14
                        }
                      },
                      title: {
                        display: true,
                        text: 'Rate',
                        color: 'black',
                        font: {
                          size: 14
                        }
                      }
                    },
                
                    y: {
                      beginAtZero: true,
                      beginAtZero: true, //y-axis starts from 0
                      precision: 0,   //Removes decimals from the y-axis values
                      grid: {
                        display: true
                      },
                      ticks: {
                        stepSize: 1, // Forces the y-axis to display only integer values
                        color: 'black',
                        font: {
                          size: 14
                        }
                      },
                      title: {
                        display: true,
                        text: 'Count',
                        color: 'black',
                        font: {
                          size: 14
                        }
                      }
                    }
                }
              },
            };
            var myChart = new Chart(
                document.getElementById('graph3'),
                config3
            );
            //Graph4-Bar chart for the total likes/dislikes per day
            // Retrieve the data passed from the controller
            var likes_startDate = '<?php echo $data['startDate']->format('Y-m-d'); ?>';
            var likes_endDate = '<?php echo $data['endDate']->format('Y-m-d'); ?>';
            var likes_dates = <?php echo json_encode($data['likes_date']); ?>;
            var likes_counts = <?php echo json_encode($data['likes_counts']); ?>;
            
            // Generate an array of dates within the desired range
            var likes_labels = [];
            var likes_currentDate = new Date(likes_startDate);
            likes_endDate = new Date(likes_endDate);
            
            while (likes_currentDate <= likes_endDate) {
                likes_labels.push(likes_currentDate.toISOString().split('T')[0]);
                likes_currentDate.setDate(likes_currentDate.getDate() + 1);
            }
        
            // Map count values to the corresponding dates
            var likes_data = likes_labels.map(function(date) {
                var index = likes_dates.indexOf(date);
                return index !== -1 ? likes_counts[index] : 0;
            });

            var dislikes_startDate = '<?php echo $data['startDate_dislikes']->format('Y-m-d'); ?>';
            var dislikes_endDate = '<?php echo $data['endDate_dislikes']->format('Y-m-d'); ?>';
            var dislikes_dates = <?php echo json_encode($data['dislikes_date']); ?>;
            var dislikes_counts = <?php echo json_encode($data['dislikes_counts']); ?>;

            // Generate an array of dates within the desired range
            var dislikes_labels = [];
            var dislikes_currentDate = new Date(dislikes_startDate);
            dislikes_endDate = new Date(dislikes_endDate);

            while (dislikes_currentDate <= dislikes_endDate) {
                dislikes_labels.push(dislikes_currentDate.toISOString().split('T')[0]);
                dislikes_currentDate.setDate(dislikes_currentDate.getDate() + 1);
            }

            // Map count values to the corresponding dates
            var dislikes_data = dislikes_labels.map(function(date) {
                var index = dislikes_dates.indexOf(date);
                return index !== -1 ? dislikes_counts[index] : 0;
            });

            const data4 = {
                labels: likes_labels,dislikes_labels,
                datasets: [
                  {
                    data:  likes_data,
                    label: 'Likes count',
                    borderColor: "rgba(0, 123, 255, 1)",
                    backgroundColor: "rgba(0, 123, 255, 0.7)",
                    fill: true,
                    tension: 1,
                  },
                  {
                    data:  dislikes_data,
                    label: 'Dislikes count',
                    borderColor: "rgba(255, 0, 255, 1)",
                    backgroundColor: "rgba(255, 0, 255, 0.7)",
                    fill: true,
                    tension: 1,
                  }
                ]
            };
            const config4 = {
              type: 'bar',
              data: data4,
              options: {
                responsive: true,
                plugins: {
                  legend: {
                    position: 'top',
                  },
                  title: {
                    display: true,
                    text: 'Total likes/dislikes per day for 3 months',
                        color: 'black',
                        font: {
                          size: 14
                        }
                  }
                },
                scales: {
                    x: {
                      beginAtZero: true,
                      grid: {
                        display: false
                      },
                      ticks: {
                        color: 'black',
                        font: {
                          size: 14
                        }
                      },
                      title: {
                        display: true,
                        text: 'Date',
                        color: 'black',
                        font: {
                          size: 14
                        }
                      }
                    },
                    y: {
                      beginAtZero: true, //y-axis starts from 0
                      precision: 0,   //Removes decimals from the y-axis values
                      grid: {
                        display: true
                      },
                      ticks: {
                        stepSize: 1, // Forces the y-axis to display only integer values
                        color: 'black',
                        font: {
                          size: 14
                        }
                      },
                      title: {
                        display: true,
                        text: 'Like / Dislike count',
                        color: 'black',
                        font: {
                          size: 14
                        }
                      }
                    }
                }
              },
            };
            var myChart = new Chart(
                document.getElementById('graph4'),
                config4
            );
            //Graph5-Line chart for the products added in this year
            var products_count = <?php echo json_encode($data['products_count']); ?>;
            // Extract the dates and counts from the data
            var products_count = products_count.map(function(item) {
                return item;
            });
            const data5 = {
                labels: ["jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec"],
                datasets: [
                  {
                    data:  products_count,
                    label: 'Product count',
                    borderColor: "rgba(0, 123, 255, 1)",
                  }
                ]
            };
            const config5 = {
              type: 'line',
              data: data5,
              options: {
                responsive: true,
                plugins: {
                  legend: {
                    position: 'top',
                  },
                  title: {
                    display: true,
                    text: 'Products added in this year',
                        color: 'black',
                        font: {
                          size: 14
                        }
                  }
                },
                scales: {
                    x: {
                      beginAtZero: true,
                      grid: {
                        display: false
                      },
                      ticks: {
                        color: 'black',
                        font: {
                          size: 14
                        }
                      },
                      title: {
                        display: true,
                        text: 'Month',
                        color: 'black',
                        font: {
                          size: 14
                        }
                      }
                    },
                    y: {
                      beginAtZero: true, //y-axis starts from 0
                      precision: 0,   //Removes decimals from the y-axis values
                      grid: {
                        display: true
                      },
                      ticks: {
                        stepSize: 1, // Forces the y-axis to display only integer values
                        color: 'black',
                        font: {
                          size: 14
                        }
                      },
                      title: {
                        display: true,
                        text: 'Products added count',
                        color: 'black',
                        font: {
                          size: 14
                        }
                      }
                    }
                }
              },
            };
            var myChart = new Chart(
                document.getElementById('graph5'),
                config5
            );
        </script>

    <!-- <div class="dashboard-item" id="">
        <h1 id="msg-count" style="color: black;"><?php echo $data['feedbackcount'] ;?></h1>
        <p>Reviews</p>
    </div>

    <div class="dashboard-item" id="">
        <h1 id="profile-views"><?php echo $data['no_auctions']->count ;?></h1>
        <p>Live Auctions</p>
    </div>

    <div class="dashboard-item" id="">
        <h1 id="Likes"><?php echo $data['likes_dislikes']['likes'];?></h1>
        <p>Total Likes</p>
    </div>

    <div class="dashboard-item" id="">
        <h1 id="Events"><?php echo $data['likes_dislikes']['dislikes'];?></h1>
        <p>Total Dislikes</p>
    </div>
    <div class="dashboard-item" id="">
        <h1 id="Flags" style="color: red;">0</h1>
        <p>Flags</p>
    </div>
    <div class="dashboard-item" id="">
        <h1 id="profile"><?php echo $data['no_views']->count;?></h1>
        <p>Advertisements Views</p>
    </div> -->

</div>
</div>
</body>


<script>

    //keeping the sidebar button clicked at the page
    link = document.querySelector('#dashboard');
    link.style.background = "#E5E9F7";
    link.style.color = "red";
    link.style.fontWeight = "800";
    
    //Print button
    // window.onload = function() {
    //     document.getElementById("btn_print").onclick = function() {
    //         window.print();
    //     }
    // }
</script>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>

</html>

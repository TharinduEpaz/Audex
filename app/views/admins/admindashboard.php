<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/form.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/manageuser.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/sidebar.css';?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/admindashboard.css';?>">
    
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/seller_advertisement.css';?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" ></script> -->
    <script src="https://kit.fontawesome.com/128d66c486.js" crossorigin="anonymous"></script>
    <title>Manage User</title>
</head>
<body>
<?php require_once APPROOT . '/views/admins/navbar.php';?>
   
    <div class="container">
    <?php require_once APPROOT . '/views/admins/sidebar.php';?>        

    <div class="poster_advertisements1">
        <div class="whitebox1">

            <div class="view-report">
                <h4>View report from here</h4>
                <button class="view-report-btn" onclick="viewreport()" >View</button>
            </div>
            <div class="dashboard-content">

                <div class="cardBox">
                   <div class="card"> 
                    <div>
                        <div class="numbers"><?php echo $data['details'][0]->num_users; ?></div>
                        <div class="cardName">Users</div>
                    </div>
                    <div class="iconBox">
                    <i class="fa-solid fa-users"></i>
                    </div>
                   </div>

                   <div class="card"> 
                    <div>
                        <div class="numbers"><?php echo $data['details'][0]->num_sellers; ?></div>
                        <div class="cardName">Sellers</div>
                    </div>
                    <div class="iconBox">
                    <i class="fa-solid fa-cart-shopping"></i>                    </div>
                   </div>

                   <div class="card"> 
                    <div>
                        <div class="numbers"><?php echo $data['details'][0]->num_service_providers; ?></div>
                        <div class="cardName">Service Providers</div>
                    </div>
                    <div class="iconBox">
                    <i class="fa-solid fa-music"></i>                    </div>
                   </div>

                   <div class="card"> 
                    <div>
                        <div class="numbers"><?php echo $data['details'][0]->num_products; ?></div>
                        <div class="cardName">Products</div>
                    </div>
                    <div class="iconBox">
                    <i class="fa-solid fa-headphones"></i>
                    </div>
                   </div>
                </div>

            </div>

            <div class="charts" style="display: flex;">

                <!-- <?php echo '<pre>'; print_r($data); echo '</pre>';?> -->
                <div class="graph1" style="margin-bottom: 2vh;width:100%">
                    <canvas id="graph1" width="20px" height="20px"></canvas>
                </div>

                <div class="graph2" style="margin-bottom: 2vh;width:100%">
                <canvas id="graph2" width="20px" height="20px"></canvas>
                </div>

            </div>
            <script>
                //Graph1-Pie chart 1(No of auctions and the fixed prices of the seller)
            const auctionCount = <?php echo $data['producttype'][0]->count ;?>;
            const fixedPriceCount = <?php echo $data['producttype'][1]->count ;?>;
            

            const data1 = {
                labels: ['Auctions('+auctionCount+')', 'Fixed Prices('+fixedPriceCount+')'],
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

            //Graph2-Line chart for the views count in this year
            var view_count = <?php echo json_encode($data['viewcount']); ?>;
            // Extract the dates and counts from the data
            var view_count = view_count.map(function(item) {
                return item;
            });
            const data2 = {
                labels: ["jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec"],
                datasets: [
                  {
                    data:  view_count,
                    label: 'View count',
                    borderColor: "rgba(0, 123, 255, 1)",
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
                    text: 'Views count in this year',
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
                      ticks: {
                          stepSize: 1 // Forces the y-axis to display only integer values
                      },
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
                        text: 'Views count',
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
            </script>

            <div class="top-rated-sellers">
                <div class="cardHeader">
                    <h3>Top Rated Sellers</h3>
                </div>
                <table class="seller-table">
                <thead>
                            <tr>
                            
                            <th> Profile Image</th>
                            <th>First Name</th>
                            <th>Second Name</th>
                            <th>Email</th>
                            <th>Registered Date</th>
                            </tr>
                        </thead>
                    <tbody>
                    <?php foreach ($data['toprated'] as $detail):  ?>
                    <tr>
                        <td>
                            <div class="imgBx"><img src="<?php echo URLROOT.'/public/uploads/'.$detail->profile_pic;?>"></div>
                        </td>
                        <td class="td-except"><?php echo $detail->first_name?></td>
                        <td class="td-except"><?php echo $detail->second_name?></td>
                        <td class="td-except"><?php echo $detail->email?></td>
                        <td class="td-except"><?php echo $detail->registered_date?></td>

                     </tr>
                     <?php endforeach; ?>
                     </tbody>
                </table>




            </div>


        
        </div>        
            
        

    </div>
</body>
<script src="<?php echo URLROOT . '/public/js/form.js';?>"></script>
<script>
    function viewreport(){
        // var url = 'http://localhost/Audex/admins/adminviewreport/';
        window.location.href="<?php echo URLROOT . '/admins/adminviewreport/';?>"
    }
     //keeping the sidebar button clicked at the page
     link = document.querySelector('#dashboard');
    link.style.background = "#E5E9F7";
    link.style.color = "red";
    link.style.fontWeight = "800";
</script>
</html>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

     <!-- chart js -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>

    <title>Dashboard Designed Using Bootstrap5 & Chart JS  by devbanban.com</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col col-sm-12">
          <div class="alert alert-primary" role="alert">
            <h4> Dashboard Template using Bootstrap5 & Chart JS</h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-6 col-sm-3">
          <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
            <div class="card-header">
              <ion-icon name="people-outline"></ion-icon>
            รายการสมาชิก 
          </div>
            <div class="card-body">
              <h5 class="card-title">จำนวน 5,000 คน</h5>
              <p class="card-text">
                <a href="https://devbanban.com/?p=4425" class="text-white" style="text-decoration: none;"> more detail...</a>
              </p>
            </div>
          </div>
        </div>

       <div class="col-6 col-sm-3">
          <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
            <div class="card-header">
              <ion-icon name="cart-outline"></ion-icon>
            รายการออเดอร์
          </div>
            <div class="card-body">
              <h5 class="card-title">จำนวน 900,000 ออเดอร์</h5>
              <p class="card-text">
                <a href="https://devbanban.com/?p=2867" class="text-white" style="text-decoration: none;"> more detail...</a>
              </p>
            </div>
          </div>
        </div>

       
       <div class="col-6 col-sm-3">
          <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
            <div class="card-header">
              <ion-icon name="desktop-outline"></ion-icon>
            รายการสินค้า 
          </div>
            <div class="card-body">
              <h5 class="card-title">จำนวน 9,999 รายการ</h5>
              <p class="card-text">
                <a href="https://devbanban.com/?p=4425" class="text-white" style="text-decoration: none;"> more detail...</a>
              </p>
            </div>
          </div>
        </div>

        <div class="col-6 col-sm-3">
          <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
            <div class="card-header">
              <ion-icon name="cash-outline"></ion-icon>
            ยอดขาย
          </div>
            <div class="card-body">
              <h5 class="card-title"> 11,500,000  บาท</h5>
              <p class="card-text">
                <a href="https://devbanban.com/?p=2867" class="text-white" style="text-decoration: none;"> more detail...</a>
              </p>
            </div>
          </div>
        </div>
      </div> <!-- //row -->

      <div class="row">
      <div class="col-sm-12">

        <canvas id="myChart" height="100px"></canvas>
              <script>
              var ctx = document.getElementById("myChart").getContext('2d');
              var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
              labels: ['2022', '2021', '2020', '2019'  ],
              datasets: [{
              label: 'รายงานภาพรวม แยกตามปี (บาท)',
              data: ['1000000','2500000','5000000', '3000000'],
              backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
              }]
              },
              options: {
              scales: {
              yAxes: [{
              ticks: {
              beginAtZero:true
              }
              }]
              }
              }
              });
              </script>
        
      </div>
       </div> <!-- //row -->
    </div> <!-- //container -->

    <footer style="margin-top: 100px">
      <center> desiged by <a href="https://devbanban.com/"> devbanban.com </a> 2022</center>
    </footer>
    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- ionicon -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!--
    ionicon docs เข้าไปอ่านกันหน่อย
    *Usage : https://ionic.io/ionicons/usage
    *All icon : https://ionic.io/ionicons
    -->

   
  </body>
</html>
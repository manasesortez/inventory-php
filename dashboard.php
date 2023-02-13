<link rel="stylesheet" href="style.css" type="text/css">
<?php

include_once'connectdb.php';
session_start();

if($_SESSION['useremail']=="" OR $_SESSION['role']==""){
  header('location:index.php');
}

$select = $pdo->prepare("select sum(total) as t , count(invoice_id) as inv from tbl_invoice");
$select->execute();
$row = $select -> fetch(PDO::FETCH_OBJ);

$total_order=$row->inv;
$net_total=$row->t;

$select=$pdo->prepare("select order_date, total from tbl_invoice group by order_date LIMIT 30");  
$select->execute();
$ttl = [];
$date = [];
            
while($row=$select->fetch(PDO::FETCH_ASSOC)){
  extract($row);
    $ttl[]=$total;
    $date[]=$order_date;
}          

if($_SESSION['role']=="Admin"){
  include_once'header.php';
}else{
  include_once'headeruser.php';
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Admin Dashboard
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">dashboard</li>
      </ol>
    </section>
 
    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
      <div class="box-body">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h2><?php echo $total_order;?></h2>
                  <p>Ordenes</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag" style = "margin-top:15px;"></i>
                </div>
                <a href="orderlist.php" class="small-box-footer">Mas Info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h2><?php echo "$".number_format($net_total,2); ?><sup style="font-size: 20px"></sup></h2>
                  <p>Ingresos</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars" style = "margin-top:15px;"></i>
                </div>
                <a href="tablereport.php" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <?php 
              $select = $pdo->prepare("SELECT count(pname) AS p FROM tbl_product");
              $select->execute();
              $row = $select -> fetch(PDO::FETCH_OBJ);

              $total_product=$row->p;
            ?>

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h2><?php echo $total_product;?></h2>
                  <p>Productos</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add" style = "margin-top:15px;"></i>
                </div>
                <a href="productlist.php" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <?php 
            $select = $pdo->prepare('SELECT count(category) AS cate FROM tbl_category');
            $select->execute();
            $row = $select -> fetch(PDO::FETCH_OBJ);

            $total_category=$row->cate;
            ?>

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h2><?php echo $total_category; ?></h2>
                  <p>Categorias</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph" style = "margin-top:15px;"></i>
                </div>
                <a href="category.php" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->

          <div class="box box-warning">           
            <div class="box-header with-border">
                <h3 class="box-title">Ganancias por Fecha</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <div class="chart">
                  <canvas id="earningbydate" style="height: 250px;"></canvas>
                </div>
            </div>
          </div>
          <!-- Main row -->
          <div class="row">

            <div class="col-md-12">
              <div class="box box-info">           
                <div class="box-header with-border">
                  <h3 class="box-title">Producto más Vendido</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                <table id="bestsellingproduct" class="table table-striped">
                  <thead>
                    <tr>
                    <th>ID</th>
                    <th>Nombre del Producto</th>   
                    <th>Cantidad</th>   
                    <th>Precio</th>
                    <th>Total</th> 
                           
                    </tr>    
                  </thead>
                  <tbody>
                    <?php
                    $select=$pdo->prepare("select product_id, product_name, price, sum(qty) as q , sum(qty*price) as total from tbl_invoice_details group by product_id ORDER BY sum(qty) DESC LIMIT 15"); 
                    $select->execute();  
                    while($row=$select->fetch(PDO::FETCH_OBJ)  ){
                        echo'
                        <tr>
                          <td>'.$row->product_id.'</td>
                          <td>'.$row->product_name.'</td>
                          <td><span class="label label-info">'.$row->q.'</span></td>
                          <td><span class="label label-success">'."$ ".$row->price.'</span></td>
                          <td><span class="label label-danger">'."$ ".$row->total.'</span></td>

                        </tr>
                        ';
                    }          
                    ?>        
                    </tbody>               
                  </table>  
                </div>
              </div>
            </div>

  
          </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  

<script>
    var ctx = document.getElementById('earningbydate').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: <?php echo json_encode($date);?>,
            datasets: [{
                label: 'Ganancia total',
                backgroundColor: 'rgb(299, 99, 150)',
                borderColor: 'rgb(255, 99, 132)',
                data: <?php echo json_encode($ttl);?>
            }]
        },

        // Configuration options go here
        options: {}
    });
</script>

<script>
  $(document).ready( function () {
    $('#bestsellingproduct').DataTable({
         
    });
} );
</script>

<script>
  $(document).ready( function () {
    $('#orderlisttable').DataTable({
        "order":[[0,"desc"]]    
     });
} );  
</script>

  <?php

include_once'footer.php';

?>
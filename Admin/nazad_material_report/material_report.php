<?php
//echo "<pre>";
require_once('../header.php');
$id=$_GET['id'];
$name=$_GET['name'];
//$con = new mysqli('localhost', 'root', '', 'production_automation');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2" style="background:blue;color:white">
                <div class="col-sm-6">
                    <h1><?php echo $name ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="h3">Stock Details</div>
        <!-- Default box -->
        <div class="card">
            <div class="container">
            </div>
            <table class="table table-bordered table-success table-striped">
                <thead>
                    <tr class="table-primary">
                        <th>date</th>
                        <th>Total purchase</th>
                        <th>Wastage</th>
                        <th>Return to Supplier</th>
                        <th> Stock in </th>
                        <th>Stock out</th>
                        <th>Closing Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $today=date("Y-m-d");
                        $convert = strtotime($today);
                        $tomorrow=strtotime('+1 day', $convert);
                    $ostock = 0;
                    $sreturn = 0;
                    $mwastage = 0;
                    for ($i=0;$i<30;$i++) {
                       $tomorrow= strtotime('-1 day', $tomorrow);
                            $date_count=date('Y-m-d', $tomorrow);
                    ?>
                        <tr>
                            <td>
                                <?php echo $date_count ?>
                            </td>
                            <td>
                                <?php
                                $quantity = $con->query("SELECT SUM(quantity) as qq FROM `purchase` WHERE material_id=$id and  date LIKE '$date_count%'")->fetch_assoc();
                                echo round($quantity['qq']);
                                $ostock = round($quantity['qq']);
                                ?>
                            </td>
                            <td>
                                <?php $wastage = $con->query("SELECT SUM(quantity) as qq FROM `material_wastage` WHERE material_id=$id and date LIKE '$date_count%'")->fetch_assoc();
                                echo round($wastage['qq']);
                                $mwastage = round($wastage['qq']);
                                ?>
                            </td>
                            <td>
                                <?php $return = $con->query("SELECT SUM(quantity) as qq FROM `stock_return` WHERE material_id=$id and date LIKE '$date_count%'")->fetch_assoc();
                                echo round($return['qq']);
                                $sreturn = round($return['qq']);
                                ?>
                            </td>
                            <td>
                                <?php echo $ostock - $sreturn - $mwastage ?>
                            </td>
                            <td>
                                <?php echo "0" ?>
                            </td>
                            <td>
                                <?php echo $ostock - $sreturn - $mwastage ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
require_once('../footer.php')
?>

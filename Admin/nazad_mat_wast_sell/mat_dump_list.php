<?php
require_once("../header.php");
//$con = new mysqli('localhost', 'root', '', 'production_automation');
// search by date;
$serror = '';
$eerror = '';
if (isset($_POST['submit1'])) {
    $sdate = $_POST['s_date'];
    $edate = $_POST['e_date'];

    if (empty($sdate) || empty($edate)) {
        if (empty($sdate)) {
            $serror = "input from date";
        } else {
            $serror = "";
        }
        if (empty($edate)) {
            $eerror = "input to date";
        } else {
            $eerror = "";
        }
        $sale = $con->query("select * from  material_wastage_dump ")->fetch_all(MYSQLI_ASSOC);
    } else {
        $sale = $con->query("select * from  material_wastage_dump where date  between '$sdate' and '$edate' ")->fetch_all(MYSQLI_ASSOC);
    }
} else {
    $sale = $con->query("select * from  material_wastage_dump ")->fetch_all(MYSQLI_ASSOC);
}
// search by name
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $sale = $con->query("select material_wastage_sale.*,secondary_buyer.*,raw_materials.* from material_wastage_sale join secondary_buyer on secondary_buyer.id=material_wastage_sale.secondary_buyer_id join raw_materials on material_wastage_sale.material_id=raw_materials.id WHERE secondary_buyer.name='$name' or raw_materials.name='$name'  ")->fetch_all(MYSQLI_ASSOC);
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Material Wastage Dump</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Material Wastage Dump</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <h3 class="card-title">Material Wastage Dump</h3>
                            </div>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-danger table-striped">
                            <tr>
                                <th>wastage Quantity</th>
                                <th>Dump Quantity</th>
                                <th>Stock for sell</th>
                                <th>Sell Quantity</th>
                                <th>Avaiable</th>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    $wastage_quantity = $con->query("SELECT SUM(quantity) as wq FROM `material_wastage`")->fetch_assoc();
                                    echo round($wastage_quantity['wq']);
                                    $was_q = round($wastage_quantity['wq']);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $wastage_dump = $con->query("SELECT SUM(quantity) as wd FROM `material_wastage_dump`")->fetch_assoc();
                                    echo round($wastage_dump['wd']);
                                    $was_d = round($wastage_dump['wd']);
                                    ?>
                                </td>
                                <td><?php echo $was_q - $was_d ?></td>
                                <td>
                                    <?php
                                    $wastage_sale = $con->query("SELECT SUM(quantity) as ws FROM `material_wastage_sale`")->fetch_assoc();
                                    echo round($wastage_sale['ws']);
                                    $was_s = round($wastage_sale['ws']);
                                    ?>
                                </td>
                                <td><?php echo $was_q - $was_d - $was_s ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="row">
                        <div class=" col-6">
                            <div class="text-left">
                                
                            </div>
                        </div>
                        <div class=" col-6">
                            <div class="text-right">
                                
                            </div>
                        </div>


                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-primary table-striped">


                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Date</th>
                                    <th>Material Name</th>
                                    <th>Dump Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $quantity = "";
                                $price = "";
                                $total = 0;
                                foreach ($sale as $i => $p) {

                                ?>

                                    <tr>
                                        <td>
                                            <?php echo ++$i ?>
                                        </td>
                                        <td>
                                            <?php echo $p['date'] ?>
                                        </td>
                                        <td>
                                            <?php $dump = $con->query("select * from raw_materials where id=" . $p['material_id'])->fetch_assoc();
                                            echo $dump['name'] ?>
                                        </td>
                                        <td>
                                            <?php $quantity = round($p['quantity']);
                                            echo round($p['quantity']) ?>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>

                        </table>
                        <a href="mat_sell_add.php" class="btn btn-primary btn-md">Sell Product</a>
                        <a href="mat_dump_add.php" class="btn btn-primary btn-md">Add Dump</a>
                    </div>
                    <!-- /.card-body -->

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

</div>
<!-- /.content-wrapper -->

<?php
require_once("../footer.php");
?>
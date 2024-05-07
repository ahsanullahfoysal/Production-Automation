<?php
require_once("../header.php");
//require_once('../database_con.php');
// search by date;
?>
<script>
    $(document).ready(function () {

        $('#formValidation').validate({ // initialize the plugin
            rules: {
                name: {
                    required: true,
                }
            }
        });
        $('#formValidation1').validate({ // initialize the plugin
            rules: {
                s_date: {
                    required: true,
                },
                e_date: {
                    required: true,
                }
            }
        });

    });
</script>

<?php




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
        $sale = $con->query("select * from material_wastage_sale ")->fetch_all(MYSQLI_ASSOC);
    } else {
        $sale = $con->query("select * from material_wastage_sale where date  between '$sdate' and '$edate' ")->fetch_all(MYSQLI_ASSOC);
    }
} else {
    $sale = $con->query("select * from material_wastage_sale ")->fetch_all(MYSQLI_ASSOC);
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
                    <h1>Material Wastage Sale</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Material Wastage Sale</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <h3 class="card-title">Material Wastage Sale</h3>
                            </div>
                            <div class="col-md-2 offset-8 text-right">
                                <a href="<?php echo $_SESSION['base_url'] ?>/nazad_mat_wast_sell/mat_sell_add.php"
                                    class="btb btn-warning">Add Wastage Material</a>
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
                                <td>
                                    <?php echo $was_q - $was_d ?>
                                </td>
                                <td>
                                    <?php
                                    $wastage_sale = $con->query("SELECT SUM(quantity) as ws FROM `material_wastage_sale`")->fetch_assoc();
                                    echo round($wastage_sale['ws']);
                                    $was_s = round($wastage_sale['ws']);
                                    ?>
                                </td>
                                <td>
                                    <?php echo $was_q - $was_d - $was_s ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="row">
                        <div class=" col-6">
                            <div class="text-left">
                                <form action="" method="post" id="formValidation">
                                    <label>Search :</label>
                                    <input type="text" name="name" id="name" value="<?php if (isset($name)) {
                                        echo $name;
                                    } ?>" placeholder="name/buyer"
                                        required>
                                    <span style="color:red" id="e_error">
                                        <?php echo $eerror; ?>
                                    </span>
                                    <input class="btn btn-primary" type="submit" name="submit" value="Search">
                                </form>
                            </div>
                        </div>
                        <div class=" col-6">
                            <div class="text-right">
                                <form action="" method="post" id="formValidation1">
                                    <label>From : </label>
                                    <input type="date" name="s_date" id="s_date" value="<?php if (isset($sdate)) {
                                        echo $sdate;
                                    } ?>" required>
                                    <span style="color:red" id="s_error">
                                        <?php echo $serror; ?>
                                    </span>
                                    <label>To : </label>
                                    <input type="date" name="e_date" id="e_date" value="<?php if (isset($edate)) {
                                        echo $edate;
                                    } ?>" required>
                                    <span style="color:red" id="e_error">
                                        <?php echo $eerror; ?>
                                    </span>
                                    <input class="btn btn-primary" type="submit" name="submit1" value="Search">
                                </form>
                            </div>
                        </div>


                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-primary table-striped">


                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Date</th>
                                    <th>Invoice Id</th>
                                    <th>Material Name</th>
                                    <th>Buyer</th>
                                    <th>Sell Quantity</th>
                                    <th>Price</th>
                                    <th>Total Price</th>
                                    <th style="width: 160px">Action</th>
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
                                            <?php echo $p['invoice_id'] ?>
                                        </td>
                                        <td>
                                            <?php $dump = $con->query("select * from raw_materials where id=" . $p['material_id'])->fetch_assoc();
                                            echo $dump['name'] ?>
                                        </td>
                                        <td>
                                            <?php $buyer = $con->query("select * from secondary_buyer where id=" . $p['secondary_buyer_id'])->fetch_assoc();
                                            echo $buyer['name'] ?>
                                        </td>
                                        <td>
                                            <?php $quantity = round($p['quantity']);
                                            echo round($p['quantity']) ?>
                                        </td>
                                        <td>
                                            <?php $price = $p['price'];
                                            echo round($p['price']) ?>
                                        </td>
                                        <td>
                                            <?php $tot = $quantity * $price;
                                            echo $tot; ?>
                                            <?php $total += $tot; ?>
                                        </td>
                                        <td>
                                            <a href="mat_sell_edit.php?id=<?php echo $p['id'] ?>"
                                                class="btn btn-success btn-sm">Update</a>

                                            <a href="mat_sell_delete.php?id=<?php echo $p['id'] ?>"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('are you sure to delete')">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td class="text-right text-bold h5" colspan="7">Total Sell :</td>
                                    <td class="text-bold h5" colspan="2">
                                        <?php echo $total . " . " . "Tk"; ?>
                                    </td>
                                </tr>

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
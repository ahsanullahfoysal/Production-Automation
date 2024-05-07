<?php
require_once("../header.php");
// //$con = new mysqli('localhost', 'root', '',  'production_automation');
if (isset($_POST["submit2"])) {
    $from = $_POST["from_date"];
    $to = $_POST["to_date"];
    $edit = $con->query("SELECT supplier_payment.*,suppliers.contract_person	 FROM supplier_payment JOIN suppliers ON supplier_payment.supplier_id=suppliers.id where date between '$from' and '$to'")->fetch_all(MYSQLI_ASSOC);
} else {
    $edit = $con->query("SELECT supplier_payment.*,suppliers.contract_person	 FROM supplier_payment JOIN suppliers ON supplier_payment.supplier_id=suppliers.id")->fetch_all(MYSQLI_ASSOC);
}

if (isset($_POST['submit1'])) {
    $supplier_id = $_POST['supplier_id'];
    $edit = $con->query("SELECT supplier_payment.*,suppliers.contract_person	 FROM supplier_payment JOIN suppliers ON supplier_payment.supplier_id=suppliers.id where supplier_payment.supplier_id= $supplier_id")->fetch_all(MYSQLI_ASSOC);
}


//$con = new mysqli('localhost', 'root', '',  'production_automation');
$dep = $con->query("select * from suppliers")->fetch_all(MYSQLI_ASSOC);

?>
<script>
    function fn() {
        let supplier = document.getElementById('supplier_payment').value.trim();
        if (supplier == '') {
            document.getElementById('supplier_payment').style.border = '1px solid red';
            document.getElementById('supplier_payment_error').innerHTML = 'select a supplier';
            return false;
        } else {

            document.getElementById('supplier_payment').style.border = '1px solid green';
            document.getElementById('supplier_payment_error').innerHTML = '';
            return true;
        }
    }
</script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Supplier payment list</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="search_stock_return.php">search</a></li>
                        <li class="breadcrumb-item active">Supplier payment list</li>
                    </ol>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            <h3 class="card-title">Supplier List</h3>
                        </div>
                        <div class="col-md-3 d-flex offset-9 justify-content-end">
                            <a href="<?php echo $_SESSION['base_url'] ?>/rezaul_supply/supplier_payment.php"
                                class="btn btn-warning">Add Supplier Payment</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <div class="row">
                            <div class="col-md-2 d-flex">
                                <form action="search.php" method="post" onsubmit="return fn()" class="form-inline">
                                    <div>
                                        <select name="supplier_id" id="supplier_payment" class="form-control">
                                            <option value="">select a name</option>
                                            <?php foreach ($dep as $d) { ?>
                                                <option value="<?php echo $d['id'] ?>">
                                                    <?php echo $d['contract_person'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div>
                                        <input type="submit" value="search" name="submit1" class="btn btn-primary">
                                    </div>
                                    <span id="supplier_payment_error"></span>
                                </form>
                            </div>
                            <div class="col-md-4 d-flex offset-6 justify-content-end">
                                <form action="" method="post" class="form-inline float-sm-right">
                                    <div>
                                        <input type="date" name="from_date" id="" class="form-control">
                                    </div>
                                    <div>
                                        <input type="date" name="to_date" id="" class="form-control">
                                    </div>
                                    <div>
                                        <input type="submit" value="search" name="submit2" class="btn btn-secondary">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <thead>
                            <tr>
                                <th style="width: 10px">SL</th>
                                <th>Supplier</th>
                                <th>amount</th>
                                <th>method</th>
                                <th>date</th>

                                <th style="width: 160px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($edit as $i => $p) { ?>
                                <tr>
                                    <td>
                                        <?php echo ++$i ?>
                                    </td>
                                    <td>
                                        <?php echo $p['contract_person'] ?>
                                    </td>
                                    <td>
                                        <?php echo $p['amount'] ?>
                                    </td>
                                    <td>
                                        <?php echo $p['method'] ?>
                                    </td>
                                    <td>
                                        <?php echo $p['date'] ?>
                                    </td>

                                    <td>
                                        <a href="supplier_payment_update.php?id=<?php echo $p['id'] ?>"
                                            class="btn btn-success btn-sm">Update</a>

                                        <a href="supplier_payment_delete.php?id=<?php echo $p['id'] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('are you sure to delete')">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

</div>
<!-- /.content-wrapper -->

<?php
require_once("../footer.php");
?>
<?php
require_once("../header.php");
// $con = new mysqli('localhost', 'root', '', 'production_automation');
$id=$_GET['id'];
$material=$con->query("select * from raw_materials");
$purchase=$con->query("select * from purchase");
$edit=$con->query("select * from stock_return where id=$id")->fetch_assoc();

if (isset($_POST['submit'])) {
    $invoice_id = $_POST['invoice_id'];
    $quantity = $_POST['quantity'];
    // $date = $_POST['date'];
    $date = date('Y,m,d');
    $material_id = $_POST['material_id'];

    $con->query("update stock_return set invoice_id='$invoice_id',quantity='$quantity',material_id='$material_id' where id=$id")
?>
    <script>
        window.location.assign('stock_return_list.php')
    </script>
<?php
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>stock Return Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">stock Return Edit</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"> Stock Return Edit </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                <div class="form-group">
                                        <label for="exampleInputEmail1">Invoice ID</label>
                                        <select name="invoice_id" id="" class="form-control">
                                            <option value="">Select Invoice id</option>
                                            <?php while($c=$purchase->fetch_assoc()){ ?>
                                                <option value="<?php echo $c['invoice_id'] ?>" <?php if($c['invoice_id']==$edit['invoice_id']) { echo "selected";}?>><?php echo $c['invoice_id'] ?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Quantity</label>
                                        <input type="text" name="quantity" class="form-control" id="exampleInputEmail1" placeholder="Enter Name" value="<?php echo $edit['quantity'] ?>">
                                    </div>

                                </div>
                                <!-- <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">date</label>
                                        <input type="date" name="quantity" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                                    </div> -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Material name</label>
                                        <select name="material_id" id="" class="form-control">
                                            <option value="">Select Material name</option>
                                            <?php while($c=$material->fetch_assoc()){ ?>
                                                <option value="<?php echo $c['id'] ?>" <?php if($c['id']==$edit['material_id']){echo "selected";} ?>><?php echo $c['name'] ?></option>
                                                <?php } ?>
                                        </select>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
<!-- /.content-wrapper -->

<?php
require_once("../footer.php");
?>
<?php
require_once("../header.php");
$order=$con->query("SELECT * FROM orders");
$unit=$con->query("SELECT * FROM units");

$pname1=$con->query("select orders.*,projects.name from orders join projects on projects.id=orders.project_id")->fetch_all(MYSQLI_ASSOC);

?>
<!-- validation -->
<script>
    $(document).ready(function(){
        $('#fpwas').validate({
            rules:{
                order_id:"required",
                quantity:"required",
                unit_id:"required",
                date:"required"
            },
            messages:{
                order_id:"Please select an order name",
                quantity:"Please select unit",
                unit_id:"Please select quantity",
                date:"required"
            }
        })
    })
</script>

<?php
//require_once('../database_con.php');
if(isset($_POST['submit'])){
    $order=$_POST['order_id'];
    $quantity=$_POST['quantity'];
    $unit=$_POST['unit_id'];
    $date=$_POST['date'];
    //$con->query("INSERT INTO `finished_product_wastage`(`order_id`, `quantity`, `unit_id`, `date`) VALUES ('$order','$quantity','$unit','$date')");
    $con->query("INSERT INTO `finished_product_wastage`(`order_id`,`quantity`,`unit_id`,`date`) VALUES ('$order','$quantity','$unit','$date')");
    ?>
    <script>
        window.location.assign('list_finished_product_wastage.php');
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
                    <h1>Finished Product Wastage List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Finished Product Wastage</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Finished Product Wastage</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" id="fpwas" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                            <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Order Name</label>
                                        <div>
                                        
                                       

                                            <select name="order_id" id="order_id" class="form-control">
                                            <option value="">Select one</option>
                                            <?php 
                                            
                                             foreach ($pname1 as $ii=>$p) { ?>
                                                <option value="<?php echo $p['id'] ?>"><?php echo $p['name'] ?></option>
                                            
                                                <?php } ?>

                                        </select>
                                        <span id="order_id_err"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Quantity</label>
                                        <input type="text" name="quantity" class="form-control" id="quantity" placeholder="Enter Name">
                                        <span id="quantity_err"></span>
                                    </div>
                            </div>
                            <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputGmail1">Unit </label>
                                        <div>
                                            <select name="unit_id" id="unit_id" class="form-control">
                                                <option value="">Select one</option>
                                                <?php while($un = $unit->fetch_assoc() ){ ?>
                                                <option value="<?php echo $un['id'] ?>"><?php echo $un['name'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <span id="unit_id_err"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Date</label>
                                        <input type="datetime-local" name="date" class="form-control" id="date" placeholder="Enter Name" value="<?php echo date('Y-m-d\TH:i:s'); ?>">
                                        <span id="date_err"></span>
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
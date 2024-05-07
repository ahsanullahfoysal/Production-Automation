<?php
require_once("../header.php");
$id=$_GET['id'];
//require_once('../database_con.php');
$ship = $con->query("select * from finished_product_wastage where id=$id")->fetch_assoc();

$unit=$con->query("SELECT * FROM units ");
$order=$con->query("SELECT * FROM orders ");
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

<?php if(isset($_POST['submit'])){
    $order=$_POST['order_id'];
    $quantity=$_POST['quantity'];
    $unit=$_POST['unit_id'];
    $date=$_POST['date'];
    $con->query("UPDATE `finished_product_wastage` SET `order_id`='$order',`quantity`='$quantity',`unit_id`='$unit',`date`='$date' WHERE id=$id");
    ?>
    <script>
        window.location.assign('list_finished_product_wastage.php')
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
                    <h1>Finished Product Wastage</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Finished Product Wastage</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Finished Product Wastage</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" onsubmit=" return fn()" enctype="multipart/form-data">
                        <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Company Name</label>
                                        <div>
                                        <select name="order_id" class="form-control" id="order_id">
                                    <option value="">Select one</option>
                                    <?php while($ord = $order->fetch_assoc() ){ ?>
                                    <option value="<?php echo $ord['id'] ?>"<?php if($ord['id']==$ship['order_id']){
                                        echo "selected";
                                    } ?>><?php $buye=$con->query("select * from buyers where id=".$ord['buyer_id'])->fetch_assoc() ; echo $buye['company_name'] ?></option>
                                    <?php } ?>
                                    </select>
                                    <span id="order_id_err"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Quantity</label>
                                <input type="text" name="quantity" class="form-control" id="quantity" placeholder="Enter quantity" value="<?php echo round($ship['quantity']) ?>" >
                                <span id="quantity_err"></span>
                                    </div>
                            </div>
                            <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputGmail1">Unit </label>
                                            <div>
                                                <select name="unit_id" class="form-control" id="unit_id">
                                                    <option value="">Select one</option>
                                                    <?php while($un = $unit->fetch_assoc() ){ ?>
                                                    <option value="<?php echo $un['id'] ?>"<?php if($un['id']==$ship['unit_id']){echo "selected";} ?>><?php echo $un['name'] ?>
                                                    </option>
                                                        <?php } ?>
                                                </select>
                                                <span id="unit_id_err"></span>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Date</label>
                                    <input type="datetime-local" name="date" class="form-control" id="date" value="<?php echo  $ship['date'];  ?>" >
                                    <span id="date_err"></span>
                                    </div>
                            </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
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
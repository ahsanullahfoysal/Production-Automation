<?php
require_once('../header.php');

if (isset($_POST['material_id'])) {
    $material_id = ($_POST['material_id']);
    $quantity = trim($_POST['quantity']);
    $orders = ($_POST['orders_id']);

    $con->query("insert into project_materials(material_id,quantity,order_id)values('$material_id','$quantity','$orders')");

    ?>
    <script>
        window.location.assign('assign_material_list.php')
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
                    <h1> Add Assign Material </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Assign Material </li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Assign Material </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return fj()" id="frm_valid">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Orders</label>
                                        <select name="orders_id" id="orders_id" class="form-control">
                                            <?php $omg = $con->query("select * from  projects")->fetch_all(MYSQLI_ASSOC); ?>
                                            <option value=""> select Orders</option>
                                            <?php foreach ($omg as $b) { ?>
                                                <option value="<?php echo $b['id'] ?>">
                                                    <?php echo $b['name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        </select><span style="color: red;" id="orders_id_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Material</label>
                                        <select name="material_id" id="name" class="form-control">
                                            <?php $data = $con->query("select * from  raw_materials")->fetch_all(MYSQLI_ASSOC); ?>
                                            <option value=""> select materials</option>
                                            <?php foreach ($data as $j) { ?>
                                                <option value="<?php echo $j['id'] ?>">
                                                    <?php echo $j['name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <span style="color: red;" id="name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Quantity</label>
                                        <input type="text" name="quantity" class="form-control" id="quantity"
                                            placeholder="Enter quantity">
                                        </select><span style="color: red;" id="quantity_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 offset-10 d-flex justify-content-end">
                                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>


<?php
require_once("../footer.php");
?>
<script>
    $(document).ready(function () {
        $('#frm_valid').validate({
            rules: {
                material_id: "required",
                quantity: "required",
                orders_id: "required",


            },
            messages: {

            }
        })
    })
</script>
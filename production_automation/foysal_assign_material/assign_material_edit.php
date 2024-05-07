<?php
require_once("../header.php");

$data = $con->query("select * from  raw_materials");

$mn = $con->query('select * from project_materials where id=' . $_GET['id'])->fetch_assoc();

if (isset($_POST['material_id'])) {
    $material_id = $_POST['material_id'];
    $quantity = $_POST['quantity'];
    $orders_id = $_POST['orders_id'];

    $mw = $con->query("update project_materials set material_id='$material_id', quantity='$quantity', orders_id='$orders_id' where id=" . $_GET['id'])
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
                    <h1>Assign materiale</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Assign_material</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Assign_material</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" enctype="multipart/form-data" onsubmit=" return fj()" id="frm_valid" >
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">material_id</label>
                                        <select name="material_id" id="name" class="form-control">

                                            <option value=""> select materials</option>
                                            <?php while ($raw = $data->fetch_assoc()) { ?>
                                                <option value="<?php echo $raw['id'] ?>" <?php if ($raw['id'] == $mn['material_id']) {
                                                      echo "selected";
                                                  } ?>>
                                                    <?php echo $raw['name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <span style="color: red;" id="name_error">*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">quantity</label>
                                        <input type="text" name="quantity" class="form-control" id="quantity"
                                            placeholder="Enter quantity" value="<?php echo $mn['quantity'] ?>"><span
                                            style="color: red;" id="quantity_error">*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Orders</label>
                                        <input type="text" name="orders_id" class="form-control" id="orders_id"
                                            placeholder="Enter title" value="<?php echo $mn['orders_id'] ?>"><span
                                            style="color: red;" id="orders_id_error">*</span>
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
<?php
require_once("../header.php");
$fb = $con->query('select project_materials.*, raw_materials.name as material_id  from project_materials join raw_materials on raw_materials.id=project_materials.material_id')->fetch_all(MYSQLI_ASSOC);

$data = $con->query("select * from  raw_materials")->fetch_all(MYSQLI_ASSOC);



if (isset($_POST['submit'])) {
    $search = $_POST['material_id'];
    $fb = $con->query("select project_materials.*, raw_materials.name as material_id  from project_materials join raw_materials on raw_materials.id=project_materials.material_id where project_materials.material_id = $search")->fetch_all(MYSQLI_ASSOC);

    $data = $con->query("select * from  raw_materials")->fetch_all(MYSQLI_ASSOC);
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Assign Material </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Assign Material List</li>
                    </ol>
                </div>
            </div>

            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <h3 class="card-title">Assign Material List</h3>
                            </div>
                            <div class="col-md-2 offset-8 text-right">
                                <a href="<?php echo $_SESSION['base_url'] ?>/foysal_assign_material/assign_material.php" class="btn btn-warning">Add Assign Material</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">

                        <table class="table table-bordered">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <form action="" method="post" class="form-inline">
                                        <div class="d-flex">
                                            <div>
                                                <select name="material_id" id="" class="form-control">

                                                    <option value=""> select materials</option>
                                                    <?php foreach ($data as $j) { ?>
                                                        <option value="<?php echo $j['id'] ?>">
                                                            <?php echo $j['name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div>
                                                <input type="submit" name="submit" value="search" class="btn btn-info btn-sm float-sm-right">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Material_id</th>
                                    <th>Quantity</th>
                                    <th>Orders_id</th>
                                    <th style="width:150px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($fb as $i => $l) { ?>
                                    <tr>
                                        <td>
                                            <?php echo ++$i ?>
                                        </td>
                                        <td>
                                            <?php echo $l['material_id'] ?>
                                        </td>
                                        <td>
                                            <?php echo $l['quantity'] ?>
                                        </td>
                                        <td>
                                            <?php echo $l['order_id'] ?>
                                        </td>
                                        <td>
                                            <a href="assign_material_edit.php?id=<?php echo $l['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href="assign_material_delete.php?id=<?php echo $l['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('are you sure?')">Delete</a>

                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.card-header -->

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
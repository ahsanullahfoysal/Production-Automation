<?php
require_once("../header.php");
$fb = $con->query('select material_wastage.*, raw_materials.name as material_id  from material_wastage join raw_materials on raw_materials.id=material_wastage.material_id')->fetch_all(MYSQLI_ASSOC);
$data = $con->query("select * from  raw_materials")->fetch_all(MYSQLI_ASSOC);



if (isset($_POST['submit'])) {
    $search = $_POST['material_id'];
    $fb = $con->query("select material_wastage.*, raw_materials.name as material_id  from material_wastage join raw_materials on raw_materials.id=material_wastage.material_id where material_wastage.material_id = $search")->fetch_all(MYSQLI_ASSOC);
    $data = $con->query("select * from  raw_materials")->fetch_all(MYSQLI_ASSOC);
}
if (isset($_POST['submit1'])) {
    $datesearch = $_POST['date'];
    $fb = $con->query("select material_wastage.*, raw_materials.name as material_id  from material_wastage join raw_materials on raw_materials.id=material_wastage.material_id where date like '%$datesearch%'")->fetch_all(MYSQLI_ASSOC);
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Material wastage</h1>
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Material wastage List</li>
                    </ol>
                </div>
            </div>

            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <h3 class="card-title">Material wastage List</h3>
                            </div>
                            <div class="col-md-2 offset-8 text-right">
                                <a href="<?php echo $_SESSION['base_url'] ?>/foysal_wastage/material_wastage.php" class="btn btn-warning">Add Wastage Material</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <div class="row mb-3">
                                <div class="col-md-4">
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
                                                <input type="submit" name="submit" value="search" class="btn btn-secondary float-sm-right">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-3 offset-md-5 ">
                                    <form action="" method="post" class="float-sm-right">
                                        <div class="d-flex justify-content-end">
                                            <div>
                                                <input type="date" name="date" class="form-control">
                                            </div>
                                            <div>
                                                <input type="submit" name="submit1" value="search" class="btn btn-secondary">
                                            </div>
                                        </div>


                                    </form>
                                </div>
                            </div>

                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Material</th>
                                    <th>Quantity</th>
                                    <th>Date</th>
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
                                            <?php echo $l['date'] ?>
                                        </td>
                                        <td>
                                            <a href=" material_wastage_edit.php?id=<?php echo $l['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href=" material_wastage_delete.php?id=<?php echo $l['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('are you sure?')">Delete</a>

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
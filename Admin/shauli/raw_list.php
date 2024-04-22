<?php
require_once("../header.php");
//$con = new mysqli('localhost', 'root', '', 'production_automation');
$cate = $con->query("select * from category")->fetch_all(MYSQLI_ASSOC);
$unit = $con->query("select * from units");
$raw = $con->query("SELECT raw_materials.*,category.name as category,units.name as units FROM raw_materials JOIN category ON category.id=raw_materials.category_id JOIN units ON units.id=raw_materials.unit_id")->fetch_all(MYSQLI_ASSOC);
if (isset($_POST['submit1'])) {
    $searchid = $_POST['search'];
    $search_error = "";
    if (empty($searchid)) {
        $search_error = "Please select a Category";
    } else {
        $raw = $con->query("SELECT raw_materials.*,category.name as category,units.name as units FROM raw_materials JOIN category ON category.id=raw_materials.category_id JOIN units ON units.id=raw_materials.unit_id where category_id=$searchid");
    }
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Raw Material list</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Raw Materials list</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <h3 class="card-title">Raw Material List</h3>
                            </div>
                            <div class="col-md-2 offset-8 text-right">
                                <a href="<?php echo $_SESSION['base_url'] ?>/shauli/raw.php" class="btn btn-warning">Add Raw Materials</a>
                            </div>
                        </div>
                        <form action="" method="post">
                            <div class="d-flex">
                                <div>
                                    <select name="search" id="" class="form-control">
                                        <option value="">select category</option>
                                        <?php foreach ($cate as $c) { ?>
                                            <option value="<?php echo $c['id'] ?>"><?php echo $c['name'] ?></option>
                                        <?php } ?>
                                    </select><span class="text-danger"><?php if (isset($_POST['submit1'])) {
                                                                            echo $search_error;
                                                                        } ?></span>
                                </div>
                                <div>
                                    <input type="submit" name="submit1" class="btn btn-secondary">
                                </div>
                            </div>
                        </form>
                        <!-- <h3 class="card-title">Raw Materials List</h3> -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">SL</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Units</th>
                                    <th>Category</th>
                                    <th style="width: 180px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($raw as $i => $r) { ?>
                                    <tr>
                                        <td><?php echo ++$i ?></td>
                                        <td><?php echo $r['name'] ?></td>
                                        <td><?php echo $r['price'] ?></td>
                                        <td><?php echo $r['units'] ?></td>
                                        <td><?php echo $r['category'] ?></td>
                                        <td>
                                            <a href="raw_edit.php?id=<?php echo $r['id'] ?>" class="btn btn-success ">Update</a>

                                            <a href="raw_delete.php?id=<?php echo $r['id'] ?>" class="btn btn-danger" onclick="return confirm('are you sure to delete')">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
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
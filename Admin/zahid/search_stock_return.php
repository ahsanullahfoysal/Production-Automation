<?php
    require_once("../header.php");
    // $con = new mysqli('localhost', 'root', '', 'production_automation');
    if(isset($_POST['search'])){
    $search=$_POST['search'];

    
    }
    // $date=$_POST['date'];
    $stock_return=$con->query("SELECT stock_return.*,raw_materials.name FROM `stock_return` JOIN raw_materials ON raw_materials.id=stock_return.material_id where stock_return.material_id=$search ")->fetch_all(MYSQLI_ASSOC);
    $material=$con->query("select * from raw_materials")->fetch_all(MYSQLI_ASSOC);
    
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="stock_return.php" class="btn btn-primary btn-sm"><h1>Add Stock Return</h1></a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="search_stock_return.php">search</a></li>
                        <li class="breadcrumb-item active">Stock Return list</li>
                    </ol>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-6">
                <form action="search_stock_return.php" method="post" class="form-inline">
                        <select name="search" id="" class="form-control">
                            <option value="">select material</option>
                            <?php foreach($material as $c) {?>
                            <option value="<?php echo $c['id'] ?>"><?php echo $c['name'] ?></option>
                            <?php } ?>
                        </select>
                       <input type="submit" value="search" class="btn btn-primary">
                    </form>
                </div>
                
                
                <div class="col-sm-6">
                    <form action="search2_stock_return.php" method="post" class="form-inline float-sm-right">
                        <input type="date" name="date" id="" class="form-control">
                        <input type="submit" value="search" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Stock Return List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">SL</th>
                                    <th>invoice Id</th>
                                    <th>material name</th>
                                    <th>Quantity</th>
                                    <th>date</th>
                                    <th style="width: 160px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php foreach($stock_return as $i=>$p){ ?>
                                <tr>
                                    <td><?php echo ++$i ?></td>
                                    <td><?php echo $p['invoice_id'] ?></td>
                                    <td><?php echo $p['name'] ?></td>
                                    <td><?php echo $p['quantity'] ?></td>
                                    <td><?php echo $p['date'] ?></td>
                                    <td>
                                        <a href="stock_return_edit.php?id=<?php echo $p['id'] ?>" class="btn btn-success btn-sm">Update</a>

                                        <a href="stock_return_delete.php?id=<?php echo $p['id'] ?>" class="btn btn-danger" onclick="return confirm('are you sure to delete')">Delete</a>
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
<?php
require_once("../header.php");
$id=$_GET['id'];
$edit=$con->query("select * from stock_out where id=$id")->fetch_assoc();

$data=$con->query("SELECT stock_out.*,raw_materials.name as material,users.name as users,projects.name FROM stock_out JOIN raw_materials ON stock_out.material_id=raw_materials.id JOIN users ON stock_out.user_id=users.id JOIN projects ON stock_out.project_id=projects.id;");

//$con = new mysqli('localhost', 'root', '', 'production_automation');
if(isset($_POST['submit'])){
    $material_id=$_POST['material_id'];
    $quantity=$_POST['quantity'];
    $user_id=$_POST['user_id'];
    $date=$_POST['date'];
    $project_id=$_POST['project_id'];
    
    $fr=$con->query("UPDATE stock_out SET material_id='$material_id',quantity='$quantity',user_id='$user_id',date='$date',project_id='$project_id' WHERE id=$id");
    ?>
    <script>
        window.location.assign('stockout_list.php')
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
                    <h1>Units</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Units</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><a href="stockout_list.php" class="btn btn-primary btn-md">Add Stock Out List</a></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" onsubmit="return validate()" enctype="multipart/form-data">
                        <div class="card-body">
                            <!-- <div class="row-"> -->

                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Material</label>
                                        <select name="material_id" id="material_id" class="form-control">
                                            <option value="">select material</option>
                                            <?php foreach($data as $m){?>
                                            <option value="<?php echo $m['material_id'] ?>" <?php if($m['id']==$edit['id']){echo "selected";}?>><?php echo $m['material'] ?></option>
                                                <?php }?>
                                        </select>
                                       <span id="error1"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Quantity</label>
                                        <input type="text" name="quantity" class="form-control" id="quantity" placeholder="Enter Quantity" value="<?php echo $edit['quantity']  ?>">
                                        <span id="error2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Users</label>
                                        <select name="user_id" id="users" class="form-control">
                                            <option value="">select users</option>
                                            <?php foreach($data as $u){?>
                                            <option value="<?php echo $u['user_id'] ?>" <?php if($u['id']==$edit['id']){echo "selected";} ?>><?php echo $u['users'] ?></option>
                                                <?php }?>
                                        </select>
                                        <span id="error3"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Date</label>
                                    <input type="datetime-local" name="date" id="date" class="form-control">
                                    <span id="error4"></span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Order</label>
                                        <select name="project_id" id="order" class="form-control">
                                            <option value="">select project</option>
                                            <?php foreach($data as $p){?>
                                            <option value="<?php echo $p['project_id'] ?>" <?php if ($p['id']==$edit['id']){echo "selected";} ?>><?php echo $p['name'] ?></option>
                                                <?php }?>
                                        </select>
                                        <span id="error5"></span>
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
<?php
require_once("../header.php");
$id=$_GET['id'];
$edit = $con->query("select * from orders where id=$id")->fetch_assoc();
$project=$con->query('select * from projects');
$buyer=$con->query('select * from buyers');
$unit=$con->query('select * from units');
$manager=$con->query('select * from users');
$supervisor=$con->query('select * from users');
$status = $con->query('select * from orders');


if(isset($_POST['submit'])){
    $project=$_POST['project'];
    $buyer=$_POST['buyer'];
    $unit=$_POST['unit'];
    $manager=$_POST['manager'];
    $supervisor=$_POST['supervisor'];
    $quantity=$_POST['quantity'];
    $rate=$_POST['rate'];
    $start_date=$_POST['start_date'];
    $end_date=$_POST['end_date'];
    $status = $_POST['status'];
    
    $con->query("UPDATE `orders` SET `project_id`='$project',`buyer_id`='$buyer',`start_date`=' $start_date',`end_date`='$end_date',`quantity`='$quantity',`unit_id`='$unit',`project_manager_id`=' $manager',`supervisor_id`=' $supervisor',`rate`='$rate',status='$status' WHERE id=$id "); 
    ?>
    <script>
        window.location.assign('orders_list.php')
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
                    <h1>Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><a href="orders_list.php" class="btn btn-primary btn-md">Add Order List</a></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="#" method="post" >
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Project</label>
                                        <select name="project" id="" class="form-control">
                                            <option value="">Select Project </option>
                                            <?php while($c=$project->fetch_assoc()) {?>
                                            <option value="<?php echo $c['id'] ?>" <?php if($c['id'] ==$edit['project_id']){echo "selected";} ?>><?php echo $c['name']?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Buyer </label>
                                        <select name="buyer" id="" class="form-control">
                                            <option value="">Select Buyer </option>
                                            <?php while($c=$buyer->fetch_assoc()) {?>
                                            <option value="<?php echo $c['id'] ?>" <?php if($c['id'] ==$edit['buyer_id']){echo "selected";} ?>><?php echo $c['company_name']?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Unit </label>
                                        <select name="unit" id="" class="form-control">
                                            <option value="">Select Unit </option>
                                            <?php while($c=$unit->fetch_assoc()) {?>
                                                <option value="<?php echo $c['id'] ?>" <?php if($c['id']==$edit['unit_id']){echo "selected";} ?>> <?php echo $c['name']?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Project Manager </label>
                                        <select name="manager" id="" class="form-control">
                                            <option value="">Select Manager </option>
                                            <?php while($c=$manager->fetch_assoc()) {?>
                                                <option value="<?php echo $c['id'] ?>" <?php if($c['id']==$edit['project_manager_id']){echo "selected";} ?>> <?php echo $c['name']?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Supervisor </label>
                                        <select name="supervisor" id="" class="form-control">
                                            <option value="">Select Supervisor </option>
                                            <?php while($c=$supervisor->fetch_assoc()) {?>
                                                <option value="<?php echo $c['id'] ?>" <?php if($c['id']==$edit['supervisor_id']){echo "selected";} ?>> <?php echo $c['name']?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Quantity</label>
                                        <input type="text" name="quantity" class="form-control" value="<?php echo $edit['quantity']?>">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Rate</label>
                                        <input type="text" name="rate" class="form-control" value="<?php echo $edit['rate']?>">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Start Date</label>
                                        <input type="date" name="start_date" class="form-control" value="<?php echo $edit['start_date']?>">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">End Date</label>
                                        <input type="date" name="end_date" class="form-control" value="<?php echo $edit['end_date']?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select name="status" id="" class="form-control">
                                            <option value="">Status</option>
                                            <option value="running" <?php if($edit['status']=='running'){ echo "selected"; } ?>>Running</option>
                                            <option value="finished" <?php if($edit['status']=='finished'){ echo "selected"; } ?>>Finished</option>
                                            
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
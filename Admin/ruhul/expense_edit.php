<?php
require_once("../header.php");
$id=$_GET['id'];
$category=$con->query('select * from expense_category');
$order = $con->query('select * from orders');
$users = $con->query('select * from users');
$edit=$con->query('select * from expense where id='.$id)->fetch_assoc();

//$con = new mysqli('localhost', 'root', '', 'production_automation');
if(isset($_POST['submit'])){
    $order=$_POST['order_id'];
    $users=$_POST['user_id'];
    $category=$_POST['category_id'];
    $amount=$_POST['amount'];
    $date=$_POST['date'];
    $con->query("UPDATE `expense` SET `order_id`='$order',`user_id`='$users',`category_id`='$category',`amount`='$amount',`date`='$date' WHERE id=$id");
    ?>
    <script>
        window.location.assign('expense_list.php')
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
                    <h1>Expense Update</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Expense Update</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><a href="supplier_payment_list.php" class="btn btn-primary btn-md"> Payment List</a></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                            <div class="col-12">

                            <div class="form-group">
                                        <label for="exampleInputEmail1">Orders</label>
                                        <select name="order_id" id="" class="form-control">
                                            <option value="">Select Name</option>
                                            <?php while($c=$order->fetch_assoc()){ ?>
                                                <option value="<?php echo $c['id'] ?>" <?php if($c['id']==$edit['order_id']){echo "selected";} ?>><?php echo $c['id'] ?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                            <div class="form-group">
                                        <label for="exampleInputEmail1">Users</label>
                                        <select name="user_id" id="" class="form-control">
                                            <option value="">Select Users</option>
                                            <?php while($c=$users->fetch_assoc()){ ?>
                                                <option value="<?php echo $c['id'] ?>" <?php if($c['id']==$edit['user_id']){echo "selected";} ?>><?php echo $c['name'] ?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                            <div class="form-group">
                                        <label for="exampleInputEmail1">Category</label>
                                        <select name="category_id" id="" class="form-control">
                                            <option value="">Select Category</option>
                                            <?php while($c=$category->fetch_assoc()){ ?>
                                                <option value="<?php echo $c['id'] ?>" <?php if($c['id']==$edit['category_id']){echo "selected";} ?>><?php echo $c['name']?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                    

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Amount</label>
                                        <input type="text" name="amount" class="form-control" id="exampleInputEmail1" placeholder="Enter amount" value="<?php echo $edit['amount'] ?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date</label>
                                        <input type="date" name="date" class="form-control" id="exampleInputEmail1" placeholder="date" value="<?php echo $edit['date'] ?>">
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
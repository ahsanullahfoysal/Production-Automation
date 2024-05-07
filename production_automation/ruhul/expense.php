<?php
require_once("../header.php");
?>
<?php
  
$excat=$con->query('select * from expense_category');
$order = $con->query('select * from orders');
$users = $con->query('select * from users');
//$edit=$con->query('select * from expense where id='.$id)->fetch_assoc();
if(isset($_POST['submit'])){
    $order_id=$_POST['order_id'];
    $user_id=$_POST['user_id'];
    $category_id=$_POST['category_id'];
    $amount=$_POST['amount'];
    $date=$_POST['date'];
    $con->query("insert into expense(order_id,user_id,category_id,amount,date) values ('$order_id','$user_id','$category_id','$amount','$date')");
    
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
    
        <a href="expense_list.php"><button type="submit" name="submit" class="btn btn-primary">Expense_List</button></a>
                        
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Expense</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Expense</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><a href="orders_list.php" class="btn btn-primary btn-md">Add Expense</a></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" id="frm_valid" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ORDER ID</label>
                                        <select name="order_id" id="order" class="form-control">
                                            <option value="">Select Order Id</option>
                                            <?php while($c=$order->fetch_assoc()){ ?>
                                                <option value="<?php echo $c['id'] ?>"><?php echo $c['id'] ?></option>
                                                <?php } ?>
                                        </select><span id="order_error"></span>
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">USER NAME</label>
                                        <select name="user_id" id="user" class="form-control">
                                            <option value="">Select User Id </option>
                                            <?php while($c=$users->fetch_assoc()){ ?>
                                                <option value="<?php echo $c['id'] ?> "><?php echo $c['name'] ?> </option>
                                                <?php } ?>
                                        </select><span id="user_error"></span>
                                    </div>
                                </div>

                                <div class="col-6">
                                <div class="form-group">
                                        <label for="exampleInputEmail1">Category</label>
                                        <select name="category_id" id="category" class="form-control">
                                            <option value="">Select Category</option>
                                            <?php while($c=$excat->fetch_assoc()){ ?>
                                                <option value="<?php echo $c['id'] ?>"><?php echo $c['name'] ?></option>
                                                <?php } ?>
                                        </select><span id="category_error"></span>
                                    </div>
                                </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                        <label for="">AMOUNT</label>
                                        <input  type="text" name="amount" class="form-control" value="" placeholder="amount" id="amount" ><span id="amount_error"></span>
                                    </div>
                                </div>
                                 <div class="col-6">
                                    <div class="form-group">
                                        <label for="">DATE</label>
                                        <input  type="date" name="date" class="form-control" value="" placeholder="date" id="date"><span id="date_error"></span>
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

<script>
        $(document).ready(function () {
            $('#frm_valid').validate({
                rules: {
                    order_id: "required",
                    user_id: "required",
                    category_id: "required",
                    amount: "required",
                    date: "required"

                },
                messages: {
                    order_id: "please select order",
                    user_id: "please select user",
                    category_id: "please select category",
                    amount: "please select amount",
                    date: "please select date",
                }
            })
        })
</script>

 <?php
 require_once("../footer.php");
?> 
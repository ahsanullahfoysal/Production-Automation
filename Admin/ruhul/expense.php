<?php
require_once("../header.php");
?>
<script>

function validation(){
let order=document.getElementById("order").value;
let user=document.getElementById("user").value;
let category=document.getElementById("category").value;
let amount=document.getElementById("amount").value;
let date=document.getElementById("date").value;
console.log(user);
if(order=="" || user=="" || category=="" || amount=="" || date==""){
    if(order==""){
        document.getElementById("order").style.border="1px solid red";
        document.getElementById("order_error").innerHTML="please select order id";
        document.getElementById("order_error").style.color="red";

    }else{
        document.getElementById("order").style.border="1px solid green";
        document.getElementById("order_error").innerHTML="";
    }

    if(user==""){
        document.getElementById("user").style.border="1px solid red";
        document.getElementById("user_error").innerHTML="select user name";
        document.getElementById("user_error").style.color="red";

    }else{
        document.getElementById("user").style.border="1px solid green";
        document.getElementById("user_error").innerHTML="";
    }

    if(category==""){
        document.getElementById("category").style.border="1px solid red";
        document.getElementById("category_error").innerHTML="select category";
        document.getElementById("category_error").style.color="red";

    }else{
        document.getElementById("category").style.border="1px solid green";
        document.getElementById("category_error").innerHTML="";
    }

    if(amount==""){
        document.getElementById("amount").style.border="1 px solid red";
        document.getElementById("amount_error").innerHTML="enter amount";
        document.getElementById("amount_error").style.color="red";

    }else{
        document.getElementById("amount").style.border="1 px solid green";
        document.getElementById("amount_error").innerHTML="";
    }

    if(date==""){
        document.getElementById("date").style.border="1 px solid red";
        document.getElementById("date_error").innerHTML="Enter date like MM/DD/YYYY";
        document.getElementById("date_error").style.color="red";

    }else{
        document.getElementById("date").style.border="1 px solid green";
        document.getElementById("date_error").innerHTML="";
    }
    
    return false;
}else{
    document.getElementById("order").style.border="1 px solid green";
    document.getElementById("order_error").innerHTML="";
    document.getElementById("user").style.border="1 px solid green";
    document.getElementById("user_error").innerHTML="";
    document.getElementById("category").style.border="1 px solid green";
    document.getElementById("category_error").innerHTML="";
    document.getElementById("amount").style.border="1 px solid green";
    document.getElementById("amount_error").innerHTML="";
    document.getElementById("date").style.border="1 px solid green";
    document.getElementById("date_error").innerHTML="";
   
    return true;
}
}
</script>

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
                    <form action="" method="post" onsubmit="return validation()" enctype="multipart/form-data">
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

 <?php
 require_once("../footer.php");
?> 
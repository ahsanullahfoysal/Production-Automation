<script>
function validation(){
let supplier=document.getElementById("supplier_id").value;
let amount=document.getElementById("amount").value;
let method=document.getElementById("method").value;
let date=document.getElementById("date").value;
if(supplier=="" || amount=="" || method=="" || date==""){
    if(supplier==""){
        document.getElementById("supplier_id").style.border="1px solid red";
        document.getElementById("supplier_error").innerHTML="please select a supplier";
        document.getElementById("supplier_error").style.color="red";

    }else{
        document.getElementById("supplier_id").style.border="1px solid green";
        document.getElementById("supplier_error").innerHTML="";
    }

    if(amount==""){
        document.getElementById("amount").style.border="1px solid red";
        document.getElementById("amount_error").innerHTML="Enter a Numeric value";
        document.getElementById("amount_error").style.color="red";

    }else{
        document.getElementById("amount").style.border="1px solid green";
        document.getElementById("amount_error").innerHTML="";
    }

    if(method==""){
        document.getElementById("method").style.border="1px solid red";
        document.getElementById("method_error").innerHTML="Enter date like MM/DD/YYYY";
        document.getElementById("method_error").style.color="red";

    }else{
        document.getElementById("method").style.border="1px solid green";
        document.getElementById("method_error").innerHTML="";
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
    document.getElementById("supplier_id").style.border="1 px solid green";
    document.getElementById("supplier_error").innerHTML="";
    document.getElementById("amount").style.border="1 px solid green";
    document.getElementById("amount_error").innerHTML="";
    document.getElementById("method").style.border="1 px solid green";
    document.getElementById("method_error").innerHTML="";
    document.getElementById("date").style.border="1 px solid green";
    document.getElementById("date_error").innerHTML="";
   
    return true;
}
}

</script>

<?php
require_once("../header.php");
$id=$_GET['id'];
$suppliers=$con->query("select * from suppliers");
$edit=$con->query("SELECT * from supplier_payment where id=$id")->fetch_assoc();

//$con = new mysqli('localhost', 'root', '', 'production_automation');
if(isset($_POST['submit'])){
    $supplier_id=$_POST['supplier_id'];
    $amount=$_POST['amount'];
    $method=$_POST['method'];
    $date=$_POST['date'];
    $con->query("UPDATE `supplier_payment` SET `supplier_id`='$supplier_id',`amount`='$amount',`method`='$method',`date`='$date' WHERE id=$id");
    ?>
    <script>
        window.location.assign('supplier_payment_list.php')
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
                    <h1>supplier payment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">supplier payment</li>
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
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validation()">
                        <div class="card-body">
                            <div class="row">
                            <div class="col-12">

                            <div class="form-group">
                                        <label for="exampleInputEmail1">Suppliers</label>
                                        <select name="supplier_id" id="supplier_id" class="form-control">
                                            <option value="">Select Name</option>
                                            <?php while($c=$suppliers->fetch_assoc()){ ?>
                                                <option value="<?php echo $c['id'] ?>" <?php if($c['id']==$edit['supplier_id']){echo "selected";} ?>><?php echo $c['contract_person'] ?></option>
                                                <?php } ?>
                                        </select><span id="supplier_error"></span>
                                    </div>
                                    

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">amount</label>
                                        <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter amount" value="<?php echo $edit['amount'] ?>"><span id="amount_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">method</label>
                                        <input type="text" name="method" class="form-control" id="method" placeholder="Enter method" value="<?php echo $edit['method'] ?>"><span id="method_error" ></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">date</label>
                                        <input type="date" name="date" class="form-control" id="date" placeholder="date" value="<?php echo $edit['date'] ?>"><span id="date_error" ></span>
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
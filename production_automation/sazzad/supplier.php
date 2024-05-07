<?php
require_once("../header.php");

//require_once('../database_con.php');
if(isset($_POST['submit'])){
    $company_name=$_POST['company_name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];
    $contract_person=$_POST['contract_person'];
    $bank_info=$_POST['bank_info'];
    
    $con->query("INSERT INTO `suppliers`( `company_name`,`email`,`phone`,`address`,`contract_person`,`bank_info`) VALUES ('$company_name',' $email',' $phone','$address','$contract_person',' $bank_info')")
    ?>
    <script>
        window.location.assign('supplier_list.php')
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
                    <h1>Suppliers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Suppliers</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <!-- <h3 class="card-title"><a href="supplier_list.php" class="btn btn-primary btn-md">Add Supplier</a></h3> -->
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                            <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">company name:</label>
                                        <input type="text" name="company_name" class="form-control" id="exampleInputEmail1" placeholder="company name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">email:</label>
                                        <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">phone:</label>
                                        <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Phone Number">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">address</label>
                                        <input type="text" name="address" class="form-control" id="exampleInputEmail1" placeholder="address">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">contract person</label>
                                        <input type="text" name="contract_person" class="form-control" id="exampleInputEmail1" placeholder="contract person Name	">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">bank Information</label>
                                        <input type="text" name="bank_info" class="form-control" id="exampleInputEmail1" placeholder="Bank Information">
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
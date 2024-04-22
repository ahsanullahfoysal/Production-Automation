<?php
require_once("../header.php");
$id=$_GET['id'];
$edit=$con->query("SELECT * from suppliers where id=$id")->fetch_assoc();

//$con = new mysqli('localhost', 'root', '', 'production_automation');
if(isset($_POST['submit'])){
    $company_name=$_POST['company_name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];
    $contract_person=$_POST['contract_person'];
    $bank_info=$_POST['bank_info'];
    
    $dip=$con->query("UPDATE `suppliers` SET `company_name`='$company_name',`email`='$email',`phone`='$phone',`address`='$address',`contract_person`='$contract_person',`bank_info`='$bank_info' WHERE id=$id");
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
                    <h1>suppliers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">suppliers</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><a href="supplier_list.php" class="btn btn-primary btn-md">Add Supplier List</a></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                            <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">company name</label>
                                        <input type="text" name="company_name" class="form-control" id="exampleInputEmail1" placeholder="Company Name Name" value="<?php echo $edit['company_name'] ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">email</label>
                                        <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Email" value="<?php echo $edit['email'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">phone</label>
                                        <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Enter Phone" value="<?php echo $edit['phone'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">address</label>
                                        <input type="text" name="address" class="form-control" id="exampleInputEmail1" placeholder="Address" value="<?php echo $edit['address'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">contract person</label>
                                        <input type="text" name="contract_person" class="form-control" id="exampleInputEmail1" placeholder="Contact Person Name" value="<?php echo $edit['contract_person'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">company name</label>
                                        <input type="text" name="bank_info" class="form-control" id="exampleInputEmail1" placeholder="Bank Information" value="<?php echo $edit['bank_info'] ?>">
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
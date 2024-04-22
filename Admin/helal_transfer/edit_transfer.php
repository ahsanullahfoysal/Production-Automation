<?php
require_once("../header.php");
$trs_id=$_GET['id'];
$trasfer = $con->query("SELECT * from transfers where id='$trs_id'")->fetch_assoc();
$rcv_date=substr($trasfer['received_date'],0,10) ;
$tr_date=substr($trasfer['transfer_date'],0,10) ;


$bid = $trasfer['bundle_id'];
$_b = $con->query("SELECT * from bundles where id='$bid'")->fetch_assoc();
$bundle_code= $_b['bundle_code'];
// echo "<pre>";
// echo $rcv_date;

// print_r($trasfer);exit();

if (isset($_POST['submit'])) { 
$received_date = $_POST['received_date'];
$transfer_date = $_POST['transfer_date'];
$con->query("UPDATE `transfers` SET received_date='$received_date',transfer_date='$transfer_date' where id='$trs_id'");
 ?>
   
   <script>
        window.location.assign('transfers.php');
    </script>
    
    <?php } ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Your Transfers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">update</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">
                        Update Transfers</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    
                    <form action="" method="post" onsubmit="return validate()" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Bundle Code</label>
                                        <span> <h2 style="background-color:black;color:white;text-align:center"> <?php echo $bundle_code ?></h2>  </span>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Received_date</label>
                                        <input type="datetime-local" name="received_date" class="form-control" value="<?php echo $rcv_date  ?>"><span id=""></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Transfer_date</label>
                                        <input type="datetime-local" name="transfer_date" class="form-control" value="<?php echo $tr_date ?>"><span id=""></span>
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

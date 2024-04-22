<?php
require_once("../header.php");


if (isset($_POST['submit'])) {
    $order_id = $_POST['order_id'];
    $s = $_POST['pstep'];
    $bundle_code = $_POST['bundle_id'];



    $bundle_id_convert = $con->query("SELECT * from bundles where bundle_code='$bundle_code'")->fetch_assoc();
    $ptt = $con->query("SELECT processing_steps.* FROM processing_steps JOIN worker_assign ON processing_steps.id=worker_assign.processing_steps_id Where processing_steps.title='$s'")->fetch_assoc();


    $order_id = $bundle_id_convert["order_id"];
    $bundle_id = $bundle_id_convert["id"];
    $processing_steps = $ptt["id"];
    $received_date = $_POST['received_date'];
    $transfer_date = $_POST['transfer_date'];


    $con->query("INSERT INTO `transfers`(`order_id`, `processing_steps_id`, `bundle_id`, `received_date`, `transfer_date`) VALUES ('$order_id','$processing_steps',' $bundle_id','$received_date','$transfer_date')");
    ?>
    <script>
        window.location.assign('transfers.php');
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
                    <h1>Enter Bundle Code To Add Transfers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"></li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">
                            ADD Transfers</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <form action="" method="post" onsubmit="return validate()" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Bundle Code</label>
                                        <input type="text" onkeyup="get_bundle(this.value)" name="bundle_id"
                                            class="form-control" id="bundle_code" placeholder="Enter bundle_code"><span
                                            id="bundle_codeError"></span>
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Order Name</label>
                                        <input type="text" name="order_id" class="form-control" id="order_id"
                                            placeholder="Enter order_name"><span id="order_nameError"></span>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Company Name</label>
                                        <input type="text" name="company_name" class="form-control" id="buyer"
                                            placeholder="Enter company_name"><span id="company_nameError"></span>
                                    </div>
                                </div>


                                <!-- ................................... -->
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Processing Step</label>
                                        <input type="hidden" name="step_id" id="step_id">
                                        <span id='spid'></span>

                                        

                                    </div>
                                </div>
                                <!-- ................................... -->


                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Received_date</label>
                                        <input type="datetime-local" name="received_date" class="form-control"><span
                                            id=""></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Transfer_date</label>
                                        <input type="datetime-local" name="transfer_date" class="form-control"><span
                                            id=""></span>
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
<script>
    function get_bundle(code) {
        fetch("get_prossesing.php?code=" + code)
            .then((r) => r.json())
            .then((data) => {

                document.getElementById('buyer').value = data[0].company_name
                document.getElementById('order_id').value = data[1].name
                // document.getElementById('step_id').value = data[2].project_id
                let st =
                    ` <select name="pstep" id="spid">
                 <option value="">Select Step name</option>`
                data[2].map((d, i) => {
                    st += `<option value="${d.title}">${d.title}</option>`
                })
                st += `</select>`
                document.getElementById('spid').innerHTML = st;
            })
    }

</script>
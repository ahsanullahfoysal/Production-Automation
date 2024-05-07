<?php
require_once("../header.php");
$machines_error = $con->query("SELECT machines.name,error_reports.* FROM machines JOIN error_reports ON machines.id=error_reports.machine_id ORDER BY error_time DESC")->fetch_all(MYSQLI_ASSOC);

?>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Machines list</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Machines list</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <h3 class="card-title">List</h3>
                            </div>
                            
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">

                        </div>
                    </div>
                    <table class="table table-bordered">

                        <thead>
                            <tr>
                                <th style="width: 10px">SL</th>
                                <th>Machines</th>
                                <th>Error Time</th>
                                <th>Error</th>
                                <th>Note</th>
                                <th style="width: 150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($machines_error as $i => $p) { ?>

                                <tr>
                                    <td>
                                        <?php echo ++$i ?>
                                    </td>
                                    <td>
                                        <?php echo $p['name'] ?>    
                                    </td>
                                    <td>
                                        <?php echo $p['error_time'] ?>
                                    </td>
                                    <td>
                                        <?php echo $p['error'] ?>
                                    </td>
                                    <td>
                                        <?php echo $p['note'] ?>
                                    </td>
                                    <td>
                                        <a href="error_report_edit.php?id=<?php echo $p['id'] ?>"
                                            class="btn btn-success">Edit</a>
                                        <a href="error_report_delete.php?id=<?php echo $p['id'] ?>" class="btn btn-danger"
                                            onclick="return confirm('Are You sure?')">Delete</a>
                                    </td>

                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

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
    $(document).ready(function () {
        $('#frm_valid').validate({
            rules: {
                buyer_id: "required",
                s_date: "required",
                e_date: "required",

            },
            messages: {
                buyer_id: "Please select a Buyer",
                s_date: "Enter only Numeric Value",
                e_date: "Please Input js TO Date",
            }
        })
    })
</script>
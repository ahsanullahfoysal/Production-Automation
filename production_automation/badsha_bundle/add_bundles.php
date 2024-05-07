<?php
require_once("../header.php");
//id comes from order tables
$id = $_GET['id'];
$order = $con->query("select orders.*,projects.name FROM orders JOIN projects ON orders.project_id=projects.id where orders.id=$id")->fetch_assoc();
// echo"<pre>";
// print_r($order);

?>


<?php
if (isset($_POST['submit'])) {
    $order_id = $_POST['order_id'];
    $bundle_code = $_POST['bundle_code'];
    foreach ($bundle_code as $b) {
        $con->query("INSERT INTO `bundles`(`order_id`, `bundle_code`) VALUES ('$order_id','$b')");
    }
    ?>
    <script>
        window.location.assign('bundle_list.php')
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
                    <h1>Add Bundles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Bundles</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><a href="bundle_list.php" class="btn btn-primary btn-md">Bundles List</a>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" onsubmit="return fn()" enctype="multipart/form-data" id="frm_valid">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Project name</label>
                                        <select name="order_id" id="order_id" class="form-control">
                                            <option value="<?php echo $order['id'] ?>">
                                                <?php echo $order['name'] ?>
                                            </option>
                                        </select><span id="error"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Order Quantity</label>
                                        <input type="text" name="order_quantity" class="form-control"
                                            id="order_quantity" placeholder="Enter Bundle Code" value="<?php ?>"><span
                                            id="error2"></span>
                                    </div>

                                </div>
                            </div>

                            <!-- Bundle code -->

                            <div class="row" id='bndl'>
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
    $(document).ready(function () {

        let id = $('#order_id').val();
        console.log(id)
        $.ajax({
            url: 'api.php',
            method: 'post',
            dataType: 'json',
            data: {
                id_a: id
            },
            success: function (data) {
                $('#order_quantity').val(data['quantity']);
                let ht = '';
                for (i = 1; i <= data['quantity']; i++) {
                    ht += `<div class="col-md-2">
                                    <label for="exampleInputEmail1">Bundle No ${i}</label>
                                    <input type="text" name="bundle_code[]" id="bundle_code" class="form-control">
                                </div>`
                }
                $('#bndl').html(ht)

            }
        })

        $('#frm_valid').validate({
            rules: {
                order_id: "required",
                bundle_code: "required"

            },
            messages: {
                order_id: "Please select a Order",

            }
        })
    })
</script>
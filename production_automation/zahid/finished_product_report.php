<?php
require_once("../header.php");
$projects = $con->query("select * from projects ")->fetch_all(MYSQLI_ASSOC);

$data = $con->query('SELECT finished_product.*,shipping.quantity AS ship,finished_product_wastage.quantity AS fin,orders.project_id FROM finished_product JOIN shipping ON finished_product.order_id=shipping.order_id JOIN finished_product_wastage ON finished_product.order_id=finished_product_wastage.order_id JOIN orders ON finished_product.order_id=orders.id');

if (isset($_POST['submit1'])) {
    $search = $_POST['search'];
    $data = $con->query('SELECT finished_product.*,shipping.quantity AS ship,finished_product_wastage.quantity AS fin,orders.project_id FROM finished_product JOIN shipping ON finished_product.order_id=shipping.order_id JOIN finished_product_wastage ON finished_product.order_id=finished_product_wastage.order_id JOIN orders ON finished_product.order_id=orders.id where orders.project_id=' . $search);
}
if (isset($_POST['submit2'])) {
    $date = $_POST['date'];
    $data = $con->query("SELECT finished_product.*,shipping.quantity AS ship,finished_product_wastage.quantity AS fin,orders.project_id FROM finished_product JOIN shipping ON finished_product.order_id=shipping.order_id JOIN finished_product_wastage ON finished_product.order_id=finished_product_wastage.order_id JOIN orders ON finished_product.order_id=orders.id where finished_product.date like '$date%'");
}


?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Finished Product Inventory</h1>
                </div>


                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">search</a></li>
                        <li class="breadcrumb-item active">Finished Product List</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <form action="" method="post" id="pro" class="form-inline">
                        <select name="search" id="project" class="form-control">
                            <option value="">select project name</option>
                            <?php foreach ($projects as $c) { ?>
                                <option value="<?php echo $c['id'] ?>">
                                    <?php echo $c['name'] ?>
                                </option>
                            <?php } ?>
                        </select>
                        <span id="project_error"></span>
                        <input type="submit" value="search" name="submit1" class="btn btn-primary">
                    </form>
                </div>


                <div class="col-sm-6">
                    <form action="" method="post" id="dat" class="form-inline float-sm-right">
                        <input type="date" name="date" id="date" class="form-control">
                        <span id="date_error"></span>
                        <input type="submit" value="search" name="submit2" class="btn btn-primary">
                    </form>
                </div>
            </div>


            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Finished Product List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th style="width:150px">product name</th>

                                    <th>Stock in</th>
                                    <th>Stock out</th>
                                    <th>wastage</th>
                                    <th>Current Stock </th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $qun = '';
                                $sip = '';
                                $finis = '';

                                ?>
                                <?php foreach ($data as $i => $p) { ?>

                                    <tr>
                                        <td>
                                            <?php echo ++$i ?>
                                        </td>
                                        <td>
                                            <?php $projects = $con->query("select * from projects where id=" . $p['project_id'])->fetch_assoc();
                                            echo $projects['name'] ?>
                                        </td>
                                        <td>
                                            <?php echo $p['quantity'] ?>
                                            <?php $qun = $p['quantity'] ?>
                                        </td>
                                        <td>
                                            <?php echo $p['ship'] ?>
                                            <?php $sip = $p['ship'] ?>
                                        </td>
                                        <td>
                                            <?php echo $p['fin'] ?>
                                            <?php $finis = $p['fin'] ?>
                                        </td>
                                        <td>
                                            <?php echo $qun - $sip - $finis ?>

                                        </td>
                                        <td>
                                            <?php echo $p['date'] ?>
                                        </td>

                                    </tr>
                                    <?php
                                }
                                ?>


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
        $('#pro').validate({
            rules: {
                search: "required",

            },
            messages: {
                search: "Please select an project name",

            }
        })
    })
    $(document).ready(function () {
        $('#dat').validate({
            rules: {
                date: "required",

            },
            messages: {
                date: "Please select date",

            }
        })
    })
</script>
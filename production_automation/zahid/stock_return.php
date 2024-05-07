<?php
require_once("../header.php");
// require_once('../database_con.php');

$material = $con->query("select * from raw_materials");

$products = $con->query("SELECT * from purchase group by invoice_id");



$purchase = $con->query("select purchase.*,raw_materials.name from purchase join raw_materials on purchase.material_id=raw_materials.id");
?>

<script>
    function fn() {
        let name = document.getElementById('invoice_id').value
        fetch('<?php echo $_SESSION['base_url'] ?>/zahid/api.php?id=' + name)
            .then((response) => response.json())
            .then((result) => {
                let ht = `
                <select name="material_id" id="material_id" class="form-control">
                                            <option value="">Select Materials</option>`
                result.map((d, i) => {
                    ht += `<option value="${d.material_id}">${d.name}</option>`
                })


                ht += `</select>`
                document.getElementById('material').innerHTML = ht;

            })
    }
</script>
<script>
    $(document).ready(function(){
        $('#frm').validate({
            rules:{
                invoice_id:"required",
                quantity:"required",
                date:"required",
                material_id:"required"
            },
            messages:{
                invoice_id:"Please select an Invoice Id",
                quantity:"Please select quantity",
                date:"Please select date",
                material_id:"Please select an material Id"
            }
        })
    })
</script>


<?php
if (isset($_POST['submit'])) {
    $invoice_id = trim($_POST['invoice_id']);
    $quantity = trim($_POST['quantity']);
    $date = trim($_POST['date']);
    $material_id = trim($_POST['material_id']);

    $con->query("INSERT INTO `stock_return`(`invoice_id`, `quantity`, `date`, `material_id`) VALUES ('$invoice_id','$quantity','$date','$material_id')");

?>
    <script>
        window.location.assign('stock_return_list.php');
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
                    <h1>stock Return</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">stock Return</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Stock Return </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" id="frm" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Invoice ID</label>
                                        <select name="invoice_id" id="invoice_id" class="form-control " onchange="fn()">
                                            <option value="">Select Category</option>
                                            <?php while ($c = $products->fetch_assoc()) { ?>
                                                <option value="<?php echo $c['invoice_id'] ?>"><?php echo $c['invoice_id'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <span id="invoice_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Quantity</label>
                                        <input type="text" name="quantity" class="form-control" id="quantity" placeholder="Enter Name"><span id="quantity_error"></span>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">date</label>
                                        <input type="datetime-local" name="date" class="form-control" id="date" placeholder="Enter Name"><span id="date_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Material</label>
                                        <span id="material">
                                            <select name="material_id" id="material_id" class="form-control">
                                                <option value="">Select Materials</option>

                                            </select>
                                        </span>
                                        <span id="material_error"></span></span>
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
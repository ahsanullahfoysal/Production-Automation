<?php
require_once("../header.php");
?>
<script>
    function validation() {
        let material = document.getElementById("material").value;
        let date1 = document.getElementById("date1").value;
        let date2 = document.getElementById("date2").value;
        if (material == "" || date1 == "" || date2 == "") {
            if (material == "") {
                document.getElementById("material").style.border = "1px solid red";
                document.getElementById("material_error").innerHTML = "please select category";
                document.getElementById("material_error").style.color = "red";

            } else {
                document.getElementById("material").style.border = "1px solid green";
                document.getElementById("material_error").innerHTML = "";
            }

            if (date1 == "") {
                document.getElementById("date1").style.border = "1px solid red";
                document.getElementById("date1_error").innerHTML = "please select start date";
                document.getElementById("date1_error").style.color = "red";

            } else {
                document.getElementById("date1").style.border = "1px solid green";
                document.getElementById("date1_error").innerHTML = "";
            }

            if (date2 == "") {
                document.getElementById("date2").style.border = "1px solid red";
                document.getElementById("date2_error").innerHTML = "please select end date";
                document.getElementById("date2_error").style.color = "red";

            } else {
                document.getElementById("date2").style.border = "1px solid green";
                document.getElementById("date2_error").innerHTML = "";
            }
            return false;
        } else {
            document.getElementById("material").style.border = "1 px solid green";
            document.getElementById("material_error").innerHTML = "";
            document.getElementById("date1").style.border = "1 px solid green";
            document.getElementById("date1_error").innerHTML = "";
            document.getElementById("date2").style.border = "1 px solid green";
            document.getElementById("date2_error").innerHTML = "";
            return true;
        }
    }
</script>


<?php
$products = $con->query("select expense.*, users.name as user_name ,expense_category.name as expense_category_name from expense join users on users.id = expense.user_id join expense_category on expense_category.id = expense.category_id ")->fetch_all(MYSQLI_ASSOC);
$materials = $con->query("select * from expense_category")->fetch_all(MYSQLI_ASSOC);
if (isset($_POST['submit1'])) {
    $matid = $_POST['material'];

    $products = $con->query("select expense.*, users.name as user_name ,expense_category.name as expense_category_name from expense join users on users.id = expense.user_id join expense_category on expense_category.id = expense.category_id where expense.category_id=$matid ")->fetch_all(MYSQLI_ASSOC);
}

if (isset($_POST['submit2'])) {
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];

    $products = $con->query("select expense.*, users.name as user_name ,expense_category.name as expense_category_name from expense join users on users.id = expense.user_id join expense_category on expense_category.id = expense.category_id where (expense.date between '$date1' and '$date2') ")->fetch_all(MYSQLI_ASSOC);
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Expense List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Expense List</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <h3 class="card-title">Expense List</h3>
                            </div>
                            <div class="col-md-3 offset-7 d-flex justify-content-end">
                                <a href="<?php echo $_SESSION['base_url'] ?>/ruhul/report.php" class="btn btn-primary">View Report</a>
                                <a href="<?php echo $_SESSION['base_url'] ?>/ruhul/expense.php" class="btn btn-warning">Add Expense</a>
                            </div>
                        </div>

                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">

                        <table class="table table-bordered table-hover">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <form action="" class="form-inline" method="POST" onsubmit="return validation()">
                                        <div class="form-group d-flex">
                                            <select name="material" id="material" onchange="getprice((this.value),1)" class="form-control">
                                                <option value="">Select Expense</option>
                                                <?php foreach ($materials as $d) { ?>
                                                    <option value="<?php echo $d['id'] ?>"><?php echo $d['name'] ?></option>
                                                <?php } ?>
                                            </select><span id="material_error"></span>
                                            <button type="submit" name="submit1" class="btn btn-secondary">Submit</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-md-2 offset-3 text-right">
                                    <form action="" class="form-inline float-sm-right" method="POST" onsubmit="return validation()">
                                        <div class="form-group d-flex">
                                            <div class="d-flex ">
                                                <label for="exampleInputEmail1" class="btn btn-info">From</label>
                                                <input type="date" name="date1" class="form-control" id="date1" placeholder="Enter title">
                                                <span id="date1_error"></span>
                                                <label for="exampleInputEmail1" class="btn btn-info">To</label>
                                                <input type="date" name="date2" class="form-control" id="date2" placeholder="Enter title">
                                                <span id="date2_error"></span>
                                            </div>
                                            <div>
                                                <input type="submit" value="Submit" name="submit2" class="btn btn-secondary"></input>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                            <thead>
                                <tr>
                                    <th style="width: 10px">SL</th>
                                    <th>Order Id</th>
                                    <th>User Name</th>
                                    <th>Category </th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th style="width: 160px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $i => $p) { ?>
                                    <tr>
                                        <td><?php echo ++$i ?></td>
                                        <td><?php echo $p['order_id'] ?></td>
                                        <td><?php echo $p['user_name'] ?></td>
                                        <td><?php echo $p['expense_category_name'] ?></td>
                                        <td><?php echo $p['amount'] ?></td>
                                        <td><?php echo $p['date'] ?></td>

                                        <td>
                                            <a href="expense_edit.php?id=<?php echo $p['id'] ?>" class="btn btn-success btn-sm">Update</a>
                                            <a href="expense_delete.php?id=<?php echo $p['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
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
<?php require_once('../header.php'); ?>
<?php
$i = $_GET['id'];
$materials = $con->query('select * from raw_materials')->fetch_all(MYSQLI_ASSOC);
$supplier = $con->query('select * from suppliers')->fetch_all(MYSQLI_ASSOC);
$purchase = $con->query("select * from purchase where id=$i")->fetch_assoc();
echo $purchase["date"];

if (isset($_POST['submit'])) {

  $mat = $_POST['material'];
  $sup = $_POST['supplier'];
  $qnt = $_POST['quantity'];
  $pri = $_POST['price'];
  $inv = $_POST['inid'];
  $dte = $_POST['date'];

  $con->query("update purchase set invoice_id=$inv,price=$pri,material_id=$mat,supplier_id=$sup,quantity=$qnt,date='$dte' where id=$i");
}
?>
<script>
  function getprice(id, eid) {
    fetch(`<?php echo $_SESSION['base_url'] ?>/rabbi_purchase/api.php?id=${id}`)
      .then((response) => response.json())
      .then((data) => {
        let p = parseFloat(data["price"]);
        let q = parseFloat(document.getElementById(`quantity${eid}`).value);
        if (!isNaN(q)) {
          let price = p * q;
          document.getElementById(`price${eid}`).value = price;
        }
      })
  }

  function getp2() {
    let x = document.getElementById(`material1`).value;
    fetch(`<?php echo $_SESSION['base_url'] ?>/rabbi_purchase/api.php?id=${x}`)
      .then((response) => response.json())
      .then((data) => {
        let p = parseFloat(data["price"]);
        let q = parseFloat(document.getElementById(`quantity1`).value);
        if (!isNaN(q)) {
          let price = p * q;
          document.getElementById(`price1`).value = price;
        }
      })
  }
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Purchase</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Purchase</li>
          </ol>
        </div>
      </div>
      <div>
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit Purchase</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Invoice ID</label>
                    <input value="<?php echo $purchase["invoice_id"] ?>" type="number" name="inid" class="form-control" id="exampleInputEmail1" placeholder="Enter title">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Date</label>
                    <input type="datetime-local" value="<?php echo $purchase["date"] ?>" name="date" class="form-control" id="exampleInputEmail1" placeholder="Enter title">
                  </div>
                </div>
              </div>
              <div class="row">
                <table class="container-fluid">
                  <thead>
                    <tr>
                      <th class="col-3">Materials</th>
                      <th class="col-3">Supplier</th>
                      <th class="col-3">Quantity</th>
                      <th class="col-3">Price</th>
                    </tr>
                  </thead>
                  <tbody id="purchase">
                    <tr>
                      <td>
                        <div class="form-group">
                          <select name="material" id="material1" onchange="getprice((this.value),1)" class="form-control">
                            <option value="">Select Material</option>

                            <?php foreach ($materials as $c) { ?>
                              <option value="<?php echo $c['id'] ?>" <?php
                                                                      if ($c['id'] == $purchase['material_id']) {
                                                                        echo "selected";
                                                                      }
                                                                      ?>><?php echo $c['name'] ?></option>
                            <?php } ?>

                          </select>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <select name="supplier" id="supplier1" class="form-control">
                            <option value="">Select Supplier</option>

                            <?php foreach ($supplier as $c) { ?>
                              <option value="<?php echo $c['id'] ?>" <?php
                                                                      if ($c['id'] == $purchase['supplier_id']) {
                                                                        echo "selected";
                                                                      }
                                                                      ?>><?php echo $c['company_name'] ?></option>
                            <?php } ?>

                          </select>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="text" name="quantity" onkeydown="getp2()" value="<?php echo $purchase["quantity"] ?>" class="form-control" id="quantity1" placeholder="Enter title">
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="text" name="price" value="<?php echo $purchase["price"] ?>" class="form-control" id="price1" placeholder="Enter title">
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
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

<?php require_once('../footer.php'); ?>
<?php
require_once('../header.php');
$invoice = $_GET['id'];
$materials = $con->query('select * from raw_materials')->fetch_all(MYSQLI_ASSOC);
$supplier = $con->query('select * from suppliers')->fetch_all(MYSQLI_ASSOC);
$purchase = $con->query("select * from purchase where invoice_id=$invoice")->fetch_all(MYSQLI_ASSOC);
$pid = [];

if (isset($_POST['submit'])) {

  $mat = $_POST['material'];
  $sup = $_POST['supplier'];
  $qnt = $_POST['quantity'];
  $pri = $_POST['price'];
  $inv = $_POST['inid'];
  $dte = $_POST['date'];
  $length = strlen($inv);
  if (is_numeric($inv)) {
  foreach ($pri as $k => $d) {

    #$p = $d;
    $m = $mat[$k];
    $s = $sup[$k];
    $q = $qnt[$k];
    $proid = $_SESSION["purchase_id"][$k];

    #echo "$inv,$p,$m,$s,$q,$dte<br>";

    $allnumber = is_numeric($m) && is_numeric($s) && is_numeric($q) && is_numeric($d) && $m != "xxx" && $s != "xxx";
    if ($allnumber) {
      $con->query("insert into purchase(invoice_id,price,material_id,supplier_id,quantity,date)values($inv,$d,$m,$s,$q,'$dte')");
    }
    ?>
    <script>
      window.location.assign('purchase_list2.php')
    </script>
<?php
  }}
} ?>
?>
<script>
  function getprice(id, eid) {
    if(id != "xp"){
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
  }

  function getp2(f) {
    if(id != "xp"){
    let x = document.getElementById(`material${f}`).value;
    fetch(`<?php echo $_SESSION['base_url'] ?>/rabbi_purchase/api.php?id=${x}`)
      .then((response) => response.json())
      .then((data) => {
        let p = parseFloat(data["price"]);
        let q = parseFloat(document.getElementById(`quantity${f}`).value);
        if (!isNaN(q)) {
          let price = p * q;
          console.log(p, q, price);
          document.getElementById(`price${f}`).value = price;
        }
      })
    }
  }

  function errchk(idname) {
    let matv = document.getElementById(idname).value;
    var inputElement = document.getElementById(idname);
    console.log(matv);
    if (!isNaN(matv)) {
      inputElement.style.border = '';
      console.log('The variable is a number.');
    } else {
      inputElement.style.border = '2px solid red';
      console.log('The variable is not a number.');
    }
  }

  function errinv() {
    let invv = document.getElementById("inv1").value;
    var inputElement = document.getElementById("inv1");
    console.log(invv);
    if (!isNaN(invv)) {
      inputElement.style.border = '';
      console.log('The variable is a number.');
    } else {
      inputElement.style.border = '2px solid red';
      console.log('The variable is not a number.');
    }
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
                    <input onkeyup="errinv()" value="<?php echo $purchase[0]["invoice_id"] ?>" type="text" name="inid" class="form-control" id="inv1" placeholder="Enter title">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Date</label>
                    <input type="datetime-local" value="<?php echo $purchase[0]["date"] ?>" name="date" class="form-control" id="exampleInputEmail1" placeholder="Enter title">
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
                    <?php
                    $ida = 1;
                    foreach ($purchase as $d) {
                      $xid = $d["id"];
                      array_push($pid, $xid);
                      $_SESSION['purchase_id'] = $pid;
                    ?>
                      <tr>
                        <td>
                          <div class="form-group">
                            <select name="material[]" id="material<?php echo $ida ?>" onchange="getprice((this.value),<?php echo $ida ?>), errchk('material<?php echo $ida ?>')" class="form-control">
                              <option value="xp">Select Material</option>

                              <?php foreach ($materials as $c) { ?>
                                <option value="<?php echo $c['id'] ?>" <?php
                                                                        if ($c['id'] == $d['material_id']) {
                                                                          echo "selected";
                                                                        }
                                                                        ?>><?php echo $c['name']." ".$c['price']." Taka" ?></option>
                              <?php } ?>

                            </select>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <select onchange="errchk('supplier<?php echo $ida ?>')" name="supplier[]" id="supplier<?php echo $ida ?>" class="form-control">
                              <option value="xp">Select Supplier</option>

                              <?php foreach ($supplier as $c) { ?>
                                <option value="<?php echo $c['id'] ?>" <?php
                                                                        if ($c['id'] == $d['supplier_id']) {
                                                                          echo "selected";
                                                                        }
                                                                        ?>><?php echo $c['company_name'] ?></option>
                              <?php } ?>

                            </select>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <input onkeyup="errchk('quantity<?php echo $ida ?>')" type="text" name="quantity[]" onkeydown="getp2(<?php echo $ida ?>)" value="<?php echo $d["quantity"] ?>" class="form-control" id="quantity<?php echo $ida ?>" placeholder="Enter title">
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <input onkeyup="errchk('price<?php echo $ida ?>')" type="text" name="price[]" value="<?php echo $d["price"] ?>" class="form-control" id="price<?php echo $ida ?>" placeholder="Enter title">
                          </div>
                        </td>
                      </tr>
                    <?php $ida += 1;
                    } ?>
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
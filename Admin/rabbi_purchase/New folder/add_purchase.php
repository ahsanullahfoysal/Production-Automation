<?php require_once('../header.php'); ?>
<?php
$materials = $con->query('select * from raw_materials')->fetch_all(MYSQLI_ASSOC);
$supplier = $con->query('select * from suppliers')->fetch_all(MYSQLI_ASSOC);
date_default_timezone_set('Asia/Dhaka');
$lenError = $qErr = $pErr = "";

if (isset($_POST['submit'])) {
  // echo "<pre>";
  // print_r($_POST);
  // exit;
  $mat = $_POST['material'];
  $sup = $_POST['supplier'];
  $qnt = $_POST['quantity'];
  $pri = $_POST['price'];
  $inv = $_POST['inid'];
  $dte = $_POST['date'];
  $length = strlen($inv);
  $zlen = count($sup);
  $nx = 0;
  // print_r($mat[0]);exit;
  if (is_numeric($inv)) {
    foreach ($pri as $k => $d) {

      #$p = $d;
      $m = $mat[$k];
      $s = $sup[$k];
      $q = $qnt[$k];
      #echo "$inv,$p,$m,$s,$q,$dte<br>";
      $allnumber = is_numeric($m) && is_numeric($s) && is_numeric($q) && is_numeric($d) && $m != "xxx" && $s != "xxx";
      if ($allnumber) {
        $con->query("insert into purchase(invoice_id,price,material_id,supplier_id,quantity,date)values($inv,$d,$m,$s,$q,'$dte')");
      }
?>
      <script>
        window.location.assign('purchase_list2.php');
      </script>
<?php
    }
  }
} ?>

<script>
  function getprice(id, eid) {
    if (id != "xxx") {
      fetch(`<?php echo $_SESSION['base_url'] ?>/rabbi_purchase/api.php?id=${id}`)
        .then((response) => response.json())
        .then((data) => {
          let p = parseFloat(data["price"]);
          let q = document.getElementById(`quantity${eid}`).value;
          console.log(id);
          if (!isNaN(q)) {
            let price = p * q;
            document.getElementById(`price${eid}`).value = price;
          }
        })
    }
  }

  function getp2(f) {
    let x = document.getElementById(`material${f}`).value;
    if (x != "xxx") {
      fetch(`<?php echo $_SESSION['base_url'] ?>/rabbi_purchase/api.php?id=${x}`)
        .then((response) => response.json())
        .then((data) => {
          let p = parseFloat(data["price"]);
          let q = document.getElementById(`quantity${f}`).value;

          if (!isNaN(q)) {
            let price = p * q;
            document.getElementById(`price${f}`).value = price;
            console.log(p, q, price);
          }
        })
    }
  }

  function errchk(idname) {
    let matv = document.getElementById(idname).value;
    var inputElement = document.getElementById(idname);
    if (!isNaN(matv)) {
      inputElement.style.border = '';
      console.log('The variable is a number.');
    } else {
      inputElement.style.border = '2px solid red';
      console.log('The variable is not a number.');
    }
  }

  function errinv() {
    let invv = document.getElementById("inv").value;
    var inputElement = document.getElementById("inv");
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
          <h1>Add Purchase</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Purchase</li>
          </ol>
        </div>
      </div>
      <div>
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add Purchase</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Invoice ID</label><span style="color: red;"><?php echo "  " . $lenError; ?></span>
                    <input onkeyup="errinv()" value="<?php echo rand(1, 999999999) ?>" type="text" name="inid" class="form-control" id="inv" placeholder="Enter title">
                    <span id="invoice_error"></span>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Date</label>
                    <input value="<?php echo date('Y-m-d\TH:i:s'); ?>" type="datetime-local" name="date" class="form-control" id="exampleInputEmail1" placeholder="Enter title">
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
                          <select name="material[]" id="material1" onchange="getprice((this.value),1), errchk('material1')" class="form-control">
                            <option value="xxx">Select Material</option>
                            <?php foreach ($materials as $d) { ?>
                              <option value="<?php echo $d['id'] ?>"><?php echo $d['name'] ?></option>
                            <?php } ?>
                          </select>
                          <span id="material_error1"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <select name="supplier[]" id="supplier1" class="form-control" onchange="errchk('supplier1')">
                            <option value="xxx">Select Supplier</option>
                            <?php foreach ($supplier as $d) { ?>
                              <option value="<?php echo $d['id'] ?>"><?php echo $d['company_name'] ?></option>
                            <?php } ?>
                          </select>
                          <span id="supplier_error1"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="text" name="quantity[]" onkeyup="getp2(1), errchk('quantity1')" class="form-control" id="quantity1" placeholder="Enter title">
                          <span id="quantity_error1"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="text" name="price[]" onkeyup="errchk('price1')" class="form-control" id="price1" placeholder="Enter title"><span id="price_error1"></span>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>
                        <a href="#" onclick="addmore()" class="btn btn-primary">Add More</a>
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <!-- /.card-body -->
            <script>
              let sl = 2;

              function addmore() {
                let ht = document.getElementById('purchase').innerHTML
                ht = ht + `
                <tr>
                      <td>
                        <div class="form-group">
                          <select onchange="getprice(this.value,${sl}), errchk('material${sl}')" name="material[]" id="material${sl}" class="form-control">
                            <option value="xxx">Select Material</option>
                            <?php foreach ($materials as $d) { ?>
                              <option value="<?php echo $d['id'] ?>"><?php echo $d['name'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <select name="supplier[]" id="supplier${sl}" onchange="errchk('supplier${sl}')" class="form-control">
                            <option value="xxx">Select Supplier</option>
                            <?php foreach ($supplier as $d) { ?>
                              <option value="<?php echo $d['id'] ?>"><?php echo $d['company_name'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="text" name="quantity[]" onkeyup="getp2(${sl}), errchk('quantity${sl}')" class="form-control" id="quantity${sl}" placeholder="Enter title">
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="text" name="price[]" onkeyup="errchk('price${sl}')" class="form-control" id="price${sl}" placeholder="Enter title">
                        </div>
                      </td>
                    </tr>`
                document.getElementById('purchase').innerHTML = ht
                sl += 1;
              }
            </script>

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
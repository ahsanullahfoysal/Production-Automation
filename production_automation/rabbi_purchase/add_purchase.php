<?php require_once('../header.php'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<?php
$materials = $con->query('select * from raw_materials')->fetch_all(MYSQLI_ASSOC);
$supplier = $con->query('select * from suppliers')->fetch_all(MYSQLI_ASSOC);
date_default_timezone_set('Asia/Dhaka');
$lenError = $qErr = $pErr = "";

function generateInvoiceId()
{
  // Base ID with timestamp and extra entropy (slightly shorter)
  $baseId = mt_rand(100000000, 999999999) . time() % 10;

  // Append a unique number to still maintain good randomness
  $uniqueNumber = mt_rand(0, 9); // Random digit
  $uniqueId = $baseId . $uniqueNumber;

  // Truncate to 10 digits consistently
  $uniqueId = substr($uniqueId, 0, 9);

  return $uniqueId;
}

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
    function validateForm() {
    let isValid = true;

    // Validate all quantity fields
    $("input[name^='quantity']").each(function(index, element) {
      let qVal = $.trim($(element).val());
      if (isNaN(qVal) || qVal == '') {
        $(element).css("border", "2px solid red");
        isValid = false;
      } else {
        $(element).css("border", "");
      }
    });

    // Validate all price fields
    $("input[name^='price']").each(function(index, element) {
      let pVal = $.trim($(element).val());
      if (isNaN(pVal) || pVal == '') {
        $(element).css("border", "2px solid red");
        isValid = false;
      } else {
        $(element).css("border", "");
      }
    });

    // Validate all material and supplier fields
    $("select[name^='material'], select[name^='supplier']").each(function(index, element) {
      let value = $(element).val();
      if (value === "xxx" || isNaN(value)) {
        $(element).css("border", "2px solid red");
        isValid = false;
      } else {
        $(element).css("border", "");
      }
    });

    return isValid;
  }

  // ... your existing functions ...

  function getprice(id, eid) {
    if (id != "xxx") {
      $.get("<?php echo $_SESSION['base_url'] ?>/rabbi_purchase/api.php?id=" + id)
        .done(function(data) {
          let p = parseFloat(data["price"]);
          let q = $("#quantity" + eid).val();
          console.log(id);
          if (!isNaN(q)) {
            let price = p * q;
            $("#price" + eid).val(price);
          }
        })
        .fail(function(error) {
          console.error("Error fetching data:", error);
        });
    }
  }


  function getp2(f) {
    let x = $("#material" + f).val();
    if (x != "xxx") {
      $.get("<?php echo $_SESSION['base_url'] ?>/rabbi_purchase/api.php?id=" + x)
        .done(function(data) {
          let p = parseFloat(data["price"]);
          let q = $("#quantity" + f).val();

          if (!isNaN(q)) {
            let price = p * q;
            $("#price" + f).val(price);
            console.log(p, q, price);
          }
        })
        .fail(function(error) {
          console.error("Error fetching data:", error);
        });
    }
  }

  function errchk(idname) {
    let $inputElement = $("#" + idname);
    let matv = $inputElement.val();

    if (!isNaN(matv)) {
      $inputElement.css("border", "");
      console.log("The variable is a number.");
    } else {
      $inputElement.css("border", "2px solid red");
      console.log("The variable is not a number.");
    }
  }

</script>

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
            <li class="breadcrumb-item ">Add Purchase</li>
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
          <form id="purchase-form" onsubmit="return validateForm()" action="" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Invoice ID</label><span style="color: red;"><?php echo "  " . $lenError; ?></span>
                    <input readonly value="<?php echo generateInvoiceId() ?>" type="text" name="inid" class="form-control" id="inv" placeholder="Enter title">
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
                      <th class="col-2">Price</th>
                      <th class="col-1"></th>
                    </tr>
                  </thead>
                  <tbody id="purchase">
                    <tr>
                      <td>
                        <div class="form-group">
                          <select onblur="errchk('price1')" name="material[]" id="material1" onchange="getprice((this.value),1), errchk('material1'), errchk('price1');"
                           class="form-control">
                            <option value="xxx">Select Material</option>
                            <?php foreach ($materials as $d) { ?>
                              <option value="<?php echo $d['id'] ?>"><?php echo $d['name'] . " (" . $d['price'] . " Taka)" ?></option>
                            <?php } ?>
                          </select>
                          <span id="material_error1"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <select name="supplier[]" id="supplier1" class="form-control" onchange="errchk('supplier1'), errchk('price1')">
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
                          <input onblur="errchk('price1')" type="text" name="quantity[]" onkeyup="getp2(1), errchk('quantity1'), errchk('price1')" class="form-control" id="quantity1" placeholder="Enter title">
                          <span id="quantity_error1"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="text" name="price[]" onkeyup="errchk('price1')" class="form-control" id="price1" placeholder="Enter title"><span id="price_error1"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <!-- <button type="button" class="btn btn-danger delete-row">Delete</button> -->
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
                        <a href="#" onclick="addmore()" class="btn btn-warning">Add More</a>
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
                $(document).ready(function() {
                  $('#purchase').on('click', '.delete-row', function() {
                    $(this).closest('tr').remove();
                  });
                });
                let newRow = `
                      <tr>
                        <td>
                          <div class="form-group">
                            <select onblur="errchk('price${sl}')" name="material[]" id="material${sl}" class="form-control" onchange="getprice(this.value, ${sl}), errchk('material${sl}'), errchk('price${sl}')">
                              <option value="xxx">Select Material</option>
                              <?php foreach ($materials as $d) { ?>
                                <option value="<?php echo $d['id'] ?>"><?php echo $d['name'] . " " . $d['price'] . " Taka" ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <select onblur="errchk('price${sl}')" name="supplier[]" id="supplier${sl}" class="form-control" onchange="errchk('supplier${sl}'), errchk('price${sl}')">
                              <option value="xxx">Select Supplier</option>
                              <?php foreach ($supplier as $d) { ?>
                                <option value="<?php echo $d['id'] ?>"><?php echo $d['company_name'] ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <input onblur="errchk('price${sl}')" type="text" name="quantity[]" id="quantity${sl}" class="form-control" placeholder="Enter title" onkeyup="getp2(${sl}), errchk('quantity${sl}'), errchk('price${sl}')">
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <input type="text" name="price[]" id="price${sl}" class="form-control" placeholder="Enter title" onkeyup="errchk('price${sl}')">
                          </div>
                        </td>
                        <td>
                        <div class="form-group">
                          <button type="button" class="btn btn-danger delete-row">Delete</button>
                        </div>
                      </td>
                      </tr>
                    `;
                $("#purchase").append(newRow);
                sl++;
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
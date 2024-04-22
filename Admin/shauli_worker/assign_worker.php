<?php
require_once("../header.php");
// $products = $con->query("SELECT * from purchase group by invoice_id ORDER BY date DESC;")->fetch_all(MYSQLI_ASSOC);
$pname=$con->query("select orders.*,projects.name from orders join projects on projects.id=orders.project_id");
$psteps = $con->query('SELECT id FROM orders;')->fetch_all(MYSQLI_ASSOC);
$workerlist = $con->query("SELECT name, id FROM users WHERE designation='worker'");

if (isset($_POST["submit"])) {
    $oid = $_POST["orderid"];
    $pidq = $con->query("select project_id as pid from orders where id=$oid")->fetch_assoc();
    $pid = $pidq["pid"];
    $ps = $con->query("SELECT id FROM processing_steps WHERE project_id=$pid")->fetch_all(MYSQLI_ASSOC);

    $wid = $_POST["worker"];
    $time = $_POST["duration"];
    foreach ($ps as $k => $v) {
        $p = $v["id"];
        $w = $wid[$k];
        $t = $time[$k];
        if (is_numeric($t) && $w != "xp") {
            $con->query("insert into worker_assign(order_id,processing_steps_id,user_id,duration)values($oid,$p,$w,$t)");
        }
    }
}


?>

<script>
    function getorder(id) {
        if (id != "xp") {
            fetch(`<?php echo $_SESSION['base_url'] ?>/shauli_worker/wapi.php?id=${id}`)
                .then((response) => response.json())
                .then((data) => {
                    let ht = '';
                    let sl = 0;
                    for (let d of data) {
                        let psname = d["title"];
                        console.log(psname);
                        ht += `
                            <tr>
                                <td>${++sl}</td>
                                <td>${d["title"]}</td>
                                <td>
                            <div class="form-group">
                                <select name="worker[]" id="supplier1" class="form-control">
                                <option value="xp">Select Worker</option>
                                <?php foreach ($workerlist as $d) { ?>
                                  <option value="<?php echo $d['id'] ?>"><?php echo $d['name'] ?></option>
                                <?php } ?>
                                </select>
                            </div>
                                </td>
                                <td>
                                <div class="form-group">
                                    <input type="text" name="duration[]" class="form-control" id="duration" placeholder="Enter Duration">
                                </div>
                                </td>
                            </tr>
                            `
                        document.getElementById("worker_assign").innerHTML = ht;
                    }
                })
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
                    <h1>Worker Assign</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Worker Assign</li>
                    </ol>
                </div>
            </div>
            
            <form action="#" method="POST">
            <div class="row mb-2">
                <div class="col-sm-4">
                    
                        <div class="form-group">
                            <select name="orderid" id="orderid" onchange="getorder(this.value)" class="form-control">
                                <option value="xp">Select Project</option>
                                <?php foreach ($pname as $p) { ?>
                                    <option value="<?php echo $p['id'] ?>"><?php echo $p['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    
                </div>
            </div>
            <div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Worker Assign</h3>
                    </div>
                    <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Processing Step</th>
                                        <th>Worker Name</th>
                                        <th>Duration(Minutes)</th>
                                    </tr>
                                </thead>
                                <tbody id="worker_assign">
                                </tbody>
                            </table>
                            <div class="card-footer">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
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
<?php
require_once('../header.php');

?>
<script>
  function valid() {
    let n = document.getElementById('n').value.trim();
    let d = document.getElementById('d').value.trim();
    let p = document.getElementById('p').value.trim();
    if (n == "" || d == "" || p == "") {
      if (n == '') {
        document.getElementById("n").style.border = '3px solid red';
        document.getElementById("nerror").innerHTML = 'Please fill up name';
        document.getElementById("nerror").style.color = 'red';
      } else {
        document.getElementById("n").style.border = '3px solid green';
        document.getElementById("nerror").innerHTML = '';
        document.getElementById("n").innerHTML = " ";
      }
      if (d == '') {
        document.getElementById("d").style.border = '3px solid red';
        document.getElementById("derror").innerHTML = 'Please fill up detail';
        document.getElementById("derror").style.color = 'red';
      } else {
        document.getElementById("d").style.border = '3px solid green';
        document.getElementById("derror").innerHTML = '';
      }
      if (p == '') {
        document.getElementById("p").style.border = '3px solid red';
        document.getElementById("perror").innerHTML = 'Please fill up project step';
        document.getElementById("perror").style.color = 'red';
      } else {
        document.getElementById("p").style.border = '3px solid green';
        document.getElementById("perror").innerHTML = '';
      }
      return false;

    } else {
      document.getElementById("n").style.border = '3px solid green';
      document.getElementById("nerror").innerHTML = '';
      document.getElementById("d").style.border = '3px solid green';
      document.getElementById("derror").innerHTML = '';
      document.getElementById("p").style.border = '3px solid green';
      document.getElementById("perror").innerHTML = '';
      return true;

    }
  }
</script>


<?php
$valid_ = "";
$valid_a = "";
$valid_b = "";
$valid_c = "";
if (isset($_POST['submit'])) {
  $name = trim($_POST['name']);
  $details = trim($_POST['details']);
  $p_step = trim($_POST['prossesing_steps']);

  if (empty($name) || empty($details) || empty($p_step)) {
    if (empty($p_step)) {
      $valid_ = "pls fill up step@ ";
    }
    if (empty($name)) {
      $valid_a = "pls fill up name@ ";
    }
    if (empty($details)) {
      $valid_b = "pls fill up detail@ ";
    }
  } else {
    if (!empty($_POST['title'])) {
      // $valid_c = "pls fill up ss ";
      $add_project = $con->query("insert into projects(name,details,prossesing_steps)values('$name','$details','$p_step')");
      $last_id = $con->insert_id;
      $step_title = $_POST['title'];
      if ($step_title != "") {
        foreach ($step_title as $i => $si) {
          if (!empty($step_title[$i])) {
            $con->query("INSERT INTO processing_steps(project_id,title)VALUES('$last_id','$si')");
?>
            <script>
              window.location.assign('project_manage.php');
            </script>
          <?php
          }
          ?>
          <script>
            window.location.assign('project_manage.php');
          </script>
<?php
        }
      }
    }
  }
}

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Project</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Project</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Enter Your Data</h3>
            </div>
            <!-- /.card-header --><!-- form start -->
            <form action="" method="post" onsubmit=" return valid()" enctype="multipart/form-data">
              <div class="card-body">

                <div class="form-group">
                  <label for="exampleInputEmail1" class="">Name</label>
                  <input type="text" name="name" id="n" class="form-control" placeholder="Enter project Name" required="">
                  <span id="nerror"> </span>
                  <span style="color:red;"> <?php echo $valid_a ?> </span>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">details</label>
                  <input type="text" name="details" class="form-control" placeholder="Enter project Details" id="d">
                  <span id="derror"> </span>
                  <span style="color:red;"> <?php echo $valid_b ?> </span>
                  <span style="color:red;"> <?php echo $valid_c ?> </span>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Prossesing Steps</label>
                  <input type="number" onkeyup="add(this.value)" name="prossesing_steps" class="form-control" placeholder="Enter Prossesing Steps" id="p">
                  <span id="perror"> </span>
                  <span style="color:red;"> <?php echo $valid_ ?> </span>
                </div>


                <span id="step"> </span>


              </div> <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
              </div>
            </form><!-- general form elements -->
          </div> <!-- /.card -->
        </div><!--/.col (right -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php
require_once('../footer.php')
?>

<script>
  function add(num) {
    let a = "";
    for (let i = 0; i < num; i++) {
      a += ` <div class="col-sm-6" >
                <div class="form-group" >
                  <label for="exampleInputPassword1">Steps: ${i+1}</label>
                  <input type="text" name="title[]" class="form-control" id="exampleInputPassword1" placeholder="Enter Prossesing name">
                </div>
            </div>`
    }
    document.getElementById('step').innerHTML = a;
  }
</script>
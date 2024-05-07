<?php 
  require_once('../header.php');
     $id=$_GET['id'];
     $p_step=$con->query('select * from processing_steps where id='.$id)->fetch_assoc();
    $p_id=$p_step['project_id'];
     $project_name=$con->query('select * from projects where id='.$p_id)->fetch_assoc();

$work=$con->query("select * from worker_assign where processing_steps_id=".$id)->fetch_all(MYSQLI_ASSOC);
// $worker_id=$work['user_id'];  
// $user=$con->query("select * from users where id=".$worker_id)->fetch_assoc();
// $user_name=$user["name"];

// echo "<pre>";
// print_r($user_name);

// print_r();

 ?>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Blank Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="container-fluid">
        <div class="card-header"> <h3 class="card-title">Project Step Details</h3></div>
        <table class="table table-bordered col-md-10 table-striped table-sucess">
             <h2 style="text-align:center; color:blue;background-color:#c0cb49 "><span style="text-align:center; color:black">Project Name :<span style="text-align:center; color:blue">[<?php echo $project_name['name']?>]</span>
            </span> <span style="text-align:center; color:black">step Name :</span> </h2>
             <h2 style="background-color:#67cbdc"><span>Project step Worker Details :</span> </h2>
        <thead>
            <tr> <th style="width: 10px">SL</th>
                    <th>Worker name</th>
                   <!-- <th>Receved Item</th>
                   <th>Trasnper Item</th>
                   <th>Due Item</th> -->
                    
                </tr>
            </thead>
            <tbody>
              
<?php foreach($work as $ii=>$il){ ?>
               <tr>
                <?php $u_id=$il['user_id'];
                  $u_name=$con->query("select * from users where id=".$u_id)->fetch_assoc();
                  ?>
                  <td><?php echo ++$ii ?></td>
                  <td><?php echo $u_name['name'] ?></td>
                   <!-- <td><?php ?></td>
                   <td><?php ?></td>
                   <td><?php ?></td> -->
                    
                </tr>
                <?php }?> 
                 
            </tbody>
        </table>
      </div>
      
      </div>
      <!-- /.card -->
      <div class="container" style="background-image: url('wallpaper.jpg'); background-size: cover;width: 600px;height: 300px; " >
</div>
    </section>
    <!-- /.content -->
  </div>
  
  <!-- /.content-wrapper -->
<?php 
  require_once('../footer.php')
   ?>
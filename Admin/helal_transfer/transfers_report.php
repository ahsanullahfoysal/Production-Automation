<?php
require_once("../header.php");
$workerlist = $con->query("SELECT name, id FROM users WHERE designation='worker'");
$pname=$con->query("select orders.*,projects.name from orders join projects on projects.id=orders.project_id")->fetch_all(MYSQLI_ASSOC);
$workerlist1 = $con->query("SELECT name, id FROM users WHERE designation='worker'");
$pname1=$con->query("select orders.*,projects.name from orders join projects on projects.id=orders.project_id")->fetch_all(MYSQLI_ASSOC);


$trasfer = $con->query("SELECT * from transfers ")->fetch_all(MYSQLI_ASSOC);
$worker = $con->query("select worker_assign.*,processing_steps.title as processing,users.name as user from worker_assign join processing_steps on processing_steps.id=worker_assign.processing_steps_id join users on users.id=worker_assign.user_id;")->fetch_all(MYSQLI_ASSOC);


if(isset($_POST["submit"])){
    $worker_ID=$_POST["worker"];
    $project_ID=$_POST["project"];

    if(!empty($worker_ID)||!empty($worker_ID)){
$workerlist_id = $con->query("SELECT * FROM worker_assign where user_id=".$worker_ID)->fetch_assoc();
    // $_ii= $workerlist_id['order_id'];
    $ii_id= $workerlist_id['user_id'];
    $_sp_id= $workerlist_id['processing_steps_id'];
    $workerlist = $con->query("SELECT name, id FROM users WHERE designation='worker' AND id=".$ii_id); 
$pname=$con->query("select orders.*,projects.name from orders join projects on projects.id=orders.project_id where orders.id=".$project_ID)->fetch_all(MYSQLI_ASSOC);

$trasfer = $con->query("SELECT * from transfers  where processing_steps_id='$_sp_id' AND order_id='$project_ID' ")->fetch_all(MYSQLI_ASSOC);}

}

?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Transfer Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Transfer Report</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card">
                    <div class="card-header">
                        
                    <form action="" method="post" class="form-inline">
                        <select name="worker" id="" class="form-control col-md-3">
                                <option value="">Select Worker</option>
                                <?php foreach ($workerlist1 as $d) { ?>
                                  <option value="<?php echo $d['id'] ?>"><?php echo $d['name'] ?></option>
                                <?php } ?>
                             </select> <span class="col-md-1"></span>
                            
                             <select name="project" id="" class="form-control col-md-3">
                                <option >Select Project</option>
                              <?php  
                            //   $worker = $con->query("select from worker_assign where user_id=".$d['id'])->fetch_all(MYSQLI_ASSOC);
                             foreach ($pname1 as $ii=>$p) { ?>
                                
                                <option value="<?php echo $p['id'] ?>"><?php echo $p['name'] ?></option>
                            
                                <?php } ?>
                             </select>
                            <input type="submit" name="submit" value="search" class="btn btn-primary">
                        </form>

                        <!-- <h3 class="card-title">Raw Materials List</h3> -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                
                                <tr>
                                    <th style="width: 10px">SL</th>
                                    <th>Bundle Code</th>
                                    <th>Order Name</th>
                                    <th>Worker Name</th>
                                    <th>Work Step</th>
                                    <th>Received Date</th>
                                    <th>Transfer Date</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($trasfer as $ti => $tl) { ?>
                                    <tr>
                                        <td><?php echo ++$ti ?></td>
                                        <td><?php $bid = $tl['bundle_id'];
                                            $_b = $con->query("SELECT * from bundles where id='$bid'")->fetch_assoc();
                                            echo $_b['bundle_code']; ?></td>
                                        <td> <?php $oid = $tl['order_id'];
                                            $ordr = $con->query("SELECT * from orders where id='$oid'")->fetch_assoc();
                                            $buyer_id = $ordr['buyer_id'];
                                            $buyer = $con->query("SELECT * from buyers where id='$buyer_id'")->fetch_assoc();
                                            $project_id = $ordr["project_id"];
                                            $project = $con->query("SELECT * from projects where id='$project_id'")->fetch_assoc();

                                            
                                            echo $project["name"];?></td>




                                            <td><?php $p_st=$tl['processing_steps_id'] ;
                                            
                                            $worker_d = $con->query("select worker_assign.*,processing_steps.title from worker_assign
                                            join processing_steps on processing_steps.id=worker_assign.processing_steps_id where processing_steps.id=".$p_st)->fetch_assoc();
                                            $ff=$worker_d['user_id'];
                                            $workerlist = $con->query("SELECT * FROM users WHERE id=".$ff)->fetch_assoc();
                                            echo $name=$workerlist["name"];
                                            ?> </td>



                                            <td><?php  
                                            echo  $worker_d['title'];
                                            
                                            


                                            
                                            ?> </td>




                                        <td><?php echo $rd=$tl['received_date']  ?></td>
                                        <td> <?php echo $td=$tl['transfer_date']?> </td>
                                        <td><?php 
                                        $pdd=$con->query("SELECT TIMESTAMPDIFF(MINUTE,' $rd','$td') as poki")->fetch_assoc();
                                        $assaign=$pdd['poki'];
                                        echo  $target=$worker_d['duration'];
                                        echo "<br>";
                                        echo $total=($assaign);
                                        ?> </td>
                                       
                                        <td><?php 
                                        if($target != $total){
                                        if($target < $total){?>
                                           <span style="background-color:red"><?php echo "Doing over time";?></span> <?php
                                        } 
                                        if($target > $total){?>
                                            <span style="background-color:green"><?php echo "Doing Right time";?></span><?php
                                            } }else{

                                            }
                                            ?></td>


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
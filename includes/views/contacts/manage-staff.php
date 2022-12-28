<?php
    
    global $stff, $clss;

    // instantiate the pagination object
    $pagination = new Zebra_Pagination();



    // set position of the next/previous page links
    $pagination->navigation_position(isset($_GET['navigation_position']) && in_array($_GET['navigation_position'], array('left', 'right')) ? $_GET['navigation_position'] : 'outside');
    $end    = 10;
    $start  = ( ($pagination->get_page() - 1) * $end );

    $s_list    = $stff->liststaff($start, $end);
    $s_count   = $stff->staffcount();



    // if we are not showing records in reversed order
    // (if we are, we already set these)
    if (!isset($_GET['reversed'])) {

        // pass the total number of records to the pagination class
        $pagination->records( $s_count );

        // records per page
        $pagination->records_per_page( 10 );

    }

?>

<div class="container-fluid">
    <div class="row page-title-div">
        <div class="col-md-6">
            <h2 class="title">Manage Staff</h2>
        
        </div>
        <div class="col-md-6" style="margin-top: 10px;">
            <a href="index.php?view=staff&action=add-staff" class="btn btn-success btn-labeled pull-right"><i class="fa fa-plus"></i> Add Staff</a>
        </div>
        
        <!-- /.col-md-6 text-right -->
    </div>
    <!-- /.row -->
    <div class="row breadcrumb-div">
        <div class="col-md-6">
            <ul class="breadcrumb">
            	<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="#"> Staff</a></li>
            	<li class="active">Manage Staff</li>
            </ul>
        </div>
     
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->

<section class="section">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h5>View Staff Info</h5>
                        </div>
                    </div>

                    <?php check_message() ; ?>

                    <div class="panel-body p-20">

                        <table id="myTable" class="table table-bordered table-hover dataTable"  role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr>
                                      <th>#</th>
                                      <th>Role</th>
                                      <th>Staff Number</th>
                                      <th>Name</th>
                                      <th>Surname</th>
                                      <th>Contact</th>
                                      <th>Class</th>
                                      <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                  <tr>
                                      <th>#</th>
                                      <th>Role</th>
                                      <th>Staff Number</th>
                                      <th>Name</th>
                                      <th>Surname</th>
                                      <th>Contact</th>
                                      <th>Class</th>
                                      <th>Action</th>
                                  </tr>
                            </tfoot>
                            <tbody>
                                <?php                                 

                                    $count = 0;

                                    foreach( $s_list as $staff ){

                                        // $class = $clss->get_class( $student->classID );
                                       
                                ?>
                                    <tr>
                                        <td><?= htmlentities($count);?></td>
                                        <td><?= htmlentities($staff->role);?></td>
                                        <td><?= htmlentities($staff->username);?></td>
                                        <td><?= htmlentities($staff->name);?></td>
                                        <td><?= htmlentities($staff->surname);?></td>
                                        <td><?= htmlentities($staff->contact);?></td>
                                        <td><?= $stff->classleading( $staff->staffID );?></td>
                                        <td>
                                            <center>

                                                <a href="index.php?view=staff&action=view-staff&staff=<?= $staff->staffID ?>"><i class="fa fa-eye" title="View or Edit Record"></i> view</a>

                                            </center></td>
                                  
                                    </tr>
                                <?php 
                                        $count++;
                                    } 

                                ?>
                                   
                                
                            </tbody>

                        </table>

                 
                        <!-- /.col-md-12 -->
                    
                    </div>

                    <div class="panel-body p-20" style="height: 70px;">
                       
                        <span>Showing <?= $count.' of '.$s_count; ?></span>

                        <div class="pull-right">
                            <?php $pagination->render(); ?>
                        </div>
                            
                    </div>

                </div>
            </div>
           
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
</section>


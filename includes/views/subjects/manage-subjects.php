<?php
    
    global $stff, $clss, $subj;


    $subjects    = $subj->listStudSubject();


?>

<div class="container-fluid">
    <div class="row page-title-div">
        <div class="col-md-6">
            <h2 class="title">Manage Subjects</h2>
        
        </div>
        <?php if( $_SESSION['mwh_s_rl'] == 'admin'){ ?>

            <div class="col-md-6" style="margin-top: 10px;">
                <a href="index.php?view=subjects&action=create-subject" class="btn btn-success btn-labeled pull-right"><i class="fa fa-plus"></i> Subject</a>
            </div>

        <?php } ?>
        
        <!-- /.col-md-6 text-right -->
    </div>
    <!-- /.row -->
    <div class="row breadcrumb-div">
        <div class="col-md-6">
            <ul class="breadcrumb">
            	<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="index.php?view=subjects"> Subjects</a></li>
            	<li class="active">Manage Subjects</li>
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

                    <?php check_message() ; ?>

                    <div class="panel-body p-20">

                        <table id="myTable" class="table table-bordered table-hover dataTable"  role="grid" aria-describedby="example1_info">
                            <thead>
                            	<tr>
                                  	<th>#</th>
                                  	<th>Subject</th>
                                  	<th>Class</th>
                                  	<th>Teacher</th>
                                  	<th>Action</th>
                            	</tr>
                            </thead>
                            <tfoot>
                              	<tr>
                                  	<th>#</th>
                                  	<th>Subject</th>
                                  	<th>Class</th>
                                  	<th>Teacher</th>
                                  	<th>Action</th>
                              	</tr>
                            </tfoot>
                            <tbody>
                                <?php                                 

                                    $count = 0;

                                    foreach( $subjects as $subject ){

                                        $class = $clss->get_class( $subject->classID );
                                        $staff = $stff->get_staff( $subject->teacherID );
                                       
                                ?>
                                    <tr>
                                        <td><?= hsc( $count );?></td>
                                        <td><?= hsc( $subject->name );?></td>
                                        <td>
                                        	<?= hsc( $class->name );?>
                                        </td>
                                        <td>
                                        	<?= hsc( $staff->name.' '.$staff->surname);?>
                                        </td>
                                        <td>
                                            <center>

                                                <a href="index.php?view=subjects&action=view-subject&subject=<?= $subject->subjectID ?>"><i class="fa fa-eye" title="View or Edit Record"></i> view</a>

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

                </div>
            </div>
           
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
</section>

<script>

    $(function($) {
        // $('#myTable').DataTable();

        $('#myTable').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true
        })

    });

    
</script>
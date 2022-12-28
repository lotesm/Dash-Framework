<?php
    
    global $stff, $clss;


    $classes    = $clss->listclasses();


?>

<div class="container-fluid">
    <div class="row page-title-div">
        <div class="col-md-6">
            <h2 class="title">Manage Classes</h2>
        
        </div>
        <div class="col-md-6" style="margin-top: 10px;">
            <a href="index.php?view=classes&action=add-class" class="btn btn-success btn-labeled pull-right"><i class="fa fa-plus"></i> Add Class</a>
        </div>
        
        <!-- /.col-md-6 text-right -->
    </div>
    <!-- /.row -->
    <div class="row breadcrumb-div">
        <div class="col-md-6">
            <ul class="breadcrumb">
            	<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="index.php?view=classes"> Classes</a></li>
            	<li class="active">Manage Classes</li>
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
                                  	<th>Class</th>
                                  	<th>Class Teacher</th>
                                  	<th>Roll</th>
                                  	<th>Action</th>
                            	</tr>
                            </thead>
                            <tfoot>
                              	<tr>
                                  	<th>#</th>
                                  	<th>Class</th>
                                  	<th>Class Teacher</th>
                                  	<th>Roll</th>
                                  	<th>Action</th>
                              	</tr>
                            </tfoot>
                            <tbody>
                                <?php                                 

                                    $count = 0;

                                    foreach( $classes as $class ){

                                        // $class = $clss->get_class( $student->classID );
                                       
                                ?>
                                    <tr>
                                        <td><?= htmlentities($count);?></td>
                                        <td><?= htmlentities($class->name);?></td>
                                        <td>
                                        	<?= $clss->get_classteacher( $class->classID);?>
                                        </td>
                                        <td>
                                        	<?= $clss->get_roll( $class->classID);?>
                                        </td>
                                        <td>
                                            <center>

                                                <a href="index.php?view=classes&action=view-class&class=<?= $class->classID ?>"><i class="fa fa-eye" title="View or Edit Record"></i> view</a>

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
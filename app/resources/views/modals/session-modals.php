<!-- Set Subject -->
<div class="modal fade" id="subject-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form action="app/helpers/mark-sheet/set-subject.php" method="post">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLabel">Set Term</h5>
	                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	                </button>
	            </div>

	            <div class="modal-body">
	                <div class="form-group">
				        <label for="email"><b>Term:</b></label>
			            <select name="subject" required class="form-control select2">
			                <option value="">-- Select Term --</option>
			                <?php 
			                	foreach( $subjects as $subject ) { 

			                		$class = $clss->get_class($subject->classID);
			                ?>

	                                <option value="<?= $subject->subjectID ?>"><?= $subject->name.' ('.$class->name.')' ?></option>
	                        
	                        <?php }?>
			            </select>
			        </div>
	            </div>
	            
	            <div class="modal-footer">
	            	<button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Close</button> 

	                <button class="btn btn-primary" type="submit">Set</button>
	            </div>

	        </form>
        </div>
    </div>

</div>

<!-- Set Term -->
<div class="modal fade" id="term-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form action="app/helpers/mark-sheet/set-session.php" method="post">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLabel">Set Term</h5>
	                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	                </button>
	            </div>

	            <div class="modal-body">
	                <div class="form-group">
				        <label for="email"><b>Term:</b></label>
			            <select name="session" required class="form-control select2">
			                <option value="">-- Select Term --</option>
			                <?php foreach( $terms as $term ) { ?>

	                                <option value="<?= $term->termID ?>"><?= $term->name ?></option>
	                        
	                        <?php }?>
			            </select>
			        </div>
	            </div>
	            
	            <div class="modal-footer">
	            	<button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Close</button> 

	                <button class="btn btn-primary" type="submit">Set</button>
	            </div>

	        </form>
        </div>
    </div>

</div>

<!-- Year -->
<div class="modal fade" id="year-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

	        <form action="app/helpers/mark-sheet/set-year.php" method="post">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLabel">Set Year</h5>
	                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	                </button>
	            </div>

	            <div class="modal-body">
	                <div class="form-group">
				            <label for="email"><b>Year:</b></label>
			            <select name="year" required class="form-control select2">
			                <option value="">-- Select Year --</option>
			                <?php
	                            $year = date('Y');

	                            for($i = $year; $i > 2009; $i--) {
	                        ?>
	                                <option value="<?= $i ?>"><?= $i ?></option>
	                        
	                        <?php }?>
			            </select>
			        </div>
	            </div>
	            
	            <div class="modal-footer">
	            	<button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Close</button> 

	                <button class="btn btn-primary" type="submit">Set</button>
	            </div>

	        </form>

        </div>
    </div>

</div>
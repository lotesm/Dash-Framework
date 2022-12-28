<?php
	
	global $member, $society;
	// instantiate the pagination object
    $pagination = new Zebra_Pagination();

    // how many records should be displayed on a page?
    $records_per_page = 10;



    // set position of the next/previous page links
    $pagination->navigation_position(isset($_GET['navigation_position']) && in_array($_GET['navigation_position'], array('left', 'right')) ? $_GET['navigation_position'] : 'outside');


    $start = ( ($pagination->get_page() - 1) * $records_per_page);

    if( isset( $_REQUEST['search'] ) ){

    	$result = $member->listsofmembers( $start, $records_per_page, $_REQUEST['search'] );

    	$rcount = $member->get_member_count( $_REQUEST['search'] );
    
    }else{

    	$result = $member->listsofmembers( $start, $records_per_page, '' );

    	$rcount = $member->get_member_count('');
    	
    }

    if( empty( $result ) )

    	$result = array();

    // if we are not showing records in reversed order
    // (if we are, we already set these)
    if (!isset($_GET['reversed'])) {

        // pass the total number of records to the pagination class
        $pagination->records( $rcount );

        // records per page
        $pagination->records_per_page($records_per_page);

    }

?>

<div class = "col-md-12 alert">
	<center>
		<h4>Log Book</h4>
	</center>
	
</div>
<div class="row">
	<div class="col-md-3">
				
		<select class="form-control" name="class-filter">
			<option>Filter Year</option>
		</select>

	</div>
	<div class="col-md-3">
				
		<select class="form-control" name="class-filter">
			<option>Filter Month</option>
		</select>
		
	</div>
	<div class="col-md-3">
				
		<select class="form-control" name="class-filter">
			<option>Filter Day</option>
		</select>
		
	</div>
	
	<div class="col-md-3">
				
		<input type="text" id="search" class="form-contro col-md-8" name="search" required="required">

		<button type="submit" id="search-btn" class="btn btn-success">Search</button>

	</div>
</div>
<div class = "alert alert-info">


	<table id = "table" class = "table table-striped table-hover" width="100%">
		<thead>
			<tr>
				<th>Staff #</th>
				<th>Name</th>
				<th>Surname</th>
				<th>Contact</th>
				<th>Position</th>
				<th>Time In</th>
				<th>Time out</th>
			</tr>
		</thead>
		<tbody>

			<?php
				$count = 0;

				foreach ($result as $item ) {

					$fsociety = $society->get_society_by_member( $item->memID );
			
			?>
				<tr>
					<td><?php echo $item->name ?></td>
					<td><?php echo $item->surname?></td>
					<td><?php echo $item->email?></td>
					<td><?php echo $item->contact?></td>
					<td><?php echo $item->residence ?></td>
					<td><?php echo date("H:m") ?></td>

					<td><?php echo date("H:m") ?></td>
					
				</tr>
			<?php
				$count ++;

				};
			?>
		</tbody>
	</table>

	<span>Showing <?php echo $count.' of '.$rcount; ?></span>

	<center> <?php $pagination->render(); ?> </center>

</div>
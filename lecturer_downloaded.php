<?php include('header_dashboard.php'); ?>
<?php include('session.php'); ?>
<body>
		<?php include('navbar_lecturer.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('Downloaded_sidebar_lecturer.php'); ?>
                <div class="span9" id="content">
                     <div class="row-fluid">
					    <!-- breadcrumb -->	
									<ul class="breadcrumb">
										<?php
										$term_year = mysqli_query($conn,"select * from term_year order by term_year DESC")or die(mysqli_error());
										$term_year_row = mysqli_fetch_array($term_year);
										$term_year = $term_year_row['term_year'];
										?>
											<li><a href="#"><b>My Class</b></a><span class="divider">/</span></li>
										<li><a href="#">Semester: <?php echo $term_year_row['term_year']; ?></a><span class="divider">/</span></li>
									</ul>
						 <!-- end breadcrumb -->
                        <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div id="" class="muted pull-right"></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
								<?php
								$query_backpack = mysqli_query($conn,"select * FROM lecturer_backpack where lecturer_id = '$session_id'  order by fdatein DESC ")or die(mysqli_error());
								$num_row = mysqli_num_rows($query_backpack);
								if ($num_row > 0){
								?>
									<div class="pull-right">
												Check All <input type="checkbox"  name="selectAll" id="checkAll" />
												<script>
												$("#checkAll").click(function () {
													$('input:checkbox').not(this).prop('checked', this.checked);
												});
												</script>					
									</div>
									<form action="delete_backpack_lecturer.php" method="post">
  									<table cellpadding="0" cellspacing="0" border="0" class="table" id="">
									<a data-toggle="modal" href="#backup_delete" id="delete"  class="btn btn-danger" name=""><i class="icon-trash icon-large"></i></a>
									<?php include('modal_backpack_delete.php'); ?>
										<thead>
										        <tr>
												<th></th>
												<th>Date Upload</th>
												<th>File Name</th>
												<th>Description</th>
												<th></th>
												</tr>
										</thead>
										<tbody>
                              		<?php
										$query = mysqli_query($conn,"select * FROM lecturer_backpack where lecturer_id = '$session_id'  order by fdatein DESC")or die(mysqli_error());
										while($row = mysqli_fetch_array($query)){
										$id  = $row['file_id'];
									?>                              
										<tr id="del<?php echo $id; ?>">
										<td width="30">
											<input id="" class="" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
										</td>
										 <td><?php echo $row['fdatein']; ?></td>
                                         <td><?php  echo $row['fname']; ?></td>
                                         <td><?php echo $row['fdesc']; ?></td>                                      
                                         <td width="30"><a href="<?php echo $row['floc']; ?>"><i class="icon-download icon-large"></i></a></td>                                      
										</tr>
									<?php } ?>
										</tbody>
									</table>
									</form>
									<?php }else{ ?>
									<div class="alert alert-info"><i class="icon-info-sign"></i> No files detected.</div>
									<?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
            </div>
		<?php include('footer.php'); ?>
        </div>
		<?php include('script.php'); ?>
    </body>
</html>
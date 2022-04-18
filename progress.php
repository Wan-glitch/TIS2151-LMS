<?php include('header_dashboard.php'); ?>
<?php include('session.php'); ?>
<?php $get_id = $_GET['id']; ?>

<body>
    <?php include('navbar_student.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php include('progress_link_student.php'); ?>
            <div class="span9" id="content">
                <div class="row-fluid">
                    <!-- breadcrumb -->

                    <?php $class_query = mysqli_query($conn,"select * from lecturer_class
										LEFT JOIN class ON class.class_id = lecturer_class.class_id
										LEFT JOIN subject ON subject.subject_id = lecturer_class.subject_id
										where lecturer_class_id = '$get_id'")or die(mysqli_error());
										$class_row = mysqli_fetch_array($class_query);
										$class_id = $class_row['class_id'];
										$term_year = $class_row['term_year'];
										?>

                    <ul class="breadcrumb">
                        <li><a href="#"><?php echo $class_row['class_name']; ?></a> <span class="divider">/</span></li>
                        <li><a href="#"><?php echo $class_row['subject_code']; ?></a> <span class="divider">/</span>
                        </li>
                        <li><a href="#">Semester: <?php echo $class_row['term_year']; ?></a> <span
                                class="divider">/</span></li>
                        <li><a href="#"><b>Progress</b></a></li>
                    </ul>
                    <!-- end breadcrumb -->

                    <!-- block -->
                    <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                            <div id="" class="muted pull-left">
                                <h4> Assignment Grade Progress</h4>
                            </div>
                        </div>

                        <div class="block-content collapse in">
                            <div class="span12">
                                <table cellpadding="0" cellspacing="0" border="0" class="table" id="">

                                    <thead>
                                        <tr>
                                            <th>Date Upload</th>
                                            <th>Assignment Title</th>

                                            <th>Mark Given</th>
                                        </tr>

                                    </thead>
                                    <tbody>

                                        <?php
										$query = mysqli_query($conn,"select * FROM student_assignment 
										LEFT JOIN student on student.student_id  = student_assignment.student_id
										RIGHT JOIN assignment on student_assignment.assignment_id  = assignment.assignment_id
										WHERE student_assignment.student_id = '$session_id'
										order by fdatein DESC")or die(mysqli_error());
										while($row = mysqli_fetch_array($query)){
										$id  = $row['student_assignment_id'];
										$student_id = $row['student_id'];
									?>
                                        <tr>
                                            <td><?php echo $row['fdatein']; ?></td>
                                            <td><?php  echo $row['fname']; ?></td>

                                            <?php if ($session_id == $student_id){ ?>
                                            <td>
                                                <span class="badge badge-success"><?php echo $row['grade']; ?></span>
                                            </td>
                                            <?php }
											else{ 
												?>
                                            	<td></td>
                                            	<?php } 
											?>
											
                                        </tr>

                                    <?php } ?>


                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- /block -->
                </div>


            </div>

            <?php /* include('downloadable_sidebar.php') */ ?>
        </div>
        <?php include('footer.php'); ?>
    </div>
    <?php include('script.php'); ?>
</body>

</html>
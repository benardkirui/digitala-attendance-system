<?php
include "database/DAO.php";
$dao=new DAO();
$result=$dao->selectAttachees();

?>

<div class="col-md-12">
    <div class="panel-body">
        <table class="table table-hover table-striped table-bordered" id="data_table">
            <thead>
            <tr>
                <th>No</th>
                <th>Full Name</th>
                <th>Id Number</th>
                <th>Phone Number</th>
                <th>Institution</th>
                <th>Course</th>
                <th>Sub-County</th>
                <th>Specialization</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $count=1;
            if(mysqli_num_rows($result)>0)
            {
            while($row=mysqli_fetch_assoc($result))
            {
                echo '
                <tr>
                <td>'.$count++.'</td>
                <td>'.$row['name'].'</td>
                <td>'.$row['idnumber'].'</td>
                <td>'.$row['phone'].'</td>
                <td>'.$row['institution'].'</td>
                <td>'.$row['course'].'</td>
                <td>'.$row['subcounty'].'</td>
                <td>'.$row['specialization'].'</td>
                <td >
					'
                    ?>
                <div class="visible-md visible-lg hidden-sm hidden-xs">
                    <a href="edit-doctor.php?id=<?php echo $row['idnumber'];?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a>
													
	<a href="admin.php?idnumber=<?php echo $row['idnumber'];?>&delAttachee=delete" onClick="return confirm(\'Are you sure you want to delete?\')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
												</div>
												<div class="visible-xs visible-sm hidden-md hidden-lg">
													<div class="btn-group" dropdown is-open="status.isopen">
														<button type="button" class="btn btn-primary btn-o btn-sm dropdown-toggle" dropdown-toggle>
															<i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
														</button>
														<ul class="dropdown-menu pull-right dropdown-light" role="menu">
															<li>
																<a href="#">
																	Edit
																</a>
															</li>
															<li>
																<a href="#">
																	Share
																</a>
															</li>
															<li>
																<a href="#">
																	Remove
																</a>
															</li>
														</ul>
													</div>
												</div></td>
                </tr>

                <?php
            }
            }
            else{
                echo '<tr>There is no data in the database</tr>';
            }

            ?>
            </tbody>

        </table>
    </div>

</div>

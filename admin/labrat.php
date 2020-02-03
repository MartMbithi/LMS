<table id="multi_col_order" class="table table-striped table-bordered display "
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Unit Code</th>
                                                <th>Unit Name</th>
                                                <th>Course</th>
                                                <th>Instructor Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                           
                                            $ret="SELECT  * FROM  lms_units_assaigns  ";
                                            $stmt= $mysqli->prepare($ret) ;
                                            //$stmt->bind_param('i',$i_id);
                                            $stmt->execute() ;//ok
                                            $res=$stmt->get_result();
                                            $cnt=1;
                                            while($row=$res->fetch_object())
                                            {
                                        ?>

                                            <tr>
                                                <td><?php echo $cnt;?></td>
                                                <td><?php echo $row->c_code;?></td>
                                                <td><?php echo $row->c_name;?></td>
                                                <td><?php echo $row->c_category;?></td>
                                                <td><?php echo $row->i_number;?></td>
                                                <td>
                                                    
                                                    <a class="badge badge-success" href="pages_admin_enroll_single_unit.php?s_id=<?php echo $row->s_id;?>&en_s_name=<?php echo $row->en_s_name;?>">
                                                     <i class="fas fa-user"></i><i class="icon  icon-doc "></i> Enroll
                                                    </a>
                                                   
                                                </td>
                                            </tr>

                                            <?php $cnt = $cnt +1; }?>

                                        </tbody>
                                    </table>
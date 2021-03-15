<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="ins_dashboard.php" class="brand-link">
        <img src="../public/sys_data/logo/<?php echo $sys->sys_logo; ?>" alt="Logo" class="brand-image  elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo $sys->sys_name; ?></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="ins_dashboard.php" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="ins_teaching_allocations.php" class="nav-link">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            Allocated Units
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="ins_unit_enrollments.php" class="nav-link">
                        <i class="nav-icon fas fa-user-check"></i>
                        <p>
                            Unit Enrollments
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="ins_study_materials.php" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Study Materials
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="ins_billings.php" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>
                            Billings
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-laptop-code"></i>
                        <p>
                            Test Engine
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="ins_questions_bank.php" class="nav-link">
                                <i class="fas fa-chevron-right nav-icon"></i>
                                <p>Questions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="ins_answers_bank.php" class="nav-link">
                                <i class="fas fa-chevron-right nav-icon"></i>
                                <p>Answers</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="ins_marks.php" class="nav-link">
                        <i class="nav-icon fas fa-poll-h"></i>
                        <p>
                            Marks Entry
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="ins_certificates.php" class="nav-link">
                        <i class="nav-icon fas fa-certificate"></i>
                        <p>
                            Certificates
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="ins_students.php" class="nav-link">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>
                            Students
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Reports
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="ins_reports_allocations.php" class="nav-link">
                                <i class="fas fa-chevron-right nav-icon"></i>
                                <p>Teaching Allocations</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="ins_reports_student_enrollments.php" class="nav-link">
                                <i class="fas fa-chevron-right nav-icon"></i>
                                <p>Student Enrollments</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="ins_reports_students.php" class="nav-link">
                                <i class="fas fa-chevron-right nav-icon"></i>
                                <p>Students</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="ins_reports_billings.php" class="nav-link">
                                <i class="fas fa-chevron-right nav-icon"></i>
                                <p>Billings</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="ins_logout.php" class="nav-link">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>
                            End Session
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
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
                    <a href="std_dashboard.php" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="std_enrolled_units.php" class="nav-link">
                        <i class="nav-icon fas fa-user-check"></i>
                        <p>
                            Unit Enrollments
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="std_manage_payments.php" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>
                            Billings
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="std_study_materials.php" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Study Materials
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
                            <a href="std_questions_bank.php" class="nav-link">
                                <i class="fas fa-chevron-right nav-icon"></i>
                                <p>Questions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="std_answers_bank.php" class="nav-link">
                                <i class="fas fa-chevron-right nav-icon"></i>
                                <p>Answers</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="std_marks.php" class="nav-link">
                        <i class="nav-icon fas fa-poll-h"></i>
                        <p>
                            Transcripts
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="std_certificates.php" class="nav-link">
                        <i class="nav-icon fas fa-certificate"></i>
                        <p>
                            Certificates
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="std_logout.php" class="nav-link">
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
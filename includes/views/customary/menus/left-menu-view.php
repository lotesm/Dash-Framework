<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="resources/images/system/logo.png" class="img-circle" alt="User Image">
            </div>

            <div class="pull-left info">
                <p><?= $_SESSION['csp_s_nms'].' '.$_SESSION['csp_s_sn'] ?></p>
                <a href="#">
                    <i class="fa fa-circle text-success"></i> 
                    <?= $_SESSION['csp_s_rl'] ?>
                </a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu tree" data-widget="tree">

            <li class="header">MAIN NAVIGATION</li>

            <li class="active">
                <a href="index.php?view=dashboard">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-green"></small>
                    </span>
                </a>
            </li>

            <!-- Accounts -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Accounts</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <?php if($_SESSION['csp_s_rl'] == 'admin') { ?>

                        <li><a href="index.php?view=accounts&action=add-account"><i class="fa fa-plus"></i> Add Accounts</a></li>

                    <?php } ?>

                    <li><a href="index.php?view=accounts&action=manage-accounts"><i class="fa fa-circle-o"></i> Manage Accounts</a></li>

                    <li><a href="index.php?view=accounts&action=manage-roles"><i class="fa fa-circle-o"></i> Manage Roles</a></li>

                    
                </ul>
            
            </li>


            <!-- Contacts -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-address-card-o" aria-hidden="true"></i> <span>Contacts</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li><a href="index.php?view=contacts&action=manage-customers"><i class="fa fa-circle-o"></i> Manage Customers</a></li>

                    <li><a href="index.php?view=contacts&action=manage-suppliers"><i class="fa fa-circle-o"></i> Manage Suppliers</a></li>
                    
                </ul>

            </li>

            <!-- Products -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cubes"></i> <span>Products</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <?php if($_SESSION['csp_s_rl'] == 'admin') { ?>

                        <li><a href="index.php?view=classes&action=add-class"><i class="fa fa-plus"></i> Add Class</a></li>

                    <?php } ?>

                    <li><a href="index.php?view=classes&action=manage-classes"><i class="fa fa-circle-o"></i> Manage Classes</a></li>
                    
                </ul>
            
            </li>


            <!-- Purchases -->   
            <li class="treeview">

                <a href="#">
                    <i class="fa fa-arrow-circle-down"></i> <span>Purchases</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">

                    <?php if( $_SESSION['csp_s_rl'] == 'admin' ) { ?> 
                        <li>
                            <a href="index.php?view=subjects&action=create-subject"><i class="fa fa-plus"></i> Create Subject</a>
                        </li>
                       
                   <?php } ?> 

                    <li><a href="index.php?view=subjects"><i class="fa fa-book"></i> Subjects</a></li>

                </ul>
            
            </li>

            <!-- Sales --> 
            <li class="treeview">

                <a href="#">
                    <i class="fa fa-arrow-circle-up"></i> <span>Sales</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">

                   <li><a href="index.php?view=mark-sheet&action=upload-marks"><i class="fa fa-upload"></i> Upload Marks</a></li>

                   <li><a href="index.php?view=mark-sheet&action=manage-mark-sheet"><i class="fa fa-file-text-o"></i> Manage Marks</a></li>

                   <li><a href="index.php?view=mark-sheet&action=class-teacher-remarks"><i class="fa fa-commenting-o"></i> Class Teacher's Remarks</a></li>
                    
                </ul>
            
            </li>


            <!-- Stock Management -->
            <li class="treeview">

                <a href="#">
                    <i class="fa fa-database"></i> <span>Stock Management</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu"> 

                   <li><a href="index.php?view=policies&action=manage-policies"><i class="fa fa-refresh"></i> Generate Reports</a></li>

                   <li><a href="index.php?view=policies&action=upload-policies"><i class="fa fa-sort-amount-desc"></i> Manage Results</a></li>

                   <li><a href="index.php?view=policies&action=upload-policies"><i class="fa fa-list-alt"></i> Mark Sheets</a></li>
                    
                </ul>
            
            </li>

            <!-- Expenses -->
            <li class="treeview">

                <a href="#">
                    <i class="fa fa-money"></i> <span>Expenses</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu"> 

                   <li><a href="index.php?view=policies&action=manage-policies"><i class="fa fa-refresh"></i> Generate Reports</a></li>

                   <li><a href="index.php?view=policies&action=upload-policies"><i class="fa fa-sort-amount-desc"></i> Manage Results</a></li>

                   <li><a href="index.php?view=policies&action=upload-policies"><i class="fa fa-list-alt"></i> Mark Sheets</a></li>
                    
                </ul>
            
            </li>

            <!-- Pay Roll -->
            <li class="treeview">

                <a href="#">
                    <i class="fa fa-envelope"></i> <span>Pay Roll</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu"> 

                   <li><a href="index.php?view=policies&action=manage-policies"><i class="fa fa-refresh"></i> Generate Reports</a></li>

                   <li><a href="index.php?view=policies&action=upload-policies"><i class="fa fa-sort-amount-desc"></i> Manage Results</a></li>

                   <li><a href="index.php?view=policies&action=upload-policies"><i class="fa fa-list-alt"></i> Mark Sheets</a></li>
                    
                </ul>
            
            </li>

            <!-- Reports -->
            <li class="treeview">

                <a href="#">
                    <i class="fa fa-bar-chart"></i> <span>Reports</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu"> 

                   <li><a href="index.php?view=policies&action=manage-policies"><i class="fa fa-refresh"></i> Generate Reports</a></li>

                   <li><a href="index.php?view=policies&action=upload-policies"><i class="fa fa-sort-amount-desc"></i> Manage Results</a></li>

                   <li><a href="index.php?view=policies&action=upload-policies"><i class="fa fa-list-alt"></i> Mark Sheets</a></li>
                    
                </ul>
            
            </li>

            <!-- Settings -->
            <li class="treeview">

                <a href="#">
                    <i class="fa fa-cog"></i> <span>Settings</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu"> 

                   <li><a href="index.php?view=policies&action=manage-policies"><i class="fa fa-refresh"></i> Generate Reports</a></li>

                   <li><a href="index.php?view=policies&action=upload-policies"><i class="fa fa-sort-amount-desc"></i> Manage Results</a></li>

                   <li><a href="index.php?view=policies&action=upload-policies"><i class="fa fa-list-alt"></i> Mark Sheets</a></li>
                    
                </ul>
            
            </li>

            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

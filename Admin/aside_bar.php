<?php  ?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="<?php echo $_SESSION['base_url'] ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span style="font-size: 15px;" class="brand-text font-weight-light">abdullahnazad@gmail.com</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo $_SESSION['base_url'] ?>/dist/img/107198.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Mohammad Abdullah</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?php echo $_SESSION['base_url'] ?>/dashboard.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <!-- <i class="right fas fa-angle-left"></i> -->
            </p>
          </a>
        </li>




        <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Charts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/charts/chartjs.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ChartJS</p>
                </a>
              </li>
            </ul>
          </li> -->




        <li class="nav-item">
          <a href="" class="nav-link" id="buyer_dw">
            <i class="fa-solid fa-house px-1"></i>
            <p>
              Blank
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/blank/buyer_pay_list.php" class="nav-link">
                <i class="fa fa-shopping-cart ml-4 mr-2" aria-hidden="true"></i>
                <p>Add Blank</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="fa-brands fa-jedi-order px-1"></i>
            <p>
              Orders
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/minhaj/orders_list.php" class="nav-link">
                <i class="far fa-circle nav-icon ml-3"></i>
                <p>Orders List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/foysal_assign_material/assign_material_list.php" class="nav-link">
                <i class="far fa-circle nav-icon ml-3"></i>
                <p>Assign Materials list</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/helal_transfer/transfers.php" class="nav-link">
                <i class="far fa-circle nav-icon ml-3"></i>
                <p>Transfer List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/badsha_bundle/bundle_list.php" class="nav-link">
                <i class="far fa-circle nav-icon ml-3"></i>
                <p>Bundil</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="fa-brands fa-elementor px-1"></i>
            <p>
              Materials
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/forhad_stock_out/stockout_list.php" class="nav-link">
                <i class="far fa-circle nav-icon ml-3"></i>
                <p>Stock Out List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/shauli/raw_list.php" class="nav-link">
                <i class="far fa-circle nav-icon ml-3"></i>
                <p>Raw Material List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/rabbi_purchase/purchase_list2.php" class="nav-link">
                <i class="far fa-circle nav-icon ml-3"></i>
                <p>Purchase List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/zahid/stock_return_list.php" class="nav-link">
                <i class="far fa-circle nav-icon ml-3"></i>
                <p>Stock Return List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>nazad_return_from_buyer/return_from%20_buyer.php" class="nav-link">
                <i class="far fa-circle nav-icon ml-3"></i>
                <p>Return From Buyer</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="fa-brands fa-elementor px-1"></i>
            <p>
              Material Wastage
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/foysal_wastage/material_wastage_list.php" class="nav-link">
                <i class="far fa-circle nav-icon ml-3"></i>
                <p>Wastage Material List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/nazad_mat_wast_sell/mat_was_sel_list.php" class="nav-link">
                <i class="far fa-circle nav-icon ml-3"></i>
                <p>Wastage Material Sale</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/nazad_mat_wast_sell/mat_dump_list.php" class="nav-link">
                <i class="far fa-circle nav-icon ml-3"></i>
                <p>Wastage Dump List</p>
              </a>
            </li>
          </ul>
        </li>




        

        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="fa-solid fa-diagram-project px-1"></i>
            <p>
              Project Management
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/helal/project_manage.php" class="nav-link">
                <i class="far fa-circle nav-icon ml-3"></i>
                <p>Projects List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/forhad_category/category_list.php" class="nav-link">
                <i class="far fa-circle nav-icon ml-3"></i>
                <p>Caterory</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/forhad_unit/unit_list.php" class="nav-link">
                <i class="far fa-circle nav-icon ml-3"></i>
                <p>Units</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/shauli_worker/assign_workerlist.php" class="nav-link">
                <i class="far fa-circle nav-icon ml-3"></i>
                <p>Worker List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/rezaul_finish_product/finished_product_list.php" class="nav-link">
                <i class="far fa-circle nav-icon ml-3"></i>
                <p>Finished Products list</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="fa-solid fa-truck-fast px-1"></i>
            <p>
              Shippping
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/nazad_shiping/shipping_list.php" class="nav-link">
                <i class="far fa-circle nav-icon ml-3"></i>
                <p>Shipping List</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="av-icon fas fa-file-alt"></i>
            <p>
            Report
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/nazad_material_report/material_stock_report.php" class="nav-link">
                <i class="far fa-circle nav-icon ml-3"></i>
                <p>Material Stock Report</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/zahid/finished_product_report.php" class="nav-link">
                <i class="far fa-circle nav-icon ml-3"></i>
                <p>Finished Product Report</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="fa-solid fa-dollar-sign px-2"></i>
            <p>
              Expenses
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/ruhul/expense_list.php" class="nav-link">
                <i class="fa fa-shopping-cart ml-4 mr-2" aria-hidden="true"></i>
                <p>Expense List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/sazib/expense_category_list.php" class="nav-link">
                <i class="fa fa-shopping-cart ml-4 mr-2" aria-hidden="true"></i>
                <p>Expense Category List</p>
              </a>
            </li>
          </ul>

        </li>

        <li class="nav-item">
          <a href="" class="nav-link" id="buyer_dw">
            <i class="fa-solid fa-person-military-pointing px-1"></i>
            <p>
              Buyers
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/badsha_buyer/buyer_list.php" class="nav-link">
                <i class="fa fa-shopping-cart ml-4 mr-2" aria-hidden="true"></i>
                <p>Buyers List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/anam/buyer_pay_list.php" class="nav-link">
                <i class="fa fa-shopping-cart ml-4 mr-2" aria-hidden="true"></i>
                <p>Buyers Payment List</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="fa-solid fa-transgender px-1"></i>
            <p>
              Suppliers
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/sazzad/supplier_list.php" class="nav-link">
                <i class="far fa-circle nav-icon ml-3"></i>
                <p>Supplier List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $_SESSION['base_url'] ?>/rezaul_supply/supplier_payment_list.php" class="nav-link">
                <i class="far fa-circle nav-icon ml-3"></i>
                <p>Supplier Payment List</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="<?php echo $_SESSION['base_url'] ?>/department/department_list.php" class="nav-link">
            <i class="nav-icon fa fa-building-o"></i>
            <p>
              Department
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo $_SESSION['base_url'] ?>/users/users.php" class="nav-link">
            <i class="fa-solid fa-user px-1"></i>
            <p>
              Users
              <i class="right fas fa-angle-left "></i>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo $_SESSION['base_url'] ?>/logout.php" class="nav-link">
            <i class="fa-solid fa-right-from-bracket px-1"></i>
            <p>
              Log Out
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
        </li>





      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
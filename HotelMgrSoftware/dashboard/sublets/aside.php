<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
          <p><?php echo ucwords($fulname); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search..." />
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="">
          <a href="overview">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> <!--<i class="fa fa-angle-left pull-right"> --></i>
          </a>
        </li>   
        
        <?php 
		# Accessed by administrator or content_mgr
		if(USEROLE == "administrator" || USEROLE=="content_mgr"){ 
		?>
                
        <li class="treeview <?php echo active_menu('property_setup.php'); echo active_menu('slides.php'); echo active_menu('services.php'); ?>">
          <a href="#">
            <i class="fa fa-th"></i>
            <span>Property Setup</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="property_setup"><i class="fa fa-circle-o"></i> General Setup</a></li>
            <li><a href="services"><i class="fa fa-circle-o"></i> Property Services</a></li>
            <li><a href="slides"><i class="fa fa-circle-o"></i> Slide Shows</a></li>           
          </ul>
        </li>        
        
        <li class="treeview <?php echo active_menu('amenities.php'); ?> <?php echo active_menu('rmtype.php'); ?>">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Manage Rooms</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="amenities"><i class="fa fa-circle-o"></i> Amenities</a></li>
            <li><a href="rmtype"><i class="fa fa-circle-o"></i> Room Type</a></li>
            <!--<li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Extra Charges</a></li> -->            
          </ul>
        </li>
        
        <li class="<?php echo active_menu('settings.php'); ?>">
          <a href="settings">
            <i class="fa fa-laptop"></i> <span>Settings</span> <!--<small class="label pull-right bg-green">new</small> -->
          </a>
        </li>
        <?php } ?>   
           
                
        <?php
		# Accessed by administrator or frontdesk -----------------------
		if(USEROLE == "administrator" || USEROLE == "frontdesk"){ 		
		?>
        <li class="<?php echo active_menu('reslist.php'); ?>">
          <a href="reslist">
            <i class="fa fa-list"></i> <span>Reservation List</span> <!--<small class="label pull-right bg-green">new</small> -->
          </a>
        </li>
        
        <li class="treeview <?php echo active_menu('reports.php'); ?>">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Reports</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="reports?days"><i class="fa fa-circle-o"></i> Reservation Report</a></li>
            <li><a href="reports?mnths"><i class="fa fa-circle-o"></i> Monthly Report</a></li>
            <li><a href="reports?yrs"><i class="fa fa-circle-o"></i> Yearly Report</a></li>
          </ul>
        </li>
        <?php } ?>
        
        
        <?php
		# Accessed by administrator  -------------------------------------------
		if(USEROLE=="administrator"){ 
		?>
        <li class="<?php echo active_menu('privilege.php'); ?>"><a href="privilege"><i class="fa fa-user"></i> <span>Privileges</span></a></li>
        <?php } ?>
        
        
        <?php 
		# Accessed by administrator  -------------------------------------------
		if(USEROLE=="administrator" || USEROLE=="frontdesk"){
		?>
        
        <li class="header">SHORTCUT LINK</li>
        <li class="<?php echo active_menu('arrlist.php'); ?>"><a href="arrlist"><i class="fa fa-circle-o text-green"></i> <span>Arrival List</span></a></li>
        <!--<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>No Show Reservation</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Void Reservation</span></a></li> --> 
        <?php }?>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
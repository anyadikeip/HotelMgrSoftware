<header class="main-header">

<!-- Logo -->
<a href="#" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>R</b>ES</span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b>eXplore</b>RES</span>
</a>


<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- Messages: style can be found in dropdown.less-->
      <li class="dropdown messages-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-tags"></i>
          <span class="label label-success"><?php echo recordcount('reservations', 'rev_date', $today); ?></span>
        </a>
        
        <ul class="dropdown-menu">
          <li class="header">You have <?php echo recordcount('reservations', 'rev_date', $today); ?> Reservation today</li>
          <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
            
            
            <?php				
			$rev_date = date("m/d/Y"); 
			$query=mysql_query("SELECT * FROM reservations WHERE rev_date='$rev_date' 
			ORDER BY arr DESC LIMIT 5") or die(mysql_error()); 
			while($row = mysql_fetch_array($query)){
			?>
            
              <li><!-- start message -->
                <a href="#">
                  <div class="pull-left">
                    <img src="dist/img/avatar5.png" class="img-circle" alt="User Image" />
                  </div> 
                  <h4>
                    <?php echo $row['title'].' ' .$row['guest_nm']; ?>
                    <small>Pax: [<?php echo $row['adult'].'/'.$row['child'] ; ?>]</small>
                  </h4>
                  <p><?php echo get_value_using_id('room_type', $row['room'], 'type_nm'); ?> 
                  &nbsp; | &nbsp;<?php echo $row['arr']; ?></p>
                  
                </a>
              </li><!-- end message -->
           
		   <?php } ?>
           
            </ul>
          </li>
          <!--<li class="footer"><a href="#">See All Messages</a></li> -->
        </ul>
      </li>
      
      
      <!-- Notifications: style can be found in dropdown.less -->
      <!--<li class="dropdown notifications-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-bell-o"></i>
          <span class="label label-warning">10</span>
        </a>
        
        <ul class="dropdown-menu">
          <li class="header">You have 10 notifications</li>
          <li>
            
            <ul class="menu">
              <li>
                <a href="#">
                  <i class="fa fa-users text-aqua"></i> 5 new members joined today
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-users text-red"></i> 5 new members joined
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-user text-red"></i> You changed your username
                </a>
              </li>
            </ul>
          </li>
          <li class="footer"><a href="#">View all</a></li>
        </ul>
      </li> -->
      
      
      <!-- Tasks: style can be found in dropdown.less -->
      <!--<li class="dropdown tasks-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-flag-o"></i>
          <span class="label label-danger">9</span>
        </a>
        
        <ul class="dropdown-menu">
          <li class="header">You have 9 tasks</li>
          <li>
           
            <ul class="menu">
              <li>
                <a href="#">
                  <h3>
                    Design some buttons
                    <small class="pull-right">20%</small>
                  </h3>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                      <span class="sr-only">20% Complete</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="#">
                  <h3>
                    Create a nice theme
                    <small class="pull-right">40%</small>
                  </h3>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                      <span class="sr-only">40% Complete</span>
                    </div>
                  </div>
                </a>
              </li>
              
              <li>
                <a href="#">
                  <h3>
                    Some task I need to do
                    <small class="pull-right">60%</small>
                  </h3>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                      <span class="sr-only">60% Complete</span>
                    </div>
                  </div>
                </a>
              </li>
              
              <li>
                <a href="#">
                  <h3>
                    Make beautiful transitions
                    <small class="pull-right">80%</small>
                  </h3>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                      <span class="sr-only">80% Complete</span>
                    </div>
                  </div>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="footer">
            <a href="#">View all tasks</a>
          </li>
        </ul>
      </li> -->
      
      
      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image" />
          <span class="hidden-xs"><?php echo ucwords($fulname); ?></span>
        </a>
        
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            <p>
              <?php echo ucwords($fulname); ?> 
              <small> <?php echo strtoupper($role); ?> </small>
            </p>
          </li>
          
          <!-- Menu Body -->
          <!--<li class="user-body">
            <div class="col-xs-4 text-center">
              <a href="#">Followers</a>
            </div>
            <div class="col-xs-4 text-center">
              <a href="#">Sales</a>
            </div>
            <div class="col-xs-4 text-center">
              <a href="#">Friends</a>
            </div>
          </li> -->
          
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="#" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
              <a href="logout" class="btn btn-default btn-flat">Sign out</a>
            </div>
          </li>
          
        </ul>
      </li>
      
      <!-- Control Sidebar Toggle Button -->
      <li>
        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
      </li>
    </ul>
    
  </div>
</nav>
</header>



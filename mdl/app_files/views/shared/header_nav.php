<div class="navbar-inner">
    <div class="container-fluid">
        
        <a class="brand" href="<?php echo site_url('dashboard');?>">
            Company logo goes here
        </a>

        <a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
            <img src="<?php echo base_url();?>assets/img/menu-toggler.png" alt="" />
        </a>          

        <ul class="nav pull-right">	
            <li class="dropdown user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img alt="" src="<?php echo base_url();?>assets/img/avatar1_small.png" />
                    <span class="username"><?php echo $user_data['first_name'] . " ". $user_data['last_name'];?></span>
                    <i class="icon-angle-down"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo site_url('profile');?>"><i class="icon-user"></i> My Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo site_url('dashboard/logout');?>"><i class="icon-key"></i> Log Out</a></li>
                </ul>
            </li>
        </ul>	
    </div>
</div>
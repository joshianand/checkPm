<ul>
    <li>
        <div class="sidebar-toggler hidden-phone"></div>
    </li>
    <li>
        <form class="sidebar-search">
        </form>
    </li>
    <li class="start <?php echo $page_title == 'Dashboard' || $page_title == 'Profile' ? 'active' : ''?>">
        <a href="<?php echo site_url('dashboard'); ?>">
            <i class="icon-home"></i> 
            <span class="title">Dashboard</span>
            <span class="selected"></span>
        </a>
    </li>
    
    <?php foreach ($menu_data as $menu) { ?>
        <?php $sub_menus = element('parent_items', $menu); $total_child_count = count($sub_menus);?>
        <li class ="<?php echo $total_child_count > 0 ? 'has-sub' : '';?> <?php echo $nav_data['parent_task_name'] == $menu['parent_name'] ? 'active' : '';?>">
            <a href="javascript:;">
                <i class="icon-fast-forward"></i> 
                <span class="title"><?php echo element('parent_name', $menu); ?></span>
                <?php if($total_child_count > 0){?>
                    <span class="arrow "></span>
                <?php }?>
            </a>
            
            
            <?php if ($total_child_count > 0) { ?>
                <ul class="sub">
        <?php foreach ($sub_menus as $sub_menu) { ?>
                        <li>
                            <a href="<?php echo element('child_link', $sub_menu);?>" class="pjax">
                                <?php echo element('child_name', $sub_menu); ?>
                            </a>
                        </li>
                <?php } ?>
                </ul>
            <?php } else { ?>
    <?php } ?>
        </li>
<?php } ?>
</ul>
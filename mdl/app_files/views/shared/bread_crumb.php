<div class="row-fluid">
    <div class="span12">		
        <h3 class="page-title">
            <?php echo $page_title; ?>
        </h3>
        <?php if (count($nav_data) == 0) { ?>
            <ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="<?php echo site_url('dashboard'); ?>">Home</a> 
                    <i class="icon-angle-right"></i>
                </li>
            </ul>
        <?php } else { ?>
            <ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="<?php echo site_url('dashboard'); ?>">Home</a> 
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:;"><?php echo $nav_data['parent_task_name'] ?></a>
                    <i class="icon-angle-right"></i>
                </li>

                <li>
                    <a href=""><?php echo $nav_data['task_name'] ?></a>
                </li>
            </ul>
        <?php } ?>

    </div>
</div>
<div class="user_group_container">
    <form id="frm_user_group" name="frm_user_group" method="POST" action="javascript:;">
        <input id="csrf_portal" type="hidden" name="csrf_portal" value="<?php echo $token; ?>"/>
        <input id="group_id" name="group_id" type="hidden" value="<?php echo $group_id; ?>"/>
        <div class="row-fluid">
            <div class="span12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <h4><i class="icon-cogs"></i>User group information</h4>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row-fluid">
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label" for="firstName">Group name</label>
                                    <div class="controls">
                                        <input id="GroupName" name="GroupName" type="text" class="m-wrap span12" placeholder="Group name" value="<?php echo element('group_name', $group_details); ?>">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label" for="lastName">Active status</label>
                                    <div class="controls">
                                        <?php if (element('active', $group_details) == 'yes') { ?>
                                            <label class="radio">
                                                <input type="radio" name="active" value="yes" checked="">
                                                Active
                                            </label>
                                            &nbsp;&nbsp;&nbsp;
                                            <label class="radio">
                                                <input type="radio" name="active" value="no">
                                                In active
                                            </label>
                                        <?php } else { ?>
                                            <label class="radio">
                                                <input type="radio" name="active" value="yes">
                                                Active
                                            </label>
                                            &nbsp;&nbsp;&nbsp;
                                            <label class="radio">
                                                <input type="radio" name="active" value="no" checked="">
                                                In active
                                            </label>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row-fluid ui-sortable" id="sortable_portlets">
            <?php
            $total_elements = count($group_tasks);
            $max_column_elements = floor($total_elements / 3);
            if ($max_column_elements == 0) {
                $max_column_elements = 1;
            }
            ?>

            <div class="span4 column sortable">
                <?php for ($i = 0; $i < $max_column_elements && $i < $total_elements; $i++) { ?>
                    <div class=" portlet box blue">
                        <div class="portlet-title"> 
                            <h4><i class="icon-reorder"></i><?php echo $group_tasks[$i]['parent_name']; ?></h4>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"></a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <?php $childs = $group_tasks[$i]['parent_items']; ?>
                            <?php if (count($childs) > 0) { ?>
                                <?php foreach ($childs as $child) { ?>
                                    <input type="checkbox" value="<?php echo element('child_id', $child); ?>" <?php echo element('checked', $child); ?> name="taskcheck"/>&nbsp;&nbsp;<?php echo element('child_name', $child) ?><br/>
                                <?php } ?>
                            <?php } else { ?>
                                Sorry, no task found
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="span4 column sortable">
                <?php for ($j = $i, $looped = 0; $looped < $max_column_elements && $j < $total_elements; $j++, $looped++) { ?>
                    <div class=" portlet box blue">
                        <div class="portlet-title"> 
                            <h4><i class="icon-reorder"></i><?php echo element('parent_name', $group_tasks[$j]); ?></h4>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"></a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <?php $childs = element('parent_items', $group_tasks[$j]); ?>
                            <?php if (count($childs) > 0) { ?>
                                <?php foreach ($childs as $child) { ?>
                                    <input type="checkbox" value="<?php echo element('child_id', $child); ?>" <?php echo element('checked', $child); ?> name="taskcheck"/><?php echo element('child_name', $child) ?><br/>
                                <?php } ?>
                            <?php } else { ?>
                                Sorry, no task found
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="span4 column sortable">
                <?php for ($k = $j, $looped = 0; $looped < $max_column_elements && $k < $total_elements; $k++, $looped++) { ?>
                    <div class=" portlet box blue">
                        <div class="portlet-title"> 
                            <h4><i class="icon-reorder"></i><?php echo element('parent_name', $group_task[$k]); ?></h4>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"></a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <?php $childs = element('parent_items', $group_task[$k]); ?>
                            <?php if (count($childs) > 0) { ?>
                                <?php foreach ($childs as $child) { ?>
                                    <input type="checkbox" value="<?php echo element('child_id', $child); ?>" <?php echo element('checked', $child); ?> name="taskcheck"/><?php echo element('child_name', $child) ?><br/>
                                <?php } ?>
                            <?php } else { ?>
                                Sorry, no task found
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="form-actions">
            <?php if ($action == 'add') { ?>
                <button type="submit" class="btn blue" onclick="onGroupSave('<?php echo $tid;?>');"><i class="icon-ok"></i>Save</button>
                <button type="submit" class="btn blue" onclick="onGroupSave('');"><i class="icon-ok"></i>Save &amp; create another</button>
            <?php } else { ?>
                <button type="submit" class="btn blue" onclick="onGroupUpdate();"><i class="icon-ok"></i>Update</button>
            <?php } ?>
        </div>

    </form>

</div>
<?php add_script('core_scripts/system_management/manage.groups.forms.js'); ?>
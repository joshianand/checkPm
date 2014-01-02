<div class="group_container">
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <h4><i class="icon-cogs"></i>User groups</h4>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <a href="javascript:;" class="btn blue" style="margin-bottom: 10px;" onclick="createNewGroup();">Create new group</a>
                    <br/>
                    <input id="csrf_portal" type="hidden" name="csrf_portal" value="<?php echo $token; ?>"/>
                    <div id="groupgrid" class="k-content"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php add_script('core_scripts/system_management/manage.groups.js'); ?>
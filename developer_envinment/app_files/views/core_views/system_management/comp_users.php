<div class="user_container">
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <h4><i class="icon-cogs"></i>Users</h4>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <a href="javascript:;" class="btn blue" style="margin-bottom: 10px;" onclick="createNewUser();">Create new user</a>
                    <br/>
                    <input id="csrf_portal" type="hidden" name="csrf_portal" value="<?php echo $token; ?>"/>
                    <div id="usergrid" class="k-content"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php add_script('core_scripts/system_management/manage.users.js'); ?>
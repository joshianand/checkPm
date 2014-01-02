<div class="bundle_container">
    <form id="frm_bundle" name="frm_bundle" action="javascript:;" method="POST">
        <input id="csrf_portal" type="hidden" name="csrf_portal" value="<?php echo $token; ?>"/>
        <div class="row-fluid">
            <div class="span6">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <h4><i class="icon-cogs"></i>Basic information</h4>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row-fluid">
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label" for="firstName">Module</label>
                                    <div class="controls">
                                        <select id="ModuleSelection" name="ModuleSelection" class="span12 chosen" data-placeholder="Choose a Category" tabindex="1">
                                            <option value="" selected="">Select a module</option>
                                            <?php foreach ($modules as $module) { ?>
                                                <option value="<?php echo element('module_id', $module); ?>"><?php echo element('module_name', $module); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label" for="firstName">Installer type</label>
                                    <div class="controls">
                                        <select id="InstallerTypeSelection" name="InstallerTypeSelection" class="span12 chosen" data-placeholder="Choose a Category" tabindex="1">
                                            <option value="" selected="">Selection installation type</option>
                                            <option value="install">New installation</option>
                                            <option value="upgrade">Upgrade</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="span6">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <h4><i class="icon-cogs"></i>Database tables</h4>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row-fluid">
                            <div class="controls">
                                <?php foreach ($db_tables as $table) { ?>
                                    <input type="checkbox" value="<?php echo $table; ?>" name="checkTables"/>&nbsp;&nbsp;<?php echo $table; ?><br/>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="form-actions">
            <button type="submit" class="btn blue" onclick="onCreateInstaller();"><i class="icon-ok"></i>Create installer</button>
        </div>
    </form>
</div>


<?php add_script('core_scripts/installer.js'); ?>

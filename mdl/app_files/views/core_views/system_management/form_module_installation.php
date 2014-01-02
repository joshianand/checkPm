<div class="module_installer_container">
    <form id="frm_module_installer" name="frm_module_installer" method="POST" action="javascript:;">
        <input id="csrf_portal" type="hidden" name="csrf_portal" value="<?php echo $token; ?>"/>
        <div class="row-fluid">
            <div class="span12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <h4><i class="icon-cogs"></i>Install a module</h4>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row-fluid">
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label" for="firstName">Installer file</label>
                                    <div class="controls">
                                        <input type="hidden" id="uploadedFileName" name="uploadedFileName" value=""/>
                                        <input name="installerFile" id="installerFile" type="file" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn blue" onclick="onInstall('<?php echo $tid; ?>');"><i class="icon-ok"></i>Install</button>
        </div>

    </form>
</div>

<?php add_script('core_scripts/system_management/manage.modules.installation.forms.js'); ?>
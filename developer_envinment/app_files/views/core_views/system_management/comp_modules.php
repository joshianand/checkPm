<div class="module_container">
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <h4><i class="icon-cogs"></i>Available modules</h4>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <br/>
                    <input id="csrf_portal" type="hidden" name="csrf_portal" value="<?php echo $token; ?>"/>
                    <div id="modulegrid" class="k-content"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/x-kendo-template" id="template">
    <div class="tabstrip">
        <ul>
            <li class="k-state-active">
                Sub modules
            </li>
        </ul>
        <div>
            <div id="submodules"></div>
        </div>
    </div>
</script>

<?php add_script('core_scripts/system_management/manage.modules.js'); ?>
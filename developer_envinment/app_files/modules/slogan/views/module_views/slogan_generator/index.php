<div class="user_container">
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <h4><i class="icon-cogs"></i>Slogans</h4>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <input id="csrf_portal" type="hidden" name="csrf_portal" value="<?php echo $token; ?>"/>
                    <div id="slogan_data_grid" class="k-content"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/x-kendo-template" id="template">
    <div class="slogans"></div>
</script>

<?php add_script('module_scripts/slogan_generator/manage.slogans.js'); ?>
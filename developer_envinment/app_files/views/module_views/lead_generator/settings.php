<div class="setting_container">
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <h4><i class="icon-cogs"></i>Settings</h4>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="<?php echo base_url();?>settings/save_settings" class="form-horizontal" method="POST">
                        <input id="csrf_portal" type="hidden" name="csrf_portal" value="<?php echo $token; ?>"/>
                        <div class="control-group">
                            <label class="control-label">Run cron every: </label>
                            <div class="controls">
                                <select id="runCronFor" name="runCronFor">
                                    <?php 
                                        $hrsFrom = 5;
                                        $hrsTo = 24;
                                        for($i = $hrsFrom; $i <= $hrsTo; $i++) {
                                            $selected = "";
                                            if($i == $settings["runCronFor"])
                                                $selected = "selected = 'selected'";
                                    ?>
                                            <option value="<?php echo $i;?>" <?php echo $selected;?>><?php echo $i;?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                <span class="help-inline">Hrs</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <input class="btn blue" data-dismiss="modal" aria-hidden="true" value="Submit" type="submit"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
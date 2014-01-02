<div class="user_container">
    <form id="frm_user" name="frm_user" action="javascript:;" method="POST">
        <input id="csrf_portal" type="hidden" name="csrf_portal" value="<?php echo $token; ?>"/>
        <input id="user_id" type="hidden" name="user_id" value="<?php echo $user_id; ?>"/>

        <div class="row-fluid">
            <div class="span12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <h4><i class="icon-cogs"></i>User information</h4>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <h3 class="form-section">Login details</h3>

                        <div class="row-fluid">
                            <div class="span4 ">
                                <div class="control-group">
                                    <label class="control-label">Group</label>
                                    <div class="controls">
                                        <select id="GroupSelection" name="GroupSelection" class="span12 chosen" data-placeholder="Choose a Category" tabindex="1">
                                            <?php foreach ($user_groups as $group) { ?>
                                                <?php if (element('group_name', $group) == element('group_name', $user_details)) { ?>
                                                    <option value="<?php echo element('group_id', $group); ?>" selected="selected"><?php echo element('group_name', $group); ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo element('group_id', $group); ?>"><?php echo element('group_name', $group); ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <?php if ($action == 'add') { ?>
                                <div class="span4">
                                    <div class="control-group">
                                        <label class="control-label" for="lastName">Login name</label>
                                        <div class="controls">
                                            <input id="LoginName" name="LoginName" type="text" class="m-wrap span12" placeholder="Ex: jhon" value="<?php echo element('login_name', $user_details); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="span4">
                                    <div class="control-group">
                                        <label class="control-label" for="lastName">Login password</label>
                                        <div class="controls">
                                            <input id="LoginPass" name="LoginPass" type="password" class="m-wrap span12" value="<?php echo element('login_pass', $user_details); ?>">
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <h3 class="form-section">User Info</h3>

                        <div class="row-fluid">
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label">First Name</label>
                                    <div class="controls">
                                        <input id="FirstName" name="FirstName" type="text" class="m-wrap span12" placeholder="Ex: Jhon" value="<?php echo element('first_name', $user_details); ?>">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label">Last Name</label>
                                    <div class="controls">
                                        <input id="LastName" name="LastName" type="text" class="m-wrap span12" placeholder="Ex: Smith" value="<?php echo element('last_name', $user_details); ?>">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="row-fluid">
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label">Email</label>
                                    <div class="input-prepend">
                                        <span class="add-on">@</span>
                                        <input id="Email" name="Email" class="m-wrap span12" type="text" placeholder="Ex: jhon@gmail.com" value="<?php echo element('email', $user_details); ?>">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label">Address</label>
                                    <div class="controls">
                                        <input id="Address" name="Address" type="text" class="m-wrap span12" placeholder="Ex: 1, USA" value="<?php echo element('address', $user_details); ?>">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="row-fluid">
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label">City</label>
                                    <div class="controls">
                                        <input id="City" name="City" type="text" class="m-wrap span12" placeholder="Ex: Manila" value="<?php echo element('city', $user_details); ?>">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label">State</label>
                                    <div class="controls">
                                        <input id="State" name="State" type="text" class="m-wrap span12" placeholder="Ex: CA" value="<?php echo element('state', $user_details); ?>">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="row-fluid">
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label">Zip</label>
                                    <div class="controls">
                                        <input id="Zip" name="Zip" type="text" class="m-wrap span12" placeholder="Ex: 1217" value="<?php echo element('zip', $user_details); ?>">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label">Country</label>
                                    <div class="controls">
                                        <input id="Country" name="Country" type="text" class="m-wrap span12" placeholder="Ex: USA" value="<?php echo element('country', $user_details); ?>">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="row-fluid">
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label">Phone</label>
                                    <div class="controls">
                                        <input id="Phone" name="Phone" type="text" class="m-wrap span12" placeholder="Ex: 12345" value="<?php echo element('phone', $user_details); ?>">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label">Mobile</label>
                                    <div class="controls">
                                        <input id="Mobile" name="Mobile" type="text" class="m-wrap span12" placeholder="Ex: 12345" value="<?php echo element('mobile', $user_details); ?>">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="row-fluid">
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label" for="lastName">Active status</label>
                                    <div class="controls" style="padding-left: 20px;">
                                        <?php if (element('active', $user_details) == 'yes') { ?>
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
                        </div>

                        <div class="form-actions">
                            <?php if ($action == 'add') { ?>
                                <button type="submit" class="btn blue" onclick="onUserSave('<?php echo $tid; ?>');"><i class="icon-ok"></i>Save</button>
                                <button type="submit" class="btn blue" onclick="onUserSave('');"><i class="icon-ok"></i>Save &amp; create another</button>
                            <?php } else { ?>
                                <button type="submit" class="btn blue" onclick="onUserUpdate();"><i class="icon-ok"></i>Update</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php add_script('core_scripts/system_management/manage.users.forms.js'); ?>
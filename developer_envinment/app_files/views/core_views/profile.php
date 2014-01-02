<div class="profile_container">
    <div class="portlet box blue">
        <div class="portlet-title">
            <h4><i class="icon-reorder"></i>Personal Information</h4>
            <div class="tools">
                <a href="javascript:;" class="collapse"></a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form id="frm_profile" name="frm_profile" action="javascript:;" class="form-horizontal">
                <input id="csrf_portal" type="hidden" name="csrf_portal" value="<?php echo $token; ?>"/>
                <div class="row-fluid">
                    <div class="span6 ">
                        <div class="control-group">
                            <label class="control-label">First Name</label>
                            <div class="controls">
                                <input id="FirstName" name="FirstName" type="text" class="m-wrap span12" placeholder="Ex: Jhon" value="<?php echo element('first_name', $user_data); ?>">
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                        <div class="control-group">
                            <label class="control-label">Last Name</label>
                            <div class="controls">
                                <input id="LastName" name="LastName" type="text" class="m-wrap span12" placeholder="Ex: Smith" value="<?php echo element('last_name', $user_data); ?>">
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                </div>
                <!--/row-->
                <div class="row-fluid">
                    <div class="span6 ">
                        <div class="control-group">
                            <label class="control-label">Email</label>
                            <div class="input-prepend">
                                <span class="add-on">@</span>
                                <input id="Email" name="Email" class="m-wrap span12" type="text" placeholder="Ex: jhon@gmail.com" value="<?php echo element('email', $personal_info); ?>">
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                        <div class="control-group">
                            <label class="control-label">Address</label>
                            <div class="controls">
                                <input id="Address" name="Address" type="text" class="m-wrap span12" placeholder="Ex: 1, USA" value="<?php echo element('address', $personal_info); ?>">
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                </div>
                <!--/row-->        
                <div class="row-fluid">
                    <div class="span6 ">
                        <div class="control-group">
                            <label class="control-label">City</label>
                            <div class="controls">
                                <input id="City" name="City" type="text" class="m-wrap span12" placeholder="Ex: Manila" value="<?php echo element('city', $personal_info); ?>">
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                        <div class="control-group">
                            <label class="control-label">State</label>
                            <div class="controls">
                                <input id="State" name="State" type="text" class="m-wrap span12" placeholder="Ex: CA" value="<?php echo element('state', $personal_info); ?>">
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
                                <input id="Zip" name="Zip" type="text" class="m-wrap span12" placeholder="Ex: 1217" value="<?php echo element('zip', $personal_info); ?>">
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                        <div class="control-group">
                            <label class="control-label">Country</label>
                            <div class="controls">
                                <input id="Country" name="Country" type="text" class="m-wrap span12" placeholder="Ex: USA" value="<?php echo element('country', $personal_info); ?>">
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
                                <input id="Phone" name="Phone" type="text" class="m-wrap span12" placeholder="Ex: 12345" value="<?php echo element('phone', $personal_info); ?>">
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="span6 ">
                        <div class="control-group">
                            <label class="control-label">Mobile</label>
                            <div class="controls">
                                <input id="Mobile" name="Mobile" type="text" class="m-wrap span12" placeholder="Ex: 12345" value="<?php echo element('mobile', $personal_info); ?>">
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn blue" onclick="OnPesonalInfoSave();"><i class="icon-ok"></i>Update</button>
                </div>
            </form>
            <!-- END FORM-->                
        </div>
    </div>

    <div class="portlet box blue">
        <div class="portlet-title">
            <h4><i class="icon-reorder"></i>Access credentials</h4>
            <div class="tools">
                <a href="javascript:;" class="collapse"></a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form id="frm_access_credentials" name="frm_access_credentials" action="javascript:;" class="form-horizontal">
                <input id="csrf_portal" type="hidden" name="csrf_portal" value="<?php echo $token; ?>"/>
                <div class="row-fluid">
                    <div class="span6 ">
                        <div class="control-group">
                            <label class="control-label">User name</label>
                            <div class="controls">
                                <input id="LoginName" name="LoginName" type="text" class="m-wrap span12" placeholder="Chee Kin" value="<?php echo element('login_name', $user_data); ?>">
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                </div>
                <!--/row-->
                <div class="row-fluid">
                    <div class="span4 ">
                        <div class="control-group">
                            <label class="control-label">Current Password</label>
                            <div class="controls">
                                <input id="OldPassword" name="OldPassword" type="password" class="m-wrap span12" placeholder="Type your current password" value="">
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="span4 ">
                        <div class="control-group">
                            <label class="control-label">New Password</label>
                            <div class="controls">
                                <input id="NewPassword" name="NewPassword" type="password" class="m-wrap span12" placeholder="Type new password" value="">
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="span4 ">
                        <div class="control-group">
                            <label class="control-label">Retype Password</label>
                            <div class="controls">
                                <input id="RetypePassword" name="RetypePassword" type="password" class="m-wrap span12" placeholder="Retype new password" value="">
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn blue" onclick="OnCredentialSave();"><i class="icon-ok"></i>Update</button>
                </div>
            </form>
            <!-- END FORM-->                
        </div>
    </div>
</div>

<?php add_script('core_scripts/user.profile.js'); ?>
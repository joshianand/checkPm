<div class="domain_container">
    <input id="csrf_portal" type="hidden" name="csrf_portal" value="<?php echo $token; ?>"/>

    <div class="row-fluid">
        <div class="span12">
            <a href="#options" role="button" class="btn btn-primary blue" data-toggle="modal" style="float: right;margin-bottom: 5px;"><i class="icon-star"></i> Selection settings</a>
        </div>
    </div>

    <div id="options" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;width: 660px;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h3 id="myModalLabel1">Advanced domain selection option</h3>
        </div>
        <div class="modal-body">
            <form id="frm_selection_options" name="frm_selection_options" class="form-horizontal" action="javascript:;" method="POST">
                <input id="csrf_portal" type="hidden" name="csrf_portal" value="<?php echo $token; ?>"/>
                <div class="control-group">
                    <label class="control-label">1st selection order</label>
                    <div class="controls">
                        <select id="firstSelectionOrder" name="firstSelectionOrder" style="width: 450px;">
                            <option value="none" <?php
                            if ($option_settings['first_selectionorders'] == 'none') {
                                echo "selected=''";
                            }
                            ?> >None</option>
                            <option value="s_com" <?php
                            if ($option_settings['first_selectionorders'] == 's_com') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has no dash or Underscore, and is .com</option>
                            <option value="s_net" <?php
                            if ($option_settings['first_selectionorders'] == 's_net') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has no dash or Underscore, and is .net</option>
                            <option value="c_com" <?php
                            if ($option_settings['first_selectionorders'] == 'c_com') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has the center - between the words, and is .com</option>
                            <option value="c_net" <?php
                            if ($option_settings['first_selectionorders'] == 'c_net') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has the center - between the words, and is .net</option>
                            <option value="s_us" <?php
                            if ($option_settings['first_selectionorders'] == 's_us') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has no dash or Underscore, and is .us</option>
                            <option value="c_us" <?php
                            if ($option_settings['first_selectionorders'] == 'c_us') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has the center - between the words, and is .us</option>

                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">2nd selection order</label>
                    <div class="controls">
                        <select id="secondSelectionOrder" name="secondSelectionOrder" style="width: 450px;">
                            <option value="none" <?php
                            if ($option_settings['second_selectionorders'] == 'none') {
                                echo "selected=''";
                            }
                            ?> >None</option>
                            <option value="s_com" <?php
                            if ($option_settings['second_selectionorders'] == 's_com') {
                                echo "selected=''";
                            }
                            ?>>Straight accross and has no dash or Underscore, and is .com</option>
                            <option value="s_net" <?php
                            if ($option_settings['second_selectionorders'] == 's_net') {
                                echo "selected=''";
                            }
                            ?>>Straight accross and has no dash or Underscore, and is .net</option>
                            <option value="c_com" <?php
                            if ($option_settings['second_selectionorders'] == 'c_com') {
                                echo "selected=''";
                            }
                            ?>>Straight accross and has the center - between the words, and is .com</option>
                            <option value="c_net" <?php
                            if ($option_settings['second_selectionorders'] == 'c_net') {
                                echo "selected=''";
                            }
                            ?>>Straight accross and has the center - between the words, and is .net</option>
                            <option value="s_us" <?php
                            if ($option_settings['second_selectionorders'] == 's_us') {
                                echo "selected=''";
                            }
                            ?>>Straight accross and has no dash or Underscore, and is .us</option>
                            <option value="c_us" <?php
                            if ($option_settings['second_selectionorders'] == 'c_us') {
                                echo "selected=''";
                            }
                            ?>>Straight accross and has the center - between the words, and is .us</option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">3rd selection order</label>
                    <div class="controls">
                        <select id="thirdSelectionOrder" name="thirdSelectionOrder" style="width: 450px;">
                            <option value="none" <?php
                            if ($option_settings['third_selectionorders'] == 'none') {
                                echo "selected=''";
                            }
                            ?> >None</option>
                            <option value="s_com" <?php
                            if ($option_settings['third_selectionorders'] == 's_com') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has no dash or Underscore, and is .com</option>
                            <option value="s_net" <?php
                            if ($option_settings['third_selectionorders'] == 's_net') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has no dash or Underscore, and is .net</option>
                            <option value="c_com" <?php
                            if ($option_settings['third_selectionorders'] == 'c_com') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has the center - between the words, and is .com</option>
                            <option value="c_net" <?php
                            if ($option_settings['third_selectionorders'] == 'c_net') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has the center - between the words, and is .net</option>
                            <option value="s_us" <?php
                            if ($option_settings['third_selectionorders'] == 's_us') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has no dash or Underscore, and is .us</option>
                            <option value="c_us" <?php
                            if ($option_settings['third_selectionorders'] == 'c_us') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has the center - between the words, and is .us</option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">4th selection order</label>
                    <div class="controls">
                        <select id="fourthSelectionOrder" name="fourthSelectionOrder" style="width: 450px;">
                            <option value="none" <?php
                            if ($option_settings['fourth_selectionorders'] == 'none') {
                                echo "selected=''";
                            }
                            ?> >None</option>
                            <option value="s_com" <?php
                            if ($option_settings['fourth_selectionorders'] == 's_com') {
                                echo "selected=''";
                            }
                            ?>>Straight accross and has no dash or Underscore, and is .com</option>
                            <option value="s_net" <?php
                            if ($option_settings['fourth_selectionorders'] == 's_net') {
                                echo "selected=''";
                            }
                            ?>>Straight accross and has no dash or Underscore, and is .net</option>
                            <option value="c_com" <?php
                            if ($option_settings['fourth_selectionorders'] == 'c_com') {
                                echo "selected=''";
                            }
                            ?>>Straight accross and has the center - between the words, and is .com</option>
                            <option value="c_net" <?php
                            if ($option_settings['fourth_selectionorders'] == 'c_net') {
                                echo "selected=''";
                            }
                            ?>>Straight accross and has the center - between the words, and is .net</option>
                            <option value="s_us" <?php
                            if ($option_settings['fourth_selectionorders'] == 's_us') {
                                echo "selected=''";
                            }
                            ?>>Straight accross and has no dash or Underscore, and is .us</option>
                            <option value="c_us" <?php
                            if ($option_settings['fourth_selectionorders'] == 'c_us') {
                                echo "selected=''";
                            }
                            ?>>Straight accross and has the center - between the words, and is .us</option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">5th selection order</label>
                    <div class="controls">
                        <select id="fifthSelectionOrder" name="fifthSelectionOrder" style="width: 450px;">
                            <option value="none" <?php
                            if ($option_settings['fifth_selectionorders'] == 'none') {
                                echo "selected=''";
                            }
                            ?> >None</option>
                            <option value="s_com" <?php
                            if ($option_settings['fifth_selectionorders'] == 's_com') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has no dash or Underscore, and is .com</option>
                            <option value="s_net" <?php
                            if ($option_settings['fifth_selectionorders'] == 's_net') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has no dash or Underscore, and is .net</option>
                            <option value="c_com" <?php
                            if ($option_settings['fifth_selectionorders'] == 'c_com') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has the center - between the words, and is .com</option>
                            <option value="c_net" <?php
                            if ($option_settings['fifth_selectionorders'] == 'c_net') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has the center - between the words, and is .net</option>
                            <option value="s_us" <?php
                            if ($option_settings['fifth_selectionorders'] == 's_us') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has no dash or Underscore, and is .us</option>
                            <option value="c_us" <?php
                            if ($option_settings['fifth_selectionorders'] == 'c_us') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has the center - between the words, and is .us</option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">6th selection order</label>
                    <div class="controls">
                        <select id="sixthSelectionOrder" name="sixthSelectionOrder" style="width: 450px;">
                            <option value="none" <?php
                            if ($option_settings['sixth_selectionorders'] == 'none') {
                                echo "selected=''";
                            }
                            ?> >None</option>
                            <option value="s_com" <?php
                            if ($option_settings['sixth_selectionorders'] == 's_com') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has no dash or Underscore, and is .com</option>
                            <option value="s_net" <?php
                            if ($option_settings['sixth_selectionorders'] == 's_net') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has no dash or Underscore, and is .net</option>
                            <option value="c_com" <?php
                            if ($option_settings['sixth_selectionorders'] == 'c_com') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has the center - between the words, and is .com</option>
                            <option value="c_net" <?php
                            if ($option_settings['sixth_selectionorders'] == 'c_net') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has the center - between the words, and is .net</option>
                            <option value="s_us" <?php
                            if ($option_settings['sixth_selectionorders'] == 's_us') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has no dash or Underscore, and is .us</option>
                            <option value="c_us" <?php
                            if ($option_settings['sixth_selectionorders'] == 'c_us') {
                                echo "selected=''";
                            }
                            ?>>Straight across and has the center - between the words, and is .us</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Close</button>
            <button class="btn yellow" onclick="saveSelection();"><i class="icon-save"></i> Apply settings</button>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span4">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <h4><i class="icon-search"></i>Domain searching from keyword</h4>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form id="frm_domain_search" name="frm_domain_search" action="javascript:;" method="POST">
                        <input id="csrf_portal" type="hidden" name="csrf_portal" value="<?php echo $token; ?>"/>
                        <div class="control-group">
                            <label class="control-label">Enter keyword</label>
                            <div class="controls">
                                <textarea id="keywords" name="keywords" placeholder="Enter up to 500 keyword name.Each name must be on a separate line" class="span12 m-wrap" rows="4"></textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Domains/Keyword (MAX)</label>
                            <div class="controls">
                                <select id="domainsPerKeyword" name="domainsPerKeyword">
                                    <option value="1" selected="">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>

                        <div style="padding-bottom: 69px;"></div>

                        <div class="form-actions">
                            <button type="submit" class="btn blue" onclick="searchByKeyword();"><i class="icon-search"></i>Search domains</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="span4">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <h4><i class="icon-search"></i>Searching domain from city & services</h4>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form id="frm_city_service_search" name="frm_city_service_search" action="javascript:;" method="POST">
                        <input id="csrf_portal" type="hidden" name="csrf_portal" value="<?php echo $token; ?>"/>
                        <div class="control-group">
                            <label class="control-label">Enter cities</label>
                            <div class="controls">
                                <textarea id="cityNames" name="cityNames" placeholder="Provide mupltiple city names in comma seperated" class="span12 m-wrap" rows="2"></textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Enter services</label>
                            <div class="controls">
                                <textarea id="serviceNames" name="serviceNames" placeholder="Provide multiple service name in comma seperated" class="span12 m-wrap" rows="2"></textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Domains/Combination (MAX)</label>
                            <div class="controls">
                                <select id="domainsPerCombination" name="domainsPerCombination">
                                    <option value="1" selected="">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>

                        <div style="padding-bottom: 10px;"></div>

                        <div class="form-actions">
                            <button type="submit" class="btn blue" onclick="searchByCityService();"><i class="icon-search"></i>Search domains</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="span4">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <h4><i class="icon-search"></i>Search domain by slogan</h4>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form id="frm_slogan_search" name="frm_slogan_search" action="javascript:;" method="POST">
                        <input id="csrf_portal" type="hidden" name="csrf_portal" value="<?php echo $token; ?>"/>

                        <div class="control-group">
                            <label class="control-label">Select slogan from</label>
                            <div class="controls">
                                <select id="sloganSource" name="sloganSource" onchange="onSloganKeyChange();">
                                    <option value="">Select source</option>
                                    <?php foreach ($slogan_keys as $slogan_key) { ?>
                                        <option value="<?php echo element('data_id', $slogan_key); ?>"><?php echo element('cities', $slogan_key); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Slogan list</label>
                            <div class="controls">
                                <select id="slogans" name="slogans" class="span12 m-wrap" multiple="">
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Domains/Slogan (MAX)</label>
                            <div class="controls">
                                <select id="domainsPerSlogan" name="domainsPerSlogan">
                                    <option value="1" selected="">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn blue" onclick="searchBySlogan();"><i class="icon-search"></i>Search domains</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span4">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <h4><i class="icon-cogs"></i>.com Domain(s)</h4>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="com_domain_grid" class="k-content"></div>
                </div>
            </div>
        </div>

        <div class="span4">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <h4><i class="icon-cogs"></i>.net Domain(s)</h4>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="net_domain_grid" class="k-content"></div>
                </div>
            </div>
        </div>

        <div class="span4">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <h4><i class="icon-cogs"></i>.us Domain(s)</h4>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="us_domain_grid" class="k-content"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn blue" onclick="saveSearchedDomain();"><i class="icon-ok"></i>Save searched domains</button>
        <button type="submit" class="btn blue" onclick="downloadGeneratedDomains();"><i class="icon-download"></i>Download searched domains</button>
    </div>
</div>

<?php add_script('module_scripts/search_domain/manage.domain.search.js');?>
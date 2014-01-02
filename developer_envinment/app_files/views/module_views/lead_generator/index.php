<div class="search_container">
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <h4><i class="icon-cogs"></i>Search yellow page</h4>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <a href="#options" role="button" class="btn btn-primary blue" data-toggle="modal" style="margin-bottom: 5px;"><i class="icon-search"></i> New search</a>
                    <input id="csrf_portal" type="hidden" name="csrf_portal" value="<?php echo $token; ?>"/>
                    <div id="searchGrid" class="k-content"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="options" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h3 id="myModalLabel1">New search</h3>
        </div>

        <div class="modal-body">
            <form id="frm_search_selection" name="frm_search_selection" class="form-horizontal" action="javascript:;" method="POST">
                <input id="csrf_portal" type="hidden" name="csrf_portal" value="<?php echo $token; ?>"/>

                <div class="control-group">
                    <label class="control-label">Select City</label>
                    <div class="controls">
                        <select id="citySelection" name="citySelection[]" multiple>
                            <?php foreach ($cities as $city) { ?>
                                <option value="<?php echo element('city_id', $city) ?>"><?php echo element('city_name', $city) . ", " . element('city_symbol', $city); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Enter text</label>
                    <div class="controls">
                        <input type="text" value="" id="searchText" name="searchText">
                    </div>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Close</button>
            <button class="btn yellow" onclick="newSearch();"><i class="icon-search"></i> Search</button>
        </div>
    </div>

    <div id="downloadOptions" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
        
    </div>
</div>


<script type="text/x-kendo-template" id="downloadTemplate">
<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h3 id="myModalLabel1">Download options</h3>
        </div>

        <div class="modal-body">
            <form id="frm_download_selection" name="frm_download_selection" class="form-horizontal" action="javascript:;" method="POST">
                <input type="hidden" id="search_id" name="search_id" value="#= search_id#"/>
                <h3 class="form-section">Column selection</h3>
                <div class="control-group">
                    <label class="control-label">Select columns</label>
                    <div class="controls">
                        <input type="checkbox" id="bsNameCheck" name="bsNameCheck" checked=""/>&nbsp;&nbsp;&nbsp;Business name&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" id="bsCatCheck" name="bsCatCheck" checked=""/>&nbsp;&nbsp;&nbsp;Business category<br/>
                        
                        <input type="checkbox" id="bsAddCheck" name="bsAddCheck" checked=""/>&nbsp;&nbsp;&nbsp;Address&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" id="bsCityCheck" name="bsCityCheck" checked="" style="margin-left: 41px;"/>&nbsp;&nbsp;&nbsp;City<br/>
                        
                        <input type="checkbox" id="bsStateCheck" name="bsStateCheck" checked=""/>&nbsp;&nbsp;&nbsp;State&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" id="bsZipCheck" name="bsZipCheck" checked="" style="margin-left: 58px;"/>&nbsp;&nbsp;&nbsp;Zip<br/>
                        
                        <input type="checkbox" id="bsPhnCheck" name="bsPhnCheck" checked=""/>&nbsp;&nbsp;&nbsp;Phone&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" id="bsWebCheck" name="bsWebCheck" checked="" style="margin-left: 50px;"/>&nbsp;&nbsp;&nbsp;Web site<br/>
                        
                        <input type="checkbox" id="bsMailCheck" name="bsMailCheck" checked=""/>&nbsp;&nbsp;&nbsp;Email&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" id="bsRateCheck" name="bsRateCheck" checked="" style="margin-left: 57px;"/>&nbsp;&nbsp;&nbsp;Rating<br/>
                        
                        <input type="checkbox" id="bsDmnOwnerCheck" name="bsRateCheck" checked=""/>&nbsp;&nbsp;&nbsp;Domain owner&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" id="bsDmnAgeCheck" name="bsRateCheck" checked=""/>&nbsp;&nbsp;&nbsp;Domain age<br/>
                        
                        <input type="checkbox" id="bsSeoScoreCheck" name="bsRateCheck" checked=""/>&nbsp;&nbsp;&nbsp;Seo score&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" id="bsSeoTipsCheck" name="bsRateCheck" checked="" style="margin-left: 32px;"/>&nbsp;&nbsp;&nbsp;Seo tips<br/>
                    </div>
                </div>

                <h3 class="form-section">Options</h3>
                <div class="control-group">
                    <label class="control-label">Select options</label>
                    <div class="controls">
                        <input type="checkbox" id="webOption" name="webOption"/>&nbsp;&nbsp;&nbsp;Select companies who have web site<br/>
                        <input type="checkbox" id="emailOption" name="emailOption" checked=""/>&nbsp;&nbsp;&nbsp;Select companies who have email address<br/>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Download format</label>
                    <div class="controls">
                        <select id="downloadFormat" name="downloadFormat">
                            <option value="xls" selected="">Excel file format</option>
                            <option value="csv">CSV file format</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Close</button>
            <button class="btn yellow" onclick="downloadBusiness();"><i class="icon-download"></i> Download</button>
        </div>
</script>

<script type="text/x-kendo-template" id="detailsTemplate">
    <div class="businessDetails"></div>
</script>

<?php add_script('module_scripts/lead_generator/manage.yp.search.js'); ?>
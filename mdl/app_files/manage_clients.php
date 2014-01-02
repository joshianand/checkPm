<div class="container">


<!-- Masthead
================================================== -->

  <div class="row">
    
    
     </div>
  <div class="row">
    <div class="span2">
    <div id="loading" class="pagination-centered" style="visibility: hidden;">
      <img src="<?php echo base_url();?>common/img/loader-blue.gif" alt="loading">
    </div>
     <h2>Accounts</h2>
     <a href="views/bmsapp/ajax/add-account.php" data-toggle="modal" class="btn btn-primary btn-block"><i class="icon-plus icon-white"></i> Add Account</a>
 <hr>
   <h5>Total 1 accounts Found. Showing Page 1 of 1</h5>  
   <hr>
    <a href="make.php?_what=csv&amp;__use__=NTJiODE3MzgyOWEyNlNFTEVDVCBpZCwgbmFtZSwgZGF0ZWNyZWF0ZWQsIGJhbGFuY2UsIGFjY3R5cGUgZnJvbSBhY2NvdW50cyBXSEVSRSAoYWNjdHlwZT0nQ3VzdG9tZXInKSBBTkQgKGlkPjk5OSkgT1JERVIgQlkgaWQgREVTQyBMSU1JVA0KMCAsIDUw" class="btn btn-primary btn-block"><i class="icon-list icon-white"></i> Export CSV</a>
     <a href="make.php?_what=pdf&amp;__use__=NTJiODE3MzgyOWEyNlNFTEVDVCBpZCwgbmFtZSwgZGF0ZWNyZWF0ZWQsIGJhbGFuY2UsIGFjY3R5cGUgZnJvbSBhY2NvdW50cyBXSEVSRSAoYWNjdHlwZT0nQ3VzdG9tZXInKSBBTkQgKGlkPjk5OSkgT1JERVIgQlkgaWQgREVTQyBMSU1JVA0KMCAsIDUw&amp;_title=All-Accounts&amp;_type=accounts" class="btn btn-primary btn-block"><i class="icon-list icon-white"></i> Export PDF</a>
    </div>
    <div class="span10">
      <div id="accounts-data">
<div id="data_wrapper" class="dataTables_wrapper form-inline" role="grid"><div class="row-fluid"><div class="span6"></div><div class="span6"><div class="dataTables_filter" id="data_filter"><label>Search: <input type="text" aria-controls="data"></label></div></div></div><table class="footable dataTable" id="data" style="width: 970px;">
      <thead>
        <tr role="row"><th colspan="7" align="left" rowspan="1"><select name="accounts" id="cfilter" data-placeholder="Choose a Country..." class="chzn-select chzn-done" tabindex="-1" style="display: none;">
          <option value="?_filter=_blank">All Accounts</option>
  <option value="?_filter=Customer" selected="selected">Customer</option>
  <option value="?_filter=Vendor">Vendor</option>
  <option value="?_filter=Cash">Cash</option>
  <option value="?_filter=Bank">Bank</option>
  <option value="?_filter=Investor">Investor</option>
  <option value="?_filter=Partner">Partner</option>
  <option value="?_filter=Employee">Employee</option>
  <option value="?_filter=Consultant">Consultant</option>
  <option value="?_filter=Income">Income</option>
  <option value="?_filter=Expense">Expense</option>
  <option value="?_filter=TAX">TAX</option>
  <option value="?_filter=Credit-Card">Credit Card</option>
  <option value="?_filter=Inventory">Inventory</option>
  <option value="?_filter=Long-Term-Liability">Long Term Liability</option>
  <option value="?_filter=Accounts-Payable">Accounts Payable</option>
  <option value="?_filter=Accounts-Receivable">Accounts Receivable</option>
  <option value="?_filter=Equity">Equity</option>
  <option value="?_filter=Account-Credit">Account Credit</option>
  <option value="?_filter=Cost-of-Goods-Sold">Cost of Goods Sold</option>
  <option value="?_filter=Other">Other</option>
</select><div id="cfilter_chzn" class="chzn-container chzn-container-single" style="width: 220px;" title=""><a href="javascript:void(0)" class="chzn-single" tabindex="-1"><span>Customer</span><div><b></b></div></a><div class="chzn-drop" style="left: -9000px; width: 218px; top: 25px;"><div class="chzn-search"><input type="text" autocomplete="off" tabindex="2" style="width: 183px;"></div><ul class="chzn-results"><li id="cfilter_chzn_o_0" class="active-result" style="">All Accounts</li><li id="cfilter_chzn_o_1" class="active-result result-selected" style="">Customer</li><li id="cfilter_chzn_o_2" class="active-result" style="">Vendor</li><li id="cfilter_chzn_o_3" class="active-result" style="">Cash</li><li id="cfilter_chzn_o_4" class="active-result" style="">Bank</li><li id="cfilter_chzn_o_5" class="active-result" style="">Investor</li><li id="cfilter_chzn_o_6" class="active-result" style="">Partner</li><li id="cfilter_chzn_o_7" class="active-result" style="">Employee</li><li id="cfilter_chzn_o_8" class="active-result" style="">Consultant</li><li id="cfilter_chzn_o_9" class="active-result" style="">Income</li><li id="cfilter_chzn_o_10" class="active-result" style="">Expense</li><li id="cfilter_chzn_o_11" class="active-result" style="">TAX</li><li id="cfilter_chzn_o_12" class="active-result" style="">Credit Card</li><li id="cfilter_chzn_o_13" class="active-result" style="">Inventory</li><li id="cfilter_chzn_o_14" class="active-result" style="">Long Term Liability</li><li id="cfilter_chzn_o_15" class="active-result" style="">Accounts Payable</li><li id="cfilter_chzn_o_16" class="active-result" style="">Accounts Receivable</li><li id="cfilter_chzn_o_17" class="active-result" style="">Equity</li><li id="cfilter_chzn_o_18" class="active-result" style="">Account Credit</li><li id="cfilter_chzn_o_19" class="active-result" style="">Cost of Goods Sold</li><li id="cfilter_chzn_o_20" class="active-result" style="">Other</li></ul></div></div>


</th></tr>
        <tr role="row"><th class="sorting" role="columnheader" tabindex="0" aria-controls="data" rowspan="1" colspan="1" aria-label="
            S/L
          : activate to sort column ascending" style="width: 30px;">
            S/L
          </th><th class="sorting_desc" role="columnheader" tabindex="0" aria-controls="data" rowspan="1" colspan="1" aria-sort="descending" aria-label="
           ID
          : activate to sort column ascending" style="width: 69px;">
           ID
          </th><th class="sorting" role="columnheader" tabindex="0" aria-controls="data" rowspan="1" colspan="1" aria-label="
            Account Name
          : activate to sort column ascending" style="width: 142px;">
            Account Name
          </th><th data-hide="phone,tablet" class="sorting" role="columnheader" tabindex="0" aria-controls="data" rowspan="1" colspan="1" aria-label="Date Created: activate to sort column ascending" style="width: 140px;">Date Created</th><th data-hide="phone,tablet" data-type="numeric" class="sorting" role="columnheader" tabindex="0" aria-controls="data" rowspan="1" colspan="1" aria-label="
            Balance
          : activate to sort column ascending" style="width: 168px;">
            Balance
          </th><th data-hide="phone" class="sorting" role="columnheader" tabindex="0" aria-controls="data" rowspan="1" colspan="1" aria-label="
            Type
          : activate to sort column ascending" style="width: 129px;">
            Type
          </th><th class="sorting" role="columnheader" tabindex="0" aria-controls="data" rowspan="1" colspan="1" aria-label="
            Manage
          : activate to sort column ascending" style="width: 144px;">
            Manage
          </th></tr>
      </thead>
      
    <tbody role="alert" aria-live="polite" aria-relevant="all"><tr class="gradeA odd">
        
          <td class=" ">1</td><td class=" sorting_1">1000
          </td><td class=" ">ivan
          </td><td class=" ">2013-12-21</td>
          <td class=" ">USD -1100.00
          </td>
		  <td class=" ">Customer</td>
		  <td class=" "><a href="account-profile.php?__account=1000#account.profile/1000" class="btn btn-primary btn-block"><i class="icon-edit icon-white"></i> Manage</a></td>
		  </tr></tbody></table><div class="row-fluid"><div class="span6"></div><div class="span6"></div></div></div>
<div class="pagination  pagination-right"><ul><li class="active"><span>1</span></li><li class="disabled"><a class="disabled">Next</a></li><li class="disabled"><a class="disabled">Last</a></li></ul></div>
 
</div>
    </div>
  
  </div>

 

    </div><!-- /container -->  
   <script src="<?php echo base_url();?>common/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>common/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>common/js/common.js"></script>
 <script type="text/javascript" language="javascript" src="<?php echo base_url();?>common/lib/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>common/lib/datatable/dt-bootstrap.js"></script>
 <script src="<?php echo base_url();?>common/lib/chosen/chosen.jquery.js" type="text/javascript"></script>
  <script type="text/javascript"> $(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true}); </script>
  
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				oTable = $('#data').dataTable({
					"bPaginate": false,
					"bInfo":false,
					 "aaSorting": [[ 1, "desc" ]]
					
					
				});
				$('#loading').css('visibility','hidden');
				$('[data-toggle="modal"]').click(function(e) {
	e.preventDefault();
	$('#loading').css('visibility','visible');
	var url = $(this).attr('href');
	if (url.indexOf('#') == 0) {
		$(url).modal('open');
	} else {
		$.get(url, function(data) {
			$('<div class="modal hide fade">' + data + '</div>').modal();
		}).success(function() {
			$('#loading').css('visibility','hidden');
			 });
	}
});
	
			} );
			$(function(){
      // bind change event to select
      $('#cfilter').bind('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });	
		
		</script>

		

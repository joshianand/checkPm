<div class="container">
<form action="bulk-email-send.php" method="post" name="bulk-email">
<div class="span12">
			
			  
	            <h4>Send Bulk Email</h4>
	          
	
				<div id="rootwizard" class="tabbable tabs-left">
                <div id="bar" class="progress progress-striped active">
					  <div class="bar" style="width: 33.33333333333333%;"></div>
					</div>
					<ul class="nav nav-tabs">
					  	<li class="active"><a href="#tab1" data-toggle="tab">Choose Contact</a></li>
						<li><a href="#tab2" data-toggle="tab">Compose Email</a></li>
						<li><a href="#tab3" data-toggle="tab">Confirm &amp; Send</a></li>
						
						
					</ul>
                    
					<div class="tab-content">
					    <div class="tab-pane active" id="tab1">
                        
					      


<select id="clgroups" multiple="multiple" name="clgroups[]" style="position: absolute; left: -9999px;">
    <option value="19">para</option></select><div id="ms-clgroups" class="ms-container"><div class="ms-selectable"><ul class="ms-list"><li class="ms-elem-selectable" id="_1_9_-selectable"><span>para</span></li></ul></div><div class="ms-selection"><ul class="ms-list"><li class="ms-elem-selection" id="_1_9_-selection" style="display: none;"><span>para</span></li></ul></div></div>
<hr>
<p><a href="#" id="select-all" class="btn btn-primary">select all</a>
<a href="#" id="deselect-all" class="btn btn-danger">deselect all</a>
<span>Select the customer group and click Next Button   →</span>

</p>


					    </div>
					    <div class="tab-pane" id="tab2">
                        <input type="text" name="subject" placeholder="email subject..." size="100" class="input-block-level">
					     <div class="redactor_box"><ul class="redactor_toolbar"><li><a href="javascript:void(null);" title="HTML" class="redactor_btn_html" tabindex="-1"></a></li><li class="redactor_separator"></li><li><a href="javascript:void(null);" title="Formatting" class="redactor_btn_formatting" tabindex="-1"></a></li><li class="redactor_separator"></li><li><a href="javascript:void(null);" title="Bold" class="redactor_btn_bold" tabindex="-1"></a></li><li><a href="javascript:void(null);" title="Italic" class="redactor_btn_italic" tabindex="-1"></a></li><li><a href="javascript:void(null);" title="Deleted" class="redactor_btn_deleted" tabindex="-1"></a></li><li class="redactor_separator"></li><li><a href="javascript:void(null);" title="• Unordered List" class="redactor_btn_unorderedlist" tabindex="-1"></a></li><li><a href="javascript:void(null);" title="1. Ordered List" class="redactor_btn_orderedlist" tabindex="-1"></a></li><li><a href="javascript:void(null);" title="&lt; Outdent" class="redactor_btn_outdent" tabindex="-1"></a></li><li><a href="javascript:void(null);" title="&gt; Indent" class="redactor_btn_indent" tabindex="-1"></a></li><li class="redactor_separator"></li><li><a href="javascript:void(null);" title="Insert Image" class="redactor_btn_image" tabindex="-1"></a></li><li><a href="javascript:void(null);" title="Insert Video" class="redactor_btn_video" tabindex="-1"></a></li><li><a href="javascript:void(null);" title="Table" class="redactor_btn_table" tabindex="-1"></a></li><li><a href="javascript:void(null);" title="Link" class="redactor_btn_link" tabindex="-1"></a></li><li class="redactor_separator"></li><li><a href="javascript:void(null);" title="Font Color" class="redactor_btn_fontcolor" tabindex="-1"></a></li><li><a href="javascript:void(null);" title="Back Color" class="redactor_btn_backcolor" tabindex="-1"></a></li><li class="redactor_separator"></li><li><a href="javascript:void(null);" title="Alignment" class="redactor_btn_alignment" tabindex="-1"></a></li><li class="redactor_separator"></li><li><a href="javascript:void(null);" title="Insert Horizontal Rule" class="redactor_btn_horizontalrule" tabindex="-1"></a></li></ul><div class="redactor_input-block-level redactor_editor" contenteditable="true" dir="ltr" style="min-height: 200px;"><p><br></p></div><textarea name="message" rows="12" class="input-block-level" id="redactor_content" style="display: none;"></textarea></div>
					    </div>
						<div class="tab-pane" id="tab3">
							<button class="btn btn-large btn-primary input-block-level" type="submit">Click Here To Continue</button>
					    </div>
						
						
						
						<ul class="pager wizard">
							<li class="previous first disabled" style="display:none;"><a href="#">First</a></li>
							<li class="previous disabled"><a href="#">← Previous</a></li>
							<li class="next last" style="display:none;"><a href="#">Last</a></li>
						  	<li class="next"><a href="#">Next  →</a></li>
						</ul>
					</div>	
				</div>			
			
 		</div>
</form>
    </div><!-- /container -->
   <script src="<?php echo base_url();?>common/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>common/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>common/js/common.js"></script>
 <script src="<?php echo base_url();?>common/js/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>common/lib/multiselect/js/jquery.multi-select.js" type="text/javascript"></script>
	<script>
	$(document).ready(function() {
    $('#rootwizard').bootstrapWizard({
        tabClass: 'nav nav-tabs',
       onTabShow: function(tab, navigation, index) {
			var $total = navigation.find('li').length;
			var $current = index+1;
			var $percent = ($current/$total) * 100;
			$('#rootwizard').find('.bar').css({width:$percent+'%'});
		},
		onNext: function(tab, navigation, index) {
           // alert('next');
        }
  });
  $('#clgroups').multiSelect();
  $('#select-all').click(function(){
  $('#clgroups').multiSelect('select_all');
  return false;
});
$('#deselect-all').click(function(){
  $('#clgroups').multiSelect('deselect_all');
  return false;
});
});
	</script>
<script src="<?php echo base_url();?>common/lib/pnp/redactor/redactor/redactor.min.js"></script>

	<script type="text/javascript">
	$(document).ready(
		function()
		{
			$('#redactor_content').redactor({
				imageUpload: 'image_upload.php',
				minHeight: 200 // pixels
			});
		}
	);
	</script> 

	
  
<div class="redactor_dropdown" style="display: none;"><a href="javascript:void(null);" class="">Paragraph</a><a href="javascript:void(null);" class="redactor_format_blockquote">Quote</a><a href="javascript:void(null);" class="redactor_format_pre">Code</a><a href="javascript:void(null);" class="redactor_format_h1">Header 1</a><a href="javascript:void(null);" class="redactor_format_h2">Header 2</a><a href="javascript:void(null);" class="redactor_format_h3">Header 3</a><a href="javascript:void(null);" class="redactor_format_h4">Header 4</a></div><div class="redactor_dropdown" style="display: none;"><a href="javascript:void(null);" class="">Insert Table</a><a class="redactor_separator_drop"></a><a href="javascript:void(null);" class="">Add Row Above</a><a href="javascript:void(null);" class="">Add Row Below</a><a href="javascript:void(null);" class="">Add Column Left</a><a href="javascript:void(null);" class="">Add Column Right</a><a class="redactor_separator_drop"></a><a href="javascript:void(null);" class="">Add Head</a><a href="javascript:void(null);" class="">Delete Head</a><a class="redactor_separator_drop"></a><a href="javascript:void(null);" class="">Delete Column</a><a href="javascript:void(null);" class="">Delete Row</a><a href="javascript:void(null);" class="">Delete Table</a></div><div class="redactor_dropdown" style="display: none;"><a href="javascript:void(null);" class="">Insert link</a><a href="javascript:void(null);" class="">Unlink</a></div><div class="redactor_dropdown" style="display: none; width: 210px;"><a rel="#ffffff" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(255, 255, 255);"></a><a rel="#000000" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(0, 0, 0);"></a><a rel="#eeece1" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(238, 236, 225);"></a><a rel="#1f497d" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(31, 73, 125);"></a><a rel="#4f81bd" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(79, 129, 189);"></a><a rel="#c0504d" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(192, 80, 77);"></a><a rel="#9bbb59" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(155, 187, 89);"></a><a rel="#8064a2" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(128, 100, 162);"></a><a rel="#4bacc6" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(75, 172, 198);"></a><a rel="#f79646" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(247, 150, 70);"></a><a rel="#ffff00" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(255, 255, 0);"></a><a rel="#f2f2f2" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(242, 242, 242);"></a><a rel="#7f7f7f" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(127, 127, 127);"></a><a rel="#ddd9c3" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(221, 217, 195);"></a><a rel="#c6d9f0" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(198, 217, 240);"></a><a rel="#dbe5f1" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(219, 229, 241);"></a><a rel="#f2dcdb" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(242, 220, 219);"></a><a rel="#ebf1dd" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(235, 241, 221);"></a><a rel="#e5e0ec" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(229, 224, 236);"></a><a rel="#dbeef3" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(219, 238, 243);"></a><a rel="#fdeada" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(253, 234, 218);"></a><a rel="#fff2ca" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(255, 242, 202);"></a><a rel="#d8d8d8" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(216, 216, 216);"></a><a rel="#595959" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(89, 89, 89);"></a><a rel="#c4bd97" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(196, 189, 151);"></a><a rel="#8db3e2" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(141, 179, 226);"></a><a rel="#b8cce4" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(184, 204, 228);"></a><a rel="#e5b9b7" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(229, 185, 183);"></a><a rel="#d7e3bc" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(215, 227, 188);"></a><a rel="#ccc1d9" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(204, 193, 217);"></a><a rel="#b7dde8" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(183, 221, 232);"></a><a rel="#fbd5b5" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(251, 213, 181);"></a><a rel="#ffe694" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(255, 230, 148);"></a><a rel="#bfbfbf" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(191, 191, 191);"></a><a rel="#3f3f3f" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(63, 63, 63);"></a><a rel="#938953" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(147, 137, 83);"></a><a rel="#548dd4" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(84, 141, 212);"></a><a rel="#95b3d7" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(149, 179, 215);"></a><a rel="#d99694" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(217, 150, 148);"></a><a rel="#c3d69b" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(195, 214, 155);"></a><a rel="#b2a2c7" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(178, 162, 199);"></a><a rel="#b7dde8" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(183, 221, 232);"></a><a rel="#fac08f" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(250, 192, 143);"></a><a rel="#f2c314" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(242, 195, 20);"></a><a rel="#a5a5a5" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(165, 165, 165);"></a><a rel="#262626" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(38, 38, 38);"></a><a rel="#494429" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(73, 68, 41);"></a><a rel="#17365d" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(23, 54, 93);"></a><a rel="#366092" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(54, 96, 146);"></a><a rel="#953734" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(149, 55, 52);"></a><a rel="#76923c" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(118, 146, 60);"></a><a rel="#5f497a" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(95, 73, 122);"></a><a rel="#92cddc" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(146, 205, 220);"></a><a rel="#e36c09" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(227, 108, 9);"></a><a rel="#c09100" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(192, 145, 0);"></a><a rel="#7f7f7f" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(127, 127, 127);"></a><a rel="#0c0c0c" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(12, 12, 12);"></a><a rel="#1d1b10" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(29, 27, 16);"></a><a rel="#0f243e" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(15, 36, 62);"></a><a rel="#244061" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(36, 64, 97);"></a><a rel="#632423" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(99, 36, 35);"></a><a rel="#4f6128" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(79, 97, 40);"></a><a rel="#3f3151" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(63, 49, 81);"></a><a rel="#31859b" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(49, 133, 155);"></a><a rel="#974806" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(151, 72, 6);"></a><a rel="#7f6000" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(127, 96, 0);"></a><a href="javascript:void(null);" class="redactor_color_none">None</a></div><div class="redactor_dropdown" style="display: none; width: 210px;"><a rel="#ffffff" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(255, 255, 255);"></a><a rel="#000000" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(0, 0, 0);"></a><a rel="#eeece1" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(238, 236, 225);"></a><a rel="#1f497d" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(31, 73, 125);"></a><a rel="#4f81bd" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(79, 129, 189);"></a><a rel="#c0504d" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(192, 80, 77);"></a><a rel="#9bbb59" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(155, 187, 89);"></a><a rel="#8064a2" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(128, 100, 162);"></a><a rel="#4bacc6" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(75, 172, 198);"></a><a rel="#f79646" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(247, 150, 70);"></a><a rel="#ffff00" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(255, 255, 0);"></a><a rel="#f2f2f2" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(242, 242, 242);"></a><a rel="#7f7f7f" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(127, 127, 127);"></a><a rel="#ddd9c3" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(221, 217, 195);"></a><a rel="#c6d9f0" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(198, 217, 240);"></a><a rel="#dbe5f1" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(219, 229, 241);"></a><a rel="#f2dcdb" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(242, 220, 219);"></a><a rel="#ebf1dd" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(235, 241, 221);"></a><a rel="#e5e0ec" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(229, 224, 236);"></a><a rel="#dbeef3" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(219, 238, 243);"></a><a rel="#fdeada" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(253, 234, 218);"></a><a rel="#fff2ca" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(255, 242, 202);"></a><a rel="#d8d8d8" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(216, 216, 216);"></a><a rel="#595959" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(89, 89, 89);"></a><a rel="#c4bd97" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(196, 189, 151);"></a><a rel="#8db3e2" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(141, 179, 226);"></a><a rel="#b8cce4" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(184, 204, 228);"></a><a rel="#e5b9b7" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(229, 185, 183);"></a><a rel="#d7e3bc" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(215, 227, 188);"></a><a rel="#ccc1d9" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(204, 193, 217);"></a><a rel="#b7dde8" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(183, 221, 232);"></a><a rel="#fbd5b5" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(251, 213, 181);"></a><a rel="#ffe694" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(255, 230, 148);"></a><a rel="#bfbfbf" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(191, 191, 191);"></a><a rel="#3f3f3f" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(63, 63, 63);"></a><a rel="#938953" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(147, 137, 83);"></a><a rel="#548dd4" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(84, 141, 212);"></a><a rel="#95b3d7" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(149, 179, 215);"></a><a rel="#d99694" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(217, 150, 148);"></a><a rel="#c3d69b" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(195, 214, 155);"></a><a rel="#b2a2c7" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(178, 162, 199);"></a><a rel="#b7dde8" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(183, 221, 232);"></a><a rel="#fac08f" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(250, 192, 143);"></a><a rel="#f2c314" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(242, 195, 20);"></a><a rel="#a5a5a5" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(165, 165, 165);"></a><a rel="#262626" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(38, 38, 38);"></a><a rel="#494429" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(73, 68, 41);"></a><a rel="#17365d" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(23, 54, 93);"></a><a rel="#366092" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(54, 96, 146);"></a><a rel="#953734" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(149, 55, 52);"></a><a rel="#76923c" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(118, 146, 60);"></a><a rel="#5f497a" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(95, 73, 122);"></a><a rel="#92cddc" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(146, 205, 220);"></a><a rel="#e36c09" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(227, 108, 9);"></a><a rel="#c09100" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(192, 145, 0);"></a><a rel="#7f7f7f" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(127, 127, 127);"></a><a rel="#0c0c0c" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(12, 12, 12);"></a><a rel="#1d1b10" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(29, 27, 16);"></a><a rel="#0f243e" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(15, 36, 62);"></a><a rel="#244061" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(36, 64, 97);"></a><a rel="#632423" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(99, 36, 35);"></a><a rel="#4f6128" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(79, 97, 40);"></a><a rel="#3f3151" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(63, 49, 81);"></a><a rel="#31859b" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(49, 133, 155);"></a><a rel="#974806" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(151, 72, 6);"></a><a rel="#7f6000" href="javascript:void(null);" class="redactor_color_link" style="background-color: rgb(127, 96, 0);"></a><a href="javascript:void(null);" class="redactor_color_none">None</a></div><div class="redactor_dropdown" style="display: none;"><a href="javascript:void(null);" class="">Align text to the left</a><a href="javascript:void(null);" class="">Center text</a><a href="javascript:void(null);" class="">Align text to the right</a><a href="javascript:void(null);" class="">Justify text</a></div></body></html>
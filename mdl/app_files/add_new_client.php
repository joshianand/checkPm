<link href="<?php echo base_url();?>common/css/adminstyle.css" rel="stylesheet">
<link href="<?php echo base_url();?>common/css/common.css" rel="stylesheet">
<div class="container">
<form class="form-horizontal" method="post" id="form1" name="form1" action="#">  
        <fieldset>  
          <legend>Add New Client  
          </legend>
 
    <div class="row-fluid">
      <div class="span6">
        
        <p>Account Name* <input name="name" type="text" class="span12" id="name"></p>
        
        <p>Company Name <input name="company" type="text" class="span12" id="company"></p>
        <p>Email <input name="email" type="text" class="span12" id="email"></p>
        <p><input name="emailnotify" type="checkbox" value="Yes" id="emailnotify"> Send Email Notification </p>
        <p>Phone <input name="phone" type="text" class="span12" id="phone"></p>
        
        <p>Choose Group<br>
 <select name="group" data-placeholder="Choose a Group..." class="chzn-select chzn-done" style="width: 250px; display: none;" tabindex="-1" id="selPZG">
          <option value=""></option> 
          <option value="19">para</option></select><div id="selPZG_chzn" class="chzn-container chzn-container-single" style="width: 250px;" title=""><a href="javascript:void(0)" class="chzn-single chzn-default" tabindex="-1"><span>Choose a Group...</span><div><b></b></div></a><div class="chzn-drop" style="left: -9000px; width: 248px; top: 25px;"><div class="chzn-search"><input type="text" autocomplete="off" tabindex="2" style="width: 213px;"></div><ul class="chzn-results"><li id="selPZG_chzn_o_1" class="active-result" style="">para</li></ul></div></div></p>
       
      </div>
      <div class="span6">
        
        <p>Address Line 1 <input name="address1" type="text" class="span12" id="address1"></p>
         <p>Address Line 2 <input name="address2" type="text" class="span12" id="address2"></p>
        <p>City <input name="city" type="text" class="span12" id="city"></p>
        <p>State <input name="state" type="text" class="span12" id="state"></p>
        <p>Postcode <input name="postcode" type="text" class="span12" id="postcode"></p>
        <p>Country<br>
 <select name="country" class="chzn-select chzn-done" id="country" style="width: 250px; display: none;" tabindex="-1" data-placeholder="Choose a Country...">
          <option value=""></option> 
	<option value="AF">Afghanistan</option>
	<option value="AX">Aland Islands</option>
	<option value="AL">Albania</option>
	<option value="DZ">Algeria</option>
	<option value="AS">American Samoa</option>
	<option value="AD">Andorra</option>
	<option value="AO">Angola</option>
	<option value="AI">Anguilla</option>
	<option value="AQ">Antarctica</option>
	<option value="AG">Antigua And Barbuda</option>
	<option value="AR">Argentina</option>
	<option value="AM">Armenia</option>
	<option value="AW">Aruba</option>
	<option value="AU">Australia</option>
	<option value="AT">Austria</option>
	<option value="AZ">Azerbaijan</option>
	<option value="BS">Bahamas</option>
	<option value="BH">Bahrain</option>
	<option value="BD">Bangladesh</option>
	<option value="BB">Barbados</option>
	<option value="BY">Belarus</option>
	<option value="BE">Belgium</option>
	<option value="BZ">Belize</option>
	<option value="BJ">Benin</option>
	<option value="BM">Bermuda</option>
	<option value="BT">Bhutan</option>
	<option value="BO">Bolivia</option>
	<option value="BA">Bosnia And Herzegovina</option>
	<option value="BW">Botswana</option>
	<option value="BV">Bouvet Island</option>
	<option value="BR">Brazil</option>
	<option value="IO">British Indian Ocean Territory</option>
	<option value="BN">Brunei Darussalam</option>
	<option value="BG">Bulgaria</option>
	<option value="BF">Burkina Faso</option>
	<option value="BI">Burundi</option>
	<option value="KH">Cambodia</option>
	<option value="CM">Cameroon</option>
	<option value="CA">Canada</option>
	<option value="CV">Cape Verde</option>
	<option value="KY">Cayman Islands</option>
	<option value="CF">Central African Republic</option>
	<option value="TD">Chad</option>
	<option value="CL">Chile</option>
	<option value="CN">China</option>
	<option value="CX">Christmas Island</option>
	<option value="CC">Cocos (Keeling) Islands</option>
	<option value="CO">Colombia</option>
	<option value="KM">Comoros</option>
	<option value="CG">Congo</option>
	<option value="CD">Congo, Democratic Republic</option>
	<option value="CK">Cook Islands</option>
	<option value="CR">Costa Rica</option>
	<option value="CI">Cote D'Ivoire</option>
	<option value="HR">Croatia</option>
	<option value="CU">Cuba</option>
	<option value="CY">Cyprus</option>
	<option value="CZ">Czech Republic</option>
	<option value="DK">Denmark</option>
	<option value="DJ">Djibouti</option>
	<option value="DM">Dominica</option>
	<option value="DO">Dominican Republic</option>
	<option value="EC">Ecuador</option>
	<option value="EG">Egypt</option>
	<option value="SV">El Salvador</option>
	<option value="GQ">Equatorial Guinea</option>
	<option value="ER">Eritrea</option>
	<option value="EE">Estonia</option>
	<option value="ET">Ethiopia</option>
	<option value="FK">Falkland Islands (Malvinas)</option>
	<option value="FO">Faroe Islands</option>
	<option value="FJ">Fiji</option>
	<option value="FI">Finland</option>
	<option value="FR">France</option>
	<option value="GF">French Guiana</option>
	<option value="PF">French Polynesia</option>
	<option value="TF">French Southern Territories</option>
	<option value="GA">Gabon</option>
	<option value="GM">Gambia</option>
	<option value="GE">Georgia</option>
	<option value="DE">Germany</option>
	<option value="GH">Ghana</option>
	<option value="GI">Gibraltar</option>
	<option value="GR">Greece</option>
	<option value="GL">Greenland</option>
	<option value="GD">Grenada</option>
	<option value="GP">Guadeloupe</option>
	<option value="GU">Guam</option>
	<option value="GT">Guatemala</option>
	<option value="GG">Guernsey</option>
	<option value="GN">Guinea</option>
	<option value="GW">Guinea-Bissau</option>
	<option value="GY">Guyana</option>
	<option value="HT">Haiti</option>
	<option value="HM">Heard Island &amp; Mcdonald Islands</option>
	<option value="VA">Holy See (Vatican City State)</option>
	<option value="HN">Honduras</option>
	<option value="HK">Hong Kong</option>
	<option value="HU">Hungary</option>
	<option value="IS">Iceland</option>
	<option value="IN">India</option>
	<option value="ID">Indonesia</option>
	<option value="IR">Iran, Islamic Republic Of</option>
	<option value="IQ">Iraq</option>
	<option value="IE">Ireland</option>
	<option value="IM">Isle Of Man</option>
	<option value="IL">Israel</option>
	<option value="IT">Italy</option>
	<option value="JM">Jamaica</option>
	<option value="JP">Japan</option>
	<option value="JE">Jersey</option>
	<option value="JO">Jordan</option>
	<option value="KZ">Kazakhstan</option>
	<option value="KE">Kenya</option>
	<option value="KI">Kiribati</option>
	<option value="KR">Korea</option>
	<option value="KW">Kuwait</option>
	<option value="KG">Kyrgyzstan</option>
	<option value="LA">Lao People's Democratic Republic</option>
	<option value="LV">Latvia</option>
	<option value="LB">Lebanon</option>
	<option value="LS">Lesotho</option>
	<option value="LR">Liberia</option>
	<option value="LY">Libyan Arab Jamahiriya</option>
	<option value="LI">Liechtenstein</option>
	<option value="LT">Lithuania</option>
	<option value="LU">Luxembourg</option>
	<option value="MO">Macao</option>
	<option value="MK">Macedonia</option>
	<option value="MG">Madagascar</option>
	<option value="MW">Malawi</option>
	<option value="MY">Malaysia</option>
	<option value="MV">Maldives</option>
	<option value="ML">Mali</option>
	<option value="MT">Malta</option>
	<option value="MH">Marshall Islands</option>
	<option value="MQ">Martinique</option>
	<option value="MR">Mauritania</option>
	<option value="MU">Mauritius</option>
	<option value="YT">Mayotte</option>
	<option value="MX">Mexico</option>
	<option value="FM">Micronesia, Federated States Of</option>
	<option value="MD">Moldova</option>
	<option value="MC">Monaco</option>
	<option value="MN">Mongolia</option>
	<option value="ME">Montenegro</option>
	<option value="MS">Montserrat</option>
	<option value="MA">Morocco</option>
	<option value="MZ">Mozambique</option>
	<option value="MM">Myanmar</option>
	<option value="NA">Namibia</option>
	<option value="NR">Nauru</option>
	<option value="NP">Nepal</option>
	<option value="NL">Netherlands</option>
	<option value="AN">Netherlands Antilles</option>
	<option value="NC">New Caledonia</option>
	<option value="NZ">New Zealand</option>
	<option value="NI">Nicaragua</option>
	<option value="NE">Niger</option>
	<option value="NG">Nigeria</option>
	<option value="NU">Niue</option>
	<option value="NF">Norfolk Island</option>
	<option value="MP">Northern Mariana Islands</option>
	<option value="NO">Norway</option>
	<option value="OM">Oman</option>
	<option value="PK">Pakistan</option>
	<option value="PW">Palau</option>
	<option value="PS">Palestinian Territory, Occupied</option>
	<option value="PA">Panama</option>
	<option value="PG">Papua New Guinea</option>
	<option value="PY">Paraguay</option>
	<option value="PE">Peru</option>
	<option value="PH">Philippines</option>
	<option value="PN">Pitcairn</option>
	<option value="PL">Poland</option>
	<option value="PT">Portugal</option>
	<option value="PR">Puerto Rico</option>
	<option value="QA">Qatar</option>
	<option value="RE">Reunion</option>
	<option value="RO">Romania</option>
	<option value="RU">Russian Federation</option>
	<option value="RW">Rwanda</option>
	<option value="BL">Saint Barthelemy</option>
	<option value="SH">Saint Helena</option>
	<option value="KN">Saint Kitts And Nevis</option>
	<option value="LC">Saint Lucia</option>
	<option value="MF">Saint Martin</option>
	<option value="PM">Saint Pierre And Miquelon</option>
	<option value="VC">Saint Vincent And Grenadines</option>
	<option value="WS">Samoa</option>
	<option value="SM">San Marino</option>
	<option value="ST">Sao Tome And Principe</option>
	<option value="SA">Saudi Arabia</option>
	<option value="SN">Senegal</option>
	<option value="RS">Serbia</option>
	<option value="SC">Seychelles</option>
	<option value="SL">Sierra Leone</option>
	<option value="SG">Singapore</option>
	<option value="SK">Slovakia</option>
	<option value="SI">Slovenia</option>
	<option value="SB">Solomon Islands</option>
	<option value="SO">Somalia</option>
	<option value="ZA">South Africa</option>
	<option value="GS">South Georgia And Sandwich Isl.</option>
	<option value="ES">Spain</option>
	<option value="LK">Sri Lanka</option>
	<option value="SD">Sudan</option>
	<option value="SR">Suriname</option>
	<option value="SJ">Svalbard And Jan Mayen</option>
	<option value="SZ">Swaziland</option>
	<option value="SE">Sweden</option>
	<option value="CH">Switzerland</option>
	<option value="SY">Syrian Arab Republic</option>
	<option value="TW">Taiwan</option>
	<option value="TJ">Tajikistan</option>
	<option value="TZ">Tanzania</option>
	<option value="TH">Thailand</option>
	<option value="TL">Timor-Leste</option>
	<option value="TG">Togo</option>
	<option value="TK">Tokelau</option>
	<option value="TO">Tonga</option>
	<option value="TT">Trinidad And Tobago</option>
	<option value="TN">Tunisia</option>
	<option value="TR">Turkey</option>
	<option value="TM">Turkmenistan</option>
	<option value="TC">Turks And Caicos Islands</option>
	<option value="TV">Tuvalu</option>
	<option value="UG">Uganda</option>
	<option value="UA">Ukraine</option>
	<option value="AE">United Arab Emirates</option>
	<option value="GB">United Kingdom</option>
	<option value="US">United States</option>
	<option value="UM">United States Outlying Islands</option>
	<option value="UY">Uruguay</option>
	<option value="UZ">Uzbekistan</option>
	<option value="VU">Vanuatu</option>
	<option value="VE">Venezuela</option>
	<option value="VN">Viet Nam</option>
	<option value="VG">Virgin Islands, British</option>
	<option value="VI">Virgin Islands, U.S.</option>
	<option value="WF">Wallis And Futuna</option>
	<option value="EH">Western Sahara</option>
	<option value="YE">Yemen</option>
	<option value="ZM">Zambia</option>
	<option value="ZW">Zimbabwe</option>
</select><div id="country_chzn" class="chzn-container chzn-container-single" style="width: 250px;" title=""><a href="javascript:void(0)" class="chzn-single chzn-default" tabindex="-1"><span>Choose a Country...</span><div><b></b></div></a><div class="chzn-drop" style="left: -9000px; width: 248px; top: 25px;"><div class="chzn-search"><input type="text" autocomplete="off" tabindex="2" style="width: 213px;"></div><ul class="chzn-results"><li id="country_chzn_o_1" class="active-result" style="">Afghanistan</li><li id="country_chzn_o_2" class="active-result" style="">Aland Islands</li><li id="country_chzn_o_3" class="active-result" style="">Albania</li><li id="country_chzn_o_4" class="active-result" style="">Algeria</li><li id="country_chzn_o_5" class="active-result" style="">American Samoa</li><li id="country_chzn_o_6" class="active-result" style="">Andorra</li><li id="country_chzn_o_7" class="active-result" style="">Angola</li><li id="country_chzn_o_8" class="active-result" style="">Anguilla</li><li id="country_chzn_o_9" class="active-result" style="">Antarctica</li><li id="country_chzn_o_10" class="active-result" style="">Antigua And Barbuda</li><li id="country_chzn_o_11" class="active-result" style="">Argentina</li><li id="country_chzn_o_12" class="active-result" style="">Armenia</li><li id="country_chzn_o_13" class="active-result" style="">Aruba</li><li id="country_chzn_o_14" class="active-result" style="">Australia</li><li id="country_chzn_o_15" class="active-result" style="">Austria</li><li id="country_chzn_o_16" class="active-result" style="">Azerbaijan</li><li id="country_chzn_o_17" class="active-result" style="">Bahamas</li><li id="country_chzn_o_18" class="active-result" style="">Bahrain</li><li id="country_chzn_o_19" class="active-result" style="">Bangladesh</li><li id="country_chzn_o_20" class="active-result" style="">Barbados</li><li id="country_chzn_o_21" class="active-result" style="">Belarus</li><li id="country_chzn_o_22" class="active-result" style="">Belgium</li><li id="country_chzn_o_23" class="active-result" style="">Belize</li><li id="country_chzn_o_24" class="active-result" style="">Benin</li><li id="country_chzn_o_25" class="active-result" style="">Bermuda</li><li id="country_chzn_o_26" class="active-result" style="">Bhutan</li><li id="country_chzn_o_27" class="active-result" style="">Bolivia</li><li id="country_chzn_o_28" class="active-result" style="">Bosnia And Herzegovina</li><li id="country_chzn_o_29" class="active-result" style="">Botswana</li><li id="country_chzn_o_30" class="active-result" style="">Bouvet Island</li><li id="country_chzn_o_31" class="active-result" style="">Brazil</li><li id="country_chzn_o_32" class="active-result" style="">British Indian Ocean Territory</li><li id="country_chzn_o_33" class="active-result" style="">Brunei Darussalam</li><li id="country_chzn_o_34" class="active-result" style="">Bulgaria</li><li id="country_chzn_o_35" class="active-result" style="">Burkina Faso</li><li id="country_chzn_o_36" class="active-result" style="">Burundi</li><li id="country_chzn_o_37" class="active-result" style="">Cambodia</li><li id="country_chzn_o_38" class="active-result" style="">Cameroon</li><li id="country_chzn_o_39" class="active-result" style="">Canada</li><li id="country_chzn_o_40" class="active-result" style="">Cape Verde</li><li id="country_chzn_o_41" class="active-result" style="">Cayman Islands</li><li id="country_chzn_o_42" class="active-result" style="">Central African Republic</li><li id="country_chzn_o_43" class="active-result" style="">Chad</li><li id="country_chzn_o_44" class="active-result" style="">Chile</li><li id="country_chzn_o_45" class="active-result" style="">China</li><li id="country_chzn_o_46" class="active-result" style="">Christmas Island</li><li id="country_chzn_o_47" class="active-result" style="">Cocos (Keeling) Islands</li><li id="country_chzn_o_48" class="active-result" style="">Colombia</li><li id="country_chzn_o_49" class="active-result" style="">Comoros</li><li id="country_chzn_o_50" class="active-result" style="">Congo</li><li id="country_chzn_o_51" class="active-result" style="">Congo, Democratic Republic</li><li id="country_chzn_o_52" class="active-result" style="">Cook Islands</li><li id="country_chzn_o_53" class="active-result" style="">Costa Rica</li><li id="country_chzn_o_54" class="active-result" style="">Cote D'Ivoire</li><li id="country_chzn_o_55" class="active-result" style="">Croatia</li><li id="country_chzn_o_56" class="active-result" style="">Cuba</li><li id="country_chzn_o_57" class="active-result" style="">Cyprus</li><li id="country_chzn_o_58" class="active-result" style="">Czech Republic</li><li id="country_chzn_o_59" class="active-result" style="">Denmark</li><li id="country_chzn_o_60" class="active-result" style="">Djibouti</li><li id="country_chzn_o_61" class="active-result" style="">Dominica</li><li id="country_chzn_o_62" class="active-result" style="">Dominican Republic</li><li id="country_chzn_o_63" class="active-result" style="">Ecuador</li><li id="country_chzn_o_64" class="active-result" style="">Egypt</li><li id="country_chzn_o_65" class="active-result" style="">El Salvador</li><li id="country_chzn_o_66" class="active-result" style="">Equatorial Guinea</li><li id="country_chzn_o_67" class="active-result" style="">Eritrea</li><li id="country_chzn_o_68" class="active-result" style="">Estonia</li><li id="country_chzn_o_69" class="active-result" style="">Ethiopia</li><li id="country_chzn_o_70" class="active-result" style="">Falkland Islands (Malvinas)</li><li id="country_chzn_o_71" class="active-result" style="">Faroe Islands</li><li id="country_chzn_o_72" class="active-result" style="">Fiji</li><li id="country_chzn_o_73" class="active-result" style="">Finland</li><li id="country_chzn_o_74" class="active-result" style="">France</li><li id="country_chzn_o_75" class="active-result" style="">French Guiana</li><li id="country_chzn_o_76" class="active-result" style="">French Polynesia</li><li id="country_chzn_o_77" class="active-result" style="">French Southern Territories</li><li id="country_chzn_o_78" class="active-result" style="">Gabon</li><li id="country_chzn_o_79" class="active-result" style="">Gambia</li><li id="country_chzn_o_80" class="active-result" style="">Georgia</li><li id="country_chzn_o_81" class="active-result" style="">Germany</li><li id="country_chzn_o_82" class="active-result" style="">Ghana</li><li id="country_chzn_o_83" class="active-result" style="">Gibraltar</li><li id="country_chzn_o_84" class="active-result" style="">Greece</li><li id="country_chzn_o_85" class="active-result" style="">Greenland</li><li id="country_chzn_o_86" class="active-result" style="">Grenada</li><li id="country_chzn_o_87" class="active-result" style="">Guadeloupe</li><li id="country_chzn_o_88" class="active-result" style="">Guam</li><li id="country_chzn_o_89" class="active-result" style="">Guatemala</li><li id="country_chzn_o_90" class="active-result" style="">Guernsey</li><li id="country_chzn_o_91" class="active-result" style="">Guinea</li><li id="country_chzn_o_92" class="active-result" style="">Guinea-Bissau</li><li id="country_chzn_o_93" class="active-result" style="">Guyana</li><li id="country_chzn_o_94" class="active-result" style="">Haiti</li><li id="country_chzn_o_95" class="active-result" style="">Heard Island &amp; Mcdonald Islands</li><li id="country_chzn_o_96" class="active-result" style="">Holy See (Vatican City State)</li><li id="country_chzn_o_97" class="active-result" style="">Honduras</li><li id="country_chzn_o_98" class="active-result" style="">Hong Kong</li><li id="country_chzn_o_99" class="active-result" style="">Hungary</li><li id="country_chzn_o_100" class="active-result" style="">Iceland</li><li id="country_chzn_o_101" class="active-result" style="">India</li><li id="country_chzn_o_102" class="active-result" style="">Indonesia</li><li id="country_chzn_o_103" class="active-result" style="">Iran, Islamic Republic Of</li><li id="country_chzn_o_104" class="active-result" style="">Iraq</li><li id="country_chzn_o_105" class="active-result" style="">Ireland</li><li id="country_chzn_o_106" class="active-result" style="">Isle Of Man</li><li id="country_chzn_o_107" class="active-result" style="">Israel</li><li id="country_chzn_o_108" class="active-result" style="">Italy</li><li id="country_chzn_o_109" class="active-result" style="">Jamaica</li><li id="country_chzn_o_110" class="active-result" style="">Japan</li><li id="country_chzn_o_111" class="active-result" style="">Jersey</li><li id="country_chzn_o_112" class="active-result" style="">Jordan</li><li id="country_chzn_o_113" class="active-result" style="">Kazakhstan</li><li id="country_chzn_o_114" class="active-result" style="">Kenya</li><li id="country_chzn_o_115" class="active-result" style="">Kiribati</li><li id="country_chzn_o_116" class="active-result" style="">Korea</li><li id="country_chzn_o_117" class="active-result" style="">Kuwait</li><li id="country_chzn_o_118" class="active-result" style="">Kyrgyzstan</li><li id="country_chzn_o_119" class="active-result" style="">Lao People's Democratic Republic</li><li id="country_chzn_o_120" class="active-result" style="">Latvia</li><li id="country_chzn_o_121" class="active-result" style="">Lebanon</li><li id="country_chzn_o_122" class="active-result" style="">Lesotho</li><li id="country_chzn_o_123" class="active-result" style="">Liberia</li><li id="country_chzn_o_124" class="active-result" style="">Libyan Arab Jamahiriya</li><li id="country_chzn_o_125" class="active-result" style="">Liechtenstein</li><li id="country_chzn_o_126" class="active-result" style="">Lithuania</li><li id="country_chzn_o_127" class="active-result" style="">Luxembourg</li><li id="country_chzn_o_128" class="active-result" style="">Macao</li><li id="country_chzn_o_129" class="active-result" style="">Macedonia</li><li id="country_chzn_o_130" class="active-result" style="">Madagascar</li><li id="country_chzn_o_131" class="active-result" style="">Malawi</li><li id="country_chzn_o_132" class="active-result" style="">Malaysia</li><li id="country_chzn_o_133" class="active-result" style="">Maldives</li><li id="country_chzn_o_134" class="active-result" style="">Mali</li><li id="country_chzn_o_135" class="active-result" style="">Malta</li><li id="country_chzn_o_136" class="active-result" style="">Marshall Islands</li><li id="country_chzn_o_137" class="active-result" style="">Martinique</li><li id="country_chzn_o_138" class="active-result" style="">Mauritania</li><li id="country_chzn_o_139" class="active-result" style="">Mauritius</li><li id="country_chzn_o_140" class="active-result" style="">Mayotte</li><li id="country_chzn_o_141" class="active-result" style="">Mexico</li><li id="country_chzn_o_142" class="active-result" style="">Micronesia, Federated States Of</li><li id="country_chzn_o_143" class="active-result" style="">Moldova</li><li id="country_chzn_o_144" class="active-result" style="">Monaco</li><li id="country_chzn_o_145" class="active-result" style="">Mongolia</li><li id="country_chzn_o_146" class="active-result" style="">Montenegro</li><li id="country_chzn_o_147" class="active-result" style="">Montserrat</li><li id="country_chzn_o_148" class="active-result" style="">Morocco</li><li id="country_chzn_o_149" class="active-result" style="">Mozambique</li><li id="country_chzn_o_150" class="active-result" style="">Myanmar</li><li id="country_chzn_o_151" class="active-result" style="">Namibia</li><li id="country_chzn_o_152" class="active-result" style="">Nauru</li><li id="country_chzn_o_153" class="active-result" style="">Nepal</li><li id="country_chzn_o_154" class="active-result" style="">Netherlands</li><li id="country_chzn_o_155" class="active-result" style="">Netherlands Antilles</li><li id="country_chzn_o_156" class="active-result" style="">New Caledonia</li><li id="country_chzn_o_157" class="active-result" style="">New Zealand</li><li id="country_chzn_o_158" class="active-result" style="">Nicaragua</li><li id="country_chzn_o_159" class="active-result" style="">Niger</li><li id="country_chzn_o_160" class="active-result" style="">Nigeria</li><li id="country_chzn_o_161" class="active-result" style="">Niue</li><li id="country_chzn_o_162" class="active-result" style="">Norfolk Island</li><li id="country_chzn_o_163" class="active-result" style="">Northern Mariana Islands</li><li id="country_chzn_o_164" class="active-result" style="">Norway</li><li id="country_chzn_o_165" class="active-result" style="">Oman</li><li id="country_chzn_o_166" class="active-result" style="">Pakistan</li><li id="country_chzn_o_167" class="active-result" style="">Palau</li><li id="country_chzn_o_168" class="active-result" style="">Palestinian Territory, Occupied</li><li id="country_chzn_o_169" class="active-result" style="">Panama</li><li id="country_chzn_o_170" class="active-result" style="">Papua New Guinea</li><li id="country_chzn_o_171" class="active-result" style="">Paraguay</li><li id="country_chzn_o_172" class="active-result" style="">Peru</li><li id="country_chzn_o_173" class="active-result" style="">Philippines</li><li id="country_chzn_o_174" class="active-result" style="">Pitcairn</li><li id="country_chzn_o_175" class="active-result" style="">Poland</li><li id="country_chzn_o_176" class="active-result" style="">Portugal</li><li id="country_chzn_o_177" class="active-result" style="">Puerto Rico</li><li id="country_chzn_o_178" class="active-result" style="">Qatar</li><li id="country_chzn_o_179" class="active-result" style="">Reunion</li><li id="country_chzn_o_180" class="active-result" style="">Romania</li><li id="country_chzn_o_181" class="active-result" style="">Russian Federation</li><li id="country_chzn_o_182" class="active-result" style="">Rwanda</li><li id="country_chzn_o_183" class="active-result" style="">Saint Barthelemy</li><li id="country_chzn_o_184" class="active-result" style="">Saint Helena</li><li id="country_chzn_o_185" class="active-result" style="">Saint Kitts And Nevis</li><li id="country_chzn_o_186" class="active-result" style="">Saint Lucia</li><li id="country_chzn_o_187" class="active-result" style="">Saint Martin</li><li id="country_chzn_o_188" class="active-result" style="">Saint Pierre And Miquelon</li><li id="country_chzn_o_189" class="active-result" style="">Saint Vincent And Grenadines</li><li id="country_chzn_o_190" class="active-result" style="">Samoa</li><li id="country_chzn_o_191" class="active-result" style="">San Marino</li><li id="country_chzn_o_192" class="active-result" style="">Sao Tome And Principe</li><li id="country_chzn_o_193" class="active-result" style="">Saudi Arabia</li><li id="country_chzn_o_194" class="active-result" style="">Senegal</li><li id="country_chzn_o_195" class="active-result" style="">Serbia</li><li id="country_chzn_o_196" class="active-result" style="">Seychelles</li><li id="country_chzn_o_197" class="active-result" style="">Sierra Leone</li><li id="country_chzn_o_198" class="active-result" style="">Singapore</li><li id="country_chzn_o_199" class="active-result" style="">Slovakia</li><li id="country_chzn_o_200" class="active-result" style="">Slovenia</li><li id="country_chzn_o_201" class="active-result" style="">Solomon Islands</li><li id="country_chzn_o_202" class="active-result" style="">Somalia</li><li id="country_chzn_o_203" class="active-result" style="">South Africa</li><li id="country_chzn_o_204" class="active-result" style="">South Georgia And Sandwich Isl.</li><li id="country_chzn_o_205" class="active-result" style="">Spain</li><li id="country_chzn_o_206" class="active-result" style="">Sri Lanka</li><li id="country_chzn_o_207" class="active-result" style="">Sudan</li><li id="country_chzn_o_208" class="active-result" style="">Suriname</li><li id="country_chzn_o_209" class="active-result" style="">Svalbard And Jan Mayen</li><li id="country_chzn_o_210" class="active-result" style="">Swaziland</li><li id="country_chzn_o_211" class="active-result" style="">Sweden</li><li id="country_chzn_o_212" class="active-result" style="">Switzerland</li><li id="country_chzn_o_213" class="active-result" style="">Syrian Arab Republic</li><li id="country_chzn_o_214" class="active-result" style="">Taiwan</li><li id="country_chzn_o_215" class="active-result" style="">Tajikistan</li><li id="country_chzn_o_216" class="active-result" style="">Tanzania</li><li id="country_chzn_o_217" class="active-result" style="">Thailand</li><li id="country_chzn_o_218" class="active-result" style="">Timor-Leste</li><li id="country_chzn_o_219" class="active-result" style="">Togo</li><li id="country_chzn_o_220" class="active-result" style="">Tokelau</li><li id="country_chzn_o_221" class="active-result" style="">Tonga</li><li id="country_chzn_o_222" class="active-result" style="">Trinidad And Tobago</li><li id="country_chzn_o_223" class="active-result" style="">Tunisia</li><li id="country_chzn_o_224" class="active-result" style="">Turkey</li><li id="country_chzn_o_225" class="active-result" style="">Turkmenistan</li><li id="country_chzn_o_226" class="active-result" style="">Turks And Caicos Islands</li><li id="country_chzn_o_227" class="active-result" style="">Tuvalu</li><li id="country_chzn_o_228" class="active-result" style="">Uganda</li><li id="country_chzn_o_229" class="active-result" style="">Ukraine</li><li id="country_chzn_o_230" class="active-result" style="">United Arab Emirates</li><li id="country_chzn_o_231" class="active-result" style="">United Kingdom</li><li id="country_chzn_o_232" class="active-result" style="">United States</li><li id="country_chzn_o_233" class="active-result" style="">United States Outlying Islands</li><li id="country_chzn_o_234" class="active-result" style="">Uruguay</li><li id="country_chzn_o_235" class="active-result" style="">Uzbekistan</li><li id="country_chzn_o_236" class="active-result" style="">Vanuatu</li><li id="country_chzn_o_237" class="active-result" style="">Venezuela</li><li id="country_chzn_o_238" class="active-result" style="">Viet Nam</li><li id="country_chzn_o_239" class="active-result" style="">Virgin Islands, British</li><li id="country_chzn_o_240" class="active-result" style="">Virgin Islands, U.S.</li><li id="country_chzn_o_241" class="active-result" style="">Wallis And Futuna</li><li id="country_chzn_o_242" class="active-result" style="">Western Sahara</li><li id="country_chzn_o_243" class="active-result" style="">Yemen</li><li id="country_chzn_o_244" class="active-result" style="">Zambia</li><li id="country_chzn_o_245" class="active-result" style="">Zimbabwe</li></ul></div></div></p>
     
      </div>
    </div>

          <div class="form-actions">  
          
          <input name="acctype" type="hidden" value="Customer">
            <button type="submit" name="submit" class="btn btn-primary">Add Client</button>
            <button class="btn" type="reset">Cancel</button>  
          </div>  
        </fieldset>  
</form>  
    </div><!-- /container -->
   <script src="<?php echo base_url();?>common/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>common/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>common/js/common.js"></script>
   <script src="<?php echo base_url();?>common/lib/chosen/chosen.jquery.js" type="text/javascript"></script>
  <script type="text/javascript"> $(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true}); </script>  

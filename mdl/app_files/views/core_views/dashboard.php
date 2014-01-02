<link rel="stylesheet" href="<?php echo base_url();?>common/css/adminstyle.css" type="text/css" />
<link rel="stylesheet" href="<?php echo site_url();?>assets/font-awesome/css/font-awesome.min.css" type="text/css" />

<div class="row-fluid">

            <div class="span6">
              <div class="widget">
                <div class="widget-header">
                  <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon=""></span> Quick Access
                  </div>
                </div>
                <div class="widget-body">
                  <a href="#" class="speed-dial-btn span3">
                     
                    <p class="no-margin">Accounts</p>
                    <p class="no-margin"><img src="<?php echo base_url();?>common/img/person-icon-64.png"> </p>

                    <div class="label label-success">9</div>
                  </a>
                  
                  <a href="#" class="speed-dial-btn span3">
                    
                    <p class="no-margin">Invoices</p>
                      <p class="no-margin"><img src="<?php echo base_url();?>common/img/invoice-icon.png"> </p>
                    <div class="label label-warning">4</div>
                  </a>
                   <a href="#" class="speed-dial-btn span3">
                    
                    <p class="no-margin">Tickets</p>
                       <p class="no-margin"><img src="<?php echo base_url();?>common/img/tickets-icon.png"> </p>
                    <div class="label label-important">1</div>
                  </a>
                  <a href="#" class="speed-dial-btn span3">
                    
                    <p class="no-margin">Enquiries</p>
                      <p class="no-margin"><img src="<?php echo base_url();?>common/img/comment-icon-64.png"> </p>
                    <div class="label label-info">0</div>
                  </a>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
    <div class="span6">
        <div class="widget">
            <div class="widget-header">
                <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon=""></span> Invoice Stats
                </div>
            </div>
            <div class="widget-body">
                <div id="piechart-placeholder" style="width: 90%; min-height: 150px; padding: 0px; position: relative;"><canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 493px; height: 150px;" width="493" height="150"></canvas><canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 493px; height: 150px;" width="493" height="150"></canvas><div class="legend"><div style="position: absolute; width: 76px; height: 66px; top: 15px; right: -30px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div><table style="position:absolute;top:15px;right:-30px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #62aeef;overflow:hidden"></div></div></td><td class="legendLabel">Paid</td></tr><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #ff4444;overflow:hidden"></div></div></td><td class="legendLabel">Unpaid</td></tr><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #dd5600;overflow:hidden"></div></div></td><td class="legendLabel">Cancelled</td></tr></tbody></table></div></div>
                <div class="hr hrdotted"></div>
                <div class="clearfix">
                    <div class="grid3"> <span class="grey"> <i class="icon-file-alt icon-2x blue"></i> &nbsp; 25% </span>
                        <h6 class="pull-right"><a href="#">Paid</a></h6>
                    </div>
                    <div class="grid3"> <span class="grey"> <i class="icon-file-alt icon-2x red"></i> &nbsp; 75.00% </span>
                        <h6 class="pull-right"><a href="#">Unpaid</a></h6>
                    </div>
                    <div class="grid3"> <span class="grey"> <i class="icon-undo icon-2x green"></i> &nbsp; 0.00% </span>
                        <h6 class="pull-right"><a href="#">Cancelled</a></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
      <div class="widget">
        <div class="widget-header">
          <div class="title">
            <span class="fs1" aria-hidden="true" data-icon=""></span> Last 5 Tickets
          </div>
        </div>
        <div class="widget-body">
          <table class="table table-striped mbzero tbl-mail">
                                                                <thead>
                                                                        <tr>
                                                                                <th class="tbl-checkbox">
                                                                                        <input type="checkbox" id="select-all"><a href="#"></a>
                                                                                </th>

                                                                                <th>Customer</th>
                                                                                <th>Subject</th>

                                                                                <th class="tbl-date">Date</th>
                                                                        </tr>
                                                                </thead>
                                                                <tbody>

<tr class="clickable">
                                                                                <td class="tbl-checkbox">
                                                                                        <input type="checkbox" name="tid[]" value="1"><a href="view-ticket.php?_xClick=1"></a>
                                                                                </td>

                                                                                <td class="tbl-lft">
                                                                                        abcd
                                                                                </td>
                                                                                <td>

                                                                                        amar computer nosto
                                                                                </td>

                                                                                <td class="tbl-date">
                                                                                        2013-12-17 06:23:03
                                                                                </td>
                                                                        </tr>


                                                                </tbody>
                                                        </table>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
<div class="row-fluid">
<div class="span4">
    <div class="widget">
      <div class="widget-header">
        <div class="title">
          <span class="fs1" aria-hidden="true" data-icon=""></span> Recent Signups
        </div>
      </div>
      <div class="widget-body">
        <div class="tab-widget">
          <ul>
             <li class="rcnt">

              <div>
                <h5><a href="account-profile.php?__account=1006#account.profile/1006">iva</a></h5>

                <small>Created On- 2013-12-17</small>
              </div>
            </li> <li class="rcnt">

              <div>
                <h5><a href="account-profile.php?__account=1005#account.profile/1005">abcd</a></h5>

                <small>Created On- 2013-12-17</small>
              </div>
            </li> <li class="rcnt">

              <div>
                <h5><a href="account-profile.php?__account=1004#account.profile/1004">far</a></h5>

                <small>Created On- 2013-12-17</small>
              </div>
            </li> <li class="rcnt">

              <div>
                <h5><a href="account-profile.php?__account=1000#account.profile/1000">Alu</a></h5>

                <small>Created On- 2013-12-17</small>
              </div>
            </li>                     




          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="span4">
    <div class="widget">
      <div class="widget-header">
        <div class="title">
          Recent Invoices
        </div>
      </div>
      <div class="widget-body">
        <div class="tab-widget">
          <ul>
             <li class="rcnt">

              <div>
                <h5><a href="invoice.php?_show=1003">Invoice# 1003 (Amount: 12000.00) <span class="label label-warning">Unpaid</span> </a></h5>

                <small>Created On- 2013-12-18</small>
              </div>
            </li> <li class="rcnt">

              <div>
                <h5><a href="invoice.php?_show=1002">Invoice# 1002 (Amount: 1500.00) <span class="label label-warning">Unpaid</span> </a></h5>

                <small>Created On- 2013-12-18</small>
              </div>
            </li> <li class="rcnt">

              <div>
                <h5><a href="invoice.php?_show=1001">Invoice# 1001 (Amount: 1200.00) <span class="label label-warning">Unpaid</span> </a></h5>

                <small>Created On- 2013-12-18</small>
              </div>
            </li> <li class="rcnt">

              <div>
                <h5><a href="invoice.php?_show=1000">Invoice# 1000 (Amount: 12.00) <span class="label label-success">Paid</span> </a></h5>

                <small>Created On- 2013-12-17</small>
              </div>
            </li>                     




          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="span4">
    <div class="widget">
      <div class="widget-header">
        <div class="title">
          Recent Orders
        </div>
      </div>
      <div class="widget-body">
        <div class="tab-widget">
          <ul>
             <li class="rcnt">

              <div>
                <h5><a href="order.php?_show=1002">Order# 7572418803 <span class="label label-important">Pending</span></a></h5>

                <small>Time- 2013-12-18 03:35:27</small>
              </div>
            </li> <li class="rcnt">

              <div>
                <h5><a href="order.php?_show=1001">Order# 9725158333 <span class="label">Cancelled</span></a></h5>

                <small>Time- 2013-12-18 03:33:54</small>
              </div>
            </li> <li class="rcnt">

              <div>
                <h5><a href="order.php?_show=1000">Order# 8180275018 <span class="label label-important">Pending</span></a></h5>

                <small>Time- 2013-12-18 03:32:11</small>
              </div>
            </li>                     




          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
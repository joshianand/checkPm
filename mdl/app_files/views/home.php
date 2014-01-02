<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Application name</title>

        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="App portal" name="description" />
        <meta content="Pronab Saha" name="author" />

        <script type="text/javascript">
            var base = '<?php echo base_url(); ?>';
        </script>

        <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap-responsive.min.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/metro.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/style.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/style_responsive.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/style_default.css" rel="stylesheet" type="text/css" id="style_color" />
	<link href="<?php echo base_url();?>assets/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
    </head>

    <body class="login">

        <div class="logo">
            COMPANY LOGO GOES HERE
        </div>

        <div class="content">
            <form id="frm_login" class="form-vertical login-form" action="javascript:;" method="POST">
                <input id="csrf_portal" type="hidden" name="csrf_portal" value="<?php echo $token; ?>"/>
                <h3 class="form-title">Login to your account</h3>
                
                <div class="alert alert-error hide">
                    <span>Enter any username and password.</span>
                </div>
                
                <div class="control-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <div class="controls">
                        <div class="input-icon left">
                            <i class="icon-user"></i>
                            <input class="m-wrap placeholder-no-fix" type="text" placeholder="Username" id="username" name="username"/>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="controls">
                        <div class="input-icon left">
                            <i class="icon-lock"></i>
                            <input class="m-wrap placeholder-no-fix" type="password" placeholder="Password" id="password" name="password"/>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn green pull-right" onclick="onLogin();">
                        Login <i class="m-icon-swapright m-icon-white"></i>
                    </button>            
                </div>
                <div class="forget-password">
                    <h4>Forgot your password ?</h4>
                    <p>
                        no worries, click <a href="javascript:;" class="" id="forget-password">here</a>
                        to reset your password.
                    </p>
                </div>
            </form>

            <form id="frm_reset_pass" class="form-vertical forget-form" action="javascript:;" method="POST">
                <h3 class="">Forget Password ?</h3>
                <p>Enter your e-mail address below to reset your password.</p>
                
                <div id="resetAlert" class="alert alert-error hide">
                    <span>Enter any username and password.</span>
                </div>
                
                <div class="control-group">
                    <div class="controls">
                        <div class="input-icon left">
                            <i class="icon-envelope"></i>
                            <input class="m-wrap placeholder-no-fix" type="text" placeholder="Email" id="email" name="email" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn">
                        <i class="m-icon-swapleft"></i> Back
                    </button>
                    <button type="submit" class="btn green pull-right" onclick="onResetPass();">
                        Submit <i class="m-icon-swapright m-icon-white"></i>
                    </button>            
                </div>
            </form>
        </div>

        <div class="copyright">
            2013 &copy; Your company name goes here.
        </div>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.10.2.min.js"></script>
        <?php $this->carabiner->display('js'); ?>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                App.initLogin();
            });
        </script>
        <script type="text/javascript" src="<?php echo base_url() ?>scripts/login.js"></script>
    </body>
</html>
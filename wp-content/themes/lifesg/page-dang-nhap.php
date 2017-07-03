<?php
/* Template Name: Login Page */
	get_header();
?>
<div id="login-page" class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="login-box">
                <div id="CustomerLoginForm">
					<?php do_action('process_login_form');?>
                    <form accept-charset="UTF-8" action="" id="customer_login" method="post" enctype="multipart/form-data" role="form">
                        <h1>Đăng Nhập</h1>
						<label for="CustomerEmail" class="label-login">Địa chỉ Email</label>
                        <input type="email" name="login[user_login]" id="CustomerEmail" placeholder="Địa Chỉ Email" class="account_input form-control " autocorrect="off" autocapitalize="off" autofocus="">
                            <label for="CustomerPassword" class="label-login">Mật khẩu</label>
                            <input type="password" value="" name="login[user_password]" id="CustomerPassword" placeholder="Mật Khẩu" class="password_input form-control ">
                        <div class="col-xs-12 col-sm-4 col-md-4">
							<p class="lost_password form-group">
                                <a href="#" id="RecoverPassword">Quên mật khẩu</a>
                            </p>
                            <button type="submit" id="SubmitLogin" name="SubmitLogin" class="btn btn-outline" style="display: inline-block;">
                                <span>
                                    <i class="fa fa-lock"></i>&nbsp;
                                    Đăng nhập                                </span>
                            </button>
							<?php wp_nonce_field( 'login-lifesg', 'add-nonce' ) ?><!-- a little security to process on submission -->
							<input name="action" type="hidden" id="action" value="login-lifesg" />
						</div>
						<?php if(!wp_is_mobile()):?>
						<div class="col-xs-12 col-sm-8 col-md-8">
						<?php endif;?>
							<p style="color: #000;margin: 0 0 10px !important;">Hoặc đăng nhập với</p>
							<a href="#" class="sc-btn sc--flat sc--facebook abcRioButton abcRioButtonLightBlue" id="loginfb" onclick="return loginfb();" style="margin-right: 30px;display: inline-block;float: left;padding: 9px 25px 9px 10px;background: #496397;border-radius: 3px;">
							  <i class="fa fa-facebook fa-lg" aria-hidden="true" style="color:#fff;"></i>
							  <span class="sc-text">
								  Facebook
							  </span>
							</a>
							<!--<div class="g-signin2" data-onsuccess="onSignIn" style="display:inline-block;">Goolge</div>-->
							<a onclick="signIn();" class="btn-google"><i class="fa fa-google-plus fa-lg" aria-hidden="true"></i> Google</a>
						<?php if(!wp_is_mobile()):?>
						</div>
						<?php endif;?>
                        
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="register-box">
                <h3>Tạo Tài Khoản</h3>
				<?php do_action('process_register_form');?>
				<form accept-charset="UTF-8" action="#" id="customer_register" method="post" enctype="multipart/form-data" role="form">
					<label for="CustomerEmail" class="label-login">Địa chỉ Email</label>
					<input type="email" name="res[email]" id="CustomerEmail" placeholder="Địa Chỉ Email" class="account_input form-control " autocorrect="off" autocapitalize="off" autofocus="">
					<label for="CustomerPassword" class="label-login">Mật khẩu</label>
					<input type="password" value="" name="res[password]" placeholder="Mật Khẩu" class="password_input form-control ">
					<label for="CustomerPassword" class="label-login">Nhập lại Mật khẩu</label>
					<input type="password" value="" name="res[re_password]" placeholder="Mật Khẩu" class="password_input form-control ">
					<button type="submit" id="SubmitLogin" name="SubmitLogin" class="btn btn-outline" style="display: inline-block;margin-top:10px;float:right;">
						<span>
							<i class="fa fa-user"></i>&nbsp;
							Tạo tài khoản
						</span>
					</button>
					<?php wp_nonce_field( 'register-lifesg', 'add-nonce' ) ?><!-- a little security to process on submission -->
					<input name="action" type="hidden" id="action" value="register-lifesg" />
				</form>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
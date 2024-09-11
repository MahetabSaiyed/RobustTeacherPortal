<?php if(count(get_included_files()) < 5) header("location:/RobustTeacherPortal/"); ?>
<section class="login">
    <div class="container">
        <h2 align="center" style="color: #c13d32;">Robust Teacher Portal</h2>
        <div class="box login-box">
            <div class="box-title">
                <h3 align="left"> Login </h3>
            </div>
            <div class="box-body">
                <form method="POST" name="frmLogin" action="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
                    <span id="err"></span>
                    <div class="form-group">
                        <label for="txt_user"> Username </label>
                        <input type="text" name="txtUser" id="txt_user" class="input-text" />
                    </div>
                    <div class="form-group">
                        <label for="txt_pwd"> Password </label>
                        <input type="password" name="txtPwd" id="txt_pwd" class="input-text" />
                    </div>
                    <div class="form-group text-right">
                        <a href="#forgot_password"> Forgot Password? </a>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="btnLogin" value="1" class="btn btn-login">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
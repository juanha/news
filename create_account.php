
<?php
include("config.inc.php");
include("dbconnect.php");
include('header.inc.php');

if ($_GET['do'] == 1) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $email=$_POST['email'];
    $gender=$_POST['optionsRadios'];
    $message='';
    $password=md5($password);
    $datetime=date("Y-m-d H:i:s");
    if($message==''){

        $sql = "insert into user(username,password,email,gender,leves,create_time) ";
        $sql .= "values('{$username}','{$password}','{$email}','{$gender}','admin','{$datetime}') ";
        if(mysql_query($sql)) {
            $message = "注册成功";
        }else {
            $message = "注册失败，DB错误";
            die(mysql_error());
        }
    }

}



?>
<!--<div class="jumbotron">-->
<!--<div class="container">-->

    <?php if ($message) { ?>

        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>提示：</strong><?php echo $message; ?>
        </div>
    <? } ?>

        <div class="col-md-12 ">
            <h1 class="margin-bottom-15">注册</h1>
<!--            <form class="form-horizontal  templatemo-container templatemo-form-list-container " role="form" action="create_account.php?do=1"-->
<!--                  method="post">-->
<!---->
<!---->
<!--                <div class="form-group">-->
<!--                    <div class="col-md-12">-->
<!--                        <div class="control-wrapper">-->
<!--                            <label for="username" class="control-label">用户名</label>-->
<!--                            <input type="text" class="form-control" id="username" name="username" placeholder="">-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!---->
<!--                <div class="form-group">-->
<!--                    <div class="col-md-12">-->
<!--                        <div class="control-wrapper">-->
<!--                            <label for="password" class="control-label">密码</label>-->
<!--                            <input type="password" class="form-control" id="password" name="password" placeholder="">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <div class="col-md-12">-->
<!--                        <div class="control-wrapper">-->
<!--                            <label for="password" class="control-label">确认密码</label>-->
<!--                            <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <div class="col-md-12">-->
<!--                        <div class="control-wrapper">-->
<!--                            <input type="submit" value="创建账号" class="btn btn-info">-->
<!--                            <a href="login.php" class="pull-right">登录</a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!---->
<!--            </form>-->
            <form class="form-horizontal templatemo-create-account templatemo-container" role="form" action="create_account.php?do=1" method="post">
                <div class="form-inner">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="username" class="control-label">邮箱</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="" required pattern="^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$"
                                   title="邮箱正确格式：xxx@xxx.xxx">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="username" class="control-label">用户名</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="" required>
                        </div>
                        <div class="col-md-6 templatemo-radio-group">
                            <label class="radio-inline">
                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="男"> 男
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="女"  checked="checked"> 女
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="password" class="control-label">密码</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="" required onchange="checkPasswords()">
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="control-label">确认密码</label>
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="" required onchange="checkPasswords()">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="submit" value="提交" class="btn btn-info">
                            <a href="login.php" class="pull-right">登录</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
<!--</div>-->
<!--</div>-->
<script>
    function checkPasswords() {
        var passl = document.getElementById("password");
        var pass2 = document.getElementById("password_confirm");
        if (passl.value != pass2.value)
            passl.setCustomValidity("两次密码必须输入一致！");
        else
            passl.setCustomValidity('');
    }

</script>
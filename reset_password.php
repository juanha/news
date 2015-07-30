
<?php
session_start();
error_reporting(0);
include("admin_check.inc.php");
include("config.inc.php");
include("dbconnect.php");
include('header.inc.php');

if($_GET["do"] == "1") {

    $password = $_POST["password"];
    $new_password = $_POST["new_password"];
    $new_password=md5($new_password);
    $username = $_SESSION["username"];

    $message = "";


    if($message == "") {

        $sql = "select * from user where username='{$username}' and leves='admin'  limit 1";
        if($res=mysql_query($sql)) {

          $row= mysql_fetch_assoc($res);
            $message=$row['username'];

            if(md5($password) == $row["password"]) {

                $sql = "update user set password='{$new_password}' where username='{$username}'";
                if (mysql_query($sql)) {
                    $message = '密码重置成功！';
                } else {
                    $message = "密码重置失败，DB错误";
                }
            }else{
                $message = "密码输入错误！请重新输入！";
//                $message=$row['password'];
            }

        }else {
            $message = "密码重置失败，DB错误";
        }
    }
}
?>
<?php if ($message) { ?>

    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>提示：</strong><?php echo $message; ?>
    </div>
<? } ?>




<div class="container">
    <div class="col-md-12">
        <h1 class="margin-bottom-15">密码重置</h1>
        <form class="form-horizontal templatemo-forgot-password-form templatemo-container" role="form" action="reset_password.php?do=1" method="post">
            <div class="form-group">
                <div class="col-md-12">
                    请输入旧密码
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <input type="password" class="form-control" id="email" name="password" placeholder="旧密码" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    请输入新密码
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="新密码" required onchange="checkPasswords()">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    请再次输入新密码
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="确认密码" required onchange="checkPasswords()">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-11">
                    <input type="submit" value="提交" class="btn btn-danger">

                </div>
                <a href="login.php">登录</a>

            </div>
        </form>
    </div>
</div>

<script>
    function checkPasswords() {
        var passl = document.getElementById("new_password");
        var pass2 = document.getElementById("password_confirm");
        if (passl.value != pass2.value)
            passl.setCustomValidity("两次密码必须输入一致！");
        else
            passl.setCustomValidity('');
    }

</script>
<?php include("footer.inc.php"); ?>
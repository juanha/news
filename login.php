
<?php
session_start();
error_reporting(0);
include("config.inc.php");
include("dbconnect.php");


if($_GET["do"]=="logout") {
    session_unset();
    header("Location: index.php");
}
if($_GET["do"]=="login") {

    $username = $_POST["username"];
    $password = $_POST["password"];


    $message = "";
    if($username == "") {
        $message .= "用名不能为空<br />";
    }
    if($password == "") {
        $message .= "密码不能为空<br />";
    }
    if($message == "") {

        $sql = "select * from user where username='{$username}' and leves='admin'  limit 1";
        if($res=mysql_query($sql)) {

            $row = mysql_fetch_array($res);

            if(md5($password) == $row["password"]) {


                header("Location: index.php?type=firstPage");
                $_SESSION["admin"]=1;
                $_SESSION["username"]=$username;
                exit;

            }else{
            $message = "用户名或密码错误";}
        }else {
            $message = "验证失败，DB错误";
        }
    }
}
?>
<?php include('header.inc.php');?>
<!--<div class="jumbotron">-->
<!--<div class="container">-->
<?php if ($message) { ?>

    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>提示：</strong><?php echo $message; ?>
    </div>
<? } ?>
<div class="col-md-12">

    <h1 class="margin-bottom-15">管理员登录</h1>

    <form class="form-horizontal templatemo-container templatemo-login-form-1 margin-bottom-30" role="form" action="login.php?do=login" method="post">
        <div class="form-group">
            <div class="col-xs-12">
                <div class="control-wrapper">
                    <label for="username" class="control-label fa-label"><i class="fa fa-user fa-medium"></i></label>
                    <input type="text" class="form-control" id="username" placeholder="Username" name="username">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="control-wrapper">
                    <label for="password" class="control-label fa-label"><i class="fa fa-lock fa-medium"></i></label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="checkbox control-wrapper">
                    <label>
                        <input type="checkbox"> 记住我
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="control-wrapper">
<!--                    <input type="submit" value="登录" class="btn btn-info">-->
                    <button type="submit" class="btn btn-small btn-info" >登录</button>
                    <a href="#" class="text-right pull-right">忘记密码?</a>
                </div>
            </div>
        </div>
        <!--            <hr>-->
        <!--            <div class="form-group">-->
        <!--                <div class="col-md-12">-->
        <!--                    <label>Login with: </label>-->
        <!--                    <div class="inline-block">-->
        <!--                        <a href="#"><i class="fa fa-facebook-square login-with"></i></a>-->
        <!--                        <a href="#"><i class="fa fa-twitter-square login-with"></i></a>-->
        <!--                        <a href="#"><i class="fa fa-google-plus-square login-with"></i></a>-->
        <!--                        <a href="#"><i class="fa fa-tumblr-square login-with"></i></a>-->
        <!--                        <a href="#"><i class="fa fa-github-square login-with"></i></a>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
    </form>
    <div class="text-center">
        <a href="create_account.php" class="templatemo-create-new">创建新账号<i class="fa fa-arrow-circle-o-right"></i></a>
    </div>
</div>
<!--</div>-->
<!--</div>-->
<?php include("footer.inc.php"); ?>
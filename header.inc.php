<!doctype html>
<html>
<head>

    <meta http-equiv="content-type" content="text/html" charset="utf-8"/>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<!--    <link href="css/bootstrap-combined.no-icons.min.css" rel="stylesheet">-->
    <!--    <link href="bootstrap.min.css" rel="stylesheet" type="text/css"/>-->
    <link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">

    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
    <link href="css/templatemo_style.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="device-wdith,initial-scale=1.0">

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="css/bootstrap.js"></script>
<!--    //图片轮播插件-->
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/unslider.js"></script>
    <script type="text/javascript" src="js/unslider.min.js"></script>
    <script type="text/javascript" src="js/unslider.min.js"></script>
<!--    //可视化编辑插件-->
<!--    <link href="css/index.css" rel="stylesheet">-->

    <link href="css/font-awesome.css" rel="stylesheet" type="text/css">
    <script src="css/bootstrap-wysiwyg.js"></script>
    <script src="external/jquery.hotkeys.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>新闻发布系统</title>
</head>
<body>
<?php
error_reporting(0);
include("dbconnect.php");
?>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        background: #444 url()
    }

    .loginBox {
        width: 420px;
        height: 230px;
        padding: 0 20px;
        border: 1px solid #fff;
        color: #000;
        margin-top: 40px;
        border-radius: 8px;
        background: white;
        box-shadow: 0 0 15px #222;
        background: -moz-linear-gradient(top, #fff, #efefef 8%);
        background: -webkit-gradient(linear, 0 0, 0 100%, from(#f6f6f6), to(#f4f4f4));
        font: 11px/1.5em 'Microsoft YaHei';
        position: absolute;
        left: 50%;
        top: 50%;
        margin-left: -210px;
        margin-top: -115px;
    }

    .loginBox h2 {
        height: 45px;
        font-size: 20px;
        font-weight: normal;
    }

    .loginBox .left {
        border-right: 1px solid #ccc;
        height: 100%;
        padding-right: 20px;
    }
</style>
<div class="container">

    <!-- Static navbar -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid ">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"> <img alt="Brand" src='/images/news.png'></a>
            </div>

            <div id="navbar" class="navbar-collapse collapse ">
                <ul class="nav nav-tabs " role="tablist">
                    <li role="presentation" <?php if ($_GET['type'] == 'firstPage') echo "class='active'"; ?>><a
                            href="index.php?type=firstPage">首页</a></li>
                    <li <?php if ($_GET['type'] == 'allCategory') echo "class='active'"; ?>><a href="index.php?type=allCategory">所有分类</a>
                    </li>


                    <?php

                    //判断当前是否为管理模式，如果是，则显示管理导航
                    if ($_SESSION["admin"] == "1") {
                        $res = mysql_query("select * from category order by order_id");
                        while ($row = mysql_fetch_array($res)) {
                            $categorys[$row["id"]] = $row["category_name"];
                        }
                        ?>

                        <li role="presentation" <?php if ($_GET['type'] == 'manageNews') echo "class='active'"; ?>><a
                                href="manage_news.php?type=manageNews">新闻管理</a></li>
                        <li  <?php if ($_GET['type'] == 'manageCategory') echo "class='active'"; ?>><a
                                href="manage_category.php?type=manageCategory">栏目管理</a></li>
                    <?php
                    } else {
                        ?>
                        <?php
                        //检索 category 表，按 order_id 排序，并在页面上显示所有栏目名


                        $res = mysql_query("select * from category order by order_id");
                        while ($row = mysql_fetch_array($res)) {
                            $categorys[$row["id"]] = $row["category_name"];
//                        echo "  <li  ><a href='list.php?category={$row['id']}'>{$row['category_name']}</a></li>";
                            echo "<li";?> <?php if ($_GET['category'] == $row['id']) echo "class='active'";
                            echo "><a href='list.php?category={$row['id']}'>{$row['category_name']}</a></li>"; ?>

                        <?php
                        }
                    } ?>

                    <?php if ($_SESSION["admin"]){ ?>

                        <ul class="nav navbar-nav navbar-right">

                            <li><a style="color: red" href="#"><? echo '你好，' . $_SESSION['username']; ?></a></li>
                            <li><a href="login.php?do=logout">注销</a></li>
                            <li  <?php if ($_GET['type'] == 'reset') echo "class='active'"; ?>><a
                                    href="reset_password.php?type=reset">重置密码</a></li>
                        </ul>
                    <?php
                    }
                    else{
                    ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="login.php">管理员登录</a></li>
                        <li><a href="create_account.php">注册</a></li>

                    </ul>
                </ul>
                <?
                }
                ?>
            </div>


        </div>

    </nav>









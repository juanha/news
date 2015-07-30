<?php


error_reporting(0);
include("dbconnect.php");

include("function.inc.php");

#如果php配置中，magic_quotes_gpc没有被设置，则执行过滤字符串。

    $form = check_form($_POST["edit"]);

    $form["reg_time"] = date("Y-m-d H:i:s");
    $form["pass"] = md5($form["pass"]);
    extract($form);

    $sql = "insert into users( name,password,sex,mail,tel,reg_time) ";
#这里{}符号是代表在字符串中引用当前环境的变量
    $sql .= " values('{$name}',";
    $sql .= " '{$pass}',";
    $sql .= " '{$sex}',";
    $sql .= " '{$mail}', ";
    $sql .= " '{$tel}', ";
    $sql .= " '{$reg_time}') ";

    $res = mysql_query($sql);
    if (!$res) {
        //die("数据库出错，请返回重试。");
        die("mysql error:".mysql_error());
    }else {

   echo("success");

}

header("Location:msg.php?m=register_success");
?>
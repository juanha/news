
<?php
session_start();
error_reporting(0);
include("admin_check.inc.php");

include("config.inc.php");
include("dbconnect.php");
include("header.inc.php");
$i = 1;
//添加栏目
if ($_GET['type'] == 'add') {
    $category_name = mysql_real_escape_string($_POST["category_name"]);
    $order_id = $_POST["order_id"];
    $datetime = date("Y-m-d H:i:s");
    $message = "";
    if ($category_name == "") {
        $message .= "栏目名不能为空<br />";
    }
    if (!is_numeric($order_id)) {
        $message .= "排序号必须为数字<br />";
    }
    if ($message == "") {

        $sql = "insert into category(category_name,order_id,pubtime) values('{$category_name}',{$order_id},'{$datetime}') ";
        if (mysql_query($sql)) {
            $message = "添加成功";
        } else {
            $message = "添加失败，DB错误";
//            die(mysql_error());
        }
    }

}
//修改栏目
if ($_GET['type'] == 'edit') {
    $category_name = mysql_real_escape_string($_POST["category_name"]);
    $order_id = $_POST["order_id"];
    $id = $_POST["id"];
    $message = "";
    if ($category_name == "") {
        $message .= "栏目名不能为空<br />";
    }
    if (!is_numeric($order_id)) {
        $message .= "排序号必须为数字<br />";
    }
    if (!is_numeric($id)) {
        $message .= "id错误<br />";
    }
    if ($message == "") {
        $sql = "update  category set category_name='{$category_name}' ,order_id={$order_id} where id={$id} ";
        if (mysql_query($sql)) {
            $message = "修改成功!";
        } else {
            $message = "修改失败，DB错误";
        }
    }

}

if ($_GET['type'] == 'del') {
    $category_id = $_GET["category_id"];
    $sql = "delete from category where id={$category_id}";
    if (mysql_query($sql)) {
        $message = "删除成功!";
    } else {
        $message = "删除失败，DB错误!";
    }
}
?>


<div class="jumbotron">
    <div class="panel panel-default " style="height: 100%">
        <div class="panel-heading">
           <h3 class="text-center">栏目信息</h3>
        </div>
        <?php if ($message) { ?>

            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <strong>提示：</strong><?php echo $message; ?>
            </div>

        <? } ?>

        <table class="table  table-striped " >
            <thead class="text-center">
            <tr>
                <th></th>
                <th>#</th>
                <th>序号</th>
                <th>排序号</th>
                <th>栏目标题</th>
                <th>添加时间</th>
                <th>编辑</th>
                <th>删除</th>
            </tr>
            </thead>

            <tbody class="list-group-item-success">
            <?php
            $sql = "select * from category order by order_id asc limit 20";
            $res = mysql_query($sql);
            while ($row = mysql_fetch_assoc($res)) {
                ?>
                <tr>

                    <td></td>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo $row['category_name']; ?></td>
                    <td><?php echo $row['pubtime']; ?></td>
                    <td>
                        <!--                        <input type="button" value="修改" onclick="location.href='category_form.php?id=-->
                        <?php //echo $row['id']; ?><!--'">|<input-->
                        <!--                            type="button" id="button" value="删除" onclick="del(-->
                        <?php //echo $row['id']; ?><!--)">-->
                        <a href="category_form.php?id=<?php echo $row['id']; ?>"><i class="fa fa-edit login-with"></i></a></td>
                    <td><a href="#" onclick="del(<?php echo $row['id']; ?>)"><i class="fa fa-cut login-with"></i></a>
                    </td>

                </tr>
            <?
            }
            ?>
<!--            <tr>-->
<!---->
<!---->
<!--                <td><a href="category_form.php?type=add" class="btn btn-small btn-info"><i class="icon-info-sign"></i>添加</a></td>-->
<!--                <td></td>-->
<!---->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--            </tr>-->
            </tbody>
        </table>

        <div class="panel panel-footer bottom-left">
            <a href="category_form.php?type=add" class="btn btn-small btn-info">添加</a>
        </div>
    </div>


</div>
<script>

    function add() {


        var category_name = $("#category_name").val();
        var order_id = $("#order_id").val();
        $.getJSON('add_category.php?category_name=' + category_name +
                '&order_id=' + order_id,
            function (data) {
                if (data.status == 1) {
                    alert("添加成功！");
                }
            });

    }

    function edit() {


        var category_name = $("#c_name").val();
        var order_id = $("#o_id").val();
        $.getJSON('edit_category.php?category_name=' + category_name +
                '&order_id=' + order_id,
            function (data) {
                if (data.status == 1) {
                    alert("修改成功！");
                }
            });

    }

    function del_check() {
        if (!confirm('<?php echo '确认要删除吗'?>')) {
            return false;
        }
        return true;
    }

    function del(id) {
        if (confirm('<?php echo '确认要删除吗'?>')) {

            location.href = 'manage_category.php?type=del&category_id=' + id;
        }


    }


</script>
<?php
include("footer.inc.php");
?>


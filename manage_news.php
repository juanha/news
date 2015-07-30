
<?php
error_reporting(0);
include("admin_check.inc.php");
include("header.inc.php");
include("dbconnect.php");

$i = 1;
//添加栏目
if ($_GET['type'] == 'add') {
    $category_name = mysql_real_escape_string($_POST["category_name"]);
    $order_id = $_POST["order_id"];
    $message = "";
    if ($category_name == "") {
        $message .= "栏目名不能为空<br />";
    }
    if (!is_numeric($order_id)) {
        $message .= "排序号必须为数字<br />";
    }
    if ($message == "") {

        $sql = "insert into category(category_name,order_id) values('{$category_name}',{$order_id}) ";
        if (mysql_query($sql)) {
            $message = "添加成功";
        } else {
            $message = "添加失败，DB错误";
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
            $message = "修改成功";
        } else {
            $message = "修改失败，DB错误";
        }
    }

}

if ($_GET['type'] == 'del') {
    $category_id = $_GET["category_id"];
    $sql = "delete from category where id={$category_id}";
    if (mysql_query($sql)) {
        $message = "删除成功";
    } else {
        $message = "删除失败，DB错误";
    }
}
?>


<?php
$pageNow = 1;
if (!empty($_GET['pageNow'])) {
    $pageNow = $_GET['pageNow'];
}
//每页大小
$pageSize = 15;
//总页数
$pageCount = 0;
//从数据取出
$sql = "select count(id) from news ";

$res = mysql_query($sql);
if ($row = mysql_fetch_row($res)) {
    //多少页

    $pageCount = ceil($row[0] / $pageSize);
}
mysql_free_result($res);


//处理前一页 后一页

if ($pageNow == 1) {
    $previous = "<a href='#'>前一页</a>";

} else {
    $pageNow2 = $pageNow - 1;
    $previous = "<a href='manage_news.php?pageNow={$pageNow2}'>前一页</a> ";
}

if ($pageNow == $pageCount) {
    $next = "<a href='#'>后一页</a>";
} else {
    $pageNow1 = $pageNow + 1;

    $next = "<a href='manage_news.php?pageNow={$pageNow1}'>后一页</a> ";
}


$sql = "select * from news order by pubtime DESC ";
$sql .= "limit " . ($pageNow - 1) * $pageSize . ",$pageSize";


$res1 = mysql_query($sql);

?>
<div class="jumbotron">
    <div class="panel panel-default" style="height: 100%">
        <div class="panel-heading ">
            <h3 class="text-center"> 新闻览表</h3>
        </div>
        <?php if ($message) { ?>

            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <strong>提示：</strong><?php echo $message; ?>
            </div>
        <? } ?>
        <table class="table  table-striped row-fluid" >
            <thead>
            <tr>
                <th>#</th>
                <th>序号</th>
                <th>标题</th>
                <th>发布人</th>
                <th>发布时间</th>
                <th>栏目</th>
                <th>查看</th>
            </tr>
            </thead>
            <tbody class="list-group-item-success">
            <?php
            //            $sql = "select * from news order by pubtime DESC limit 15";
            //            $res = mysql_query($sql);
            while ($row = mysql_fetch_assoc($res1)) {

                $sql = "select category_name from category where id={$row['category_id']}";
                $res2 = mysql_query($sql);
                $c = mysql_fetch_row($res2);
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['sender']; ?></td>
                    <td><?php echo $row['pubtime']; ?></td>
                    <td><?php echo $c[0]; ?></td>

                    <td><a href="display.php?id=<?php echo $row['id']; ?>" class="btn btn-info"><i class="fa fa-arrow-circle-right"></i></a>
                    </td>
                </tr>
            <?
            }
            ?>
            </tbody>
        </table>

        <div class="pull-right">


            <div class="pagination">

                <ul class="pager">

                    <li class="previous"><?php echo($previous); ?></li>
                    <?php
                    //处理整体翻页
                    $pageBlock = 10; //整体翻页数
                    $start = floor(($pageNow - 1) / 10) * $pageBlock + 1;
                    $index = $start;
                    //处理整体前翻页

                    if ($pageNow >= 1 & $pageNow <= $pageBlock) {
                        $preblock = "<a href='#'><<<</a>";

                    } else {
                        $start1 = $start - 1;

                        $preblock = "<a href='manage_news.php?pageNow=$start1}'><<<</a> ";
                    }
                    ?>
                    <li>
                        <?php echo($preblock); ?></li>

                    <?php for (; $start < $index + $pageBlock; $start++) { ?>
                        <?php
                        if ($start <= $pageCount) {
                            ?>

                            <li <? if ($pageNow == $start) echo "class='active'"; ?>>
                                <a href="manage_news.php?pageNow=<?php echo($start); ?>"><?php echo($start); ?></a>
                            </li>
                        <?php
                        }
                    }

                    //处理整体后翻页
                    $temp = fmod($pageCount, $pageBlock) - 1;

                    if ($pageNow + $temp >= $pageCount) {

                        $nextBlock = "<a href='#'>>>></a>";
                    } else {

                        $nextBlock = "<a href='manage_news.php?pageNow=$start'>>>></a> ";
                    }
                    ?>

                    <li>
                        <?php echo($nextBlock); ?></li>

                    <li class="next"><?php echo($next); ?></li>

                </ul>

            </div>
        </div>

        <div class="panel-footer">
            <a href="admin_addnews.php" class="btn btn-small btn-info">添加</a>
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


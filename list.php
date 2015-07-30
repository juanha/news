
<?php
session_start();
include("config.inc.php");
include("dbconnect.php");
$id = $_GET["category"];
if (!is_numeric($id) && $id != "") die("id错误");
if ($id != "") {
    $res = mysql_query("select * from category where id={$id}");
    $row = mysql_fetch_array($res);
    $category_name = $row["category_name"];
} else {
    $category_name = "所有类别";
}

//引入顶部导航页面
include("header.inc.php");
?>
<?php //echo $category_name; ?>

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
    $sql = "select count(id) from news where category_id={$id}";

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
        $previous = "<a href='list.php?category={$id}&pageNow={$pageNow2}'>前一页</a> ";
    }

    if ($pageNow == $pageCount) {
        $next = "<a href='#'>后一页</a>";
    } else {
        $pageNow1 = $pageNow + 1;

        $next = "<a href='list.php?category={$id}&pageNow={$pageNow1}'>后一页</a> ";
    }


    $sql = "select id,title ,pubtime from news where category_id={$id} ";
    $sql .= "limit " . ($pageNow - 1) * $pageSize . ",$pageSize";


    $res1 = mysql_query($sql);

    ?>

    <div class="panel panel-default" style="height: 100%">
        <div class="panel-heading">
            <?php echo $category_name; ?>
        </div>
        <?php while ($row = mysql_fetch_array($res1)) {
            ?>
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="pull-left"><?php echo($row['id']); ?></span>
                    <a href="display.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
                    <span class="pull-right"><?php echo($row['pubtime']); ?></span>
                </li>
            </ul>
        <?php
        }
        ?>
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

                        $preblock = "<a href='list.php?category=$id&pageNow=$start1}'><<<</a> ";
                    }
                    ?>
                    <li>
                        <?php echo($preblock); ?></li>

                    <?php for (; $start < $index + $pageBlock; $start++) { ?>
                        <?php
                        if ($start <= $pageCount) {
                            ?>

                            <li <? if ($pageNow == $start) echo "class='active'"; ?>>
                                <a href="list.php?category=<?php echo($id); ?>&pageNow=<?php echo($start); ?>"><?php echo($start); ?></a>
                            </li>
                        <?php
                        }
                    }

                    //处理整体后翻页
                    $temp = fmod($pageCount, $pageBlock) - 1;

                    if ($pageNow + $temp >= $pageCount) {

                        $nextBlock = "<a href='#'>>>></a>";
                    } else {

                        $nextBlock = "<a href='list.php?category=$id&pageNow=$start'>>>></a> ";
                    }
                    ?>

                    <li>
                        <?php echo($nextBlock); ?></li>

                    <li class="next"><?php echo($next); ?></li>

                </ul>

            </div>

        </div>
    </div>







<?php include("footer.inc.php"); ?>


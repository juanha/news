<?php
session_start();
include("config.inc.php");
include("dbconnect.php");
$id = $_GET["id"];
if (!is_numeric($id)) die("id错误");
$res = mysql_query("select * from news where id={$id}");
$row = mysql_fetch_array($res);
$title = $row["title"];
$content = $row["content"];
$pubtime = $row["pubtime"];
$sender = $row["sender"];
include("header.inc.php");
?>
    <script language="javascript">
        function doDel(title, id, ref) {
            ref = '<?php echo $_SERVER['HTTP_REFERER']; ?>';
            if (confirm('你确定要删除新闻\n-------------------------\n' + title + '\n-------------------------'))
                location.href = 'admin_editnews.php?del=' + id + '&ref=' + ref;
        }
    </script>
<div class="jumbotron">
    <div class="panel panel-default " >
        <div class="panel-heading ">
            <span class="label label-default">新闻标题</span>

            <div class="list-group text-center">
                <li class="list-group-item list-group-item-info"><?php echo $title; ?></li>
            </div>
            <span class="label label-default">新闻内容</span>

            <div class=" panel panel-primary">
                <div class="panel-body">
<!--                    <textarea class="input-xxlarge center-block input-block-level v" rows="24">--><?php //echo $content; ?><!--</textarea>-->
                    <?php echo $content;?>
                </div>
            </div>

                <div class="pull-left">
                    <span class="label label-default">发布者：<?php echo $sender; ?></span>
                    <span class="label label-default">发布时间：<?php echo $pubtime; ?></span>
                </div>
                <?php if ($_SESSION["admin"]) { ?>
                    <div class="pull-right">
                        <span> <button type="submit" class="btn btn-small btn-info"
                                       onclick="location.href='admin_editnews.php?id=<?php echo $id; ?>';">编辑
                            </button></span>
                        <span> <button type="submit" class="btn btn-small btn-info" onclick="doDel('<?php echo $title; ?>','<?php echo $id; ?>');">
                                删除
                            </button></span>
                    </div>
                <?php } ?>

        </div>

    </div>
</div>

<?php include("footer.inc.php"); ?>
<div class="jumbotron">

<?php
$idx=1;//设置一个循环次数的标识
//循环从数据库中检索到的栏目信息
foreach($categorys as $id=>$category_name) {
    ?>

<!--   <span class="pull-right"><a href="list.php?category=--><?// echo $id;?><!--">更多内容</a></span>-->

        <div class="panel panel-default">

            <div class="panel-heading"><?php echo $category_name; ?><span class="pull-right"><a href="list.php?category=<? echo $id;?>">更多内容</a></span></div>
<!--            <div class="panel-heading">-->
<!--                --><?php //echo $category_name; ?>
<!--            </div>-->
            <?php
            //根据当前循环中的category_id值(栏目编号)，检索 news 数据表，并取得最新的5条记录
            mysql_query("set names utf8");
            $sql = "select id,title,pubtime from news where category_id={$id} order by pubtime desc limit 3";
            $res = mysql_query($sql);
            while($row = mysql_fetch_array($res)) {


//                //如果当前是管理模式，则设置编辑链接
//                if($_SESSION["admin"]) {
//                    $edit_link = '<td width="50" align="right">
//			[<a href="admin_editnews.php?id='.$row['id'].'">编辑</a>]</td>';
//                }
                ?>

                <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item"><a href="display.php?id=<?php echo $row['id']; ?>" ><?php echo $row['title']; ?></a>
                        <span class="pull-right" ><?php echo ($row['pubtime']); ?></span> </li>
                </ul>
            <?php
            }
            ?>
        </div>

    <?php
    //每循环3次，另起一个<TR>标签，在表格中增加一行。

    $idx++;
}
?>
</div>




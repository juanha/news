
<?php
error_reporting(0);
include("admin_check.inc.php");
include("header.inc.php");
include("dbconnect.php");

$type=$_GET['type'];


if(is_numeric($_GET["id"])) {
    $id = $_GET["id"];
    $res = mysql_query("select * from category where id={$id}");
    $row = mysql_fetch_array($res);
    $category_name = $row["category_name"];
    $order_id = $row["order_id"];
    $id = $row["id"];
}


?>
<div class="jumbotron">
<div class="container ">
    <h2 class="margin-bottom-15 pull-left"><?php if($type=='add') echo '添加栏目';else  echo '修改栏目'; ?></h2><br><br><br>
    <div class="col-md-6">
        <form class="form-horizontal templatemo-create-account templatemo-container" role="form" action="manage_category.php?type=<?php if($type=='add') echo 'add';else  echo 'edit'; ?>" method="post">
            <div class="form-inner">

                <div class="form-group">
                    <div class="col-md-12">
                        <label for="category_name" class="control-label">栏目标题</label>
                        <input type="text" class="form-control" name="category_name" id="category_name" value="<?php if($type!='add') echo $category_name;?>"  required>
                    </div>
                </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="order_id" class="control-label">排序号</label>
                            <input type="text"  class="form-control" name="order_id" id="order_id"  value="<?php if($type!='add') echo $order_id;?>" required pattern="^\d+" title="例:5" >
                        </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="submit" value="确定" class="btn btn-info">
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
            </div>
        </form>
    </div>
</div>



</div>
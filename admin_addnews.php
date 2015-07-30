<!--//字体显示 不知道放头部不可以 为什么要放在这才有效-->
<link href="css/index.css" rel="stylesheet">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>




<?php
error_reporting(0);
include("admin_check.inc.php");
include("config.inc.php");
include("dbconnect.php");
if ($_GET["ok"] == "1") $message = "操作成功";
if ($_GET["dosubmit"] == "1") {
    $title = mysql_real_escape_string($_POST["title"]);
    $content = mysql_real_escape_string($_POST["content"]);
    $category_id = $_POST["category_id"];
    $datetime = date("Y-m-d H:i:s");
    $sender = $_SESSION["username"];
    $message = "";
    if ($title == "") {
        $message .= "新闻标题不能为空<br />";
    }
    if ($content == "") {
        $message .= "新闻内容不能为空<br />";
    }
    if (!is_numeric($category_id)) {
        $message .= "栏目错误<br />";
    }
    if ($message == "") {
        $sql = "insert into news(title,content,sender,pubtime,category_id) ";
        $sql .= "values('{$title}','{$content}','{$sender}','{$datetime}',{$category_id}) ";
        if (mysql_query($sql)) {
            $message = "添加完成";
            $id = mysql_insert_id();
            header("Location:manage_news.php");
        } else {
            $message = "添加失败，DB错误";
        }
    }

}


?>
<?php include("header.inc.php"); ?>

<div class="jumbotron">
    <h2 class="page-header">添加新闻</h2>
    <?php if ($message) { ?>

        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>提示：</strong><?php echo $message; ?>
        </div>
    <? } ?>
    <form action="admin_addnews.php?dosubmit=1" method="post" class="form-horizontal" >
        <fieldset>
            <div class="form-group">

                <div class="col-md-12">
                    <label class="control-label" for="title">新闻标题：</label>
                    <input type="text" id="title" class="form-control" name="title" value="<?php echo $title; ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <label class="control-label" for="category_id"">新闻栏目：</label>
                    <select id="somewhere"  name="category_id">
                        <?php
                        $res = mysql_query("select * from category order by order_id");
                        while($row = mysql_fetch_array($res)) {
                            if($category_id==$row["id"]) $default  = " selected='selected' ";
                            echo "<option value='{$row['id']}' {$default}>{$row['category_name']}</option>";
                            $default = "";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label" for="content">新闻内容：</label>


                    <div class=" panel panel-primary">
                        <!--                            <div class="panel-body ">-->
                        <!--                                <textarea class="input-xxlarge center-block input-block-level v" rows="20" name="content">--><?php //echo $content; ?><!--</textarea>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <div class="hero-unit" style="padding-top: 10px">
                            <div id="alerts"></div>
                            <div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor">
                                <div class="btn-group">
                                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="icon-font"></i><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="icon-text-height"></i><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
                                        <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
                                        <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="icon-bold"></i></a>
                                    <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="icon-italic"></i></a>
                                    <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="icon-strikethrough"></i></a>
                                    <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="icon-underline"></i></a>
                                </div>
                                <div class="btn-group">
                                    <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="icon-list-ul"></i></a>
                                    <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="icon-list-ol"></i></a>
                                    <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="icon-indent-left"></i></a>
                                    <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="icon-indent-right"></i></a>
                                </div>
                                <div class="btn-group">
                                    <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="icon-align-left"></i></a>
                                    <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="icon-align-center"></i></a>
                                    <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="icon-align-right"></i></a>
                                    <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="icon-align-justify"></i></a>
                                </div>
                                <div class="btn-group">
                                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="icon-link"></i></a>
                                    <div class="dropdown-menu input-append">
                                        <input class="span2" placeholder="URL" type="text" data-edit="createLink"/>
                                        <button class="btn" type="button">Add</button>
                                    </div>
                                    <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="icon-cut"></i></a>

                                </div>

                                <div class="btn-group">
                                    <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="icon-picture"></i></a>
                                    <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
                                </div>
                                <div class="btn-group">
                                    <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="icon-undo"></i></a>
                                    <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="icon-repeat"></i></a>
                                </div>
                                <input type="text" data-edit="inserttext"   id="voiceBtn" x-webkit-speech="">
                            </div>

                            <div id="editor" >

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" id="content" name="content" >
        </fieldset>
        <div class="pull-right">

            <button type="submit" class="btn btn-small btn-info" onclick="getcontent()">添加</button>
        </div>
    </form>
</div>
<script>
    $(function () {
        function initToolbarBootstrapBindings() {
            var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
                    'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
                    'Times New Roman', 'Verdana'],
                fontTarget = $('[title=Font]').siblings('.dropdown-menu');
            $.each(fonts, function (idx, fontName) {
                fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
            });
            $('a[title]').tooltip({container: 'body'});
            $('.dropdown-menu input').click(function () {
                return false;
            })
                .change(function () {
                    $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
                })
                .keydown('esc', function () {
                    this.value = '';
                    $(this).change();
                });

            $('[data-role=magic-overlay]').each(function () {
                var overlay = $(this), target = $(overlay.data('target'));
                overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
            });
            if ("onwebkitspeechchange"  in document.createElement("input")) {
                var editorOffset = $('#editor').offset();
                $('#voiceBtn').css('position', 'absolute').offset({top: editorOffset.top, left: editorOffset.left + $('#editor').innerWidth() - 35});
            } else {
                $('#voiceBtn').hide();
            }
        };
        function showErrorAlert(reason, detail) {
            var msg = '';
            if (reason === 'unsupported-file-type') {
                msg = "Unsupported format " + detail;
            }
            else {
                console.log("error uploading file", reason, detail);
            }
            $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
        };
        initToolbarBootstrapBindings();
        $('#editor').wysiwyg({ fileUploadError: showErrorAlert});
        window.prettyPrint && prettyPrint();
    });

    function getcontent() {
        $("#content").val($("#editor").html())
    }
</script>
<?php include("footer.inc.php"); ?>
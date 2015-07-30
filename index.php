<?php
header('Content-type: text/html; charset=utf-8');
session_start();
error_reporting(0);
include("config.inc.php");
include("dbconnect.php");
include("header.inc.php");
$type=empty($_GET['type'])? 'firstPage' :$_GET['type'];
if($type=='allCategory') {
    include("content.php");
}else if($type=='firstPage'){?>
<!--      <div class="jumbotron">-->
<!--        <h1 class="text-center">欢迎来到新闻中心</h1>-->
<!--        <br>-->
<!--          <table class="table">-->
<!--       <tr> <td><a href="#" class="thumbnail">-->
<!--            <img src="/images/news.jpg"  alt="新闻" />-->
<!--        </a></td>-->
<!--           </tr>-->
<!--          </table>-->
<!--        <p><a class="btn btn-small btn-info" href="index.php?type=allCategory" role="button">进入</a></p>-->
<!--    </div>-->

    <div class="banner">

        <ul  >
            <li style="background-image: url('images/1.jpg');">
                <div class="inner">
                    <h1>英国迎来圣诞节“超级星期六” 消费者血拼购物</h1>
                    <p>与11月感恩节隔天的低价折扣日“黑色星期五”一样..</p>

                    <a class="btn" href="display.php?id=533">查看</a>
                </div>

            </li>

            <li style="background-image: url('images/2.jpg');">
                <div class="inner">
                    <h1>青岛居民楼发生爆炸 屋顶被掀有人受伤</h1>
                    <p>青岛上海路和上海支路交界处一栋二层居民楼发生爆炸..</p>

                    <a class="btn" href="display.php?id=532">查看</a>
                </div>
            </li>

            <li style="background-image: url('images/3.jpg');">
                <div class="inner">
                    <h1>范冰冰：女王蜕变 戏如人生</h1>
                    <p> “范爷”的名号一直在贵圈都很响亮..</p>

                    <a class="btn" href="display.php?id=530">查看</a>
                </div>
            </li>

            <li style="background-image: url('images/4.jpg');">
                <div class="inner">
                    <h1>香港举行万人冬至盆菜宴</h1>
                    <p>香港金银业贸易场在葵涌运动场举行“万人冬至盆菜宴”..</p>

                    <a class="btn" href="display.php?id=531">查看</a>
                </div>
            </li>
        </ul>
    </div>

    <div class="features">
        <ul class="wrap">
            <li class="browser">
                <b><a href="display.php?id=530">范冰冰：女王蜕变 戏如人生</a></b>
                <p>腾讯娱乐专稿（文/姜宇佳 摄影/ISSAC 制作/小涵）敢于放言自己就是豪门，敢于承包国内外红毯，“范爷”的名号一直在贵圈都很响亮。只是回到演员路..</p>
            </li>

            <li class="keyboard">
                <b><a href="display.php?id=531">香港举行万人冬至盆菜宴</a></b>
                <p>2014年12月21日，香港金银业贸易场在葵涌运动场举行“万人冬至盆菜宴”，为区内低收入家庭、少数族裔人士安排“冬至团年饭”。中新社 谭达明 摄</p>
            </li>

            <li class="height">
                <b><a href="display.php?id=532">青岛居民楼发生爆炸 屋顶被掀有人受伤</a></b>
                <p>2014年12月21日，山东青岛，晚上8时20分许，青岛上海路和上海支路交界处一栋二层居民楼发生爆炸，两面墙被炸塌，一人被埋，三人受伤..</p>
            </li>

            <li class="responsive">
                <b><a href="display.php?id=533">英国迎来圣诞节“超级星期六” 消费者血拼购物</a></b>
                <p>Y当地时间2014年12月20日，英国，“超级星期六”到来，各地消费者们血拼购物。 　　与11月感恩节隔天的低价折扣日“黑色星期五”一样..</p>
            </li>
        </ul>
    </div>






    <script>
        if(window.chrome) {
            $('.banner li').css('background-size', '100% 100%');
        }

        $('.banner').unslider({
            arrows: true,
            fluid: true,
            dots: true
        });

        //  Find any element starting with a # in the URL
        //  And listen to any click events it fires
        $('a[href^="#"]').click(function() {
            //  Find the target element
            var target = $($(this).attr('href'));

            //  And get its position
            var pos = target.offset(); // fallback to scrolling to top || {left: 0, top: 0};

            //  jQuery will return false if there's no element
            //  and your code will throw errors if it tries to do .offset().left;
            if(pos) {
                //  Scroll the page
                $('html, body').animate({
                    scrollTop: pos.top,
                    scrollLeft: pos.left
                }, 1000);
            }

            //  Don't let them visit the url, we'll scroll you there
            return false;
        });

        var GoSquared = {acct: 'GSN-396664-U'};
    </script>

<?php }





	function substrgb($in,$num){
        $pos=0;
        $out="";
        while($c=substr($in,$pos,1)){
            if($c=="\n") break;
            if(ord($c)>128){
                $out.=$c;
                $pos++;
                $c=substr($in,$pos,1);
                $out.=$c;
            }else{
                $out.=$c;
            }
            $pos++;
            if($pos>=$num) break;
        }
        if($out!=$in) $out = $out . "...";
        return $out;
    }
?>


<?php include("footer.inc.php"); ?>



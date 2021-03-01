<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"D:\phpstudy_pro\WWW\etcp\public/../application/index\view\index\index.html";i:1614514376;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" media="(device-height: 568px)">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>车牌号码查询</title>

    <link type="text/css" rel="stylesheet" href="/assets/css/etcp.css" />
    <script src="https://www.jq22.com/jquery/jquery-1.10.2.js"></script>
    <style>
        .car_input{width:500px; margin:100px auto;}
    </style>

</head>
<body>


<div class="car_input">
    <ul class="clearfix ul_input">
        <li id="cp1" class="input_zim" data-sort= "1"><span id="cp1_span"></span></li>
        <li id="cp2" data-sort="2"><span id="cp2_span"></span></li>
        <li id="cp3" data-sort="3"><span id="cp3_span"></span></li>
        <li id="cp4" data-sort="4"><span id="cp4_span"></span></li>
        <li id="cp5" data-sort="5"><span id="cp5_span"></span></li>
        <li id="cp6" data-sort="6"><span id="cp6_span"></span></li>
        <li id="cp7" data-sort="7"><span id="cp7_span"></span></li>
        <li id="cp8" data-sort="8" style="display:none;"><span id="cp8_span"></span></li>
        <li class="xinneng"><span><img src="/assets/img/xinweng.png" width="35rpx" height="35rpx"></span></li>
    </ul>
    <div class="buttons">
        <button id="submit">查询</button>
    </div>
</div>


<div class="table" style="display:none;">
    <table border="0" cellspacing="0" id="test">
        <tr>
            <th>牌</th>
            <th>场</th>
            <th>时间</th>
        </tr>
        <tr>
            <td>11111</td>
            <td>22222</td>
            <td>33333</td>
        </tr>
    </table>
</div>

<script src="/assets/libs/etcp/slide.js"></script>

<script src="/assets/libs/etcp/layui/layui.js"></script>
<script>
    //一般直接写在一个js文件中
    layui.use(['layer', 'form'], function(){

        var $ = layui.jquery
            ,layer = layui.layer
            ,form = layui.form;

        $('.car_input li').on('click', function () {
            document.activeElement.blur();  // 阻止弹出系统软键盘
            var _cliss = $(this).attr("class");
            var _sort = $(this).data("sort");

            $(this).addClass("input_zim").siblings().removeClass("input_zim");

            if(_sort == 1){
                $('body').keyboard({
                    defaults:'symbol',    //键盘显示类型   English 字母  number 数字  symbol 符号
                    inputClass:_cliss,        //输入框Class
                });
            }else{
                $('body').keyboard({
                    defaults:'English',    //键盘显示类型   English 字母  number 数字  symbol 符号
                    inputClass:_cliss,        //输入框Class
                });
            }
        });

        $(document).on("click", '#keyboard .keyContent li', function(event){

            $(".input_zim span").html($(this).text());
            var _sort = $(".input_zim").data("sort") + 1;
            if(_sort == 2){
                $('body').keyboard({
                    defaults:'English',    //键盘显示类型   English 字母  number 数字  symbol 符号
                });
            }
            $("#cp"+_sort).addClass("input_zim").siblings().removeClass("input_zim");
        });

        $(document).on("click", '.del', function(event){
            $(".input_zim span").text('');
            var _sort = $(".input_zim").data("sort") - 1;
            $("#cp"+_sort).addClass("input_zim").siblings().removeClass("input_zim");
        });

        $(document).on("click", '.xinneng', function(event){
            $(".xinneng").remove();
            $("#cp8").show();
        });


        $(document).on("click", '#submit', function(event){
            var cp1 = $("#cp1_span").text();
            var cp2 = $("#cp2_span").text();
            var cp3 = $("#cp3_span").text();
            var cp4 = $("#cp4_span").text();
            var cp5 = $("#cp5_span").text();
            var cp6 = $("#cp6_span").text();
            var cp7 = $("#cp7_span").text();
            var cp8 = $("#cp8_span").text();

            if(!cp1 || !cp2 || !cp3 || !cp4 || !cp5 || !cp6 || !cp7){
                layer.open({
                    type: 1
                    ,offset: 'auto' //具体配置参考：http://www.layui.com/doc/modules/layer.html#offset
                    ,id: 'layerDemo'+'auto' //防止重复弹出
                    ,content: '<div style="padding: 20px 100px;">请输入正确得车牌号</div>'
                    ,btn: '关闭'
                    ,btnAlign: 'c' //按钮居中
                    ,shade: 0 //不显示遮罩
                    ,yes: function(){
                        layer.closeAll();
                    }
                });
            }

            var carNumber = cp1+cp2+cp3+cp4+cp5+cp6+cp7+cp8;

            var url = location.protocol + '//' + location.host + location.pathname + location.search;

            $.get(url,{'carNumber':carNumber},function(result){
                layer.open({
                    type: 1
                    ,offset: 'auto' //具体配置参考：http://www.layui.com/doc/modules/layer.html#offset
                    ,id: 'layerDemo'+'auto' //防止重复弹出
                    ,content: '<div style="padding: 20px 100px;">'+ result.msg +'</div>'
                    ,btn: '关闭'
                    ,btnAlign: 'c' //按钮居中
                    ,shade: 0 //不显示遮罩
                    ,yes: function(){
                        layer.closeAll();
                    }
                });
            });
        });
    });
</script>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX+CURL 快递查询功能</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/toastr.min.css">
    <style>
        body {
            font: 14px/1.5 '微软雅黑';
            /*margin:200px auto;*/
            vertical-align: middle;
            height: 100%;
            background: url('images/flower.jpg');

        }
        #myform {
            max-width: 800px;min-width: 400px;min-height:200px;
            margin:200px auto;
            background-color: rgba(255,255,255,0.5);
            /*opacity:0.5;*/
        }
        li {
            list-style: none;
            color: blue;
        }
        #result {
            margin-top: 15px;
        } 
    </style>
</head>
<body>
    <div class="row" id="myform">
        <div class="row col-md-12 content">
            <center>
                <form class="form-inline" style="margin-top: 35px;">
                    <div class="form-group">
                        <label for="num">快递单号</label>
                        <input type="email" class="form-control" id="num" placeholder="Email" minlength="6" maxlength="20">
                    </div>
                    <input type="button" id="search" class="btn btn-primary" value="查询">
                </form>
            </center>
            <div id="result" style="margin-left: 10px;"></div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="layer/layer.js"></script>
    <script>
        $("#search").click(function() {
            var data = {
                num: $("#num").val()
            }
            $("#result").empty();
            if ( $("#num").val().length == 0 ) {
                layer.alert('不能为空', {icon: 5});
            } else if(!(/^\d{6,20}$/.test($("#num").val()) ) ) {
                layer.alert('至少六位数字', {icon: 5});
            } else{
                layer.msg('加载中', {
                  icon: 16
                  ,shade: 0.01,
                  time: 1000
                });
                $.ajax({
                    url: 'search.php',
                    data: data,
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {
                       if(data.status != 200) {
                            layer.alert('没有相关记录', {icon: 5});
                       } else {
                            switch(data.com) {
                                case 'kuaijiesudi':
                                data.com = '快捷速递';
                                break;
                                case 'zhongtong':
                                data.com = '中通';
                                break;
                                case 'yudakuaidi':
                                data.com = '韵达快递';
                                break;
                                case 'shunfeng':
                                data.com = '顺丰';
                                break;
                                case 'baishiwuliu':
                                data.com = '百世物流';
                                break;
                                case 'huitongkuaidi':
                                data.com = '汇通快递';
                                break;
                                case 'quanfengkuaidi':
                                data.com = '全峰快递';
                                break;
                            }
                            $("#result").append("<li><font color='red'> 快递: " + data.com + "</li>");
                            for (var i = 0; i <= data.data.length - 1; i++) {
                                console.log(data.data[i]);
                                $("#result").append("<li style='margin-left:0px;'>" + '时间: ' + data.data[i].time + "&nbsp;" + data.data[i].context + data.data[i].location +"</li>");
                            }
                       }
                    }
                });                
            }
        });
    </script>
</body>
</html>
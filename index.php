<!doctype html>
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <head>
        <script src="jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
    </head>
    <body>
        <ul id="tweets">
            
        </ul>
        <script type="text/javascript">
            var tag = "HMフォアグラ";
            var url = "twitter.php?tag=" + tag;
            $.get(url, function(data) {
                var ulT = $("#tweets");
                console.log(data.length);
                for(var i = 0; i < data.length;i++){
                    console.log(i);
                    ulT.append("<li>"
                            +"<a href='http://twitter.com/"+data[i].screen_name+"'>"
                            +"<img src="+data[i].profile_image_url+">"
                            + data[i].user_name +":"
                            +"</a>"
                            +"<p>"+data[i].status+"</p>"
                            +"<small>"+data[i].time+"</small>"
                            +"</li>");
                }
            },"json");
        </script>
    </body>
</html>
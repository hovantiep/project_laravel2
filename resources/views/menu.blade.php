<!doctype html>
<html lang=''>
<head>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset("cssmenu/styles.css") }}">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="{{ asset('cssmenu/script.js') }}"></script>
    <title>CSS MenuMaker</title>
</head>
<body>
Hello! Đây là menu đa cấp, tự động sinh (very hard)
<div id='cssmenu'>
    {{ display_children(0,1) }}
</div>

</body>
</html>

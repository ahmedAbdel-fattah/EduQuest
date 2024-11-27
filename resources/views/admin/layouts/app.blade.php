<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title>Courses</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet'>
    <!-- Syntax Highlighter -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/syntax-highlighter/styles/shCore.css')}}" media="all">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/syntax-highlighter/styles/shThemeDefault.css')}}" media="all">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{asset('admin/css/font-awesome.min.css')}}">
    <!-- Normalize/Reset CSS-->
    <link rel="stylesheet" href="{{asset('admin/css/normalize.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/main.css')}}">
</head>

@yield('content')

<!-- Essential JavaScript Libraries
	==============================================-->
<script type="text/javascript" src="{{asset('admin/js/jquery-1.11.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/jquery.nav.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/syntax-highlighter/scripts/shCore.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/syntax-highlighter/scripts/shBrushXml.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/syntax-highlighter/scripts/shBrushCss.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/syntax-highlighter/scripts/shBrushJScript.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/syntax-highlighter/scripts/shBrushPhp.js')}}"></script>
<script type="text/javascript">
    SyntaxHighlighter.all()
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{asset('admin/js/custom.js')}}"></script>

</body>
</html>

<!doctype html>
<html lang="en">
<head>
    @include("admin.html.head")
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include("admin.html.aside")

@yield("main")

@include("admin.html.script")
@include("pages.html.script")
</body>
</html>

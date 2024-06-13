<!doctype html>
<html lang="en">
<head>
    @include("admin.layouts.parts.head")
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include("admin.layouts.parts.aside")

@yield("main")

@include("admin.layouts.parts.script")
@include("pages.parts.script")
</body>
</html>

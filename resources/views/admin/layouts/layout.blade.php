<!doctype html>
<html lang="en">
<head>
    @include("admin.layouts.parts.head")
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@if (session('success'))
    <div style="margin-left: 650px;width: 500px;text-align: center" class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@elseif(session('danger'))
    <div style="margin-left: 650px;width: 500px;text-align: center" class="alert alert-danger" role="alert">
        {{ session('danger') }}
    </div>
@endif

@if ($errors->any())
    <div style="margin-left: 650px;width: 500px;text-align: center" class="alert alert-danger">
        <ul style="list-style: none">
            @foreach ($errors->all() as $error)
                <li style="margin-left: -35px">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@include("admin.layouts.parts.aside")

@yield("main")

@include("admin.layouts.parts.script")
@include("web.layouts.parts.script")
</body>
</html>

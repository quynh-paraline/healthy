<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @include("admin.layouts.parts.head")

        <title>{{ $title ?? 'Page Title' }}</title>
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

        {{ $slot }}

    @include("admin.layouts.parts.script")
    @include("web.layouts.parts.script")
    </body>
</html>

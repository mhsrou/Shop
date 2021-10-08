        @extends('adminlte::page', ['iFrameEnabled' => true])

        @section('title', 'Dashboard')

        @section('content_header')
            <h1>Dashboard</h1>
        @stop

        @section('right-sidebar')

        @section('content')
            <p></p>
        @stop
        @section('css')
            <link rel="stylesheet" href="/css/admin_custom.css">
        @stop

        @section('js')
            <script> console.log('Hi!'); </script>
        @stop



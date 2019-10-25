@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">CSV Import</div>

                <div class="panel-body">

                    <head>
                        <title>Import CSV Data to MySQL database with Laravel</title>
                    </head>

                    <body>
                        <!-- Message -->
                        @if(Session::has('message'))
                        <p>{{ Session::get('message') }}</p>
                        @endif

                        <!-- Form -->
                        <form method='post' action='/uploadFile' enctype='multipart/form-data'>
                            {{ csrf_field() }}
                            <input type='file' name='file'>
                            <input type='submit' name='submit' value='Import'>
                        </form>
                    </body>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
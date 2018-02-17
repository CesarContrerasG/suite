<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Storage Files</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Upload Files / Filesystem Laravel</h1>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    {!! Form::open(['route' => 'test.storage', 'method' => 'POST', 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::label('file-upload', 'Archivo Prueba') !!}<br>
                            {!! Form::file('file-upload', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('register_date', 'Fecha de Registro') !!}
                            {!! Form::date('register_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-sm']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </body>
</html>

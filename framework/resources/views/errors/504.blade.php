<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Cristhofer Ordaz">

    <title>ESuite</title>

    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>
    <style>
        body{ font-family: 'Raleway', sans-serif; font-size: 16px; color: #34495e; }

        .content{ display: flex; width: 100%; height: 100vh; align-items: center; justify-content: center; }
        .content h1{  font-size: 6em; font-weight: 200; margin: 0; }
        .content a { display: block; text-align: center; text-decoration: none; color: #d35400; }
        .content a:hover { text-decoration: underline; }
    </style>
</head>

<body>
    <div class="content">
        <div>
            <h1>404</h1>
            <a href="{{ URL::previous() }}">Return Back</a>
        </div>
    </div>
</body>
</html>

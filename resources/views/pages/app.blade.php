<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Documento PDF</title>
</head>
<body>
    <div style="position: relative; width:100%">
        <div style="width: 100%; background: #000; height:60px; position:absolute;">
        </div>
        @if(isset($rutaArchivo))
    <embed src="{{ asset('storage/' . $rutaArchivo) }}" type="application/pdf" width="100%" height="900px">
@endif
    </div>
    
</body>
</html>

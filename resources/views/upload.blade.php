<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Archivo PDF</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body class="container mt-5">
    <h2 class="mb-4">Subir Archivo PDF</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="/upload" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="pdf_files" class="form-label">Selecciona archivos PDF</label>
            <input type="file" class="form-control" name="pdf_files[]" accept=".pdf" multiple required>
        </div>
        <button type="submit" class="btn btn-primary">Subir y Procesar</button>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
    @endif
    
   @isset($texts)
    <hr>
    <h3>Textos extraídos de los PDF:</h3>
    @foreach($texts as $text)
        <pre>{{ mb_convert_encoding($text, 'UTF-8', 'auto') }}</pre>
    @endforeach
   @endisset
</body>
</html>
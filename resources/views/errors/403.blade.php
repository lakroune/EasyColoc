<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page non trouvée - EsyColoc</title>
    <style>
        body {
            text-align: center;
            padding: 50px;
            font-family: sans-serif;
            background-color: #f9fafb;
            color: #1f2937;
        }

        h1 {
            font-size: 50px;
            margin-bottom: 10px;
        }

        .logo {
            max-width: 400px;
            margin-bottom: 70px;
        }

        p {
            font-size: 18px;
            color: #4b5563;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <img src="{{ asset('logo/logo.png') }}" alt="Logo EsyColoc" class="logo">

    <h1>Oups ! 403</h1>
    <p>{{ $exception->getMessage() ?? "Vous n'avez pas les droits pour acceder à cette page" }}.</p>

    <a href="{{ url('/') }}">Retour à l'accueil</a>
</body>

</html>

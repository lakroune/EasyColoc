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
        }

        h1 {
            font-size: 50px;
        }

        .logo {
            max-width: 300px;
            margin-bottom: 80px;
        }
    </style>
</head>

<body>
    <img src="{{ asset('logo/logo.png') }}" alt="Logo EsyColoc" class="logo">
    <h1>Oups ! 404</h1>
    <p>La page que vous cherchez n'existe pas ou a été déplacée.</p>
    <a href="{{ url('/') }}">Retour à l'accueil</a>
</body>

</html>

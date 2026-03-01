<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    <h2> bonjour </h2>
    <p>
        Vous avez recu une invitation de <b>EasyColoc </b>
    </p>
    <P> pour rejoiner la colocation : {{ $colocation->nom_coloc }} </P>
    <a href="http://127.0.0.1:8000/invitations/{{ $invetation->token }}" style="color: #0f4c4c">
        {{ $invetation->token }}
    </a>
    <p>
        merci
    </p>
</body>
</html>

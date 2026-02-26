<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    <h2>Salam </h2>
    <p>
        Ttsiftat lik invitation bach tjoin <b>EasyColoc</b>.
    </p>
    <P> colocation : {{ $colocation->nom_coloc }} </P>
    <a href="http://127.0.0.1:8000/invitations/{{ $invetation->token }}" style="">
        clicker ici pour accepter
    </a>
    <p>
        Merci
    </p>
</body>

</html>

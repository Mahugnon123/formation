<!DOCTYPE html>
<html>
<head>
    <title>Nouveau message de contact</title>
</head>
<body>
    <p>Vous avez reçu un nouveau message de contact depuis votre site web :</p>

    <p><strong>Nom :</strong> {{ $contactData['name'] }}</p>
    <p><strong>Email :</strong> {{ $contactData['email'] }}</p>
    <p><strong>Sujet :</strong> {{ $contactData['subject'] }}</p>
    <p><strong>Message :</strong></p>
    <p>{{ $contactData['message'] }}</p>

    <p>Cordialement,</p>
    <p>Votre site web</p>
</body>
</html>
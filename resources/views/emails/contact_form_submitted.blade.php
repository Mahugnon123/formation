<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau message de contact</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        p {
            font-size: 16px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Nouveau message depuis le site</h2>
        
        <p><strong>Nom :</strong> {{ $contactData['name'] }}</p>
        <p><strong>Email :</strong> {{ $contactData['email'] }}</p>
        <p><strong>Sujet :</strong> {{ $contactData['subject'] }}</p>
        <p><strong>Message :</strong></p>
        <p>{{ $contactData['message'] }}</p>

        <div class="footer">
            <p>Ce message a été envoyé depuis le formulaire de contact de la Plateforme Formation.</p>
        </div>
    </div>
</body>
</html>

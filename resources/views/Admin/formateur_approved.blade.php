<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bienvenue chez EduPulse</title>
    <style>
        body {
            font-family: 'Segoe UI', Roboto, Arial, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            padding: 40px 0;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        h2 {
            color: #007bff;
        }
        p {
            font-size: 16px;
            margin-bottom: 20px;
        }
        ul {
            background-color: #f1f1f1;
            padding: 15px;
            border-radius: 8px;
        }
        li {
            margin-bottom: 10px;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #007bff;
            color: #fff !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }
        .footer {
            font-size: 13px;
            color: #777;
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Bienvenue parmi nous, {{ $nom_complet }} !</h2>

        <p>Nous sommes ravis de vous accueillir en tant que <strong>formateur partenaire</strong> sur notre plateforme EduPulse.</p>

        <p>Voici vos identifiants de connexion :</p>
        <ul>
            <li><strong>Email :</strong> {{ $email }}</li>
            <li><strong>Mot de passe temporaire :</strong> {{ $password }}</li>
        </ul>

        <p>➡️ Pour accéder à votre espace personnel, cliquez sur le bouton ci-dessous :</p>
        <a href="{{ url('/login') }}" class="button">Se connecter</a>

        <p style="margin-top: 30px;">🔒 Pour des raisons de sécurité, merci de <strong>modifier votre mot de passe</strong> dès votre première connexion.</p>

        <p>Nous vous remercions pour votre confiance et vous souhaitons une belle aventure pédagogique à nos côtés.</p>

        <p>Cordialement,<br>
        <strong>L’équipe EduPulse by SinusTic</strong></p>

        <div class="footer">
            © {{ date('Y') }} EduPulse By SinusTic. Tous droits réservés.
        </div>
    </div>
</body>
</html>

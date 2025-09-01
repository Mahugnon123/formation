<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Demande de partenariat - Réponse</title>
    <style>
        body {
            font-family: 'Segoe UI', Roboto, Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            padding: 40px 0;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        h2 {
            color: #d32f2f;
        }
        p {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .footer {
            font-size: 14px;
            color: #777;
            text-align: center;
            margin-top: 40px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Bonjour {{ $nom_complet }},</h2>

        <p>Nous vous remercions pour l’intérêt que vous avez porté à notre programme de partenariat.</p>

        <p>Après étude attentive de votre dossier, nous sommes au regret de vous informer que votre demande n’a pas été retenue. Cette décision ne remet en aucun cas en cause vos compétences ou votre parcours, mais résulte d’une sélection rigoureuse basée sur des critères spécifiques à nos besoins actuels.</p>

        <p>Si vous avez des questions ou souhaitez obtenir des précisions, n’hésitez pas à nous contacter à l’adresse suivante : <a href="mailto:support@sinusticformation.com">support@sinusticformation.com</a>.</p>

        <p>Nous vous remercions encore pour votre démarche et vous souhaitons une pleine réussite dans vos projets.</p>

        <p>Cordialement,<br><strong>L’équipe EduPulse.</strong></p>

        <div class="footer">
            © {{ date('Y') }} EduPulse. Tous droits réservés.
        </div>
    </div>
</body>
</html>

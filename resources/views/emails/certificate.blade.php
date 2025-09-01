<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Certificat de Réussite</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f8; padding: 40px; color: #2c3e50;">

    <div style="max-width: 600px; margin: auto; background: #ffffff; border-radius: 8px; padding: 30px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">

        <div style="text-align: center;">
            <img src="{{ asset('blancEdupulse.png') }}" style="width: 100px; margin-bottom: 20px;">
            <h2 style="color: #2c3e50;">Félicitations pour votre Réussite !</h2>
        </div>

        <p>Bonjour <strong>{{ $user->prenom }} {{ $user->nom }}</strong>,</p>

        <p>Nous sommes ravis de vous féliciter pour avoir <strong>terminé avec succès</strong> la formation :</p>

        <p style="font-size: 18px; font-weight: bold; color: #0056b3;">« {{ $formation->titre }} »</p>

        <p>Grâce à votre implication, vous avez terminé le cours et réussi le test, ce qui témoigne de votre sérieux et de vos compétences acquises.</p>

        <p>Vous pouvez dès à présent consulter votre certificat officiel en cliquant sur le bouton ci-dessous. Ce lien reste accessible tant que vous êtes connecté à votre compte.</p>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $url }}" style="background-color: #007BFF; color: white; text-decoration: none; padding: 12px 25px; border-radius: 5px; font-size: 16px;">Accéder à mon certificat</a>
        </div>

        <p style="font-size: 14px; color: #7f8c8d;"><em>Ce lien est personnel, confidentiel et nécessite vot.</em></p>

        <hr style="margin: 30px 0; border: none; border-top: 1px solid #ecf0f1;">

        <p>En cas de questions ou de difficultés, notre équipe est à votre disposition à l’adresse suivante :</p>
        <p><a href="mailto:support@tondomaine.com" style="color: #007BFF;">support@tondomaine.com</a></p>

        <p>Cordialement,</p>
        <p><strong>L’équipe pédagogique</strong><br>EduPulse</p>

    </div>

</body>
</html>
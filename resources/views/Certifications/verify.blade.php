<!DOCTYPE html>
<html>
<head>
    <title>Vérification de Certificat</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
        .result { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ccc; }
        h1 { color: #2c3e50; }
        p { font-size: 18px; }
    </style>
</head>
<body>
    <div class="result">
        <h1>Vérification de Certificat</h1>
        <p>Certificat valide pour : {{ $name }}</p>
        <p>Cours : {{ $course }}</p>
        <p>Date d'émission : {{ $date }}</p>
    </div>
</body>
</html>
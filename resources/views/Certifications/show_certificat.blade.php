<!DOCTYPE html>
<html>
<head>
    <title>Certificat d'Achèvement</title>
    <meta name="robots" content="noindex, nofollow">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #f0f2f5;
            user-select: none;
            overflow: hidden;
        }
        .certificate-container {
            position: relative;
            max-width: 850px;
            margin: 60px auto;
            background: #ffffff;
            border: 6px solid #1e3a8a;
            padding: 50px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            background-image: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%), 
                             repeating-linear-gradient(45deg, transparent 0, transparent 15px, rgba(0, 0, 0, 0.03) 15px, rgba(0, 0, 0, 0.03) 25px);
            background-blend-mode: overlay;
            border-radius: 10px;
        }
        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 100px;
            height: auto;
        }
        .sidebar {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 120px;
            background: linear-gradient(180deg, #3b82f6 0%, #1e3a8a 100%);
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }
        .badge {
            width: 130px;
            margin: 0 auto 25px;
            background: #e6f0fa;
            border-radius: 50%;
            padding: 15px;
            border: 5px solid #3b82f6;
        }
        .badge img {
            width: 100%;
            height: auto;
        }
        h1 {
            color: #1e3a8a;
            font-size: 40px;
            margin-bottom: 15px;
            text-transform: uppercase;
            font-weight: bold;
        }
        .completion-ribbon {
            background: #3b82f6;
            color: #ffffff;
            padding: 8px 30px;
            display: inline-block;
            border-radius: 25px;
            font-size: 22px;
            margin-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        p {
            font-size: 22px;
            color: #374151;
            margin: 12px 0;
            line-height: 1.6;
        }
        .certificate-id {
            font-size: 18px;
            color: #6b7280;
            margin-top: 35px;
            font-style: italic;
            font-weight: 500;
        }
        .powered-by {
            font-size: 15px;
            color: #9ca3af;
            margin-top: 30px;
            font-style: italic;
        }
        @media print {
            body { display: none; }
        }
    </style>
    <script>
        document.addEventListener('contextmenu', e => e.preventDefault());
        document.addEventListener('keydown', e => {
            if (e.ctrlKey && ['s', 'p', 'u'].includes(e.key.toLowerCase())) {
                e.preventDefault();
            }
        });
    </script>
</head>
<body>
    <div class="certificate-container">
        <div class="sidebar"></div>
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
        <div class="badge">
            <img src="{{ asset('images/badge.png') }}" alt="Badge">
        </div>
        <h1>Certificat</h1>
        <div class="completion-ribbon">of Completion</div>
        <p>This certificate is awarded to</p>
        <p><strong>{{ $name }}</strong></p>
        <p>for the successful completion of the</p>
        <p><strong>{{ $course }}</strong></p>
        <p>Date: {{ $date }}</p>
        <p class="certificate-id">Certificate ID: {{ $certificate_id }}</p>
        <p class="powered-by">Powered by YourPlatformName © {{ now()->format('Y') }}</p>
    </div>
</body>
</html>
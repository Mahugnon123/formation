<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate of Completion</title>
    <meta name="robots" content="noindex, nofollow">
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: url('/assets/images/certificate/bg1.png') center bottom no-repeat;
            background-size: cover;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
        .certificate-outer {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
        }
        .certificate-box {
            background: #fff;
            
            box-shadow: 0 8px 32px rgba(59,130,246,0.18), 0 1.5px 0 #1976f3 inset;
            border-radius: 18px;
            padding: 0;
            position: relative;
            max-width: 1100px;
            width: 100%;
            overflow: hidden;
        }
       
        .certificate-content {
            text-align: left;
            padding: 48px 48px 32px 180px;
            position: relative;
            z-index: 2;
            background: url('data:image/svg+xml;utf8,<svg width="100%25" height="100%25" xmlns="http://www.w3.org/2000/svg"><polygon points="0,0 100,0 100,100" fill="%23f3f4f6" opacity="0.25"/><polygon points="0,100 0,0 100,100" fill="%23e5e7eb" opacity="0.15"/></svg>') no-repeat right bottom;
            background-size: cover;
        }
        .ribbon-badge {
            position: absolute;
            left: 0px;
            top: 0;
            bottom: 0;
            width: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 3;
        }
        .ribbon-badge-inner {
            background: linear-gradient(180deg, #3b82f6 0%, #1e3a8a 100%);
            border-radius: 50%;
            width: 110px;
            height: 110px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 12px rgba(59,130,246,0.10);
            border: 6px solid #fff;
        }
        .ribbon-badge-inner img {
            width: 60px;
            height: 60px;
        }
        .certificate-title {
            text-align: center;
            font-size: 4em;
            font-weight: bold;
            color: #22223b;
            margin-bottom: 0.1em;
            letter-spacing: 4px;
        }
        .certificate-subtitle {
            display: block;
            margin: 0 auto 2.2em auto;
            width: 420px;
            max-width: 90vw;
            height: 54px;
            background: linear-gradient(90deg, #3b82f6 0%, #06b6d4 100%);
            border-radius: 0 28px 28px 0;
            color: #fff;
            font-size: 1.5em;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            text-align: center;
            line-height: 54px;
            box-shadow: 0 2px 8px rgba(59,130,246,0.08);
        }
        .certify-text,
        .completion-text {
            font-size: 1.1em;
            margin-bottom: 1.2em;
            font-weight: normal;
            padding: 40px 0 0px 0;
        }
        .recipient {
            font-size: 2em;
            font-weight: bold;
            color: #22223b;
            margin-bottom: 0.5em;
            display: block;
            letter-spacing: 2px;
        }
        .course-title {
            font-size: 2em;
            font-weight: bold;
            color: #22223b;
            display: block;
        }
        .details {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 3em;
            font-size: 1em;
        }
        .details .left {
            color:rgb(1, 1, 1);
            margin-left: 150px;
            
        }
        .details .center {
            text-align: center;
            flex: 1;
        }
        .details .status-dot {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #22c55e;
            margin-right: 7px;
            vertical-align: middle;
        }
        .details .status-dot.expired {
            background: #ef4444;
        }
        .details .right {
            text-align: right;
        }
        .details .right img {
            width: 70px;
            margin-bottom: 8px;
        }
        .certificate-id {
            font-size: 0.95em;
            color:rgb(205, 208, 216);
            margin-top: 0.5em;
        }
        @media (max-width: 900px) {
            .certificate-content {
                padding: 32px 8px 24px 8px;
            }
            .ribbon-badge {
                display: none;
            }
        }
        .ribbon-banner {
            width: 600px;
            max-width: 100%;
            height: 50px;
            margin: 30px auto 0 auto;
            background: url('/assets/images/certificate/ribbon.png') center center/contain no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-left: 150px;
        }
        .ribbon-banner span {
            color: #fff;
            font-size: 28px;
            font-family: 'Segoe UI', Arial, sans-serif;
            font-weight: bold;
            letter-spacing: 4px;
            text-shadow: 0 2px 8px #0008;
        }
        .cert-container {
            position: relative;
            overflow: hidden;
            background: #fff;
        }
        
        .cert-decoration-bottom {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: auto;
            z-index: 0;
            pointer-events: none;
        }
        .cert-decoration-right {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: auto;
            z-index: 0;
            pointer-events: none;
        }
        /* .cert-container {
            background: url('/assets/images/certificate/bg1.jpg') center bottom no-repeat;
            background-size: cover;
        } */
        .certificate {
            position: relative;
            width: 1200px;
            height: 700px;
            margin: auto;
            background: #fff;
            background-image: url('/assets/images/certificate/frame.png');
            background-repeat: no-repeat;
            background-size: 100% 100%;
            box-shadow: 0 0 10px #ccc;
            padding: 40px 60px;
            z-index: 1;
        }
        .certificate-align-left {
            text-align: left;
            margin-left: 150px;
        }
        .certificate-align-left .recipient,
        .certificate-align-left .course-title {
            margin-left: 0 !important;
            transform: none !important;
            display: block;
        }
        .underline-blue {
            display: inline-block;
            border-bottom: 4px solid #60a5fa;
            padding-bottom: 4px;
        }
        .date-underline {
            display: inline-block;
            border-bottom: 1px solid #222;
            padding-bottom: 1px;
        }
    </style>
</head>
<body>
<div class="certificate-outer">
    <div class="certificate-box">
        <div class="ribbon-badge">
            <svg width="220" height="100%" viewBox="0 0 220 800" fill="none" xmlns="http://www.w3.org/2000/svg" style="position:absolute; left:20px; top:0; height:100%; min-height:400px;">
                <!-- Bande verticale avec la photo -->
                <image href="{{ asset('/badge_vertical.png') }}" x="0" y="0" width="220" height="800" preserveAspectRatio="xMidYMid slice"/>
                <!-- Logo centré dans le ruban -->
                <image href="{{ asset('/SinusTic.png') }}" x="70" y="155" height="80" width="80" />
            </svg>
        </div>
        <div class="cert-container">
            <!-- Décorations -->
            <img src="/assets/images/certificate/backgroundpattern_right.png" alt="" class="cert-decoration-right">
            <img src="/assets/images/certificate/backgroundpattern_left_1.png" alt="" class="cert-decoration-bottom">

            <div class="certificate-content">
                <div class="certificate-title">CERTIFICATE</div>
                <div style="display: flex; justify-content: center; margin-bottom: 2.2em;">
                    <div class="ribbon-banner">
                        <span>OF COMPLETION</span>
                    </div>
                </div>
                <div class="certificate-align-left">
                    <div class="certify-text">This certificate is awarded to</div>
                    <div class="recipient">
                        <span class="underline-blue">{{ $nom }} {{ $prenom }}</span>
                    </div>
                    <div class="completion-text">for the successful completion of the</div>
                    <div class="course-title">
                        <span class="underline-blue">{{ $course }}</span>
                    </div>
                </div>
                <div class="details">
                    <div class="left">
                        <div class="date-underline">{{ $date }}</div>
                        <div style="font-size:0.95em;color:#6b7280;">Issue Date</div>
                    </div>
                    
                    <div class="right" style="text-align: center;">
                        <img src="{{asset('/SinusTic.png')}}" alt="Logo" style="display: block; margin: 0 auto 8px auto;">
                        <div class="certificate-id">ID: {{ $certificate_id }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
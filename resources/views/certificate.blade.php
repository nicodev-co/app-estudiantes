<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Certificado de Honor</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Great+Vibes&family=Roboto:wght@400;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f3f3f3, #e2e2e2);
        }
        .container {
            border: 10px solid #2c3e50;
            padding: 50px;
            margin: 50px auto;
            width: 80%;
            background: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
        }
        .header {
            font-size: 48px;
            font-weight: bold;
            font-family: 'Great Vibes', cursive;
            color: #2c3e50;
        }
        .subheader {
            font-size: 28px;
            margin-top: 20px;
            color: #d35400; /* Cambiado a un tono más suave */
        }
        .content {
            font-size: 22px;
            margin-top: 30px;
            color: #333;
        }
        .footer {
            margin-top: 50px;
            font-size: 20px;
            color: #777;
        }
        .signature {
            margin-top: 50px;
            font-size: 20px;
            color: #333;
        }
        .signature-line {
            margin-top: 30px;
            border-top: 2px solid #2c3e50;
            width: 300px;
            margin: 30px auto 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Certificado de Honor</div>
        <div class="subheader">Otorgado a</div>
        <div class="content">
            <strong>{{ $student->name }}</strong><br>
            Por haber obtenido un excelente promedio académico<br>
            durante el año escolar <strong>2024</strong>.
        </div>
        <div class="footer">
            Felicitaciones por tu dedicación y esfuerzo.<br>
            Sigue adelante y continúa alcanzando tus metas.
        </div>
        <div class="signature">
            <div class="signature-line"></div>
            {{ $admin->name }}<br>
            Directora de la Escuela
        </div>
    </div>
</body>
</html>

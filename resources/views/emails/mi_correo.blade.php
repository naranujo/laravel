<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            font-size: 16px;
            color: #ffffff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            font-size: 12px;
            color: #666;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Recuperación de Contraseña</h2>
        </div>
        <p>Hola,</p>
        <p>Recibimos una solicitud para restablecer tu contraseña. Haz clic en el botón de abajo para continuar:</p>
        <p style="text-align: center;">
            <a href="{{ $url }}" class="button">Restablecer Contraseña</a>
        </p>
        <p>Si no solicitaste este cambio, puedes ignorar este mensaje.</p>
        <p><strong>Nota:</strong> Este código es válido solo por 30 minutos. Después de ese tiempo, necesitarás solicitar un nuevo código.</p>
        <p>Saludos,<br>El equipo de Greenock Trust</p>
        <div class="footer">
            <p>Este es un mensaje automático, por favor no respondas.</p>
        </div>
    </div>
</body>
</html>

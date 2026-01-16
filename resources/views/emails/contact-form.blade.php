<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: #f4f4f4;
            padding: 10px;
            margin-bottom: 20px;
            border-bottom: 2px solid #ddd;
        }

        .label {
            font-weight: bold;
            color: #555;
        }

        .content {
            background: #fff;
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>New Contact Form Submission</h2>
        </div>

        <p><span class="label">Name:</span> {{ $contactMessage->name }}</p>
        <p><span class="label">Email:</span> {{ $contactMessage->email }}</p>
        <p><span class="label">Phone:</span> {{ $contactMessage->phone ?? 'N/A' }}</p>
        <p><span class="label">Subject:</span> {{ $contactMessage->subject }}</p>

        <div class="content">
            <p><span class="label">Message:</span></p>
            <p>{{ $contactMessage->message }}</p>
        </div>

        <p style="font-size: 0.9em; color: #888; margin-top: 30px;">
            This email was sent from the contact form on {{ config('app.name') }}.
        </p>
    </div>
</body>

</html>
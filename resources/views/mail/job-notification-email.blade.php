<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Hello, {{ $mail_data['employer']->name }} ! Someone has applied on your job, see details:</h1>

<p>Job Title: {{ $mail_data['job']->title }}</p>

<p>Employee Details: </p>
<p>Name: {{ $mail_data['user']->name }}</p>
<p>Email: {{ $mail_data['user']->email }}</p>
<p>Mobile No: {{ $mail_data['user']->mobile }}</p>
</body>
</html>
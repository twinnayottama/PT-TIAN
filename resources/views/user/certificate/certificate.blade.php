<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
</head>

<body>
    <h1>{{ $data['certificate_name'] }}</h1>
    <p>Date Issued: {{ $data['date_issued'] }}</p>
    <p>Issued By: {{ $data['issued_by'] }}</p>
</body>

</html>

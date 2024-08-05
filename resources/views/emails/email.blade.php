<!DOCTYPE html>
<html>
<head>
    <title>Application Update</title>
</head>
<body>
    <h3>{{ $mailData['subject'] }}</h3>

    {!!$mailData['body'] !!}
</body>
</html>

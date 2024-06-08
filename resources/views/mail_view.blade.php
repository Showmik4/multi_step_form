<!DOCTYPE html>
<html>

<head>
    <title>Your Survey Details and Total Marks</title>
</head>

<body>
    <h1>Your Survey Details</h1>
    <p>Dear {{$people_info->first_name}} {{$people_info->last_name}},</p>
    <p>Your total marks are: {{ number_format($people_info->total_marks,2,'.', ',') }} %</p>
    <p>Thank you for your participation!</p>
</body>

</html>
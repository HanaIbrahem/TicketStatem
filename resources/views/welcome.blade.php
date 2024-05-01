<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('dashbord/assets/fontawsom/css/all.min.css') }}">
    <link rel="icon" href="{{ asset('unnamed.png') }}">

    <title>Teammart-IT</title>
    <style>
        body {
            background-color: #052958;
            margin: 0;
            padding: 0;
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            /* background-color: #333; */
            color: #fff;
            padding: 10px 20px;
            box-sizing: border-box;
            z-index: 9999;
        }

        .header .logo {
            float: left;
        }

        .header .login {
            float: right;
            margin-top: 22px;
        }
        .header .login a {
            margin: 20px;
            color: #fff;
            text-decoration: none;
            padding: 8px 16px;
            border: 2px solid #fff;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .header .login a:hover {
            background-color: #fff;
            color: #333;
        }

        /* Center the image horizontally and vertically */
        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 60px); /* Adjust header height */
            /* Adjust as needed */
        }

        /* Optional: Set max-width for the image */
        .image-container img {
            max-width: 100%;
            /* Adjust as needed */
            max-height: 100%;
            /* Adjust as needed */
            width: 40%;
        }
    </style>
</head>

<body>

    <div class="header">
     
        <div class="login">
            @if(auth()->check())
            <a  href="{{ route('dashbord.index') }}">Dashboard</a>
            @else
            <a href="{{ route('login') }}">Login</a>
            @endif
        </div>
    </div>

    <div class="image-container">
        <img src="{{ asset('logo-small.svg') }}" alt="Your Image">
    </div>

</body>

</html>




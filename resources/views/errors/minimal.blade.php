@extends('frontend.layout.top')
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
        <link rel="shortcut icon" href="{{asset('assetsku/images/marketplace.png')}}" />
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .code {
                border-right: 2px solid;
                font-size: 26px;
                padding: 0 15px 0 15px;
                text-align: center;
            }

            .message {
                font-size: 18px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="code">
                @yield('code')
            </div>
            <img src="{{asset('assetsku/images/marketplace.png')}}" style="width: 60px; height: 60px;"/>
            <div class="message" style="padding: 10px;">
                @yield('message')
                <div class="button4">					
                    <a href="/">
                        <button type="submit" class="btn" id="disable-button">Continue Shopping</button>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" src="libs/bootstrap/dist/css/bootstrap-min.css" />
        <style>
            #device {
                margin: 1em auto;
                width: 280px;
                height: 580px;
                background-image: url('assets/iphone6frame.png');
                background-repeat: no-repeat;
                background-size: contain;
                display: block;
            }
            #device #view {
                width: 250px;
                height: 450px;
                position: relative;
                left: 16px;
                top: 65px;
                border: none;
            }
        </style>
    </head>
    <body>
        <div id="device_frame">
            <div id="device">
                <iframe id="view" src=""></iframe>
            </div>
        </div>
        <script src="libs/jquery/dist/jquery.min.js"></script>
        <script>
            $(document).on('ready', function() {
                if(/localhost/.test(window.location.href)) {
                    appRoot = 'http://localhost/cardioflux/';
                } else {
                    appRoot = 'http://cardioflux.co/';
                }
                $('#view').attr('src', appRoot);
            });
        </script>
    </body>
</html>

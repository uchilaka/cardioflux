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
                width: 310px;
                height: 710px;
                background-image: url('assets/iphone6frame.png');
                background-repeat: no-repeat;
                background-size: contain;
                display: block;
            }
            #device #view {
                width: 280px;
                height: 500px;
                position: relative;
                left: 16px;
                top: 65px;
                border: none;
            }
            #home_button {
                display: block; 
                margin: 0 auto;
                position: relative;
                top: 60px;
                width: 60px; 
                height: 60px; 
                text-decoration: none; 
                /*background-color: rgba(255, 255, 255, 0.75);*/
            }
        </style>
    </head>
    <body>
        <div id="device_frame">
            <div id="device">
                <iframe id="view" src=""></iframe>
                <div class="form-group">
                    <a href="#" id="home_button">
                        &nbsp;
                    </a>
                </div>
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
                
                $('#home_button').on('click', function(e) {
                    if(e) e.preventDefault();
                    console.log("Resetting view...");
                    $('#view').attr('src', appRoot);
                    $('#view').attr('src', appRoot + '?' + (new Date()).getTime());
                });
            });
        </script>
    </body>
</html>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ config('app.name', 'Laravel') }} | Newsletter</title>

        <!-- Place favicon.png in the root directory -->
        <link rel="shortcut icon" href="{{ asset('frontend_assets/img/favicon.png') }}" type="image/x-icon" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <style>

            body{
                font-family: 'Open Sans', sans-serif;
            }

            .newsletter_unsubscribe_header{
                padding:30px 0px;
                border-bottom:1px solid #e2e2e2;
            }

            .newsletter_unsubscribe_content{
                padding: 70px 15px;
            }

            .newsletter_unsubscribe_content h1{
                color:#80B500;
                margin-bottom: 20px;
            }

            .newsletter_unsubscribe_content p{
                margin:0;
            }

            .subscribe_again_btn{
                color:#80B500;
                text-decoration:none;
            }

            .subscribe_again_btn:hover{
                color:#80B500;
            }

            .newsletter_unsubscribe_content img{
                max-width: 100%;
                width:80px;
                margin-bottom:20px;
            }
            .cnt_to_site_btn{
                background-color: #80B500;
                color: #fff;
                margin-top:30px;
            }
            .cnt_to_site_btn:hover{
                color: #fff;
            }
        </style>

    </head>
    <body>
        <div id="main_wrapper">
            <header class="newsletter_unsubscribe_header">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="newsletter_logo_container">
                                <a href="{{ route('index') }}"><img src="{{ asset('frontend_assets/img/logo.png') }}" alt="Logo"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="newsletter_unsubscribe_main_content">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="newsletter_unsubscribe_content">
                                <img src="{{ asset('frontend_assets/img/mail_icon.png') }}" alt="">
                                <h1>We are sad to see you go!</h1>
                                <p>You have successfully unsubscribed, you will no longer  recieve mails from Lettuce.</p>
                                <a href="{{ route('index') }}" class="cnt_to_site_btn btn">Continue to site</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Favicon -->
    <link rel="icon" href="<?=site_url('favicon.png');?>">
    <title>Admin API</title>
    <style>
        html, body {
            font-family: sans-serif;
            background: #222;
            color: #eee;
        }

        #card-content {
            margin-top: 22%;
            margin-left: auto;
            margin-right: auto;
            width: 600px;
        }

        .status-start,
        .status-end {
            font-size: 0.8rem;
            padding: 0.2rem 0.3rem;
        }

        .status-start {
            margin-left: 0.2rem;
            border-radius: 4px 0 0 4px;
            background: #666;
        }

        .status-end {
            font-weight: 700;
            text-transform: uppercase;
            margin-right: 0.2rem;
            border-radius: 0 4px 4px 0;
        }
        
        .card > .card-footer {
            font-size: 0.8rem;
        }

        p {
            margin: 0;
        }

        .text-italic {
            font-style: italic;
        }

        .text-clear {
            font-style: normal;
        }
    </style>
</head>
<body>
    <section id="section-main" class="container">
        <div id="card-content" class="card text-light bg-dark mb-3 text-center">
            <div class="card-body">
                <h1 class="card-title display-3">Admin API</h1>
                <span><?php switch(ENVIRONMENT) {

                    case 'localhost':
                        echo '<span class="status-start"><i class="fa fa-cubes fa-fw"></i></span><span class="status-end bg-success">' . ENVIRONMENT . '</span>';
                        break;

                    case 'testing':
                        echo '<span class="status-start"><i class="fa fa-cubes fa-fw"></i></span><span class="status-end bg-warning">' . ENVIRONMENT . '</span>';
                        break;

                    case 'staging':
                        echo '<span class="status-start"><i class="fa fa-cubes fa-fw"></i></span><span class="status-end bg-danger">' . ENVIRONMENT . '</span>';
                        break;

                    default:
                        break;
                } ?><span class="status-start"><i class="fa fa-cog fa-fw"></i></span><span class="status-end text-dark bg-light"><?= VERSION_NO; ?></span></p>
                <p>You are accessing an interface for programmers.<br/>You if came here by accident, click <a id="click-here" class="text-warning" href="javascript:history.back()">here</a> to go back.</p>
            </div>
            <div class="card-footer text-italic">
                <p class="text-secondary">Admin API <i class="fa fa-copyright fa-fw"></i> Davina Leong, <?=now('Y');?>. All rights reserved.</p>
                <p class="text-danger"><i class="fa fa-exclamation-triangle fa-fw"></i> Warning: Any unauthorized access will be <span class="text-clear">reported</span> to the respective authorities.</p>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    <script src="https://use.fontawesome.com/e134f514cc.js"></script>
</body>
</html>
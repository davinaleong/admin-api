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
        }

        #div-content, #div-footer {
            text-align: center;
        }

        #div-content {
            margin-top: 25%;
        }

        .bg-darker {
            background: #333;
        }

        .status-start {
            margin-left: 0.2rem;
            padding: 0.2rem 0.3rem;
            border-radius: 4px 0 0 4px;
        }

        .status-end {
            margin-right: 0.2rem;
            padding: 0.2rem 0.3rem;
            border-radius: 0 4px 4px 0;
        }

        #div-footer {
            margin-top: 2rem;
            color: #868e96;
            font-style: italic;
            font-size: 0.8rem;
        }

        #div-footer > p {
            margin: 0;
        }
    </style>
</head>
<body class="bg-dark text-light">
    <section id="section-main" class="container">
        <div id="div-content">
            <h1 class="display-3">Admin API</h1>
            <span><?php switch(ENVIRONMENT) {

                case 'localhost':
                    echo '<span class="status-start bg-secondary"><i class="fa fa-cubes fa-fw"></i></span><span class="status-end bg-success">' . strtoupper(ENVIRONMENT) . '</span>';
                    break;

                case 'testing':
                    echo '<span class="status-start bg-secondary"><i class="fa fa-cubes fa-fw"></i></span><span class="status-end bg-warning">' . strtoupper(ENVIRONMENT) . '</span>';
                    break;

                case 'staging':
                    echo '<span class="status-start bg-secondary"><i class="fa fa-cubes fa-fw"></i></span><span class="status-end bg-danger">' . strtoupper(ENVIRONMENT) . '</span>';
                    break;

                default:
                    break;
            } ?><span class="status-start bg-secondary"><i class="fa fa-cog fa-fw"></i></span><span class="status-end bg-primary"><?= strtoupper(VERSION_NO); ?></span></p>
            <p>You are accessing an interface for programmers.<br/>You if came here by accident, click <a id="click-here" class="text-info" href="javascript:history.back()">here</a> to go back.</p>
        </div>
        <div id="div-footer">
            <p>Admin API <i class="fa fa-copyright fa-fw"></i> Davina Leong, <?=now('Y');?>. All rights reserved.</p>
            <p class="text-warning"><i class="fa fa-exclamation-triangle fa-fw"></i> Warning: Any unauthorized access will be reported to the respective authorities.</p>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    <script src="https://use.fontawesome.com/e134f514cc.js"></script>
</body>
</html>
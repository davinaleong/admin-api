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

        #div-content {
            margin-top: 30%;
        }
    </style>
</head>
<body class="bg-dark text-light">
    <section id="section-main" class="container">
        <div id="div-content" class="text-center">
            <h1 class="display-3">Admin API</h1>
            <?php switch(ENVIRONMENT) {

                case 'localhost':
                    echo '<p class="lead">env: <span class="badge badge-success">' . strtoupper(ENVIRONMENT) . '</span></p>';
                    break;

                case 'testing':
                    echo '<p class="lead">env: <span class="badge badge-warning">' . strtoupper(ENVIRONMENT) . '</span></p>';
                    break;

                case 'staging':
                    echo '<p class="lead">env: <span class="badge badge-danger">' . strtoupper(ENVIRONMENT) . '</span></p>';
                    break;

                default:
                    break;
            } ?>
            <p>You are accessing an interface for programmers.<br/>You if came here by chance, click <a id="click-here" class="text-info" href="javascript:history.back()">here</a> to go back.</p>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    <script src="https://use.fontawesome.com/e134f514cc.js"></script>
</body>
</html>
<?php
if (!empty($_REQUEST['Sender'])):
    $sender = $_REQUEST['Sender'];
    $layout = file_get_contents('./layout.html', FILE_USE_INCLUDE_PATH);

    if (empty($sender['mobile'])) {
        $start = strpos($layout, '[[IF-MOBILE]]');
        $end   = strpos($layout, '[[ENDIF-MOBILE]]');
        $layout = str_replace(substr($layout, $start, $end-$start+16), '', $layout);

    } else {
        $layout = str_replace("[[IF-MOBILE]]", '', $layout);
        $layout = str_replace("[[ENDIF-MOBILE]]", '', $layout);
        $layout = str_replace("[[MOBILE]]", $sender['mobile'], $layout);
    }
    
    $layout = str_replace("[[NAME]]", $sender['name'], $layout);
    $layout = str_replace("[[PHONE]]", $sender['phone'], $layout);
    $layout = str_replace("[[EMAIL]]", $sender['email'], $layout);

    if (!empty($_REQUEST['download'])) {
        header('Content-Description: File Transfer');
        header('Content-Type: text/html');
        header('Content-Disposition: attachment; filename=assinatura.html');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
    }

    echo $layout;
else: ?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Lucas Machado">

        <title>Signature Generator</title>

        <!-- Bootstrap core CSS -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <style type="text/css">
            /* Sticky footer styles
            -------------------------------------------------- */

            html,
            body {
                height: 100%;
                /* The html and body elements cannot have any padding or margin. */
            }

            /* Wrapper for page content to push down footer */
            #wrap {
                min-height: 100%;
                height: auto !important;
                height: 100%;
                /* Negative indent footer by its height */
                margin: 0 auto -60px;
                /* Pad bottom by footer height */
                padding: 0 0 60px;
            }

            /* Set the fixed height of the footer here */
            #footer {
                height: 60px;
                background-color: #f5f5f5;
            }


            /* Custom page CSS
            -------------------------------------------------- */
            /* Not required for template or sticky footer method. */

            #wrap > .container {
                padding: 60px 15px 0;
            }
            .container .credit {
                margin: 20px 0;
            }

            #footer > .container {
                padding-left: 15px;
                padding-right: 15px;
            }

            code {
                font-size: 80%;
            }
        </style>

    </head>

    <body>

        <!-- Wrap all page content here -->
        <div id="wrap">

            <!-- Fixed navbar -->
            <div class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Signature Generator</a>
                    </div>
                </div>
            </div>

            <!-- Begin page content -->
            <div class="container">
                <div class="page-header">
                    <h1>Simple Signature Generator</h1>
                </div>
                <form role="form" method="post" target="preview" id="form">
                    <div class="form-group">
                        <label for="Name">Name</label>
                        <input type="text" class="form-control" id="Name" name="Sender[name]" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" class="form-control" id="Email" name="Sender[email]" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="Phone">Telefone</label>
                        <input type="phone" class="form-control" id="Phone" name="Sender[phone]" placeholder="+XX (XX) XXXX-XXXX">
                    </div>
                    <div class="form-group">
                        <label for="Mobile">Celular</label>
                        <input type="phone" class="form-control" id="Mobile" name="Sender[mobile]" placeholder="+XX (XX) XXXXX-XXXX">
                    </div>

                    <button id="preview" type="submit" class="btn btn-default">Preview</button>
                    <button id="download" class="btn btn-default">Download</button>
                    <input type="hidden" name="download" id="will-download" value="">
                </form>
            </div>

            <div class="container">
                <iframe src="about:blank" name="preview" width="100%" height="200"></iframe>
            </div>

        </div>

        <div id="footer">
            <div class="container">
                <p class="text-muted credit">developed by <a href="http://www.lucasms.net/">Lucas Machado</a>.</p>
            </div>
        </div>


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        <script type="text/javascript">
        $( document ).ready(function() {
            $("#download").bind( "click", function() {
                $('#will-download').val('true');
                $('#form').removeAttr('target').submit();
            });

            $("#preview").bind( "click", function() {
                $('#will-download').val('');
                $('#form').attr('target','preview');
            });

        });
        </script>
    </body>
</html>
<?php endif;
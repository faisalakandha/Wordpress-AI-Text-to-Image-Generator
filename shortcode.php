<?php


function texttoimg()
{

    ob_start();
?>

    <!DOCTYPE html>

    <html>

    <head>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

        <script type="text/javascript">
            $("document").ready(function() {
                $("#textSubmit").click(function() {

                    var data = {
                        imgtext: $("#textCommand").val()
                    };
                    console.log(data.imgtext);

                    async function postData(data) {

                        return fetch('http://localhost/wp-json/imggenerator/v1/imggenerated', {
                                method: 'POST', // or 'PUT',
                                mode: 'cors', // no-cors, *cors, same-origin
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify(data),
                            })
                            .then((response) => response.json())
                            .then(function(data) {
                                $("#img-content").attr("src", data);
                                $("#img-link").attr("href", data);
                            })
                            .catch((error) => {
                                console.error('Error:', error);
                            });
                    }

                    postData(data);

                });

                $("#panda").click(function() 
                { 
                    console.log("Panda");
                });

                $("#flower").click(function() 
                { 
                    console.log("Flower");
                });

                $("#3dObjectGenerator").click(function() 
                { 
                    console.log("3d Object");
                });

                $("#contemporary").click(function() 
                { 
                    console.log("Contemporary");
                });

                $("#surreal").click(function() 
                { 
                    console.log("surreal");
                });

                $("#oldStyle").click(function() 
                { 
                    console.log("Old style");
                });

                $("#fantasy").click(function() 
                { 
                    console.log("Fantasy");
                });
            });
        </script>
        <style>
            #container {
                margin: auto;
                width: 50%;
                padding: 10px;
            }

            #img-container {
                margin: auto;
                padding: 30px;
                margin-top: 30px;
                display: flex;
                flex-direction: column;
            }

            .flex-container {
                display: flex;
                flex-direction: column;
            }
        </style>
    </head>

    <body>
        <div id="container">
            <div class="flex-container">
                <h2 style="text-align: center; margin-bottom: 2px;">AI Text To Image Generator</h2>
                <hr>
                <textarea id="textCommand" style="height: 200px; outline: none; border: solid 3px #000; border-radius:5px;"></textarea><br>
                <button id="textSubmit" class="btn btn-primary" type="submit">Generate Image</button>
            </div>
            <!-- Page Content -->
            <div class="container">

                <h6 class="fw-light text-center text-lg-start mt-4 mb-0">Choose a style</h6>

                <hr class="mt-2 mb-5">

                <div class="row text-center text-lg-start">

                    <div id="panda" class="col-lg-3 col-md-4 col-6">
                        <a href="#" class="d-block mb-4 h-100">
                            <img class="img-fluid img-thumbnail" src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/panda.jpeg';?>"  alt="">
                        </a>
                    </div>
                    <div id="flower" class="col-lg-3 col-md-4 col-6">
                        <a href="#" class="d-block mb-4 h-100">
                            <img class="img-fluid img-thumbnail" src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/abstracttt.jpeg';?>" alt="">
                        </a>
                    </div>
                    <div id="3dObjectGenerator" class="col-lg-3 col-md-4 col-6">
                        <a href="#" class="d-block mb-4 h-100">
                            <img class="img-fluid img-thumbnail" src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/cmpre.jpeg';?>" alt="">
                        </a>
                    </div>
                    <div id="contemporary" class="col-lg-3 col-md-4 col-6">
                        <a href="#" class="d-block mb-4 h-100">
                            <img class="img-fluid img-thumbnail" src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/contemporary.png';?>" alt="">
                        </a>
                    </div>
                    <div id="surreal" class="col-lg-3 col-md-4 col-6">
                        <a href="#" class="d-block mb-4 h-100">
                            <img class="img-fluid img-thumbnail" src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/cupcoff.jpeg';?>" alt="">
                        </a>
                    </div>
                    <div id="oldStyle" class="col-lg-3 col-md-4 col-6">
                        <a href="#" class="d-block mb-4 h-100">
                            <img class="img-fluid img-thumbnail" src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/old_skool.jpeg';?>" alt="">
                        </a>
                    </div>
                    <div id="fantasy" class="col-lg-3 col-md-4 col-6">
                        <a href="#" class="d-block mb-4 h-100">
                            <img class="img-fluid img-thumbnail" src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/sf_fantasy.jpeg';?>" alt="">
                        </a>
                    </div>

                </div>

            </div>
            <div id="img-container">
                <h5>Your Image Will be Shown Here:</h5>
                <a id="img-link"><img style="height: 70%; width: 70%;" id="img-content" /></a>
            </div>
        </div>
    </body>

    </html>

<?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_shortcode('text2img_shortcode', 'texttoimg');

?>
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
            var globe = 0;
            var myInterval;
            var siteUrl = "<?php get_site_url(); ?>";

            $("document").ready(function() {

                var data = {
                    imgtext: '',
                    king: '',
                };

                function CreateLoading() {
                    myElement = $("#loading-count");
                    myElement.text("Loading.. "+ globe + "%");
                }

                $("#textSubmit").click(function() {
                    data.imgtext = $("#textCommand").val();
                    console.log(data);

                    async function postData(data) {
                        $("#app-container").css("opacity", 0.3);
                        myInterval = setInterval(() => {
                            globe += 1;
                            CreateLoading();
                        }, 500)

                        return fetch(siteUrl + '/wp-json/imggenerator/v1/imggenerated', {
                                method: 'POST', // or 'PUT',
                                mode: 'cors', // no-cors, *cors, same-origin
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify(data),
                            })
                            .then(function(response) {
                                return response.json()
                            })
                            .then(function(data) {
                                console.log(data);
                                $("#img-content").attr("src", data);
                                $("#img-link").attr("href", data);
                                $("#app-container").css("opacity", 1);
                                $("#loading-count").hide();
                                clearInterval(myInterval);
                            })
                            .catch((error) => {
                                console.error('Error:', error);
                            });
                    }

                    postData(data);

                });

                $("#panda").click(function() {
                    $("#textHolder").text("This option will generate an image of a cute animal.");
                    $(".option").removeClass("active");
                    $(this).addClass("active");
                    data.king = 'panda';
                });

                $("#flower").click(function() {
                    $("#textHolder").text("This option will generate an abstract painting.");
                    $(".option").removeClass("active");
                    $(this).addClass("active");
                    data.king = 'flower';
                });

                $("#3dObjectGenerator").click(function() {
                    $("#textHolder").text("This option will generate a highly detailed 3d image of any object.");
                    $(".option").removeClass("active");
                    $(this).addClass("active");
                    data.king = '3dObjectGenerator';
                });

                $("#contemporary").click(function() {
                    $("#textHolder").text("This option will generate contemporary architecture concept image.");
                    $(".option").removeClass("active");
                    $(this).addClass("active");
                    data.king = 'contemporary';
                });

                $("#surreal").click(function() {
                    $("#textHolder").text("This option will generate detailed surreal graphics.");
                    $(".option").removeClass("active");
                    $(this).addClass("active");
                    data.king = '';
                });

                $("#oldStyle").click(function() {
                    $("#textHolder").text("This option will generate an image in 18th century drawing style.");
                    $(".option").removeClass("active");
                    $(this).addClass("active");
                    data.king = 'surreal';
                });

                $("#fantasy").click(function() {
                    $("#textHolder").text("This option will generate an image in fantasy style.");
                    $(".option").removeClass("active");
                    $(this).addClass("active");
                    data.king = 'fantasy';
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

            .active {
                border: solid 2px #0d6efd;
            }
        </style>
    </head>

    <body>
        <div id="container">
        <center><p id="loading-count" style="z-index: 2; position: absolute; top: 500px; left:46%"></p></center>
            <div id="app-container" class="row" style="z-index: 1; position:relative;">
                <div class="flex-container">
                    <h2 style="text-align: center; margin-bottom: 2px; font-family: Times New Roman, Times, serif;">AI Text To Image Generator</h2>
                    <hr style="color: #0d6efd">
                    <textarea id="textCommand" style="height: 200px; outline: none; border: solid 2px #0d6efd; border-radius:8px;"></textarea><br>
                    <button id="textSubmit" class="btn btn-primary" type="submit">Generate Image</button>
                </div>
                <!-- Page Content -->
                <div class="container">

                    <h6 class="fw-light text-center text-lg-start mt-4 mb-0">Select a style from below:</h6>

                    <hr class="mt-2">
                    <p id="textHolder" class="fw-light">A.I. Will Generate An Image According To Your Chosen Style From Below</p>
                    <div class="row text-center text-lg-start">

                        <div id="panda" class="col-lg-3 col-md-4 col-6 option">

                            <img class="img-fluid img-thumbnail" src="<?php echo plugin_dir_url(__FILE__) . 'assets/panda.jpeg'; ?>" alt="">

                        </div>
                        <div id="flower" class="col-lg-3 col-md-4 col-6 option">

                            <img class="img-fluid img-thumbnail" src="<?php echo plugin_dir_url(__FILE__) . 'assets/abstracttt.jpeg'; ?>" alt="">

                        </div>
                        <div id="3dObjectGenerator" class="col-lg-3 col-md-4 col-6 option">

                            <img class="img-fluid img-thumbnail" src="<?php echo plugin_dir_url(__FILE__) . 'assets/cmpre.jpeg'; ?>" alt="">

                        </div>
                        <div id="contemporary" class="col-lg-3 col-md-4 col-6 option">

                            <img class="img-fluid img-thumbnail" src="<?php echo plugin_dir_url(__FILE__) . 'assets/contemporary.png'; ?>" alt="">

                        </div>
                        <div id="surreal" class="col-lg-3 col-md-4 col-6 option">

                            <img class="img-fluid img-thumbnail" src="<?php echo plugin_dir_url(__FILE__) . 'assets/cupcoff.jpeg'; ?>" alt="">

                        </div>
                        <div id="oldStyle" class="col-lg-3 col-md-4 col-6 option">

                            <img class="img-fluid img-thumbnail" src="<?php echo plugin_dir_url(__FILE__) . 'assets/old_skool.jpeg'; ?>" alt="">

                        </div>
                        <div id="fantasy" class="col-lg-3 col-md-4 col-6 option">

                            <img class="img-fluid img-thumbnail" src="<?php echo plugin_dir_url(__FILE__) . 'assets/sf_fantasy.jpeg'; ?>" alt="">

                        </div>

                    </div>

                </div>
                <center>
                    <div id="img-container">
                        <h5>Your Image Will be Shown Here:</h5>
                        <a id="img-link"><img style="height: 70%; width: 70%;" id="img-content" alt="Your Image" /></a>
                    </div>
                </center>
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
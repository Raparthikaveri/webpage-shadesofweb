<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Cards and Carousel with Bootstrap</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    #mobileCarousel{
        display:none;
    }
    .carousel-control-prev, .carousel-control-next {
        width: 10%;
        top: 50%;
        transform: translateY(-50%);
    }

    .carousel-control-prev span, .carousel-control-next span {
        background-color: black;
    }

    .carousel-control-prev {
        left: 0;
    }

    
    .carousel-control-next {
        right: 0;
    }

    .carousel-control1 {
        display: none;
    }

    .site-color {
        color: #775a05b5;
    }

   
    @media (min-width: 992px) {
        .carousel-control-prev, .carousel-control-next {
            width: 5%; 
        }
    }

    .card {
        height: 90%;
        margin-bottom: 70px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); 
    }

    .card-body {
        min-height: 200px; 
    }

    .card-img-top {
        height: 250px; 
        object-fit: cover;
    }

    .carousel-item img {
        max-height: 350px;
        object-fit: cover;
        width: 100%;
    }

    .carousel-caption {
        padding: 10px;
        bottom: 10px;
    }

    .carousel-caption h5 {
        margin: 0;
    }

    .slider_image {
        height: 400px;
    }

    @media (min-width: 200px) and (max-width: 761px) {
        #mobileCarousel, .carousel-item, .carousel-control1 {
            display: block;
        }
    }

    @media (min-width: 762px) {
        #mobileCarousel, .carousel-item, .carousel-control1 {
            display: none;
        }
    }
  </style>
</head>
<body>
<?php
$targetUrl = 'https://devsow.wpengine.com/wp-json/communities/all/';
$header = array(
    'Authorization: Basic bmVoYTowI21JdkJCdzRBdWJoKTU5QXhEQ0hIQTU='
);
$ch = curl_init($targetUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$response = curl_exec($ch);
$datas = json_decode($response, true);
$cards = $datas['data']; 
curl_close($ch);
?>
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-lg-12 text-center mb-3">
            <h2 class="site-color">COMMUNITIES WE MANAGE</h2>
            <div></div>
        </div>
    </div>
    <div class="row mb-5">
        <?php
        foreach ($cards as $data) {
            if (isset($data['image_url'])) {
        ?>
        <div class="col-md-4">
            <div class="card">
                <img src="<?php echo $data['image_url']; ?>" class="card-img-top" alt="<?php echo $data['post_title']; ?>">
                <div class="card-body">
                    <p class="card-text site-color"><?php echo $data['post_excerpt']; ?></p>
                </div>
                <div class="card-footer">
                    <h5 class="card-title site-color"><?php echo $data['post_title']; ?></h5>
                </div>
            </div>
        </div>
        <?php
            }
        }
        ?>
    </div>

    <div class="row mt-5">
        <div class="col-lg-12 text-center mb-3">
            <h2 class="site-color">OUR SERVICES</h2>
            <div></div>
        </div>
    </div>
    <div id="desktopCarousel" class="carousel slide d-none d-md-block" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            $count = 0;
            foreach ($cards as $data) {
                if (isset($data['image_url'])) {
                    if ($count % 3 == 0) {
                        echo '<div class="carousel-item' . ($count == 0 ? ' active' : '') . '">';
                        echo '<div class="row">';
                    }
                    ?>
                    <div class="col-md-4">
                        <img src="<?php echo $data['image_url']; ?>" class="d-block w-100 slider_image" alt="Image <?php echo $count + 1; ?>">
                        <div class="carousel-caption d-none d-md-block">
                            <h4 style="text-transform: uppercase;"><?php echo $data['post_title']; ?></h4>
                        </div>
                    </div>
                    <?php
                    $count++;
                    if ($count % 3 == 0 || $count == count($cards)) {
                        echo '</div>';
                        echo '</div>';
                    }
                }
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#desktopCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#desktopCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div id="mobileCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            $count = 0;
            foreach ($cards as $data) {
                if (isset($data['image_url'])) {
                    ?>
                    <div class="carousel-item<?php echo ($count == 0 ? ' active' : ''); ?>">
                        <img src="<?php echo $data['image_url']; ?>" class="d-block w-100 slider_image" alt="<?php echo $data['post_title']; ?>">
                        <div class="carousel-caption d-md-block">
                            <h4 style="text-transform: uppercase;"><?php echo $data['post_title']; ?></h4>
                        </div>
                    </div>
                    <?php
                    $count++;
                }
            }
            ?>
        </div>
        <a class="carousel-control-prev carousel-control1" href="#mobileCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next carousel-control1" href="#mobileCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
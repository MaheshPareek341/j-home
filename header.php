<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>J Home Furnishings</title>
    <link rel="icon" type="image/png" href="images/_57db7495-4caf-499d-8097-868b1e255999.jpg">
    <!-- fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700,700i">
    <!-- css -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/owl-carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="vendor/photoswipe/photoswipe.css">
    <link rel="stylesheet" href="vendor/photoswipe/default-skin/default-skin.css">
    <link rel="stylesheet" href="css/style.css?v=1.1">
    <!-- fontawesome -->
    <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Protest+Guerrilla&display=swap" rel="stylesheet">
   
   
</head>

<?php
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Load route definitions
// require_once __DIR__ . '/routes/web.php';
require_once __DIR__ . '/controllers/ContactController.php';

if (isset($routes[$requestUri])) {
    list($controllerName, $methodName) = $routes[$requestUri];

    $controller = new $controllerName();
    if (method_exists($controller, $methodName)) {
        $controller->$methodName();
    } else {
        echo "Method not found!";
    }
} else {
    http_response_code(404);
    echo "404 - Page Not Found";
}
?>

<body>
    <!-- mobilemenu -->
    <div class="mobilemenu" id="mobilemenu">
        <div class="mobilemenu__backdrop"></div>
        <div class="mobilemenu__container">
            <div class="mobilemenu__header">
                <div class="mobilemenu__title">Menu</div>
                <button class="mobilemenu__close" type="button">
                    <svg width="10px" height="10px">
                        <use xlink:href="images/sprite.svg#cross-10"></use>
                    </svg>
                </button>
            </div>
            <div class="mobilemenu__body">
                <ul class="mobilemenu__links mobilemenu__links--level--1" data-collapse
                    data-collapse-open-class="mobilemenu__item--open">
                    <li class="mobilemenu__item" data-collapse-item>
                        <a class="mobilemenu__link" href="index.php" onclick="myFunction()">Home</a>
                    </li>

                    <li class="mobilemenu__item mobilemenu__item--has-children" data-collapse-item>
                        <a class="mobilemenu__link" href="about-us.php" onclick="myFunction()">About Us </a>
                        </svg></button>
                    </li>
                    <li class="mobilemenu__item mobilemenu__item--has-children" data-collapse-item>
                        <a class="mobilemenu__link" href="index.php#catalogue" onclick="myFunction()">Catalogues </a>
                        </svg></button>
                    </li>
                    <li class="mobilemenu__item mobilemenu__item--has-children" data-collapse-item>
                        <a class="mobilemenu__link" href="index.php#products" onclick="myFunction()">Products </a>
                        </svg></button>
                    </li>
                    <li class="mobilemenu__item" data-collapse-item>
                        <a class="mobilemenu__link" href="contact-us.php">
                            Contact Us
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- mobilemenu / end -->
    <!-- site -->
    <div class="site">
        <div class="site__container">
            <header class="site__header fixed-top">
                <div class="header">
                    <div class="header__body">
                        <div class="row">
                            <div class="col-2">
                                <button class="header__mobilemenu" type="button" style="width:60px; height:54px">
                                    <svg width="22px" height="16px">
                                        <use xlink:href="images/sprite.svg#menu"></use>
                                    </svg>
                                </button>
                            </div>
                            
                            <div class="mainlogo col-10">
                                <a href="index.php" class="header__logo" style="justify-content:center; padding-top:10px; margin-top:5px">
                                    <!-- logo -->
                                   <img src="images/logo.png" id="logo">
                                    <!-- logo / end -->
                                </a>
                            </div>
                        </div>
                        
                       

                        <div class="row" style="width:100%; text-align:center">
                            <nav class="header__nav main-nav">
                            <ul class="main-nav__list">

                                <li class="main-nav__item">
                                    <a class="main-nav__link" href="index.php">
                                        Home
                                    </a>
                                </li>

                                <li class="main-nav__item main-nav__item--with--menu">
                                    <a class="main-nav__link" href="about-us.php">About Us </a>
                                </li>

                              
                                
                                <li class="main-nav__item main-nav__item--with--menu">
                                    <a class="main-nav__link" href="index.php#catalogue">
                                        Catalogues
                                    </a>
                                    <ul class="main-nav__sub-menu bg-white">
                                        <li><a href="catalogues.php?=DiningRoom">Dining Room</a></li>
                                        <li><a href="catalogues.php?=Bedroom">Bed Room</a></li>
                                        <li><a href="catalogues.php?=Occasional">Occasional</a></li>
                                    </ul>
                                </li>

                                <li class="main-nav__item"><a class="main-nav__link" href="index.php#products">
                                        Products
                                    </a>
                                </li>
                                <li class="main-nav__item"><a class="main-nav__link" href="contact-us.php">
                                        Contact Us
                                    </a>
                                </li>

                            </ul>
                        </nav>
                        </div>
                    </div>
                </div>
            </header>
            <!-- site__header / end -->
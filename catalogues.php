<?php include_once "header.php" ?>
<style>
@media (max-width: 600px) {
    .site__body > div {
        padding-top: 16px !important;
        margin: 0 4px !important;
    }
}
</style>
<div class="container-fluid">
    <div style="padding-top: 135px; padding-bottom: 30px;">
        <div class="row">
            <div class="col-2">
                <h3>PRODUCT</h3>
            </div>
            <div class="col-10">
                <div class="pb-2">
                    <?php
                        $route = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                        if (isset($_SERVER['QUERY_STRING']) && strpos($_SERVER['QUERY_STRING'], 'DiningRoom') !== false) {
                            echo "<h2>DiningRoom</h2>";
                        } else if (isset($_SERVER['QUERY_STRING']) && strpos($_SERVER['QUERY_STRING'], 'Bedroom') !== false) {
                            echo "<h2>Bedroom</h2>";
                        } else if (isset($_SERVER['QUERY_STRING']) && strpos($_SERVER['QUERY_STRING'], 'Occasional') !== false) {
                            echo "<h2>Occasional</h2>";
                        }
                    ?>
                </div>
                <div class="row">
                    <div class="col-3 p-1">
                        <div class="w-100 border border">
                            <div class="p-2 border border-bottom">
                                <img src="images/products/product10-1.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="p-2">
                                <h4>Bed</h4>
                                <p class="text-muted">500</p>
                            </div>
                            <div class="p-2 pt-0">
                                <button class="btn btn-primary w-100">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "footer.php" ?>
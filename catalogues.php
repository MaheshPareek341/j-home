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
            <div class="col-2"></div>
            <div class="col-10">
                <div class="pb-2" style="font-family: 'century-gothic' !important;">
                    <?php
                        $route = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                        if (isset($_SERVER['QUERY_STRING']) && strpos($_SERVER['QUERY_STRING'], 'DiningRoom') !== false) {
                            echo "<span style=\"font-size: 40px;\">DiningRoom</span>";
                        } else if (isset($_SERVER['QUERY_STRING']) && strpos($_SERVER['QUERY_STRING'], 'Bedroom') !== false) {
                            echo "<span style=\"font-size: 40px;\">Bedroom</span>";
                        } else if (isset($_SERVER['QUERY_STRING']) && strpos($_SERVER['QUERY_STRING'], 'Occasional') !== false) {
                            echo "<span style=\"font-size: 40px;\">Occasional</span>";
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <h3>Filter</h3>
                <ul class="list-unstyled">
                    <li><input type="checkbox" name="product[]" value="DiningRoom">&nbsp; Dining Room</li>
                    <li><input type="checkbox" name="product[]" value="Bedroom">&nbsp; Bedroom</li>
                    <li><input type="checkbox" name="product[]" value="Occasional">&nbsp; Occasional</li>
                </ul>
            </div>
            <div class="col-10">
                <div class="row">
                    <div class="col-3 p-1">
                        <div class="w-100 border border">
                            <div class="p-2 border border-bottom">
                                <img src="images/products/product10-1.jpg" class="img-fluid" alt="">
                            </div>
                            <!-- <div class="p-2">
                                <h4>Bed</h4>
                                <p class="text-muted">500</p>
                            </div>
                            <div class="p-2 pt-0">
                                <button class="btn btn-primary w-100">Add to Cart</button>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "footer.php" ?>
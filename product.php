<?php
session_start();
require 'config.php'; // Include your database configuration file

// Fetch single product from the database based on a parameter (e.g., product ID)
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        // Handle error if no product found
        $_SESSION['message'] = "Product not found!";
        $_SESSION['message_type'] = 'error';
        header('Location: index.php'); // Redirect to homepage or error page
        exit();
    }
} else {
    // Handle error if no product ID provided
    $_SESSION['message'] = "Product ID not provided!";
    $_SESSION['message_type'] = 'error';
    header('Location: index.php'); // Redirect to homepage or error page
    exit();
}

include('includes/header.php'); // Include your header
?>



<section id="banner" class="py-3" style="background: #F9F3EC;">
    <div class="container">
        <div class="hero-content py-5 my-3">
            <h2 class="display-1 mt-3 mb-0"><?php echo $product['name']; ?></h2>
            <nav class="breadcrumb">
                <a class="breadcrumb-item nav-link" href="#">Home</a>
                <span class="breadcrumb-item active" aria-current="page"><?php echo $product['name']; ?></span>
            </nav>
        </div>
    </div>
</section>

<section id="selling-product">
    <div class="container my-md-5 py-5">
        <div class="row g-md-5">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-md-12">
                        <!-- product-large-slider -->
                        <div class="swiper product-large-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="<?php echo $product['image_url']; ?>" class="img-fluid" />
                                </div>

                                <div class="swiper-slide">
                                    <img src="images/blog-lg3.jpg" class="img-fluid" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="images/blog-lg4.jpg" class="img-fluid" />
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <!-- product-thumbnail-slider -->
                        <div thumbsSlider="" class="swiper product-thumbnail-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="<?php echo $product['image_url']; ?>" class="img-fluid" />
                                </div>

                                <div class="swiper-slide">
                                    <img src="images/blog-lg3.jpg" class="img-fluid" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="images/blog-lg4.jpg" class="img-fluid" />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="col-lg-6 mt-5 ">
                <div class="product-info">
                    <div class="element-header">
                        <h2 itemprop="name" class="display-6"><?php echo $product['name']; ?></h2>

                    </div>
                    <div class="product-price pt-3 pb-3">
                        <strong class="text-primary display-6 fw-bold">$<?php echo $product['name']; ?></strong>
                    </div>
                    <p>Justo, cum feugiat imperdiet nulla molestie ac vulputate scelerisque amet. Bibendum adipiscing
                        platea
                        blandit sit sed quam semper rhoncus. Diam ultrices maecenas consequat eu tortor orci, cras
                        lectus mauris,
                        cras egestas quam venenatis neque.</p>
                    <div class="cart-wrap">
                        <div class="product-quantity pt-2">
                            <div class="stock-number text-dark"><em>Available in stock</em></div>
                            <div class="stock-button-wrap">
                                <form action="add-to-cart.php" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <div class="input-group product-qty align-items-center w-25">
                                        <span class="input-group-btn">
                                            <button type="button" class="quantity-left-minus btn btn-light btn-number"
                                                data-type="minus">
                                                <svg width="16" height="16">
                                                    <use xlink:href="#minus"></use>
                                                </svg>
                                            </button>
                                        </span>
                                        <input type="text" id="quantity" name="quantity"
                                            class="form-control input-number text-center p-2 mx-1" value="1">
                                        <span class="input-group-btn">
                                            <button type="button" class="quantity-right-plus btn btn-light btn-number"
                                                data-type="plus" data-field="">
                                                <svg width="16" height="16">
                                                    <use xlink:href="#plus"></use>
                                                </svg>
                                            </button>
                                        </span>
                                    </div>

                                    <div class="d-flex flex-wrap pt-4">
                                        <button type="submit" class="btn btn-outline-primary me-3 px-4 pt-3 pb-3">
                                            <h5 class="text-uppercase m-0">Add to Cart</h5>
                                        </button>
                                        <a href="#" class="btn-wishlist px-4 pt-3 ">
                                            <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="meta-product pt-4">
                        <div class="meta-item d-flex align-items-baseline">
                            <h6 class="item-title fw-bold no-margin pe-2">SKU:</h6>
                            <ul class="select-list list-unstyled d-flex">
                                <li data-value="S" class="select-item"><?php echo $product['id']; ?></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product-info-tabs py-md-5">
    <div class="container">
        <div class="row">
            <div class="d-flex flex-column flex-md-row align-items-start gap-5">
                <div class="nav flex-row flex-wrap flex-md-column nav-pills me-3 col-lg-3" id="v-pills-tab"
                    role="tablist" aria-orientation="vertical">
                    <button class="nav-link fs-5 mb-2 text-start active" id="v-pills-description-tab"
                        data-bs-toggle="pill" data-bs-target="#v-pills-description" type="button" role="tab"
                        aria-controls="v-pills-description" aria-selected="false" tabindex="-1">Description</button>
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade active show" id="v-pills-description" role="tabpanel"
                        aria-labelledby="v-pills-description-tab" tabindex="0">
                        <h2>Product Description</h2>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis
                            eros.
                            Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit, posuere a,
                            pede. Donec
                            nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean
                            dignissim
                            pellentesque felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer
                            ligula
                            vulputate sem tristique cursus.</p>
                        <ul style="list-style-type:disc;" class="list-unstyled ps-4">
                            <li>Donec nec justo eget felis facilisis fermentum.</li>
                            <li>Suspendisse urna viverra non, semper suscipit pede.</li>
                            <li>Aliquam porttitor mauris sit amet orci.</li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis
                            eros.
                            Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit, posuere a,
                            pede. Donec
                            nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean
                            dignissim
                            pellentesque felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer
                            ligula
                            vulputate sem tristique cursus. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('includes/footer.php') ?>
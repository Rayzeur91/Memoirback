<?php include('includes/header.php')?>
<?php
include 'config.php'; 

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

?>

<section id="banner" style="background: #F9F3EC;">
    <div class="container">
        <div class="swiper main-swiper">
            <div class="swiper-wrapper">

                <div class="swiper-slide py-5">
                    <div class="row banner-content align-items-center">
                        <div class="img-wrapper col-md-5">
                            <img src="images/banner-img.png" class="img-fluid">
                        </div>
                        <div class="content-wrapper col-md-7 p-5 mb-5">
                            <div class="secondary-font text-primary text-uppercase mb-4">Save 10 - 20 % off</div>
                            <h2 class="banner-title display-1 fw-normal">Best destination for <span
                                    class="text-primary">your
                                    pets</span>
                            </h2>
                            <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                                shop now
                                <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                                    <use xlink:href="#arrow-right"></use>
                                </svg></a>
                        </div>

                    </div>
                </div>
                <div class="swiper-slide py-5">
                    <div class="row banner-content align-items-center">
                        <div class="img-wrapper col-md-5">
                            <img src="images/banner-img3.png" class="img-fluid">
                        </div>
                        <div class="content-wrapper col-md-7 p-5 mb-5">
                            <div class="secondary-font text-primary text-uppercase mb-4">Save 10 - 20 % off</div>
                            <h2 class="banner-title display-1 fw-normal">Best destination for <span
                                    class="text-primary">your
                                    pets</span>
                            </h2>
                            <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                                shop now
                                <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                                    <use xlink:href="#arrow-right"></use>
                                </svg></a>
                        </div>

                    </div>
                </div>
                <div class="swiper-slide py-5">
                    <div class="row banner-content align-items-center">
                        <div class="img-wrapper col-md-5">
                            <img src="images/banner-img4.png" class="img-fluid">
                        </div>
                        <div class="content-wrapper col-md-7 p-5 mb-5">
                            <div class="secondary-font text-primary text-uppercase mb-4">Save 10 - 20 % off</div>
                            <h2 class="banner-title display-1 fw-normal">Best destination for <span
                                    class="text-primary">your
                                    pets</span>
                            </h2>
                            <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                                shop now
                                <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                                    <use xlink:href="#arrow-right"></use>
                                </svg></a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="swiper-pagination mb-5"></div>

        </div>
    </div>
</section>


<section id="bestselling" class="my-5 overflow-hidden">
    <div class="container py-5 mb-5">
        <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
            <h2 class="display-3 fw-normal">Products</h2>
            <div>
                <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                    shop now
                    <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                        <use xlink:href="#arrow-right"></use>
                    </svg>
                </a>
            </div>
        </div>

        <div class="swiper bestselling-swiper">
            <div class="swiper-wrapper">
                <?php if ($result->num_rows > 0) : ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="swiper-slide">
                    <div class="card position-relative">
                        <div class="product-image">
                            <a href="product.php?id=<?php echo $row['id']; ?>">
                                <img src="<?php echo $row['image_url']; ?>" class="img-fluid rounded-4"
                                    alt="<?php echo $row['name']; ?>">
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <a href="product.php?id=<?php echo $row['id']; ?>">
                                <h3 class="card-title pt-4 m-0"><?php echo $row['name']; ?></h3>
                            </a>
                            <div class="card-text">
                                <h3 class="secondary-font text-primary">$<?php echo number_format($row['price'], 2); ?>
                                </h3>
                                <div class="d-flex flex-wrap mt-3">
                                    <form action="add-to-cart.php" method="post">
                                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" class="btn btn-primary me-3 px-4 pt-3 pb-3">
                                            <h5 class="text-uppercase m-0">Add to Cart</h5>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php else : ?>
                <p>No products found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
$conn->close();
?>

<section id="testimonial" class="bg-dark">
    <div class="container my-2 py-2 ">
        <div class="row">
            <div class="offset-md-1 col-md-10">
                <div class="swiper testimonial-swiper">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="row ">
                                <div class="col-2">
                                    <iconify-icon icon="ri:double-quotes-l" class="quote-icon text-primary">
                                    </iconify-icon>
                                </div>
                                <div class="col-md-10 mt-md-5 p-5 pt-0 pt-md-5">
                                    <p class="testimonial-content fs-2">At the core of our practice is the idea that
                                        cities are the
                                        incubators of our
                                        greatest achievements, and the best hope for a sustainable future.</p>
                                    <p class="text-black">- Joshima Lin</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="row ">
                                <div class="col-2">
                                    <iconify-icon icon="ri:double-quotes-l" class="quote-icon text-primary">
                                    </iconify-icon>
                                </div>
                                <div class="col-md-10 mt-md-5 p-5 pt-0 pt-md-5">
                                    <p class="testimonial-content fs-2">At the core of our practice is the idea that
                                        cities are the
                                        incubators of our
                                        greatest achievements, and the best hope for a sustainable future.</p>
                                    <p class="text-black">- Joshima Lin</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="row ">
                                <div class="col-2">
                                    <iconify-icon icon="ri:double-quotes-l" class="quote-icon text-primary">
                                    </iconify-icon>
                                </div>
                                <div class="col-md-10 mt-md-5 p-5 pt-0 pt-md-5">
                                    <p class="testimonial-content fs-2">At the core of our practice is the idea that
                                        cities are the
                                        incubators of our
                                        greatest achievements, and the best hope for a sustainable future.</p>
                                    <p class="text-black">- Joshima Lin</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="swiper-pagination"></div>

                </div>
            </div>
        </div>
    </div>

</section>

<section id="service">
    <div class="container py-5 my-5">
        <div class="row g-md-5 pt-4">
            <div class="col-md-3 my-3">
                <div class="card">
                    <div>
                        <iconify-icon class="service-icon text-primary" icon="la:shopping-cart"></iconify-icon>
                    </div>
                    <h3 class="card-title py-2 m-0">Free Delivery</h3>
                    <div class="card-text">
                        <p class="blog-paragraph fs-6">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 my-3">
                <div class="card">
                    <div>
                        <iconify-icon class="service-icon text-primary" icon="la:user-check"></iconify-icon>
                    </div>
                    <h3 class="card-title py-2 m-0">100% secure payment</h3>
                    <div class="card-text">
                        <p class="blog-paragraph fs-6">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 my-3">
                <div class="card">
                    <div>
                        <iconify-icon class="service-icon text-primary" icon="la:tag"></iconify-icon>
                    </div>
                    <h3 class="card-title py-2 m-0">Daily Offer</h3>
                    <div class="card-text">
                        <p class="blog-paragraph fs-6">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 my-3">
                <div class="card">
                    <div>
                        <iconify-icon class="service-icon text-primary" icon="la:award"></iconify-icon>
                    </div>
                    <h3 class="card-title py-2 m-0">Quality guarantee</h3>
                    <div class="card-text">
                        <p class="blog-paragraph fs-6">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section id="insta" class="my-5">
    <div class="row g-0 py-5">
        <div class="col instagram-item  text-center position-relative">
            <div class="icon-overlay d-flex justify-content-center position-absolute">
                <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
            </div>
            <a href="#">
                <img src="images/insta1.jpg" alt="insta-img" class="img-fluid rounded-3">
            </a>
        </div>
        <div class="col instagram-item  text-center position-relative">
            <div class="icon-overlay d-flex justify-content-center position-absolute">
                <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
            </div>
            <a href="#">
                <img src="images/insta2.jpg" alt="insta-img" class="img-fluid rounded-3">
            </a>
        </div>
        <div class="col instagram-item  text-center position-relative">
            <div class="icon-overlay d-flex justify-content-center position-absolute">
                <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
            </div>
            <a href="#">
                <img src="images/insta3.jpg" alt="insta-img" class="img-fluid rounded-3">
            </a>
        </div>
        <div class="col instagram-item  text-center position-relative">
            <div class="icon-overlay d-flex justify-content-center position-absolute">
                <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
            </div>
            <a href="#">
                <img src="images/insta4.jpg" alt="insta-img" class="img-fluid rounded-3">
            </a>
        </div>
        <div class="col instagram-item  text-center position-relative">
            <div class="icon-overlay d-flex justify-content-center position-absolute">
                <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
            </div>
            <a href="#">
                <img src="images/insta5.jpg" alt="insta-img" class="img-fluid rounded-3">
            </a>
        </div>
        <div class="col instagram-item  text-center position-relative">
            <div class="icon-overlay d-flex justify-content-center position-absolute">
                <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
            </div>
            <a href="#">
                <img src="images/insta6.jpg" alt="insta-img" class="img-fluid rounded-3">
            </a>
        </div>
    </div>
</section>

<?php include('includes/footer.php') ?>
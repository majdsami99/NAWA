
    <!-- Start Trending Product Area -->
    <section class="trending-product section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>{{ $tittle }}</h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($product as $products )


                <div class="col-lg-3 col-md-6 col-12">
                    <x-product-card :product="$products" />

                </div>
                @endforeach

            </div>
        </div>
    </section>

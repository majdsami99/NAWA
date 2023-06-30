 <!-- Start Single Product -->
 <div class="single-product">
    <div class="product-image">
        <img src={{$products->image_url}} alt="#">
        <div class="button">
            <a href="{{route('shop.products.show',$products->$slug)}}" class="btn"><i class="lni lni-cart"></i> Add to Cart</a>
        </div>
    </div>
    <div class="product-info">
        <span class="category">Watches</span>
        <h4 class="title">
            <a href="{{route('shop.products.show',$products->$slug)}}">{{$products->name}}</a>
        </h4>
        <ul class="review">
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star"></i></li>
            <li><span>4.0 Review(s)</span></li>
        </ul>
        <div class="price">
            <span>{{$products->price_formatted}}</span>
            @if ($products->compare_price)
            <span class="discount-price">{{$products->compare_price_formatted}}</span>
            @endif
        </div>
    </div>
</div>
<!-- End Single Product -->

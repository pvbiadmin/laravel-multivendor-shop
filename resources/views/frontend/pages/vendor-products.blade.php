@extends( 'frontend.layouts.master' )

@section( 'title' )
    {{ $settings->site_name }} || Vendor Products
@endsection

@section( 'content' )
    <!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>vendor products</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">home</a></li>
                            <li><a href="javascript:">vendor products</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        PRODUCT PAGE START
    ==============================-->
    <section id="wsus__product_page">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__pro_page_bammer vendor_det_banner">
                        <img src="{{ asset('frontend/images/vendor_details_banner.jpg') }}" alt="banner"
                             class="img-fluid w-100">
                        <div class="wsus__pro_page_bammer_text wsus__vendor_det_banner_text">
                            <div class="wsus__vendor_text_center">
                                <h4>{{ $vendor->shop_name }}</h4>

                                <a href="callto:{{ $vendor->phone }}">
                                    <i class="far fa-phone-alt"></i> {{ $vendor->phone }}
                                </a>
                                <a href="mailto:{{ $vendor->email }}">
                                    <i class="far fa-envelope"></i> {{ $vendor->email }}
                                </a>
                                <p class="wsus__vendor_location">
                                    <i class="fal fa-map-marker-alt"></i> {{ $vendor->address }}
                                </p>
                                <ul class="d-flex">
                                    <li><a class="facebook" href="{{ $vendor->fb_link }}">
                                            <i class="fab fa-facebook-f"></i></a></li>
                                    <li><a class="twitter" href="{{ $vendor->tw_link }}">
                                            <i class="fab fa-twitter"></i></a></li>
                                    <li><a class="instagram" href="{{ $vendor->insta_link }}">
                                            <i class="fab fa-instagram"></i></a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- Buttons --}}
                    <div class="col-xl-12 d-none d-md-block mt-md-4 mt-lg-0">
                        <div class="wsus__product_topbar">
                            <div class="wsus__product_topbar_left">
                                <div class="nav nav-pills" id="v-pills-tab" role="tablist"
                                     aria-orientation="vertical">

                                    <button
                                        class="nav-link {{ session()->has('product_tab_view_style')
                                                && session('product_tab_view_style') === 'grid'
                                                ? 'active' : '' }} {{ !session()->has('product_tab_view_style')
                                                ? 'show active' : '' }} tab-view" data-id="grid" id="v-pills-home-tab"
                                        data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button"
                                        role="tab" aria-controls="v-pills-home" aria-selected="{{
                                                session('product_tab_view_style') === 'grid' ? 'true' : 'false' }}">
                                        <i class="fas fa-th"></i>
                                    </button>

                                    <button
                                        class="nav-link {{ session()->has('product_tab_view_style')
                                                && session('product_tab_view_style') === 'list' ? 'active' : ''
                                                }} tab-view" data-id="list" id="v-pills-profile-tab"
                                        data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button"
                                        role="tab" aria-controls="v-pills-profile" aria-selected="{{
                                                session('product_tab_view_style') === 'list' ? 'true' : 'false' }}">
                                        <i class="fas fa-list-ul"></i>
                                    </button>

                                </div>
                                {{--<div class="wsus__topbar_select">
                                    <select class="select_2" name="state">
                                        <option>default shorting</option>
                                        <option>short by rating</option>
                                        <option>short by latest</option>
                                        <option>low to high</option>
                                        <option>high to low</option>
                                    </select>
                                </div>--}}
                            </div>
                            {{--<div class="wsus__topbar_select">
                                <select class="select_2" name="state">
                                    <option>show 12</option>
                                    <option>show 15</option>
                                    <option>show 18</option>
                                    <option>show 21</option>
                                </select>
                            </div>--}}
                        </div>
                    </div>

                    {{-- Products --}}
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade {{ session()->has('product_tab_view_style')
                                && session('product_tab_view_style') === 'grid' ? 'show active' : '' }} {{
                                    !session()->has('product_tab_view_style') ? 'show active' : '' }}"
                             id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="row">
                                @if ( count($products) > 0 )
                                    @foreach ( $products as $product )
                                        <div class="col-xl-4 col-sm-6">
                                            <div class="wsus__product_item">
                                                <span class="wsus__new">
                                                        {{ productType($product->product_type) }}</span>
                                                @if ( hasDiscount($product) )
                                                    <span class="wsus__minus">
                                                    -{{ displayNumber(discountPercent($product->price,
                                                        $product->offer_price), 2) }}%</span>
                                                @endif
                                                <a class="wsus__pro_link"
                                                   href="{{ route('product-detail', $product->slug) }}">
                                                    <img src="{{ asset($product->thumb_image) }}"
                                                         alt="{{ $product->name }}"
                                                         class="img-fluid w-100 img_1"/>
                                                    <img src="@if ( isset($product->imageGallery[0]->image) )
                                                    {{ asset($product->imageGallery[0]->image) }}
                                                    @else
                                                    {{ asset($product->thumb_image) }}
                                                    @endif"
                                                         alt="{{ $product->name }}"
                                                         class="img-fluid w-100 img_2"/>
                                                </a>
                                                <ul class="wsus__single_pro_icon">
                                                    <li><a href="#" data-bs-toggle="modal"
                                                           data-bs-target="#exampleModal-{{ $product->id }}">
                                                            <i class="far fa-eye"></i></a></li>
                                                    <li><a href="javascript:" class="add-wishlist"
                                                           data-id="{{ $product->id }}">
                                                            <i class="far fa-heart"></i></a></li>
                                                    <li><a href="#"><i class="far fa-random"></i></a>
                                                </ul>
                                                <div class="wsus__product_details">
                                                    <a class="wsus__category"
                                                       href="#">{{ $product->category->name }}</a>
                                                    @php
                                                        $product = $product ?? null;

                                                        $count_reviews = count($product->reviews);
                                                        $average_rating = $product->reviews()->avg('rating');

                                                        $average_rating = $average_rating ?? 0;

                                                        // Check if $average_rating is a whole number
                                                        $is_whole_number = is_int($average_rating);

                                                        // If not a whole number, split it into integer and fractional parts
                                                        if (!$is_whole_number) {
                                                            $integer_part = floor($average_rating);
                                                            $fractional_part = $average_rating - $integer_part;
                                                        }
                                                    @endphp
                                                    <p class="wsus__pro_rating">
                                                        @if ( $is_whole_number )
                                                            {{-- Render full stars --}}
                                                            @for ( $i = 1; $i <= 5; $i++ )
                                                                @if ( $i <= $average_rating )
                                                                    <i class="fas fa-star"></i>
                                                                @else
                                                                    <i class="far fa-star"></i>
                                                                @endif
                                                            @endfor
                                                        @else
                                                            {{-- Render integer part as full stars --}}
                                                            @for ( $i = 1; $i <= $integer_part; $i++ )
                                                                <i class="fas fa-star"></i>
                                                            @endfor
                                                            {{-- Render fractional part as half star --}}
                                                            <i class="fas fa-star-half-alt"></i>
                                                            {{-- Render remaining empty stars --}}
                                                            @for ( $i = $integer_part + 1; $i < 5; $i++ )
                                                                <i class="far fa-star"></i>
                                                            @endfor
                                                        @endif
                                                        <span>({{ $count_reviews }} review{{
                                                                $count_reviews > 1 ? 's' : '' }})</span>
                                                    </p>
                                                    <a class="wsus__pro_name show-read-more-product-page"
                                                       href="{{ route('product-detail', $product->slug) }}">
                                                        {{ ucwords($product->name) }}</a>
                                                    @if ( hasDiscount($product) )
                                                        <p class="wsus__price">
                                                            {{ $settings->currency_icon }}{{
                                                                number_format($product->offer_price, 2) }}
                                                            <del>{{ $settings->currency_icon }}{{
                                                                number_format($product->price, 2) }}</del>
                                                        </p>
                                                    @else
                                                        <p class="wsus__price">
                                                            {{ $settings->currency_icon }}{{
                                                                number_format($product->price, 2) }}
                                                        </p>
                                                    @endif
                                                    <form class="cart-form">
                                                        <input type="hidden" name="product_id"
                                                               value="{{ $product->id }}">
                                                        <input type="hidden" name="quantity" value="1"/>
                                                        @foreach ( $product->variants as $variant )
                                                            @if ( $variant->status != 0 )
                                                                <select id="variant_{{ $variant->id }}"
                                                                        class="d-none" name="variant_options[]"
                                                                        aria-label="product_variant">
                                                                    @foreach (
                                                                        $variant->productVariantOptions as $option )
                                                                        @if ( $option->status != 0 )
                                                                            <option value="{{ $option->id }}"
                                                                                {{ $option->is_default == 1
                                                                                    ? 'selected' : '' }}>
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            @endif
                                                        @endforeach
                                                        <button type="submit" class="add_cart btn btn-primary">
                                                            Add to Cart
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-xl-12">
                                        <div class="wsus__product_item wsus__list_view">
                                            <div class="col-xl-6 col-md-10 col-lg-8 col-xxl-5 m-auto">
                                                <div class="wsus__404_text">
                                                    <p>No products to show</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="tab-pane fade {{ session()->has('product_tab_view_style')
                                && session('product_tab_view_style') === 'list' ? 'show active' : '' }}"
                             id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <div class="row">
                                @if ( count($products) > 0 )
                                    @foreach ( $products as $product )
                                        <div class="col-xl-12">
                                            <div class="wsus__product_item wsus__list_view">
                                                <span class="wsus__new">
                                                    {{ productType($product->product_type) }}</span>
                                                @if ( hasDiscount($product) )
                                                    <span class="wsus__minus">
                                                    -{{ displayNumber(discountPercent($product->price,
                                                        $product->offer_price), 2) }}%</span>
                                                @endif
                                                <a class="wsus__pro_link"
                                                   href="{{ route('product-detail', $product->slug) }}">
                                                    <img src="{{ asset($product->thumb_image) }}"
                                                         alt="{{ $product->name }}"
                                                         class="img-fluid w-100 img_1"/>
                                                    <img src="@if ( isset($product->imageGallery[0]->image) )
                                                    {{ asset($product->imageGallery[0]->image) }}
                                                    @else
                                                    {{ asset($product->thumb_image) }}
                                                    @endif"
                                                         alt="{{ $product->name }}"
                                                         class="img-fluid w-100 img_2"/>
                                                </a>
                                                <div class="wsus__product_details">
                                                    <a class="wsus__category" href="#">
                                                        {{ $product->category->name }}</a>
                                                    @php
                                                        $product = $product ?? null;

                                                        $count_reviews = count($product->reviews);
                                                        $average_rating = $product->reviews()->avg('rating');

                                                        $average_rating = $average_rating ?? 0;

                                                        // Check if $average_rating is a whole number
                                                        $is_whole_number = is_int($average_rating);

                                                        // If not a whole number, split it into integer and fractional parts
                                                        if (!$is_whole_number) {
                                                            $integer_part = floor($average_rating);
                                                            $fractional_part = $average_rating - $integer_part;
                                                        }
                                                    @endphp
                                                    <p class="wsus__pro_rating">
                                                        @if ( $is_whole_number )
                                                            {{-- Render full stars --}}
                                                            @for ( $i = 1; $i <= 5; $i++ )
                                                                @if ( $i <= $average_rating )
                                                                    <i class="fas fa-star"></i>
                                                                @else
                                                                    <i class="far fa-star"></i>
                                                                @endif
                                                            @endfor
                                                        @else
                                                            {{-- Render integer part as full stars --}}
                                                            @for ( $i = 1; $i <= $integer_part; $i++ )
                                                                <i class="fas fa-star"></i>
                                                            @endfor
                                                            {{-- Render fractional part as half star --}}
                                                            <i class="fas fa-star-half-alt"></i>
                                                            {{-- Render remaining empty stars --}}
                                                            @for ( $i = $integer_part + 1; $i < 5; $i++ )
                                                                <i class="far fa-star"></i>
                                                            @endfor
                                                        @endif
                                                        <span>({{ $count_reviews }} review{{
                                                                $count_reviews > 1 ? 's' : '' }})</span>
                                                    </p>
                                                    <a class="wsus__pro_name"
                                                       href="{{ route('product-detail', $product->slug) }}">
                                                        {{ ucwords($product->name) }}</a>
                                                    @if( hasDiscount($product) )
                                                        <p class="wsus__price">
                                                            {{ $settings->currency_icon }}{{
                                                                number_format($product->offer_price, 2) }}
                                                            <del>{{ $settings->currency_icon }}{{
                                                                number_format($product->price, 2) }}</del>
                                                        </p>
                                                    @else
                                                        <p class="wsus__price">
                                                            {{ $settings->currency_icon }}{{
                                                                number_format($product->price, 2) }}
                                                        </p>
                                                    @endif
                                                    <p class="list_description">
                                                        {!! $product->short_description !!}</p>
                                                    <ul class="wsus__single_pro_icon">
                                                        <li>
                                                            <form class="cart-form">
                                                                <input type="hidden" name="product_id"
                                                                       value="{{ $product->id }}">
                                                                <input type="hidden" name="quantity" value="1"/>
                                                                @foreach ( $product->variants as $variant )
                                                                    @if ( $variant->status != 0 )
                                                                        <select id="variant_{{ $variant->id }}"
                                                                                class="d-none"
                                                                                name="variant_options[]"
                                                                                aria-label="product_variant">
                                                                            @foreach (
                                                                                $variant->productVariantOptions as $option )
                                                                                @if ( $option->status != 0 )
                                                                                    <option
                                                                                        value="{{ $option->id }}"
                                                                                        {{ $option->is_default == 1
                                                                                            ? 'selected' : '' }}>
                                                                                    </option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    @endif
                                                                @endforeach
                                                                <button type="submit" class="add_cart_list">
                                                                    Add to Cart
                                                                </button>
                                                            </form>
                                                        </li>
                                                        <li><a href="javascript:" class="add-wishlist"
                                                               data-id="{{ $product->id }}">
                                                                <i class="far fa-heart"></i></a></li>
                                                        <li><a href="#"><i class="far fa-random"></i></a>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-xl-12">
                                        <div class="wsus__product_item wsus__list_view">
                                            <div class="col-xl-6 col-md-10 col-lg-8 col-xxl-5 m-auto">
                                                <div class="wsus__404_text">
                                                    <p>No products to show</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pagination --}}
                <div class="col-xl-12">
                    @if ( $products->hasPages() )
                        {{ $products->withQueryString()->links() }}
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!--============================
        PRODUCT PAGE END
    ==============================-->

    @foreach ( $products as $product )
        <section class="product_popup_modal">
            <div class="modal fade" id="exampleModal-{{ $product->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"><i class="far fa-times"></i></button>
                            <div class="row">
                                <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
                                    <div class="wsus__quick_view_img">
                                        @if ( $product->video_link )
                                            <a class="venobox wsus__pro_det_video"
                                               data-autoplay="true" data-vbtype="video"
                                               href="{{ $product->video_link }}">
                                                <i class="fas fa-play"></i>
                                            </a>
                                        @endif
                                        <div class="row modal_slider">
                                            @if ( count($product->imageGallery) === 0 )
                                                <div class="col-xl-12">
                                                    <div class="modal_slider_img">
                                                        <img src="{{ asset($product->thumb_image) }}"
                                                             alt="{{ $product->name }}"
                                                             class="img-fluid w-100">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="modal_slider_img">
                                                        <img src="{{ asset($product->thumb_image) }}"
                                                             alt="{{ $product->name }}"
                                                             class="img-fluid w-100">
                                                    </div>
                                                </div>
                                            @else
                                                @foreach ( $product->imageGallery as $image )
                                                    <div class="col-xl-12">
                                                        <div class="modal_slider_img">
                                                            <img src="{{ asset($image->image) }}"
                                                                 alt="{{ $product->name }}"
                                                                 class="img-fluid w-100">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
                                    <div class="wsus__pro_details_text">
                                        <a class="title" href="{{ route('product-detail', $product->slug) }}">
                                            {{ $product->name }}</a>
                                        <p class="wsus__stock_area">
                                            <span class="in_stock">in stock</span> (167 item)
                                        </p>
                                        @if ( hasDiscount($product) )
                                            <h4>
                                                {{ $settings->currency_icon }}{{
                                                    number_format($product->offer_price, 2) }}
                                                <del>{{ $settings->currency_icon }}{{
                                                    number_format($product->price, 2) }}</del>
                                            </h4>
                                        @else
                                            <h4>
                                                {{ $settings->currency_icon }}{{ number_format($product->price, 2) }}
                                            </h4>
                                        @endif
                                        @php
                                            $product = $product ?? null;

                                            $count_reviews = count($product->reviews);
                                            $average_rating = $product->reviews()->avg('rating');

                                            $average_rating = $average_rating ?? 0;

                                            // Check if $average_rating is a whole number
                                            $is_whole_number = is_int($average_rating);

                                            // If not a whole number, split it into integer and fractional parts
                                            if (!$is_whole_number) {
                                                $integer_part = floor($average_rating);
                                                $fractional_part = $average_rating - $integer_part;
                                            }
                                        @endphp
                                        <p class="review">
                                            @if ( $is_whole_number )
                                                {{-- Render full stars --}}
                                                @for ( $i = 1; $i <= 5; $i++ )
                                                    @if ( $i <= $average_rating )
                                                        <i class="fas fa-star"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif
                                                @endfor
                                            @else
                                                {{-- Render integer part as full stars --}}
                                                @for ( $i = 1; $i <= $integer_part; $i++ )
                                                    <i class="fas fa-star"></i>
                                                @endfor
                                                {{-- Render fractional part as half star --}}
                                                <i class="fas fa-star-half-alt"></i>
                                                {{-- Render remaining empty stars --}}
                                                @for ( $i = $integer_part + 1; $i < 5; $i++ )
                                                    <i class="far fa-star"></i>
                                                @endfor
                                            @endif
                                            <span>{{ $count_reviews }} review{{ $count_reviews > 1 ? 's' : '' }}</span>
                                        </p>
                                        <p class="description">{!! $product->short_description !!}</p>

                                        @if ( hasDiscount($product) )
                                            <div class="wsus_pro_hot_deals">
                                                <h5>offer ending time : </h5>
                                                <div class="simply-countdown simply-countdown-one"></div>
                                            </div>
                                        @endif

                                        <form class="cart-form">
                                            <div class="wsus__selectbox">
                                                <div class="row">
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    @foreach ( $product->variants as $variant )
                                                        @if ( $variant->status != 0 )
                                                            <div class="col-xl-6 col-sm-6">
                                                                <h5 class="mb-2">
                                                                    <label for="variant_{{ $variant->id }}">
                                                                        {{ $variant->name }}:</label>
                                                                </h5>
                                                                <select id="variant_{{ $variant->id }}"
                                                                        class="select_2" name="variant_options[]">
                                                                    @foreach (
                                                                        $variant->productVariantOptions as $option )
                                                                        @if ( $option->status != 0 )
                                                                            <option value="{{ $option->id }}" {{
                                                                                $option->is_default ? 'selected' : ''
                                                                                }}>{{ $option->name }} {{
                                                                            $option->price > 0 ? '(' .
                                                                            $settings->currency_icon .
                                                                                number_format($option->price, 2) .
                                                                                    ')' : '' }}
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="wsus__quentity">
                                                <h5><label for="quantity">quantity:</label></h5>
                                                <div class="select_number">
                                                    <input class="number_area" id="quantity" name="quantity"
                                                           type="text" min="1" max="100" value="1"/>
                                                </div>
                                                <h3>{{ $settings->currency_icon }}{{
                                                    number_format($product->price, 2) }}</h3>
                                            </div>
                                            <ul class="wsus__button_area">
                                                <li>
                                                    <button type="submit" class="add_cart btn btn-primary">
                                                        Add to Cart
                                                    </button>
                                                </li>
                                                <li><a class="buy_now" href="#">Buy Now</a></li>
                                                <li><a href="javascript:" class="add-wishlist"
                                                       data-id="{{ $product->id }}"><i class="fal fa-heart"></i></a>
                                                </li>
                                                <li><a href="#"><i class="far fa-random"></i></a></li>
                                            </ul>
                                        </form>

                                        <p class="brand_model">
                                            <span>category :</span> {{ $product->category->name }}
                                        </p>
                                        <p class="brand_model"><span>brand :</span> {{ $product->brand->name }}</p>
                                        @if (
                                            $product->vendor->fb_link
                                            || $product->vendor->yt_link
                                            || $product->vendor->tw_link
                                            || $product->vendor->insta_link
                                        )
                                            <div class="wsus__pro_det_share">
                                                <h5>share :</h5>
                                                <ul class="d-flex">
                                                    @if ( $product->vendor->fb_link )
                                                        <li><a class="facebook"
                                                               href="{{ $product->vendor->fb_link }}">
                                                                <i class="fab fa-facebook-f"></i></a></li>
                                                    @endif
                                                    @if ( $product->vendor->tw_link )
                                                        <li><a class="twitter"
                                                               href="{{ $product->vendor->tw_link }}">
                                                                <i class="fab fa-twitter"></i></a></li>
                                                    @endif
                                                    @if ( $product->vendor->yt_link )
                                                        <li><a class="youtube"
                                                               href="{{ $product->vendor->yt_link }}">
                                                                <i class="fab fa-youtube"></i></a></li>
                                                    @endif
                                                    @if ( $product->vendor->fb_link )
                                                        <li><a class="instagram"
                                                               href="{{ $product->vendor->fb_link }}">
                                                                <i class="fab fa-instagram"></i></a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endsection

@push( 'scripts' )
    <script>
        ($ => {
            $(() => {
                const tabView = () => {
                    $("body").on("click", ".tab-view", e => {
                        const $this = $(e.currentTarget);
                        let style = $this.data("id");

                        $.ajax({
                            method: "GET",
                            url: "{{ route('change-product-tab-view') }}",
                            data: {style: style},
                            success: response => {
                                console.log(response);
                            },
                            error: (xhr, status, error) => {
                                console.log(error);
                            }
                        });
                    });
                };

                @php
                    $from = 0;
                    $to = 8000;

                    if (request()->has('range')) {
                        $price = explode(';', request()->range);
                        $from = $price[0];
                        $to = $price[1];
                    }
                @endphp

                $("#slider_range").flatslider({
                    min: 0, max: 10000,
                    step: 100,
                    values: [{{ $from }}, {{ $to }}],
                    range: true,
                    einheit: '{{ $settings->currency_icon }}'
                });

                tabView();
            });
        })(jQuery);
    </script>
@endpush

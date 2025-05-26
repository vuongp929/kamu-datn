@extends('layouts.client')

@section('title', 'CHILL FRIEND')

@section('CSS')
    <link rel="stylesheet" href="{{ asset('assets/user/css/shop-index.css') }}">
    <style>
        .banner{
            display: flex !important;
            align-items: center;
            justify-content: center;
        }
    </style>
@endsection

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container">
    <div class="banner mb-5" data-copy-text="vuong" onclick="copyToClipboard(this)">
        <img src="https://teddy.vn/wp-content/uploads/2024/01/banner-thuong_DC.jpg" alt="Banner" class="img-fluid rounded" style="width:1200px">
    </div>

    <div class="featured-products">
        <h2>Sản phẩm nổi bật</h2>
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3">
                    <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none">
                        <div class="card">
                            <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title text-truncate" title="{{ $product->name }}">{{ $product->name }}</h5>
                            </a>
                                <form action="{{ route('cart.add') }}" method="POST" class="ajax-add-to-cart">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" id="selected-size-{{ $product->id }}" name="size"
                                           value="{{ optional($product->variants->first())->id ?? '' }}">
                                    <div class="size-buttons">
                                        @foreach ($product->variants as $variant)
                                            <button type="button" class="size-button"
                                                data-size-id="{{ $variant->id }}"
                                                data-price="{{ $variant->price }}"
                                                onclick="selectSize({{ $product->id }}, this)">
                                                {{ $variant->size }}
                                            </button>
                                        @endforeach
                                    </div>
                                    <p class="price mt-2">
                                        Giá: <span id="product-price-{{ $product->id }}">{{ number_format(optional($product->variants->first())->price ?? 0) }} VND</span>
                                    </p>
                                    <button type="submit" class="btn btn-add btn-block mt-3">Thêm vào giỏ</button>
                                </form>
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('JS')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function copyToClipboard(element) {
        const text = element.getAttribute('data-copy-text');
        if (!text) return;

        const tempInput = document.createElement('input');
        tempInput.value = text;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);

        alert('Đã sao chép: ' + text);
    }

    document.addEventListener('DOMContentLoaded', function () {
    // Lấy tất cả các form trong trang có class 'ajax-form'
    const ajaxForms = document.querySelectorAll('form.ajax-form');
    
    ajaxForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            let form = $(this);
            let formData = form.serialize();
            let actionUrl = form.attr('action');

            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        alert('Sản phẩm đã được thêm vào giỏ hàng!');
                        $('.cart-count').text(response.cart_count);
                    } else {
                        alert(response.message || 'Có lỗi xảy ra.');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Không thể thêm sản phẩm vào giỏ hàng!');
                }
            });
        });
    });
    });
</script>

@endsection

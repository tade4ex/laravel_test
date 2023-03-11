@extends('layouts.app')

@section('content')
    <div class="container">
        @if($products->count() == 0)
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        No products.
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-4">
                                <div class="card mb-3" style="max-width: 540px;">
                                    <div class="row g-0">
                                        <div class="col-12 mt-2 text-center">
                                            <figure class="figure">
                                                <img src="{!! $product->photo !!}" class="figure-img img-fluid rounded"
                                                     alt="{{ $product->description }}">
                                            </figure>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                                <p class="card-text">
                                                    @foreach($product->tags as $tag)
                                                        <span class="badge bg-primary mr-2">{{ $tag->title }}</span>
                                                    @endforeach
                                                </p>
                                                <h5 class="card-title">{{ $product->sku }}</h5>
                                                <p class="card-text">{{ $product->description }}</p>
                                                <div class="d-flex w-100 justify-content-between">
                                                    <div>Stock: {{ $product->stocks_sum_stock ?? 0 }}</div>
                                                    <a href="{!! route('product.show', ['sku' => $product->sku]); !!}"
                                                       class="btn btn-primary">Product details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-12">
                        <nav>
                            <ul class="pagination pagination-sm justify-content-center">
                                <li class="page-item{{$products->onFirstPage() ? ' disabled' : ''}}" {{$products->onFirstPage() ? 'aria-current="page"' : ''}}>
                                    <a class="page-link" href="{!! $products->previousPageUrl() !!}">Previous</a>
                                </li>

                                @for($page = 1; $page <= $products->lastPage(); $page++)
                                    @php($currentPage =  $products->currentPage() == $page)
                                    <li class="page-item{{$currentPage ? ' active' : ''}}" {{$currentPage ? 'aria-current="page"': ''}}>
                                        <a class="page-link" href="{!! $products->url($page) !!}">{{ $page }}</a>
                                    </li>
                                @endfor

                                <li class="page-item{{$products->onLastPage() ? ' disabled' : ''}}" {{$products->onLastPage() ? 'aria-current="page"' : ''}}>
                                    <a class="page-link" href="{!! $products->nextPageUrl() !!}">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <h5 class="card-header">Top 10 tags</h5>
                        <div class="card-body">
                            <dl class="row">
                                @foreach($topTenTags as $tag)
                                    <dt class="col-sm-9">{{ $tag->title }}</dt>
                                    <dd class="col-sm-3">{{ $tag->stocks_sum_stock }}</dd>
                                @endforeach
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

        @endif
    </div>
@endsection

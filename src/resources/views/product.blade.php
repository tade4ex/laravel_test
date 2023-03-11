@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <img src="{!! $product->photo !!}" class="img-thumbnail" alt="{{ $product->description }}">
            </div>
            <div class="col-9">
                <h5>Description</h5>
                <p>{{ $product->description }}</p>
                <hr>
                @if($product->tags->count() > 0)
                    <h5>Tags:</h5>
                    @foreach($product->tags as $tag)
                        <span class="badge bg-primary mr-2">{{ $tag->title }}</span>
                    @endforeach
                    <hr>
                @endif
                <h5>Stock:</h5>
                @if($product->stocks->count() > 0)
                    <dl class="row">
                        @foreach($product->stocks as $stock)
                            <dt class="col-sm-3">{{ $stock->city }}</dt>
                            <dd class="col-sm-9">{{ $stock->stock }}</dd>
                        @endforeach
                    </dl>
                @else
                    <div class="alert alert-danger" role="alert">
                        Empty
                    </div>
                @endif
            </div>
        </div>
        @if(url()->previous() != url()->current())
            <div class="row">
                <div class="col-12">
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        @endif
    </div>
@endsection

@extends('layouts.default')
@section('content')
    <edit-product-view
        :product="{{ json_encode($product, null) }}"
    />
@endsection

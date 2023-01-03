@extends('layouts.default')
@section('content')
<product-view :product="{{ json_encode($product, null) }}" />
@endsection
@extends('templates.template')
@section('content')


@foreach ($pedidos as $pedido)
    {{$pedido->idproduto}}
@endforeach

@endsection
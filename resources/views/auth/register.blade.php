@extends('layouts.empty')
@section('title', 'Connection')
@section('app_name', 'SimplesMailer')
@section('content')

<x-cards.cardadminlte
  title="Connection"
>
  <x-inputs.input 
    name = "name"
    type = "text"
    required = "true"
    icon = "user"
    value
    placeholder
    autofocus>
  </x-inputs.input>

</x-cards.cardadminlte>
@endsection
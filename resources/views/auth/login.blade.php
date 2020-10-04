@extends('layouts.empty')
@section('content')
  <x-cards.cardadminlte
  title="Connexion"
  > 
    <x-forms.loginForm
       route="login"
    >
    </x-forms.loginForm>
  </x-cards.cardadminlte> 
@endsection



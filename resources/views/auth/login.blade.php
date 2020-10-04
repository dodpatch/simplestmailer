@extends('layouts.empty')
@section('content')
 <x-cards.cardadminlte 
 title="Connextion"
 > 
 <x-inputs.input
    name="firstname"
    type="text"
    icon="person"
    label="Prénom"
    placeholder="Prénom"
    required="true"
  ></x-inputs.input>
 
 </x-cards.cardadminlte> 
@endsection


@extends('layouts.app')

@section('content')
<div class="container">
    
    <question-page :question="{{ $question }}"></question-page>
  
</div>
@endsection
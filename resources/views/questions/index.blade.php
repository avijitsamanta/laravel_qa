@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                 <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Questions</h2>
                        <div class="ml-auto">
                            <a href="{{ route('question.create') }}" class="btn btn-outline-secondary">Ask Question</a>                           
                            <a href="{{ route('taskpage') }}" class="btn btn-outline-secondary">Task</a>

                        </div>
                    </div>

                </div>

                <div class="card-body">
                    @include ('layouts._messages')
                   @include('questions._excerpt')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
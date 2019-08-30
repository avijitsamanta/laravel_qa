@if($model instanceof App\Question)

@php

$name = 'question';

$uriSegment = 'questions';

@endphp

@elseif($model instanceof App\Answer)

@php

$name = 'answer';

$uriSegment = 'answers';

@endphp

@endif




<div class="d-fex flex-column vote-controls">

    <a title="This {{ $name }} is useful" class="vote-up {{ Auth::guest() ? 'off' : '' }}"

       onclick="event.preventDefault(); document.getElementById('vote-{{ $name }}-up-{{ $model->id }}').submit();" >
        <i class="fas fa-caret-up fa-3x"></i>
    </a>

    <form id="vote-{{ $name }}-up-{{ $model->id }}" action="/{{ $uriSegment }}/{{ $model->id }}/vote" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>

    <span class="votes-count">{{ $model->votes_count }}</span>

    <a title="This {{ $name }} is not useful" 
       class="vote-down off "
       onclick="event.preventDefault(); document.getElementById('vote-{{ $name }}-down-{{ $model->id }}').submit();" >
        <i class="fas fa-caret-down fa-3x"></i>
    </a>
    <form id="vote-{{ $name }}-down-{{ $model->id }}" action="/{{ $uriSegment }}/{{ $model->id }}/vote" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>
    @if($model instanceof App\Question)
     <favorite :question="{{ $model }}"></favorite>
    @elseif($model instanceof App\Answer)
     <accept :answer="{{ $model }}"></accept>
    @endif
</div>
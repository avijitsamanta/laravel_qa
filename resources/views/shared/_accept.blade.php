@can ('accept', $answer)
<a title="Mark this answer as best answer" 
   class="{{ $answer->status }} mt-2"
   onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit();"
   >
    <i class="fas fa-check fa-2x"></i>                                    
</a>
<form id="accept-answer-{{ $answer->id }}" action="{{ route('answer.accept', $answer->id) }}" method="POST" style="display:none;">
    @csrf
</form>
@else
@if ($answer->is_best)
<a title="The question owner accepted this answer as best answer" 
   class="{{ $answer->status }} mt-2"                                        
   >
    <i class="fas fa-check fa-2x"></i>                                    
</a>
@endif
@endcan
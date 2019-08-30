@forelse ($questions as $question)
                    
                        <div class="media post">
                            <div class="d-flex flex-column counters">
                                <div class="vote">
                                    <strong>{{ $question->votes_count }}</strong> {{ str_plural('vote', $question->votes_count) }}
                                </div>                            
                                <div class="status {{ $question->status }}">
                                    <strong>{{ $question->answers_count }}</strong> {{ str_plural('answer', $question->answers_count) }}
                                </div>                            
                                <div class="view">
                                    {{ $question->views . " " . str_plural('view', $question->views) }}
                                </div>                            
                            </div>
                            <div class="media-body">
                                <div class="d-flex align-items-center">
                                    <h3 class="mt-0"><a href="{{ $question->url }}">{{ $question->title }}</a></h3>
                                    
                                    <div class="ml-auto">
                                        
                                        @can('update',$question)
                                        
                                            <a href="{{ route('question.edit', $question->id) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                        @endcan
                                        @can('delete',$question)
                                        <form action="{{ route('question.destroy',$question->id) }}" method="post" class="form-delete">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure')">Delete</button>
                                        </form>
                                         @endcan
                                    </div>
                                </div>
                                 <p class="lead">
                                    Asked by 
                                    <a href="{{ $question->user->url }}">{{ $question->user->name }}</a> 
                                    <small class="text-muted">{{ $question->created_date }}</small>
                                </p>
                                <div> {{ $question->excerpt(350) }}</div>
                            </div>                        
                        </div>
                       
                        @empty
                        <div class="alert alert-danger">
                            <strong>Sorry!</strong> There are no question available.
                        </div>
                     @endforelse

                    
                        {{ $questions->links() }}
                   
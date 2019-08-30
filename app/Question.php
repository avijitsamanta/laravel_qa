<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

use App\Answer;

class Question extends Model
{
    use VotableTrait;
    protected $fillable = ['title', 'body'];
    protected $appends =['created_date','is_favorited','favorite_count','body_html'];


    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }
    
    public function getUrlAttribute() {
        
        return route("question.show", $this->slug);
        
    }
    
    public function getCreatedDateAttribute() {
        
        return $this->created_at->diffForHumans();
    }
    
    public function getStatusAttribute($param) {
        
        if($this->answers_count > 0)
        {
            if($this->best_answer_id)
            {
                return "answered-accepted";
            }
            
            return "answered";
        }
        return "unanswered";
    }
    
    public function getBodyHtmlAttribute() {
        
        return clean($this->bodyHtml());
        
    }
    
    public function answers() {
        
        return $this->hasMany(Answer::class)->OrderBy('votes_count','DESC');
        
    }
    
    public function acceptBestAnswer(Answer $answer) {
        
        $this->best_answer_id = $answer->id;
        
        $this->save();
    }
    
    public function favorites()
    {
        return $this->belongsToMany(User::class,'favorites')->withTimestamps();
    }
    
    public function getIsFavoritedAttribute() {
        
        return $this->favorites()->where('user_id',auth()->id())->count() >0;
        
    }
    
    public function getFavoriteCountAttribute() {
        
        return $this->favorites()->count();
        
    }
    public function getExcerptAttribute() {
        
        return $this->excerpt(250);
    }
    public function excerpt($length){
     
        return str_limit(strip_tags($this->bodyHtml()),$length);
    }
    
    private function bodyHtml()
    {
        return \Parsedown::instance()->text($this->body);
    }
}

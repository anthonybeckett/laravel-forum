<?php

namespace App\Models;

use App\Notifications\MarkedAsBestReply;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function markAsBestReply(Reply $reply){
        $this->update([
            'reply_id' => $reply->id
        ]);

        if($reply->user->id !== $this->user->id){
            $reply->user->notify(new MarkedAsBestReply($reply->discussion));
        }
    }

    public function bestReply(){
        return $this->belongsTo(Reply::class, 'reply_id');
    }

    public function scopeFilterByChannels($builder){
        if(request()->query('channel')){
            $channel = Channel::where('slug', request()->query('channel'))->first();

            if($channel){
                return $builder->where('channel_id', $channel->id);
            }
        }

        return $builder;
    }
}

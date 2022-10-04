<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "target_id",
        "target_type",
        "message"
    ];

    public function getUser(){
        return User::find($this->user_id);
    }

    public function getTarget(){
        if($this->target_type == "resume"){
            $resume = Resume::find($this->target_id);
            if($resume != null){
                return $resume;
            }else{
                abort(404, "Response@getTarget(invalid target_id)");
            }
        }
        abort(401, "Response@getTarget(invalid target type)");
    }
}

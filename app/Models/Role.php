<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doc_id',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id')->withDefault();
    }

    public function doc(){
        return $this->belongsTo(Document::class,'doc_id')->withDefault();
    }
}

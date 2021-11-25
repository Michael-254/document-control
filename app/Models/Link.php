<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'children_id',
    ];

    public function parent(){
        return $this->belongsTo(Document::class,'children_id');
    }
}

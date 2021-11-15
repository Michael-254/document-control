<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date_created',
        'revision_status',
        'person_incharge',
        'document_creator',
        'location',
        'revisor',
        'approver',
        'department',
        'file',
    ];
}

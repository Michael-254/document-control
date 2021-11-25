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
        'uploader_comment',
        'location',
        'revisor',
        'status',
        'department',
        'document_no',
        'HOD_revisor',
        'HOD_date',
        'HOD_comment',
        'QC_revisor',
        'QC_date',
        'QC_comment',
        'MD_approver',
        'MD_date',
        'MD_comment',
        'implementor',
        'implementor_date',
        'implementor_comment',
        'implementation_date',
        'file',
    ];

    public function depart():string
    {
        return [
            'IT' => 'IT',
            'Forestry' => 'FR',
            'Operations' => 'OP',
            'HR' => 'HR',
            'Communications' => 'COM',
            'Miti Magazine' => 'MITI',
            'Accounts' => 'ACC',
            'ME' => 'M&E',
        ][$this->department] ?? '$';
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('document_no', 'like', $term)
                  ->orWhere('title', 'like', $term)
                  ->orWhere('department', 'like', $term)
                  ->orWhere('file', 'like', $term);
        });
    }

    public function links(){
        return $this->hasMany(Link::class,'parent_id');
    }

    public function creator(){
        return $this->belongsTo(User::class,'document_creator');
    }

    public function personIncharge(){
        return $this->belongsTo(User::class,'person_incharge');
    }

    public function HOD(){
        return $this->belongsTo(User::class,'HOD_revisor');
    }

    public function QC(){
        return $this->belongsTo(User::class,'QC_revisor');
    }

    public function MD(){
        return $this->belongsTo(User::class,'MD_approver');
    }

}

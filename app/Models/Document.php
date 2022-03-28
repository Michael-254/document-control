<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'date_created',
        'revision_status',
        'person_incharge',
        'document_creator',
        'uploader_comment',
        'location',
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

    public function depart(): string
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
        ][$this->department] ?? 'IT';
    }

    public function HODEmail(): string
    {
        return [
            'IT' => 'jpd@betterglobeforestry.com',
            'Forestry' => 'samuel@betterglobeforestry.com',
            'Operations' => 'lawrence@betterglobeforestry.com',
            'HR' => 'jpd@betterglobeforestry.com',
            'Communications' => 'jpd@betterglobeforestry.com',
            'Miti Magazine' => 'jan@betterglobeforestry.com',
            'Accounts' => 'lawrence@betterglobeforestry.com',
            'ME' => 'lawrence@betterglobeforestry.com',
        ][$this->department] ?? 'jpd@betterglobeforestry.com';
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('document_no', 'like', $term)
                ->orWhere('title', 'like', $term)
                ->orWhere('location', 'like', $term)
                ->orWhere('uploader_comment', 'like', $term)
                ->orWhere('HOD_comment', 'like', $term)
                ->orWhere('QC_comment', 'like', $term)
                ->orWhere('MD_comment', 'like', $term)
                ->orWhere('implementation_date', 'like', $term)
                ->orWhere('department', 'like', $term)
                ->orWhere('status', 'like', $term)
                ->orWhere('file', 'like', $term);
        });
    }

    public function links()
    {
        return $this->hasMany(Link::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'document_creator')->withDefault();
    }

    public function personIncharge()
    {
        return $this->belongsTo(User::class, 'person_incharge')->withDefault();
    }

    public function HOD()
    {
        return $this->belongsTo(User::class, 'HOD_revisor')->withDefault();
    }

    public function QC()
    {
        return $this->belongsTo(User::class, 'QC_revisor')->withDefault();
    }

    public function MD()
    {
        return $this->belongsTo(User::class, 'MD_approver')->withDefault();
    }

    public function Imp()
    {
        return $this->belongsTo(User::class, 'implementor')->withDefault();
    }

    public function access()
    {
        return $this->hasMany(Role::class, 'doc_id');
    }

    public function confirms()
    {
        return $this->hasOne(Confirm::class, 'doc_id')->withDefault();
    }
}

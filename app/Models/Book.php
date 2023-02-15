<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        // if (isset($filters['search'])?$filters['search']:false) {
        //     return $query->where('nama', 'like', '%' . request('search') . '%')
        //             ->orWhere('nama', 'like', '%' . request('search') . '%');
        // }

        $query->when($filters['search']??false, function($query, $search){
            return $query->where('nama', 'like', '%' . $search . '%')
            ->orWhere('nama', 'like', '%' . $search . '%');
        });

        $query->when($filters['publisher']??false, function($query, $category){
            return $query->whereHas('publisher', function($query) use ($category){
                $query->where('id', $category);
            });
        });
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
}

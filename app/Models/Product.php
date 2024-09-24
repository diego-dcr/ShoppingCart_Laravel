<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'id',
        'name',
        'price',
        'category_id',
        'description',
        'img'
    ];

    public function category() {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function getImage()
    {
        if (Storage::disk('public')->exists($this->img)) {
            $imageContent = Storage::disk('public')->get($this->img);
            return $imageContent;
        }

        abort(404, 'Image not found');
    }
}

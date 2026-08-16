<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $fillable = [
        'menu_item_id',
        'content',
        'title',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];
    use HasFactory;
}

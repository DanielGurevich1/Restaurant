<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;

class Restaurant extends Model
{
    use HasFactory;
    // public function menuBelongsToRestaurant()
    // {
    //     return $this->belongsTo('App\Models\Menu', 'menu_id', 'id');
    // }

    //     public function bookAuthor()
    //    {
    //        return $this->belongsTo('App\Models\Author', 'author_id', 'id');
    //    }

    public function restMenu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
}
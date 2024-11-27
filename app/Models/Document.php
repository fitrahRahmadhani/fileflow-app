<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
  protected $guarded = [];

  // Relasi
  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  // 
  public function getFormattedDateAttribute()
  {
    return $this->created_at->format('d F Y');
  }
}

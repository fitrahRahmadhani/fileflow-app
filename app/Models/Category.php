<?php

namespace App\Models;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $guarded = [];

  public function documents()
  {
    return $this->hasMany(Document::class);
  }

  public function getCountDocument()
  {
    return $this->documents()->count();
  }
}

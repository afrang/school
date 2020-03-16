<?php

namespace App\Model\Pages;

use Illuminate\Database\Eloquent\Model;

class page_setting extends Model
{
   protected $fillable=['name','text','method','image','model'];
}

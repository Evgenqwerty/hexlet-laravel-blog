<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //Laravel предлагает создавать внутри модели массив, в котором перечисляются поля, доступные для mass-assignment.
    protected $fillable = ['name', 'body'];
}

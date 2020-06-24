<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sp extends Model
{

    use SoftDeletes;

    protected $table = 'shangpin';

    protected $guarded = ['id'];
}
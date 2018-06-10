<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    //
    protected $table = 'ads';
    protected $primaryKey='id_ads';
    public $timestamps = false;
}

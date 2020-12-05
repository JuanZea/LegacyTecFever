<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    // Functions

    /**
     * @return String
     */
    public function getGetPathAttribute() : String
    {
        return '/'.$this->name.'.pdf';
    }
}

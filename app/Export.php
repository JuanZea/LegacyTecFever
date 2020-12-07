<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Export extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'name'
    ];

    /**
     * Returns the url of the export
     * @return String
     */
    public function getGetRealNameAttribute() : String
    {
        return $this->name.'-'.$this->date.'.xlsx';
    }
}

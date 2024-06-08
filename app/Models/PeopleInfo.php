<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeopleInfo extends Model
{
    use HasFactory;

    protected $table ='people_info';
    protected $primaryKey='id';
    public $timestamps = true;
    protected $fillable=[
        'first_name',
        'last_name',
        'email', 
        'total_marks',     
    ];
}

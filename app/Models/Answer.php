<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table ='answers';
    protected $primaryKey='id';
    public $timestamps = true;
    protected $fillable=[
        'marks', 
        'question',     
        'people_id',
        'total_marks',    
    ]; 

    public function people()
    {
        return $this->belongsTo(PeopleInfo::class);
    }

}

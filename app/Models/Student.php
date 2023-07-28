<?php

namespace App\Models;

use App\Models\StudentDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $table='students';

    protected $fillable=[
        'Name',
        'Course',
        'Email',
        'Phone',

    ];

    public function StudentDetails(){
        return $this->hasOne(StudentDetails::class,'student_id','id');
    }
}

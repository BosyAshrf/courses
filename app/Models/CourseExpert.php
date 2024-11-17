<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseExpert extends Model
{
    protected $table = 'course_experts';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['expert_id', 'course_id'];

}

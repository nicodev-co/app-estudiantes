<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'user_id',
    ];

    /**
     * Get the teacher that owns the Subject
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_subject');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}

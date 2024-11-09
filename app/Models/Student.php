<?php

namespace App\Models;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get all of the grades for the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }

    /**
     * Get all of the subjects for the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subject');
    }

    public function scopeWhenIsTeacher(Builder $query): Builder
    {
        return $query->when(auth()->user()->isTeacher(),function($query) {
            $query->whereHas('subjects', function ($query) {
                $query->where('user_id', auth()->id());
            });
        });
    }

    public function promedio(?Subject $subject = null)
    {
        return number_format($this->grades()
        ->when($subject->id, fn($q) => $q->where('subject_id', $subject->id))->avg('grade'),2);
    }

}

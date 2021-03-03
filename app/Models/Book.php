<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Book
 * @package App\Models
 *
 * @mixin Builder
 */
class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'isbn',
        'published_at',
        'status'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'published_at' => 'date'
    ];
    /**
     * The possible status of Books
     */
    const STATUS = [
        'CHECKED_OUT' => 'CHECKED_OUT',
        'AVAILABLE' => 'AVAILABLE'
    ];

    /**
     * The books that belong to user
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_action_logs')->withPivot('action');
    }
}

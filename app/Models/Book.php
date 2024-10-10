<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'author',
        'published_at',
    ];

    /**
     * Get the shelves that the book belongs to.
     */
    public function shelves(): BelongsToMany
    {
        return $this->belongsToMany(Shelf::class, 'book_shelf')->withTimestamps();
    }

    /**
     * Get the users that owns the book.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}

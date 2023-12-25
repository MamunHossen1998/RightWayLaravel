<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Offer extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $fillable = ['title', 'description', 'price', 'status', 'author_id'];
    public const PLACEHOLDER_IMG_PATH = 'image/placeholderimg.jpg';

    protected $with = ['author'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(Location::class);
    }
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id')->selectRaw('id, name');
    }
    public function getImageUrlAttribute(): string
    {
        return $this->hasMedia()
            ? $this->getFirstMediaUrl()
            : self::PLACEHOLDER_IMG_PATH;
    }
}

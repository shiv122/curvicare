<?php

namespace App\Traits;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;


trait Liker
{
    public function likes(?Model $likeable = null): MorphMany
    {
        if ($likeable) {
            return $this->morphMany(Like::class, 'liker')
                ->where('likeable_id', $likeable->id)
                ->where('likeable_type', get_class($likeable));
        }
        return $this->morphMany(Like::class, 'liker');

        // ->with(['likeable' => ['likes' => ['liker']]]);
    }


    /**
     * @param Model $likeable
     * @throws \Exception
     * @return void
     * 
     * This method is used to like a model that uses Likable trait
     */

    public function like(Model $likeable): void
    {
        if (!in_array(Likable::class, class_uses($likeable))) {
            throw new \Exception('Likeable model must use Likable trait');
        }

        if ($this->isLiked($likeable)) {
            return;
        }
        $likeable->likes()->create([
            'liker_id' => $this->id,
            'liker_type' => get_class($this),
        ]);
    }

    public function unlike(Model $likeable): void
    {
        if (!in_array(Likable::class, class_uses($likeable))) {
            throw new \Exception('Likeable model must use Likable trait');
        }
        $likeable->likes()->where([
            'liker_id' => $this->id,
            'liker_type' => get_class($this),
        ])->delete();
    }


    public function isLiked(Model $likeable): bool
    {
        if (!in_array(Likable::class, class_uses($likeable))) {
            throw new \Exception('Likeable model must use Likable trait');
        }
        return $likeable->likes()->where([
            'liker_id' => $this->id,
            'liker_type' => get_class($this),
        ])->exists();
    }

    /**
     * @param Model $likeable
     * @throws \Exception
     * @return string 'liked' or 'un-liked'
     * 
     * This method is used to toggle like on a model that uses Likable trait
     * 
     */


    public function toggleLike(Model $likeable): string
    {
        if (!in_array(Likable::class, class_uses($likeable))) {
            throw new \Exception('Likeable model must use Likable trait');
        }

        if ($this->isLiked($likeable)) {
            $this->unlike($likeable);
            return 'un-liked';
        } else {
            $this->like($likeable);
            return 'liked';
        }
    }


    public function likesCount(Model|null $likeable = null): int
    {
        if ($likeable) {
            if (!in_array(Likable::class, class_uses($likeable))) {
                throw new \Exception('Likeable model must use Likable trait');
            }

            return $this->likes($likeable)->count();
        }
        return $this->likes()->count();
    }
}

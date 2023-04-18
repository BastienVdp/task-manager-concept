<?php

namespace App\Models;

use App\Models\Todo;
use App\Models\Category;
use App\Enums\TaskStatusEnum;
use App\Enums\TaskPriorityEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'state' => TaskStatusEnum::class,
        'priority' => TaskPriorityEnum::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function todos(): HasMany
    {
        return $this->hasMany(Todo::class);
    }

    public function todosCompleted(): HasMany
    {
        return $this->hasMany(Todo::class)->where('todos.done', 1);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

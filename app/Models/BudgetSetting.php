<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\AsCollection;

class BudgetSetting extends Model
{
    protected $fillable = ['monthly_income', 'categories'];
    protected $casts = [
        'categories' => 'collection',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

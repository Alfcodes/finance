<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Expense;
use App\Models\IncomeEntry;
use App\Models\Saving;
use App\Models\Giving;
use App\Models\Family;
use App\Models\Goal;

class FinancePolicy
{
    public function update(User $user, $model): bool
    {
        return $user->id === $model->user_id;
    }

    public function delete(User $user, $model): bool
    {
        return $user->id === $model->user_id;
    }
}

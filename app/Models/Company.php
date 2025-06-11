<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected function casts(): array
    {
        return [
            'sale_date' => 'date',
        ];
    }
}

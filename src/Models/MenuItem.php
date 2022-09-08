<?php

namespace Reinholdjesse\Components\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')
            ->with('children');
    }
}

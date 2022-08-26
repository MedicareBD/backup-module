<?php

namespace Modules\Backup\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'driver' => 'array',
    ];

    public function by()
    {
        return $this->belongsTo(User::class, 'by', 'id');
    }
}

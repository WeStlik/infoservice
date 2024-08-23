<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Statuses;

class Leads extends Model
{
    use HasFactory;

    protected $with = ['statusDetail'];

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'lead_text',
        'status',
    ];

    protected $attributes = [
        'status' => 'new',
    ];

    public function statusDetail(): BelongsTo
    {
        return $this->belongsTo(Statuses::class, 'status', 'type');
    }
}

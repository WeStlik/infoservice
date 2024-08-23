<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Leads;

class Statuses extends Model
{
    use HasFactory;

    protected $visible = [
        'id',
        'type',
        'status_text',
        'badge_color',
    ];
}

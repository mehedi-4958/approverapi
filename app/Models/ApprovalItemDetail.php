<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalItemDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'approvalItemID',
        'key',
        'value',
    ];
}

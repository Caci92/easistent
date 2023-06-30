<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class PurchaseListItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'user_id',
        'purchase_list_id',
        'completed'
    ];

    public function purchaseList(): BelongsTo
    {
        return $this->belongsTo(PurchaseList::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

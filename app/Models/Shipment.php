<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Shipment extends Model
{
    use HasFactory;
    protected $table = 'shipment';

    const STATUS_STARTED = 'started';
    const STATUS_UNASSIGNED  = 'unassigned';
    const STATUS_COMPLETED   = 'completed';
    const STATUS_PROBLEM     = 'problem';


    const ALLOWED_STATUS = [
        self::STATUS_STARTED,
        self::STATUS_UNASSIGNED,
        self::STATUS_COMPLETED,
        self::STATUS_PROBLEM,
        ];
    protected $fillable = [
        'title',
        'from_city',
        'from_country',
        'to_city',
        'to_country',
        'price',
        'status',
        'user_id',
        'details',
        'client_id'
    ];
    public function status(): Attribute
    {
        return Attribute::make(
            set: function ($status) {
                if(!array($status, self::ALLOWED_STATUS))
                {
                    throw new \Exception('Invalid status');
                }
                return $status;

            }
        );
    }
    public function shipment_docs(): HasMany
    {
        return $this->hasMany(ShipmentDocuments::class, 'shipment_id', 'id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'user_id', ownerKey: 'id');
    }

    public function scopeUnassignedShipments($query)
    {
        return $query->where('status', Shipment::STATUS_UNASSIGNED);
    }

}

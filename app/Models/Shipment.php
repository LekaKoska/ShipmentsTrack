<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;
    protected $table = 'shipment';

    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_UNASSIGNED  = 'unassigned';
    const STATUS_COMPLETED   = 'completed';
    const STATUS_PROBLEM     = 'problem';


    const ALLOWED_STATUS = [
        self::STATUS_IN_PROGRESS,
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
    ];


//    public function setStatusAttribute($status)
//    {
//        if(!array($status, self::ALLOWED_STATUS))
//        {
//            throw new \Exception('Invalid status');
//        }
//
//        $this->attributes['status'] = $status;
//    }

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

}

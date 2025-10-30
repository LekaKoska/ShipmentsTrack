<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentDocuments extends Model
{
    const TABLE = 'shipment_documents';
    protected $table = self::TABLE;
    protected $fillable = ['shipment_id', 'shipment_document'];
}

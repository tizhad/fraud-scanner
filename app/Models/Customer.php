<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model\Scan;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'date_of_birth','phone_number','iban','is_fraud','ip_address'];

    public function scan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Scan::class);
    }
}

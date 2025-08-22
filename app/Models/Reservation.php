<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'table_id',
        'reservation_date',
        'reservation_time',
        'duration',
        'customer_name',
        'customer_phone',
        'status',
    ];
public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function getStartDatetimeAttribute()
    {
        // reservation_time may include seconds; take H:i
        return Carbon::createFromFormat(
            'Y-m-d H:i',
            $this->reservation_date . ' ' . substr($this->reservation_time, 0, 5)
        );
    }

    public function getEndDatetimeAttribute()
    {
        return $this->start_datetime->copy()->addMinutes($this->duration);
    }
    public function payment()
{
    return $this->hasOne(Payment::class, 'reservation_id');
}
}


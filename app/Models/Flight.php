<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
    ];

    public function airplane()
    {
        return $this->belongsTo(Airplane::class);
    }

    public function terminalOrig()
    {
        return $this->belongsTo(Terminal::class, 'terminal_orig_id');
    }

    public function terminalDest()
    {
        return $this->belongsTo(Terminal::class, 'terminal_dest_id');
    }
}

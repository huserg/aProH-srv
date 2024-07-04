<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'status',
        'mac',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function relatedDevices()
    {
        return $this->belongsToMany(Device::class, 'device_device', 'device_id', 'related_device_id');
    }


    public function getStatusColorAttribute()
    {
        // Assurez-vous que le statut est bien défini et commence par #
        $hexColor = $this->status ? ltrim($this->status, '#') : '888888';

        // Convertir le hex en RGB
        if (strlen($hexColor) === 6) {
            list($r, $g, $b) = sscanf($hexColor, "%02x%02x%02x");
        } else {
            // Valeur par défaut
            $r = $g = $b = 136;
        }

        return "rgb({$r}, {$g}, {$b})";
    }

}

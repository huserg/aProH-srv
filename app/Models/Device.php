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
        return $this->belongsToMany(Device::class, 'device_device', 'device_id', 'related_device_id')->withTimestamps();
    }


    public function getStatusColorAttribute()
    {
        // Assurez-vous que le statut est bien défini et commence par #
        $hexColor = $this->status ? ltrim($this->status, '#') : '888888';

        // Retourne la couleur hexadécimale
        return "#{$hexColor}";
    }

    public function getStatusTextColorAttribute()
    {
        // Définir une couleur de texte contrastée en fonction de la couleur de fond
        $hexColor = $this->status ? ltrim($this->status, '#') : '888888';

        // Convertir le hex en RGB
        if (strlen($hexColor) === 6) {
            list($r, $g, $b) = sscanf($hexColor, "%02x%02x%02x");
        } else {
            $r = $g = $b = 136;
        }

        // Calculer la luminance
        $luminance = 0.2126 * ($r / 255) + 0.7152 * ($g / 255) + 0.0722 * ($b / 255);

        // Retourner blanc ou noir en fonction de la luminance
        return $luminance > 0.5 ? '#000000' : '#FFFFFF';
    }

}

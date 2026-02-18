<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject',
        'message',
        'type',
        'status',
        'admin_reply',
    ];

    protected $casts = [
        'status' => 'integer',
        'type' => 'integer',
    ];

    const STATUS_ABERTO = 0;
    const STATUS_RESPONDIDO = 1;

    const TYPE_DUVIDA = 0;
    const TYPE_SUGESTAO = 1;
    const TYPE_BUG = 2;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeAbertos($query)
    {
        return $query->where('status', self::STATUS_ABERTO);
    }

    public function scopeRespondidos($query)
    {
        return $query->where('status', self::STATUS_RESPONDIDO);
    }

    public function marcarComoRespondido()
    {
        $this->update([
            'status' => self::STATUS_RESPONDIDO
        ]);
    }

    public function estaAberto()
    {
        return $this->status === self::STATUS_ABERTO;
    }

    public function estaRespondido()
    {
        return $this->status === self::STATUS_RESPONDIDO;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'tagihans';
    protected $fillable = [
        'no_tagihan',
        'id_bulan',
        'tahun',
        'id_pelanggan',
        'jumlah_tagihan',
        'status',
        'tgl_bayar',
        'user_id',
        'remark1',
        'remark2',
        'remark3',
    ];
    protected $casts = [
        'tgl_bayar' => 'date',
        'tahun'     => 'integer',
        'jumlah_tagihan' => 'decimal:2',
    ];

    public function bulan()
    {
        return $this->belongsTo(\App\Models\Bulan::class, 'id_bulan', 'id_bulan');
    }
    public function pelanggan()
    {
        return $this->belongsTo(\App\Models\Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    // app/Models/Tagihan.php
    public function pembayarans()
    {
        return $this->hasMany(\App\Models\Pembayaran::class);
    }
    public function getTotalPaidAttribute()
    {
        return (float)($this->pembayarans()->sum('amount'));
    }
    public function getIsLunasAttribute()
    {
        return $this->total_paid + 0.00001 >= (float)$this->jumlah_tagihan;
    }

    public function scopeBelum($q)
    {
        return $q->where('status', 'belum');
    }
}

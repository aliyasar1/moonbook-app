<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatuses extends Model
{
    use HasFactory;

    protected $table = 'order_statuses';

    protected $fillable = ['icon', 'status'];

    public const ORDER_STATUS = [
        1 => 'Sipariş Alındı',
        2 => 'Sipariş Hazırlanıyor',
        3 => 'Kargoya Verildi',
        4 => 'Yolda',
        5 => 'Teslim Edildi'
    ];

    public const ORDER_STATUS_ICON = [
        1 => 'fa-solid fa-thumbs-up',
        2 => 'fa-solid fa-list-check',
        3 => 'fa-solid fa-truck-ramp-box',
        4 => 'fa-solid fa-road',
        5 => 'fa-solid fa-check',
    ];

    public $timestamps = false;
}

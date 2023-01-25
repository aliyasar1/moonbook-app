<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Yazarlar
 *
 * @property int $id
 * @property string $adi_soyadi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Yazarlar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Yazarlar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Yazarlar query()
 * @method static \Illuminate\Database\Eloquent\Builder|Yazarlar whereAdiSoyadi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yazarlar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yazarlar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yazarlar whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Yazarlar extends Model
{
    use HasFactory;

    protected $table = 'yazarlar';

    protected $fillable = ['adi_soyadi'];
}

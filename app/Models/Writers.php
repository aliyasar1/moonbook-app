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
 * @method static \Illuminate\Database\Eloquent\Builder|Writers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Writers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Writers query()
 * @method static \Illuminate\Database\Eloquent\Builder|Writers whereAdiSoyadi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Writers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Writers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Writers whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Writers extends Model
{
    use HasFactory;

    protected $table = 'yazarlar';

    protected $fillable = ['adi_soyadi'];
}

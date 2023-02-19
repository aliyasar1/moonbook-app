<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\YayinEvleri
 *
 * @property int $id
 * @property string $adi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublishingHouses newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublishingHouses newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublishingHouses query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublishingHouses whereAdi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublishingHouses whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublishingHouses whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublishingHouses whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PublishingHouses extends Model
{
    use HasFactory;

    protected $table = 'yayin_evleri';

    protected $fillable = ['adi'];
}

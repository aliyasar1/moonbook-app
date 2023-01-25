<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Stok
 *
 * @property int $id
 * @property int $kitap_id
 * @property int $stok_adeti
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Kitaplar $kitap
 * @method static \Illuminate\Database\Eloquent\Builder|Stok newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stok newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stok query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stok whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stok whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stok whereKitapId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stok whereStokAdeti($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stok whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Stok extends Model
{
    use HasFactory;

    protected $table = 'stok_durumu';

    protected $fillable = ['kitap_id', 'stok_adeti'];

    public function kitap()
    {
        return $this->belongsTo(Kitaplar::class, 'kitap_id', 'id');
    }
}

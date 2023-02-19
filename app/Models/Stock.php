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
 * @property-read \App\Models\Books $kitap
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereKitapId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereStokAdeti($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Stock extends Model
{
    use HasFactory;

    protected $table = 'stok_durumu';

    protected $fillable = ['kitap_id', 'stok_adeti'];

    public function kitap()
    {
        return $this->belongsTo(Books::class, 'kitap_id', 'id');
    }
}

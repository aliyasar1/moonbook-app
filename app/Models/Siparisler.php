<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Siparisler
 *
 * @property int $id
 * @property int $sepet_id
 * @property string $kod
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Siparisler newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Siparisler newQuery()
 * @method static \Illuminate\Database\Query\Builder|Siparisler onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Siparisler query()
 * @method static \Illuminate\Database\Eloquent\Builder|Siparisler whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siparisler whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siparisler whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siparisler whereKod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siparisler whereSepetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siparisler whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Siparisler withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Siparisler withoutTrashed()
 * @mixin \Eloquent
 */
class Siparisler extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'siparisler';

    protected $fillable = ['id', 'sepet_id', 'kod'];

    public function sepetler() {
        return $this->hasMany(Sepet::class, 'sepet_id', 'id');
    }

    public function siparis_detaylari()
    {
        return $this->hasMany(SiparisDetaylari::class, "siparis_id", "id");
    }
}

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
 * @method static \Illuminate\Database\Eloquent\Builder|Orders newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Orders newQuery()
 * @method static \Illuminate\Database\Query\Builder|Orders onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Orders query()
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereKod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereSepetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Orders withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Orders withoutTrashed()
 * @mixin \Eloquent
 */
class Orders extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'siparisler';

    protected $fillable = ['id', 'sepet_id', 'kod'];

    public function sepetler() {
        return $this->hasMany(Cart::class, 'id', 'sepet_id');
    }

    public function siparis_detaylari()
    {
        return $this->hasMany(OrderDetails::class, "siparis_id", "id");
    }
}

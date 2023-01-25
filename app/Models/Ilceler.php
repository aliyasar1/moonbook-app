<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Ilceler
 *
 * @property int $id
 * @property int $il_id
 * @property string $ilce
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Iller $il
 * @method static \Illuminate\Database\Eloquent\Builder|Ilceler newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ilceler newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ilceler query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ilceler whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ilceler whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ilceler whereIlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ilceler whereIlce($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ilceler whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ilceler extends Model
{
    use HasFactory;

    protected $table = 'ilceler';

    protected $fillable = ['il_id', 'ilce'];

    public function il(){

        return $this->belongsTo(Iller::class,'il_id');

    }
}

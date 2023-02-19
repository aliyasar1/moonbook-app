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
 * @property-read \App\Models\Cities $il
 * @method static \Illuminate\Database\Eloquent\Builder|Districts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Districts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Districts query()
 * @method static \Illuminate\Database\Eloquent\Builder|Districts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Districts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Districts whereIlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Districts whereIlce($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Districts whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Districts extends Model
{
    use HasFactory;

    protected $table = 'ilceler';

    protected $fillable = ['il_id', 'ilce'];

    public function il(){

        return $this->belongsTo(Cities::class,'il_id');

    }
}

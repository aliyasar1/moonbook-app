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
 * @method static \Illuminate\Database\Eloquent\Builder|YayinEvleri newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|YayinEvleri newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|YayinEvleri query()
 * @method static \Illuminate\Database\Eloquent\Builder|YayinEvleri whereAdi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|YayinEvleri whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|YayinEvleri whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|YayinEvleri whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class YayinEvleri extends Model
{
    use HasFactory;

    protected $table = 'yayin_evleri';

    protected $fillable = ['adi'];
}

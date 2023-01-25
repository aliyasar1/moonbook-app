<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $type
 * @property string $fotograf
 * @property string|null $firma_adi
 * @property string|null $tckn
 * @property string $adi_soyadi
 * @property string $kullanici_adi
 * @property string $tel_no
 * @property string $email
 * @property string $sifre
 * @property string $sifre_tekrar
 * @property string $adres
 * @property int $ilce_id
 * @property int $il_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Favoriler[] $favori_kitaplar
 * @property-read int|null $favori_kitaplar_count
 * @property-read \App\Models\Ilceler $ilceler
 * @property-read \App\Models\Iller $iller
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sepet[] $sepetler
 * @property-read int|null $sepetler_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAdiSoyadi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAdres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirmaAdi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFotograf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIlceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereKullaniciAdi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSifre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSifreTekrar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTckn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTelNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [ 'type', 'fotograf', 'firma_adi', 'tckn', 'adi_soyadi', 'kullanici_adi', 'tel_no', 'email', 'sifre', 'sifre_tekrar', 'adres', 'ilce_id', 'il_id' ];

    public function iller()
    {
        return $this->belongsTo(Iller::class, 'il_id', 'id');
    }

    public function ilceler()
    {
        return $this->belongsTo(Ilceler::class, 'ilce_id', 'id');
    }

    public const USER_TYPE = [
        'ADMIN' => 'admin',
        'USER' => 'user'
    ];

    // Relations
    public function favori_kitaplar()
    {
        return $this->hasMany(Favoriler::class, 'kullanici_id');
    }

    public function sepetler () {
        return $this->hasMany(Sepet::class, 'kullanici_id');
    }
}

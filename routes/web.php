<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
    'as' => 'giris_yap',
    'uses' => 'App\Http\Controllers\LoginController@getGiris_Yap'
]);

Route::post('/', [
    'uses' => 'App\Http\Controllers\LoginController@postGiris_Yap'
]);

Route::get('/kayit-ol', [
    'as' => 'kayit_ol',
    'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@Kayit_Ol'
]);

Route::post('/kayit-ol', [
    'as' => 'kayit_ol_post',
    'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@postHesap_Olustur'
]);

Route::post('/ilce-by-il', [
    'as' => 'ilce_by_il',
    'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@postIlceByIl'
]);

Route::get('/satici-girisi-yap', [
    'as' => 'satici_girisi_yap',
    'uses' => 'App\Http\Controllers\LoginController@Satici_Girisi_Yap'
]);

Route::post('/satici-girisi-yap', [
    'as' => 'satici_girisi_yap_post',
    'uses' => 'App\Http\Controllers\LoginController@postSatici_Girisi_Yap'
]);

Route::get('/satici-ol', [
    'as' => 'satici_ol',
    'uses' => 'App\Http\Controllers\Admin\AdminController@getSaticiOl'
]);

Route::post('/satici-ol', [
    'as' => 'satici_ol_post',
    'uses' => 'App\Http\Controllers\Admin\AdminController@postSaticiOl'
]);

Route::get('/cikis-yap', [
    'as' => 'cikis_yap',
    'uses' => 'App\Http\Controllers\Admin\AdminController@getCikis_yap'
]);

Route::get('/kitaplar', [
    'as' => 'kitaplar',
    'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@getKitaplar'
]);

Route::get('/anasayfa', [
    'as' => 'anasayfa',
    'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@getAnasayfa'
]);

Route::get('/kitap-incele/{kitap}', [
    'as' => 'kitap_incele',
    'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@getKitapIncele'
]);

Route::post('/kitap-incele/{kitap}/yorum-eklendi', [
    'as' => 'yorum_ekle',
    'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@postKitapYorum'
]);

Route::get('/yazarlar', [
    'as' => 'yazarlar',
    'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@getYazarlar'
]);

Route::get('/yayin-evleri', [
    'as' => 'yayin_evleri',
    'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@getYayinEvleri'
]);

Route::get('/cikis-yap', [
    'as' => 'cikis_yap',
    'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@getCikisYap'
]);

Route::prefix('/satici')->as('satici.')->middleware(['admin'])->group(function () {
    Route::get('/anasayfa', [
        'as' => 'anasayfa',
        'uses' => 'App\Http\Controllers\Admin\AdminController@getAnasayfa'
    ]);

    Route::get('/profil-duzenle', [
        'as' => 'profil_duzenle',
        'uses' => 'App\Http\Controllers\Admin\AdminController@getProfilDuzenle'
    ]);

    Route::put('/profil-duzenle/{user}', [
        'as' => 'profil_duzenle_put',
        'uses' => 'App\Http\Controllers\Admin\AdminController@putProfilDuzenle'
    ]);

    Route::prefix('/kitaplar')->as('kitaplar.')->group(function () {
        Route::get('/anasayfa', [
            'as' => 'anasayfa',
            'uses' => 'App\Http\Controllers\Admin\KitaplarController@getAnasayfa',
        ]);
        Route::get('/kitap-ekle', [
            'as' => 'kitap_ekle',
            'uses' => 'App\Http\Controllers\Admin\KitaplarController@getKitap_Ekle'
        ]);
        Route::post('/kitap-ekle', [
            'as' => 'kitap_ekle_post',
            'uses' => 'App\Http\Controllers\Admin\KitaplarController@postKitap_Ekle'
        ]);
        Route::get('/kitap-duzenle/{kitap}', [
            'as' => 'kitap_duzenle',
            'uses' => 'App\Http\Controllers\Admin\KitaplarController@getKitapDuzenle'
        ]);
        Route::put('/kitap-duzenle/{kitap}',[
            'as' => 'kitap_duzenle_put',
            'uses' => 'App\Http\Controllers\Admin\KitaplarController@putKitapDuzenle'
        ]);
        Route::delete('/kitap-sil/{kitap}',[
            'as' => 'kitap_sil',
            'uses' => 'App\Http\Controllers\Admin\KitaplarController@deleteKitap'
        ]);
        Route::get('/stok',[
            'as' => 'stok',
            'uses' => 'App\Http\Controllers\Admin\StokController@getStokAnasayfa'
        ]);
        Route::put('/stok/{stok}',[
            'as' => 'stok_put',
            'uses' => 'App\Http\Controllers\Admin\StokController@putStok'
        ]);
    });
});

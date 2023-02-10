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

Route::get('/favoriler', [
    'as' => 'favoriler',
    'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@getFavoriler'
]);

Route::get('/anasayfa', [
    'as' => 'anasayfa',
    'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@getAnasayfa'
]);

Route::get('/yazarlar', [
    'as' => 'yazarlar',
    'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@getYazarlar'
]);

Route::get('/yazarlar/yazar-kitaplari/{yazar}', [
    'as' => 'yazar_kitaplari',
    'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@getYazarKitaplari'
]);

Route::get('/yayin-evleri', [
    'as' => 'yayin_evleri',
    'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@getYayinEvleri'
]);

Route::get('/yayin-evleri/yayin-evleri-kitaplari/{yayinevi}', [
    'as' => 'yayin_evleri_kitaplari',
    'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@getYayinEviKitaplari'
]);

Route::get('/cikis-yap', [
    'as' => 'cikis_yap',
    'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@getCikisYap'
]);

Route::get('/saticilar/{satici}', [
    'as' => 'saticilar',
    'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@getSaticilar'
]);

Route::get('/kvkk', [
    'as' => 'kvkk',
    'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@getKVKK'
]);

Route::get('/profil-duzenle', [
    'as' => 'profil_duzenle',
    'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@getProfilDuzenle'
]);

Route::get('/tum-siparislerim', [
    'as' => 'tum_siparislerim',
    'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@getTumSiparislerim'
]);

Route::put('/profil-duzenle/{user}', [
    'as' => 'profil_duzenle_put',
    'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@putProfilDuzenle'
]);

// Kitap İşlemleri
Route::prefix('/kitaplar')->as('kitaplar.')->group(function () {
    Route::get('/kategori/{kategori}', [
        'as' => 'kategori',
        'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@getKitaplarByKategori'
    ]);
    Route::get('/kitap-incele/{kitap}', [
        'as' => 'kitap_incele',
        'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@getKitapIncele'
    ]);

    Route::post('/kitap-incele/{kitap}/favorilere-eklendi', [
        'as' => 'favorilere_ekle',
        'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@postFavoriEkle'
    ]);

    Route::delete('/kitap-incele/{kitap}/favorilerden-silindi', [
        'as' => 'favorilerden_sil',
        'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@deleteFavoriSil'
    ]);

    Route::post('/kitap-incele/{kitap}/yorum-eklendi', [
        'as' => 'yorum_ekle',
        'uses' => 'App\Http\Controllers\Kullanicilar\KullaniciController@postKitapYorum'
    ]);

    Route::get('/sepet', [
        'as' => 'sepet',
        'uses' => 'App\Http\Controllers\Kullanicilar\SepetController@getSepet'
    ]);

    Route::post('/sepet/sepete-eklendi/{kitap}', [
        'as' => 'sepete_ekle',
        'uses' => 'App\Http\Controllers\Kullanicilar\SepetController@postSepeteEkle'
    ]);

    Route::get('/sepet/{sepet}/sepetten-silindi/{kitap}', [
        'as' => 'sepetten_sil',
        'uses' => 'App\Http\Controllers\Kullanicilar\SepetController@deleteSepettenSil'
    ]);

    Route::put('/sepet/adet-guncellendi/{sepetDetaylari}', [
        'as' => 'sepetteki_kitap_miktari',
        'uses' => 'App\Http\Controllers\Kullanicilar\SepetController@putSepet'
    ]);

    Route::post('/siparis', [
        'as' => 'siparis',
        'uses' => 'App\Http\Controllers\Kullanicilar\SepetController@postSepetiOnayla'
    ]);
});

// Admin
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

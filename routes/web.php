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
    'uses' => 'App\Http\Controllers\LoginController@getLogin'
]);

Route::post('/', [
    'uses' => 'App\Http\Controllers\LoginController@postLogin'
]);

Route::get('/kayit-ol', [
    'as' => 'kayit_ol',
    'uses' => 'App\Http\Controllers\RegisterController@getRegister'
]);

Route::post('/kayit-ol', [
    'as' => 'kayit_ol_post',
    'uses' => 'App\Http\Controllers\RegisterController@postRegister'
]);

Route::post('/ilce-by-il', [
    'as' => 'ilce_by_il',
    'uses' => 'App\Http\Controllers\RegisterController@postDistrictByCity'
]);

Route::get('/satici-girisi-yap', [
    'as' => 'satici_girisi_yap',
    'uses' => 'App\Http\Controllers\LoginController@getSellerLogin'
]);

Route::post('/satici-girisi-yap', [
    'as' => 'satici_girisi_yap_post',
    'uses' => 'App\Http\Controllers\LoginController@postSellerLogin'
]);

Route::get('/satici-ol', [
    'as' => 'satici_ol',
    'uses' => 'App\Http\Controllers\RegisterController@getSellerRegister'
]);

Route::post('/satici-ol', [
    'as' => 'satici_ol_post',
    'uses' => 'App\Http\Controllers\RegisterController@postSellerRegister'
]);

Route::get('/cikis-yap', [
    'as' => 'cikis_yap',
    'uses' => 'App\Http\Controllers\LoginController@getLogout'
]);

Route::get('/favoriler', [
    'as' => 'favoriler',
    'uses' => 'App\Http\Controllers\Customers\BooksController@getFavorites'
]);

Route::get('/anasayfa', [
    'as' => 'anasayfa',
    'uses' => 'App\Http\Controllers\Customers\CustomerController@getHome'
]);

Route::get('/yazarlar', [
    'as' => 'yazarlar',
    'uses' => 'App\Http\Controllers\Customers\BooksController@getWriters'
]);

Route::get('/yazarlar/yazar-kitaplari/{yazar}', [
    'as' => 'yazar_kitaplari',
    'uses' => 'App\Http\Controllers\Customers\BooksController@getWriterBooks'
]);

Route::get('/yayin-evleri', [
    'as' => 'yayin_evleri',
    'uses' => 'App\Http\Controllers\Customers\BooksController@getPublishingHouses'
]);

Route::get('/yayin-evleri/yayin-evleri-kitaplari/{yayinevi}', [
    'as' => 'yayin_evleri_kitaplari',
    'uses' => 'App\Http\Controllers\Customers\BooksController@getPublishingHouseBooks'
]);

Route::get('/saticilar/{satici}', [
    'as' => 'saticilar',
    'uses' => 'App\Http\Controllers\Customers\BooksController@getSeller'
]);

Route::get('/kvkk', [
    'as' => 'kvkk',
    'uses' => 'App\Http\Controllers\Customers\CustomerController@getKVKK'
]);

Route::get('/profil-duzenle', [
    'as' => 'profil_duzenle',
    'uses' => 'App\Http\Controllers\Customers\CustomerController@getEditProfile'
]);

Route::put('/profil-duzenle/{user}', [
    'as' => 'profil_duzenle_put',
    'uses' => 'App\Http\Controllers\Customers\CustomerController@putEditProfile'
]);

Route::get('/tum-siparislerim', [
    'as' => 'tum_siparislerim',
    'uses' => 'App\Http\Controllers\Customers\CustomerController@getAllOrders'
]);

Route::get('/tum-siparislerim/siparis-detayi/{siparis}', [
    'as' => 'siparis_detayi',
    'uses' => 'App\Http\Controllers\Customers\CustomerController@getOrderDetail'
]);


// Kitap İşlemleri
Route::prefix('/kitaplar')->as('kitaplar.')->group(function () {

    Route::get('/', [
        'as' => 'kitaplar',
        'uses' => 'App\Http\Controllers\Customers\BooksController@getBooks'
    ]);

    Route::get('/kategori/{kategori}', [
        'as' => 'kategori',
        'uses' => 'App\Http\Controllers\Customers\BooksController@getBooksByCategory'
    ]);

    Route::get('/kitap-detaylari/{kitap}', [
        'as' => 'kitap_detayi',
        'uses' => 'App\Http\Controllers\Customers\BooksController@getBookDetails'
    ]);

    Route::post('/kitap-detaylari/{kitap}/favorilere-eklendi', [
        'as' => 'favorilere_ekle',
        'uses' => 'App\Http\Controllers\Customers\BooksController@postAddFavorite'
    ]);

    Route::delete('/kitap-detaylari/{kitap}/favorilerden-silindi', [
        'as' => 'favorilerden_sil',
        'uses' => 'App\Http\Controllers\Customers\BooksController@deleteFavorite'
    ]);

    Route::post('/kitap-detaylari/{kitap}/yorum-eklendi', [
        'as' => 'yorum_ekle',
        'uses' => 'App\Http\Controllers\Customers\BooksController@postBookComment'
    ]);

    Route::get('/sepet', [
        'as' => 'sepet',
        'uses' => 'App\Http\Controllers\Customers\CartController@getCart'
    ]);

    Route::post('/sepet/sepete-eklendi/{kitap}', [
        'as' => 'sepete_ekle',
        'uses' => 'App\Http\Controllers\Customers\CartController@postAddToCart'
    ]);

    Route::get('/sepet/{sepet}/sepetten-silindi/{kitap}', [
        'as' => 'sepetten_sil',
        'uses' => 'App\Http\Controllers\Customers\CartController@deleteFromCart'
    ]);

    Route::put('/sepet/adet-guncellendi/{sepetDetaylari}', [
        'as' => 'sepetteki_kitap_miktari',
        'uses' => 'App\Http\Controllers\Customers\CartController@putCart'
    ]);

    Route::post('/siparis', [
        'as' => 'siparis',
        'uses' => 'App\Http\Controllers\Customers\CartController@postConfirmCart'
    ]);
});

// Admin
Route::prefix('/satici')->as('satici.')->middleware(['admin'])->group(function () {
    Route::get('/anasayfa', [
        'as' => 'anasayfa',
        'uses' => 'App\Http\Controllers\Admin\AdminController@getHome'
    ]);

    Route::get('/profil-duzenle', [
        'as' => 'profil_duzenle',
        'uses' => 'App\Http\Controllers\Admin\AdminController@getEditProfile'
    ]);

    Route::put('/profil-duzenle/{user}', [
        'as' => 'profil_duzenle_put',
        'uses' => 'App\Http\Controllers\Admin\AdminController@putEditProfile'
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
        Route::put('/kitap-duzenle/{kitap}', [
            'as' => 'kitap_duzenle_put',
            'uses' => 'App\Http\Controllers\Admin\KitaplarController@putKitapDuzenle'
        ]);
        Route::delete('/kitap-sil/{kitap}', [
            'as' => 'kitap_sil',
            'uses' => 'App\Http\Controllers\Admin\KitaplarController@deleteKitap'
        ]);
        Route::get('/stok', [
            'as' => 'stok',
            'uses' => 'App\Http\Controllers\Admin\StockController@getStockHome'
        ]);
        Route::put('/stok/{stok}', [
            'as' => 'stok_put',
            'uses' => 'App\Http\Controllers\Admin\StockController@putStock'
        ]);
    });
});

<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


// Login Routes
Route::get('/', [
    'as' => 'login',
    'uses' => 'App\Http\Controllers\AuthController@getLogin'
]);
Route::post('/', [
    'uses' => 'App\Http\Controllers\AuthController@postLogin'
]);

Route::get('/kayit-ol', [
    'as' => 'register',
    'uses' => 'App\Http\Controllers\AuthController@getRegister'
]);

Route::post('/kayit-ol', [
    'as' => 'postRegister',
    'uses' => 'App\Http\Controllers\AuthController@postRegister'
]);

Route::post('/ilce-by-il', [
    'as' => 'DistrictByCity',
    'uses' => 'App\Http\Controllers\AuthController@postDistrictByCity'
]);

Route::get('/satici-girisi-yap', [
    'as' => 'sellerLogin',
    'uses' => 'App\Http\Controllers\AuthController@getSellerLogin'
]);

Route::post('/satici-girisi-yap', [
    'as' => 'postSellerLogin',
    'uses' => 'App\Http\Controllers\AuthController@postSellerLogin'
]);

Route::get('/satici-ol', [
    'as' => 'sellerRegister',
    'uses' => 'App\Http\Controllers\AuthController@getSellerRegister'
]);

Route::post('/satici-ol', [
    'as' => 'postSellerRegister',
    'uses' => 'App\Http\Controllers\AuthController@postSellerRegister'
]);

Route::get('/cikis-yap', [
    'as' => 'logout',
    'uses' => 'App\Http\Controllers\AuthController@getLogout'
]);

Route::get('/favoriler', [
    'as' => 'favorites',
    'uses' => 'App\Http\Controllers\Customers\BooksController@getFavorites'
]);

Route::get('/anasayfa', [
    'as' => 'home',
    'uses' => 'App\Http\Controllers\Customers\CustomerController@getHome'
]);

Route::get('/yazarlar', [
    'as' => 'writers',
    'uses' => 'App\Http\Controllers\Customers\BooksController@getWriters'
]);

Route::get('/yazarlar/yazar-kitaplari/{writer}', [
    'as' => 'writerBooks',
    'uses' => 'App\Http\Controllers\Customers\BooksController@getWriterBooks'
]);

Route::get('/yayin-evleri', [
    'as' => 'publishingHouses',
    'uses' => 'App\Http\Controllers\Customers\BooksController@getPublishingHouses'
]);

Route::get('/yayin-evleri/yayin-evleri-kitaplari/{publishingHouse}', [
    'as' => 'publishingHousesBooks',
    'uses' => 'App\Http\Controllers\Customers\BooksController@getPublishingHouseBooks'
]);

Route::get('/saticilar/{seller}', [
    'as' => 'sellers',
    'uses' => 'App\Http\Controllers\Customers\BooksController@getSeller'
]);

Route::get('/kvkk', [
    'as' => 'kvkk',
    'uses' => 'App\Http\Controllers\Customers\CustomerController@getKVKK'
]);

Route::get('/profil-duzenle', [
    'as' => 'editProfile',
    'uses' => 'App\Http\Controllers\Customers\CustomerController@getEditProfile'
]);

Route::put('/profil-duzenle/{user}', [
    'as' => 'putEditProfile',
    'uses' => 'App\Http\Controllers\Customers\CustomerController@putEditProfile'
]);

Route::get('/tum-siparislerim', [
    'as' => 'allOrders',
    'uses' => 'App\Http\Controllers\Customers\CustomerController@getAllOrders'
]);

Route::get('/tum-siparislerim/siparis-detayi/{order}', [
    'as' => 'orderDetail',
    'uses' => 'App\Http\Controllers\Customers\CustomerController@getOrderDetail'
]);


// Kitap İşlemleri
Route::prefix('/kitaplar')->as('books.')->group(function () {

    Route::get('/', [
        'as' => 'books',
        'uses' => 'App\Http\Controllers\Customers\BooksController@getBooks'
    ]);

    Route::get('/kategori/{category}', [
        'as' => 'category',
        'uses' => 'App\Http\Controllers\Customers\BooksController@getBooksByCategory'
    ]);

    Route::get('/kitap-detaylari/{kitap}', [
        'as' => 'bookDetail',
        'uses' => 'App\Http\Controllers\Customers\BooksController@getBookDetails'
    ]);

    Route::post('/kitap-detaylari/{book}/favorilere-eklendi', [
        'as' => 'addFavorites',
        'uses' => 'App\Http\Controllers\Customers\BooksController@postAddFavorite'
    ]);

    Route::delete('/kitap-detaylari/{book}/favorilerden-silindi', [
        'as' => 'deleteFavorite',
        'uses' => 'App\Http\Controllers\Customers\BooksController@deleteFavorite'
    ]);

    Route::post('/kitap-detaylari/{book}/yorum-eklendi', [
        'as' => 'addComment',
        'uses' => 'App\Http\Controllers\Customers\BooksController@postBookComment'
    ]);

    Route::get('/sepet', [
        'as' => 'cart',
        'uses' => 'App\Http\Controllers\Customers\CartController@getCart'
    ]);

    Route::post('/sepet/sepete-eklendi/{book}', [
        'as' => 'addToCart',
        'uses' => 'App\Http\Controllers\Customers\CartController@postAddToCart'
    ]);

    Route::get('/sepet/{cart}/sepetten-silindi/{book}', [
        'as' => 'deleteFromCart',
        'uses' => 'App\Http\Controllers\Customers\CartController@deleteFromCart'
    ]);

    Route::put('/sepet/adet-guncellendi/{cartDetails}', [
        'as' => 'quantityOfBookInCart',
        'uses' => 'App\Http\Controllers\Customers\CartController@putCart'
    ]);

    Route::post('/siparis', [
        'as' => 'order',
        'uses' => 'App\Http\Controllers\Customers\CartController@postConfirmCart'
    ]);
});

// Admin
Route::prefix('/satici')->as('seller.')->middleware(['admin'])->group(function () {
    Route::get('/anasayfa', [
        'as' => 'home',
        'uses' => 'App\Http\Controllers\Admin\AdminController@getHome'
    ]);

    Route::get('/profil-duzenle', [
        'as' => 'editProfile',
        'uses' => 'App\Http\Controllers\Admin\AdminController@getEditProfile'
    ]);

    Route::put('/profil-duzenle/{user}', [
        'as' => 'putEditProfile',
        'uses' => 'App\Http\Controllers\Admin\AdminController@putEditProfile'
    ]);

    Route::prefix('/kitaplar')->as('books.')->group(function () {
        Route::get('/anasayfa', [
            'as' => 'home',
            'uses' => 'App\Http\Controllers\Admin\BooksController@getHome',
        ]);
        Route::get('/kitap-ekle', [
            'as' => 'addBook',
            'uses' => 'App\Http\Controllers\Admin\BooksController@getAddBook'
        ]);
        Route::post('/kitap-ekle', [
            'as' => 'postAddBook',
            'uses' => 'App\Http\Controllers\Admin\BooksController@postAddBook'
        ]);
        Route::get('/kitap-duzenle/{book}', [
            'as' => 'editBook',
            'uses' => 'App\Http\Controllers\Admin\BooksController@getEditBook'
        ]);
        Route::put('/kitap-duzenle/{book}', [
            'as' => 'putEditBook',
            'uses' => 'App\Http\Controllers\Admin\BooksController@putEditBook'
        ]);
        Route::delete('/kitap-sil/{book}', [
            'as' => 'deleteBook',
            'uses' => 'App\Http\Controllers\Admin\BooksController@deleteBook'
        ]);
        Route::get('/stok', [
            'as' => 'stock',
            'uses' => 'App\Http\Controllers\Admin\StockController@getStockHome'
        ]);
        Route::put('/stok/{stock}', [
            'as' => 'putStock',
            'uses' => 'App\Http\Controllers\Admin\StockController@putStock'
        ]);
    });
});

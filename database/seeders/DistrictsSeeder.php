<?php

namespace Database\Seeders;

use App\Models\Districts;
use App\Models\Cities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $iller = [
            Cities::ILLER['Adana'] => [
                'Seyhan',
                'Kozan',
                'Yumurtalık',
                'Yüreğir',
                'İmamoğlu',
                'Tufanbeyli',
                'Çukurova',
                'Karataş',
                'Feke',
                'Sarıçam',
                'Karaisalı',
                'Aladağ',
                'Ceyhan',
                'Pozantı',
                'Saimbeyli',
            ],

            Cities::ILLER['Adıyaman'] => [
                'Besni',
                'Çelikhan',
                'Gerger',
                'Gölbaşı',
                'Kâhta',
                'Samsat',
                'Sincik',
                'Tut',
            ],

            Cities::ILLER['Afyon'] => [
                'Merkez',
                'Başmakçı',
                'Bayat',
                'Bolvadin',
                'Çay',
                'Çobanlar',
                'Dazkırı',
                'Dinar',
                'Emirdağ',
                'Evciler',
                'Hocalar',
                'İhsaniye',
                'İscehisar',
                'Kızılören',
                'Sandıklı',
                'Sinanpaşa',
                'Şuhut',
                'Sultandağı'
            ],

            Cities::ILLER['Ağrı'] => [
                'Diyadin',
                'Doğubayazıt',
                'Eleşkirt',
                'Hamur',
                'Patnos',
                'Taşlıçay',
                'Tutak',
            ],

            Cities::ILLER['Amasya'] => [
                'Göynücek',
                'Gümüşhacıköy',
                'Hamamözü',
                'Merzifon',
                'Suluova',
                'Taşova',
            ],

            Cities::ILLER['Ankara'] => [
                'Akyurt',
                'Ayaş',
                'Altındağ',
                'Balâ',
                'Çamlıdere',
                'Beypazarı',
                'Çankaya',
                'Elmadağ',
                'Çubuk',
                'Etimesgut',
                'Gölbaşı',
                'Evren',
                'Haymana',
                'Güdül',
                'Kahramankazan',
                'Keçiören',
                'Kızılcahamam',
                'Kalecik',
                'Nallıhan',
                'Mamak',
                'Polatlı',
                'Sincan',
                'Pursaklar',
                'Şereflikoçhisar',
                'Yenimahalle'
            ],

            Cities::ILLER['Antalya'] => [
                'Kepez', 'Muratpaşa', 'Alanya', 'Manavgat', 'Konyaaltı', 'Serik', 'Aksu', 'Kumluca', 'Döşemealtı', 'Kaş', 'Korkuteli', 'Gazipaşa', 'Finike', 'Kemer', 'Elmalı', 'Demre', 'Akseki', 'Gündoğmuş', 'İbradi'
            ],

            Cities::ILLER['Artvin'] => [
                'Merkez', 'Hopa', 'Borçka', 'Arhavi', 'Yusufeli', 'Şavşat', 'Aksu', 'Kumluca', 'Ardanuç', 'Kemalpaşa', 'Murgul',
            ],

            Cities::ILLER['Aydın'] => [
                'Efeler', 'Nazilli', 'Söke', 'Kuşadası', 'Didim', 'İncirliova', 'Çine', 'Germencik', 'Bozdoğan', 'Köşk', 'Kuyucak', 'Koçarlı', 'Sultanhisar', 'Karacasu', 'Buharkent', 'Yenipazar', 'Karpuzlu',
            ],

            Cities::ILLER['Balıkesir'] => [
                'Altıeylül', 'Karesi', 'Edremit', 'Bandırma', 'Gönen', 'Ayvalık', 'Burhaniye', 'Bigadiç', 'Susurluk', 'Dursunbey', 'Sındırgı', 'Erdek', 'İvrindi', 'Havran', 'Kepsut', 'Manyas', 'Savaştepe', 'Gömeç', 'Balya', 'Marmara',
            ],

            Cities::ILLER['Bilecik'] => [
                'Merkez',
                'Bozüyük',
                'Osmaneli',
                'Söğüt',
                'Gölpazarı',
                'Pazaryeri',
                'İnhisar',
                'Yenipazar',
            ],

            Cities::ILLER['Bingöl'] => [
                'Merkez', 'Genç', 'Solhan', 'Karlıova', 'Adaklı', 'Kiğı', 'Yedisu', 'Yayladere',
            ],

            Cities::ILLER['Bitlis'] => [
                'Tatvan', 'Merkez', 'Güroymak', 'Ahlat', 'Hizan', 'Mutki', 'Adilcevaz',
            ],

            Cities::ILLER['Bolu'] => [
                'Merkez', 'Gerede', 'Mudurnu', 'Göynük', 'Mengen', 'Yeniçağa', 'Dörtdivan', 'Seben', 'Kıbrıscık',
            ],

            Cities::ILLER['Burdur'] => [
                'Merkez', 'Bucak', 'Gölhisar', 'Yeşilova', 'Çavdır', 'Tefenni', 'Ağlasun', 'Karamanlı', 'Altınyayla', 'Çeltikçi', 'Kemer',
            ],

            Cities::ILLER['Bursa'] => [
                'Osmangazi', 'Yıldırım', 'Nilüfer', 'İnegöl', 'Gemlik', 'Mustafakemalpa', 'Mudanya', 'Gürsu', 'Karacabey', 'Orhangazi', 'Kestel', 'Yenişehir', 'İznik', 'Orhaneli', 'Keles', 'Büyükorhan', 'Harmancık',
            ],

            Cities::ILLER['Çanakkale'] => [
                'Merkez', 'Biga', 'Çan', 'Gelibolu', 'Ayvacık', 'Ezine', 'Yenice', 'Bayramiç', 'Lapseki', 'Gökçeada', 'Eceabat', 'Bozcaada',
            ],

            Cities::ILLER['Çankırı'] => [
                'Merkez', 'Orta', 'Çerkeş', 'Ilgaz', 'Şabanözü', 'Kurşunlu', 'Yapraklı', 'Kızılırmak', 'Eldivan', 'Atkaracalar', 'Korgun', 'Bayramören',
            ],

            Cities::ILLER['Çorum'] => [
                'Merkez', 'Sungurlu', 'Osmancık', 'İskilip', 'Alaca', 'Bayat', 'Kargı', 'Mecitözü', 'Ortaköy', 'Uğurludağ', 'Dodurga', 'Oğuzlar', 'Laçin', 'Boğazkale',
            ],

            Cities::ILLER['Denizli'] => [
                'Pamukkale', 'Merkezefendi', 'Çivril', 'Acıpayam', 'Tavas', 'Honaz', 'Sarayköy', 'Buldan', 'Kale', 'Çal', 'Çameli', 'Serinhisar', 'Bozkurt', 'Güney', 'Çardak', 'Bekilli', 'Beyağaç', 'Babadağ', 'Baklan',
            ],

            Cities::ILLER['Diyarbakır'] => [
                'Bağlar', 'Kayapınar', 'Yenişehir', 'Ergani', 'Bismil', 'Sur', 'Silvan', 'Çınar', 'Çermik', 'Dicle', 'Kulp', 'Hani', 'Lice', 'Eğil', 'Hazro', 'Kocaköy', 'Çüngüş',
            ],

            Cities::ILLER['Edirne'] => [
                'Merkez', 'Keşan', 'Uzunköprü', 'İpsala', 'Havsa', 'Meriç', 'Enez', 'Süloğlu', 'Lalapaşa',
            ],

            Cities::ILLER['Elazığ'] => [
                'Merkez', 'Kovancılar', 'Karakoçan', 'Palu', 'Baskil', 'Arıcak', 'Maden', 'Sivrice', 'Keban', 'Alacakaya', 'Ağın',
            ],

            Cities::ILLER['Erzincan'] => [
                'Merkez', 'Tercan', 'Üzümlü', 'Refahiye', 'Çayırlı', 'İliç', 'Kemah', 'Kemaliye', 'Otlukbeli',
            ],

            Cities::ILLER['Erzurum'] => [
                'Yakutiye', 'Palandöken', 'Aziziye', 'Horasan', 'Oltu', 'Pasinler', 'Karayazı', 'Hınıs', 'Tekman', 'Aşkale', 'Karaçoban', 'Şenkaya', 'Çat', 'Tortum', 'Köprüköy', 'İspir', 'Narman', 'Uzundere', 'Olur', 'Pazaryolu',
            ],

            Cities::ILLER['Eskişehir'] => [
                'Odunpazarı', 'Tepebaşı', 'Sivrihisar', 'Çifteler', 'Seyitgazi', 'Alpu', 'Mihalıççık', 'Mahmudiye', 'Beylikova', 'İnönü', 'Günyüzü', 'Sarıcakaya', 'Mihalgazi', 'Han',
            ],

            Cities::ILLER['Gaziantep'] => [
                'Şahinbey', 'Şehitkamil', 'Nizip', 'İslahiye', 'Nurdağı', 'Araban', 'Oğuzeli', 'Yavuzeli', 'Karkamış',
            ],

            Cities::ILLER['Giresun'] => [
                'Merkez', 'Bulancak', 'Espiye', 'Görele', 'Tirebolu', 'Şebinkarahisar', 'Keşap', 'Dereli', 'Yağlıdere', 'Piraziz', 'Eynesil', 'Alucra', 'Çamoluk', 'Güce', 'Doğankent', 'Çanakçı',
            ],

            Cities::ILLER['Gümüşhane'] => [
                'Merkez', 'Kelkit', 'Şiran', 'Kürtün', 'Torul', 'Köse',
            ],

            Cities::ILLER['Hakkari'] => [
                'Yüksekova', 'Merkez', 'Şemdinli', 'Derecik', 'Çukurca',
            ],

            Cities::ILLER['Hatay'] => [
                'Antakya', 'İskenderun', 'Defne', 'Dörtyol', 'Samandağ', 'Kırıkhan', 'Reyhanlı', 'Arsuz', 'Altınözü', 'Hassa', 'Payas', 'Erzin', 'Yayladağı', 'Belen', 'Kumlu',
            ],

            Cities::ILLER['Isparta'] => [
                'Merkez', 'Yalvaç', 'Eğirdir', 'Şarkikaraağaç', 'Gelendost', 'Keçiborlu', 'Senirkent', 'Sütçüler', 'Gönen', 'Uluborlu', 'Atabey', 'Aksu', 'Yenişarbademli',
            ],

            Cities::ILLER['Mersin'] => [
                'Tarsus', 'Toroslar', 'Akdeniz', 'Yenişehir', 'Mezitli', 'Erdemli', 'Silifke', 'Anamur', 'Mut', 'Bozyazı', 'Gülnar', 'Aydıncık', 'Çamlıyayla',
            ],

            Cities::ILLER['İstanbul'] => [
                'Esenyurt', 'Küçükçekmece', 'Bağcılar', 'Pendik', 'Ümraniye', 'Bahçelievler', 'Üsküdar', 'Sultangazi', 'Maltepe', 'Gaziosmanpaşa', 'Kartal', 'Kadıköy', 'Esenler', 'Kağıthane', 'Fatih', 'Avcılar', 'Başakşehir', 'Ataşehir', 'Sancaktepe', 'Eyüp', 'Sarıyer', 'Beylikdüzü', 'Sultanbeyli', 'Güngören', 'Zeytinburnu', 'Şişli', 'Bayrampaşa', 'Arnavutköy', 'Tuzla', 'Çekmeköy', 'Büyükçekmece', 'Beykoz', 'Beyoğlu', 'Bakırköy', 'Silivri', 'Beşiktaş', 'Çatalca', 'Şile', 'Adalar',
            ],

            Cities::ILLER['İzmir'] => [
                'Buca', 'Karabağlar', 'Bornova', 'Konak', 'Karşıyaka', 'Bayraklı', 'Çiğli', 'Torbalı', 'Menemen', 'Gaziemir', 'Ödemiş', 'Kemalpaşa', 'Bergama', 'Aliağa', 'Menderes', 'Tire', 'Balçova', 'Urla', 'Narlıdere', 'Dikili', 'Kiraz', 'Seferihisar', 'Çeşme', 'Bayındır', 'Selçuk', 'Foça', 'Güzelbahçe', 'Kınık', 'Beydağ', 'Karaburun',
            ],

            Cities::ILLER['Kars'] => [
                'Merkez', 'Kağızman', 'Sarıkamış', 'Selim', 'Digor', 'Arpaçay', 'Akyaka', 'Susuz',
            ],

            Cities::ILLER['Kastamonu'] => [
                'Merkez', 'Tosya', 'Taşköprü', 'Cide', 'İnebolu', 'Araç', 'Bozkurt', 'Daday', 'Azdavay', 'Çatalzeytin', 'Doğanyurt', 'Küre', 'Pınarbaşı', 'İhsangazi', 'Şenpazar', 'Abana', 'Hanönü', 'Seydiler', 'Ağlı'
            ],

            Cities::ILLER['Kayseri'] => [
                'Melikgazi', 'Kocasinan', 'Talas', 'Develi', 'Yahyalı', 'Bünyan', 'Pınarbaşı', 'Tomarza', 'Yeşilhisar', 'Sarıoğlan', 'Hacılar', 'Sarız', 'Felahiye', 'Akkışla', 'Özvatan',
            ],

            Cities::ILLER['Kırklareli'] => [
                'Lüleburgaz', 'Merkez', 'Babaeski', 'Vize', 'Pınarhisar', 'Demirköy', 'Pehlivanköy', 'Kofçaz',
            ],

            Cities::ILLER['Kırşehir'] => [
                'Merkez', 'Kaman', 'Mucur', 'Çiçekdağı', 'Akpınar', 'Boztepe', 'Akçakent'
            ],

            Cities::ILLER['Kocaeli'] => [
                'Gebze', 'İzmit', 'Darıca', 'Körfez', 'Gölcük', 'Derince', 'Çayırova', 'Kartepe', 'Başiskele', 'Karamürsel', 'Kandıra', 'Dilovası',
            ],

            Cities::ILLER['Konya'] => [
                'Selçuklu', 'Meram', 'Karatay', 'Ereğli', 'Akşehir', 'Beyşehir', 'Çumra', 'Seydişehir', 'Ilgın', 'Cihanbeyli', 'Kulu', 'Karapınar', 'Kadınhanı', 'Sarayönü', 'Bozkır', 'Yunak', 'Hüyük', 'Doğanhisar', 'Altınekin', 'Hadim', 'Çeltik', 'Güneysınır', 'Emirgazi', 'Taşkent', 'Tuzlukçu', 'Derebucak', 'Akören', 'Ahırlı', 'Derbent', 'Halkapınar', 'Yalıhüyük',
            ],

            Cities::ILLER['Kütahya'] => [
                'Merkez', 'Tavşanlı', 'Simav', 'Gediz', 'Emet', 'Altıntaş', 'Domaniç', 'Hisarcık', 'Aslanapa', 'Çavdarhisar', 'Şaphane', 'Pazarlar', 'Dumlupınar',
            ],

            Cities::ILLER['Malatya'] => [
                'Yeşilyurt', 'Battalgazi', 'Doğanşehir', 'Akçadağ', 'Darende', 'Hekimhan', 'Yazıhan', 'Pütürge', 'Arapgir', 'Kuluncak', 'Arguvan', 'Kale', 'Doğanyol',
            ],

            Cities::ILLER['Manisa'] => [
                'Yunusemre', 'Akhisar', 'Şehzadeler', 'Turgutlu', 'Salihli', 'Soma', 'Alaşehir', 'Saruhanlı', 'Kula', 'Demirci', 'Kırıkağaç', 'Sarıgöl', 'Gördes', 'Selendi', 'Ahmetli', 'Gölmarmara', 'Köprübaşı',
            ],

            Cities::ILLER['Kahramanmaraş'] => [
                'Onikişubat', 'Dulkadiroğlu', 'Elbistan', 'Afşin', 'Türkoğlu', 'Pazarcık', 'Göksun', 'Andırın', 'Çağlayancerit', 'Nurhak', 'Ekinözü',
            ],

            Cities::ILLER['Mardin'] => [
                'Kızıltepe', 'Artuklu', 'Midyat', 'Nusaybin', 'Derik', 'Mazıdağı', 'Dargeçit', 'Savur', 'Yeşilli', 'Ömerli',
            ],

            Cities::ILLER['Muğla'] => [
                'Bodrum', 'Fethiye', 'Milas', 'Menteşe', 'Marmaris', 'Seydikemer', 'Ortaca', 'Yatağan', 'Dalaman', 'Köyceğiz', 'Ula', 'Datça', 'Kavaklıdere',
            ],

            Cities::ILLER['Muş'] => [
                'Merkez', 'Bulanık', 'Malazgirt', 'Varto', 'Korkut', 'Hasköy',
            ],

            Cities::ILLER['Nevşehir'] => [
                'Merkez', 'Ürgüp', 'Avanos', 'Gülşehir', 'Derinkuyu', 'Acıgöl', 'Kozaklı', 'Hacıbektaş',
            ],

            Cities::ILLER['Niğde'] => [
                'Merkez', 'Bor', 'Çiftlik', 'Ulukışla', 'Altunhisar', 'Çamardı',
            ],

            Cities::ILLER['Ordu'] => [
                'Altınordu', 'Ünye', 'Fatsa', 'Perşembe', 'Kumru', 'Korgan', 'Gölköy', 'Ulubey', 'Mesudiye', 'Akkuş', 'Aybastı', 'Gürgentepe', 'İkizce', 'Çatalpınar', 'Çaybaşı', 'Çamaş', 'Kabataş', 'Kabadüz', 'Gülyalı',
            ],

            Cities::ILLER['Rize'] => [
                'Merkez', 'Çayeli', 'Ardeşen', 'Pazar', 'Fındıklı', 'Kalkandere', 'Güneysu', 'İyidere', 'İkizdere', 'Derepazarı', 'Çamlıhemşin', 'Hemşin',
            ],

            Cities::ILLER['Sakarya'] => [
                'Adapazarı', 'Serdivan', 'Akyazı', 'Erenler', 'Hendek', 'Karasu', 'Geyve', 'Arifiye', 'Sapanca', 'Pamukova', 'Ferizli', 'Kocaali', 'Kaynarca', 'Söğütlü', 'Karapürçek', 'Taraklı',
            ],

            Cities::ILLER['Samsun'] => [
                'İlkadım', 'Atakum', 'Bafra', 'Çarşamba', 'Canik', 'Vezirköprü', 'Terme', 'Tekkeköy', 'Havza', '19 Mayıs', 'Alaçam', 'Salıpazarı', 'Ayvacık', 'Kavak', 'Asarcık', 'Ladik', 'Yakakent',
            ],

            Cities::ILLER['Siirt'] => [
                'Merkez', 'Kurtalan', 'Pervari', 'Baykan', 'Şirvan', 'Eruh', 'Tillo'
            ],

            Cities::ILLER['Sinop'] => [
                'Merkez', 'Boyabat', 'Gerze', 'Ayancık', 'Durağan', 'Türkeli', 'Erfelek', 'Saraydüzü', 'Dikmen',
            ],

            Cities::ILLER['Sivas'] => [
                'Merkez', 'Şarkışla', 'Yıldızeli', 'Suşehri', 'Gemerek', 'Zara', 'Kangal', 'Gürün', 'Divriği', 'Koyulhisar', 'Hafik', 'Ulaş', 'Altınyayla', 'İmranlı', 'Akıncılar', 'Gölova', 'Doğanşar',
            ],

            Cities::ILLER['Tekirdağ'] => [
                'Çorlu', 'Süleymanpaşa', 'Çerkezköy', 'Kapaklı', 'Ergene', 'Malkara', 'Saray', 'Şarköy', 'Hayrabolu', 'Muratlı', 'Marmaraereğlisi',
            ],

            Cities::ILLER['Tokat'] => [
                'Merkez', 'Erbaa', 'Turhal', 'Niksar', 'Zile', 'Reşadiye', 'Almus', 'Pazar', 'Yeşilyurt', 'Artova', 'Sulusaray', 'Başçiftlik',
            ],

            Cities::ILLER['Trabzon'] => [
                'Ortahisar', 'Akçaabat', 'Araklı', 'Of', 'Yomra', 'Arsin', 'Vakfıkebir', 'Sürmene', 'Maçka', 'Beşikdüzü', 'Çarşıbaşı', 'Çaykara', 'Tonya', 'Düzköy', 'Şalpazarı', 'Hayrat', 'Köprübaşı', 'Dernekpazarı',
            ],

            Cities::ILLER['Tunceli'] => [
                'Merkez', 'Pertek', 'Mazgirt', 'Çemişgezek', 'Ovacık', 'Hozat', 'Pülümür', 'Nazımiye',
            ],

            Cities::ILLER['Şanlıurfa'] => [
                'Eyyübiye', 'Haliliye', 'Siverek', 'Viranşehir', 'Karaköprü', 'Akçakale', 'Suruç', 'Birecik', 'Harran', 'Ceylanpınar', 'Bozova', 'Hilvan',
            ],

            Cities::ILLER['Uşak'] => [
                'Merkez', 'Banaz', 'Eşme', 'Sivaslı', 'Ulubey', 'Karahallı',
            ],

            Cities::ILLER['Van'] => [
                'İpekyolu', 'Erciş', 'Tuşba', 'Edremit', 'Özalp', 'Çaldıran', 'Başkale', 'Muradiye', 'Gürpınar', 'Gevaş', 'Saray', 'Çatak', 'Bahçesaray',
            ],

            Cities::ILLER['Yozgat'] => [
                'Merkez', 'Sorgun', 'Akdağmadeni', 'Yerköy', 'Boğazlıyan', 'Sarıkaya', 'Çekerek', 'Şefaatli', 'Saraykent', 'Çayıralan', 'Kadışehri', 'Aydıncık', 'Yenifakılı', 'Çandır',
            ],

            Cities::ILLER['Zonguldak'] => [
                'Ereğli', 'Merkez', 'Çaycuma', 'Devrek', 'Kozlu', 'Alaplı', 'Kilimli', 'Gökçebey',
            ],

            Cities::ILLER['Aksaray'] => [
                'Merkez', 'Ortaköy', 'Eskil', 'Gülağaç', 'Güzelyurt', 'Sultanhanı', 'Ağaçören', 'Sarıyahşi',
            ],

            Cities::ILLER['Bayburt'] => [
                'Merkez', 'Demirözü', 'Aydıntepe',
            ],

            Cities::ILLER['Karaman'] => [
                'Merkez', 'Ermenek', 'Sarıveliler', 'Ayrancı', 'Kazımkarabekir', 'Başyayla',
            ],

            Cities::ILLER['Kırıkkale'] => [
                'Merkez', 'Yahşihan', 'Keskin', 'Delice', 'Sulakyurt', 'Bahşili', 'Balışeyh', 'Karakeçili', 'Çelebi',
            ],

            Cities::ILLER['Batman'] => [
                'Merkez', 'Kozluk', 'Sason', 'Beşiri', 'Gercüş', 'Hasankeyf',
            ],

            Cities::ILLER['Şırnak'] => [
                'Cizre', 'Silopi', 'Merkez', 'İdil', 'Uludere', 'Beytüşşebap', 'Güçlükonak',
            ],

            Cities::ILLER['Bartın'] => [
                'Merkez', 'Ulus', 'Amasra', 'Kurucaşile',
            ],

            Cities::ILLER['Ardahan'] => [
                'Merkez', 'Göle', 'Çıldır', 'Hanak', 'Posof', 'Damal',
            ],

            Cities::ILLER['Iğdır'] => [
                'Merkez', 'Tuzluca', 'Aralık', 'Karakoyunlu',
            ],

            Cities::ILLER['Yalova'] => [
                'Merkez', 'Çiftlikköy', 'Çınarcık', 'Altınova', 'Armutlu', 'Termal',
            ],

            Cities::ILLER['Karabük'] => [
                'Merkez', 'Safranbolu', 'Yenice', 'Eskipazar', 'Eflani', 'Ovacık',
            ],

            Cities::ILLER['Kilis'] => [
                'Merkez', 'Musabeyli', 'Elbeyli', 'Polateli',
            ],

            Cities::ILLER['Osmaniye'] => [
                'Merkez', 'Kadirli', 'Düziçi', 'Bahçe', 'Toprakkale', 'Sumbas', 'Hasanbeyli',
            ],

            Cities::ILLER['Düzce'] => [
                'Merkez', 'Akçakoca', 'Kaynaşlı', 'Gölyaka', 'Çilimli', 'Yığılca', 'Gümüşova', 'Cumayeri',
            ],
        ];

        $this->createIlce($iller);

    }

    public function createIlce($iller)
    {
        foreach ($iller as $il_adi => $ilceler) {
            foreach ($ilceler as $ilce) {
                Districts::query()->create([
                    'il_id' => Cities::query()->where('il', $il_adi)->first()->id,
                    'ilce' => $ilce
                ]);
            }
        }
    }
}

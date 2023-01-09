<?php

namespace Database\Seeders;

use App\Models\Ilceler;
use App\Models\Iller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IlcelerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $iller = [
            Iller::ILLER['Adana'] => [
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

            Iller::ILLER['Adıyaman'] => [
                'Besni',
                'Çelikhan',
                'Gerger',
                'Gölbaşı',
                'Kâhta',
                'Samsat',
                'Sincik',
                'Tut',
            ],

            Iller::ILLER['Afyon'] => [
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

            Iller::ILLER['Ağrı'] => [
                'Diyadin',
                'Doğubayazıt',
                'Eleşkirt',
                'Hamur',
                'Patnos',
                'Taşlıçay',
                'Tutak',
            ],

            Iller::ILLER['Amasya'] => [
                'Göynücek',
                'Gümüşhacıköy',
                'Hamamözü',
                'Merzifon',
                'Suluova',
                'Taşova',
            ],

            Iller::ILLER['Ankara'] => [
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

            Iller::ILLER['Antalya'] => [
                'Kepez', 'Muratpaşa', 'Alanya', 'Manavgat', 'Konyaaltı', 'Serik', 'Aksu', 'Kumluca', 'Döşemealtı', 'Kaş', 'Korkuteli', 'Gazipaşa', 'Finike', 'Kemer', 'Elmalı', 'Demre', 'Akseki', 'Gündoğmuş', 'İbradi'
            ],

            Iller::ILLER['Artvin'] => [
                'Merkez', 'Hopa', 'Borçka', 'Arhavi', 'Yusufeli', 'Şavşat', 'Aksu', 'Kumluca', 'Ardanuç', 'Kemalpaşa', 'Murgul',
            ],

            Iller::ILLER['Aydın'] => [
                'Efeler', 'Nazilli', 'Söke', 'Kuşadası', 'Didim', 'İncirliova', 'Çine', 'Germencik', 'Bozdoğan', 'Köşk', 'Kuyucak', 'Koçarlı', 'Sultanhisar', 'Karacasu', 'Buharkent', 'Yenipazar', 'Karpuzlu',
            ],

            Iller::ILLER['Balıkesir'] => [
                'Altıeylül', 'Karesi', 'Edremit', 'Bandırma', 'Gönen', 'Ayvalık', 'Burhaniye', 'Bigadiç', 'Susurluk', 'Dursunbey', 'Sındırgı', 'Erdek', 'İvrindi', 'Havran', 'Kepsut', 'Manyas', 'Savaştepe', 'Gömeç', 'Balya', 'Marmara',
            ],

            Iller::ILLER['Bilecik'] => [
                'Merkez',
                'Bozüyük',
                'Osmaneli',
                'Söğüt',
                'Gölpazarı',
                'Pazaryeri',
                'İnhisar',
                'Yenipazar',
            ],

            Iller::ILLER['Bingöl'] => [
                'Merkez', 'Genç', 'Solhan', 'Karlıova', 'Adaklı', 'Kiğı', 'Yedisu', 'Yayladere',
            ],

            Iller::ILLER['Bitlis'] => [
                'Tatvan', 'Merkez', 'Güroymak', 'Ahlat', 'Hizan', 'Mutki', 'Adilcevaz',
            ],

            Iller::ILLER['Bolu'] => [
                'Merkez', 'Gerede', 'Mudurnu', 'Göynük', 'Mengen', 'Yeniçağa', 'Dörtdivan', 'Seben', 'Kıbrıscık',
            ],

            Iller::ILLER['Burdur'] => [
                'Merkez', 'Bucak', 'Gölhisar', 'Yeşilova', 'Çavdır', 'Tefenni', 'Ağlasun', 'Karamanlı', 'Altınyayla', 'Çeltikçi', 'Kemer',
            ],

            Iller::ILLER['Bursa'] => [
                'Osmangazi', 'Yıldırım', 'Nilüfer', 'İnegöl', 'Gemlik', 'Mustafakemalpa', 'Mudanya', 'Gürsu', 'Karacabey', 'Orhangazi', 'Kestel', 'Yenişehir', 'İznik', 'Orhaneli', 'Keles', 'Büyükorhan', 'Harmancık',
            ],

            Iller::ILLER['Çanakkale'] => [
                'Merkez', 'Biga', 'Çan', 'Gelibolu', 'Ayvacık', 'Ezine', 'Yenice', 'Bayramiç', 'Lapseki', 'Gökçeada', 'Eceabat', 'Bozcaada',
            ],

            Iller::ILLER['Çankırı'] => [
                'Merkez', 'Orta', 'Çerkeş', 'Ilgaz', 'Şabanözü', 'Kurşunlu', 'Yapraklı', 'Kızılırmak', 'Eldivan', 'Atkaracalar', 'Korgun', 'Bayramören',
            ],

            Iller::ILLER['Çorum'] => [
                'Merkez', 'Sungurlu', 'Osmancık', 'İskilip', 'Alaca', 'Bayat', 'Kargı', 'Mecitözü', 'Ortaköy', 'Uğurludağ', 'Dodurga', 'Oğuzlar', 'Laçin', 'Boğazkale',
            ],

            Iller::ILLER['Denizli'] => [
                'Pamukkale', 'Merkezefendi', 'Çivril', 'Acıpayam', 'Tavas', 'Honaz', 'Sarayköy', 'Buldan', 'Kale', 'Çal', 'Çameli', 'Serinhisar', 'Bozkurt', 'Güney', 'Çardak', 'Bekilli', 'Beyağaç', 'Babadağ', 'Baklan',
            ],

            Iller::ILLER['Diyarbakır'] => [
                'Bağlar', 'Kayapınar', 'Yenişehir', 'Ergani', 'Bismil', 'Sur', 'Silvan', 'Çınar', 'Çermik', 'Dicle', 'Kulp', 'Hani', 'Lice', 'Eğil', 'Hazro', 'Kocaköy', 'Çüngüş',
            ],

            Iller::ILLER['Edirne'] => [
                'Merkez', 'Keşan', 'Uzunköprü', 'İpsala', 'Havsa', 'Meriç', 'Enez', 'Süloğlu', 'Lalapaşa',
            ],

            Iller::ILLER['Elazığ'] => [
                'Merkez', 'Kovancılar', 'Karakoçan', 'Palu', 'Baskil', 'Arıcak', 'Maden', 'Sivrice', 'Keban', 'Alacakaya', 'Ağın',
            ],

            Iller::ILLER['Erzincan'] => [
                'Merkez', 'Tercan', 'Üzümlü', 'Refahiye', 'Çayırlı', 'İliç', 'Kemah', 'Kemaliye', 'Otlukbeli',
            ],

            Iller::ILLER['Erzurum'] => [
                'Yakutiye', 'Palandöken', 'Aziziye', 'Horasan', 'Oltu', 'Pasinler', 'Karayazı', 'Hınıs', 'Tekman', 'Aşkale', 'Karaçoban', 'Şenkaya', 'Çat', 'Tortum', 'Köprüköy', 'İspir', 'Narman', 'Uzundere', 'Olur', 'Pazaryolu',
            ],

            Iller::ILLER['Eskişehir'] => [
                'Odunpazarı', 'Tepebaşı', 'Sivrihisar', 'Çifteler', 'Seyitgazi', 'Alpu', 'Mihalıççık', 'Mahmudiye', 'Beylikova', 'İnönü', 'Günyüzü', 'Sarıcakaya', 'Mihalgazi', 'Han',
            ],

            Iller::ILLER['Gaziantep'] => [
                'Şahinbey', 'Şehitkamil', 'Nizip', 'İslahiye', 'Nurdağı', 'Araban', 'Oğuzeli', 'Yavuzeli', 'Karkamış',
            ],

            Iller::ILLER['Giresun'] => [
                'Merkez', 'Bulancak', 'Espiye', 'Görele', 'Tirebolu', 'Şebinkarahisar', 'Keşap', 'Dereli', 'Yağlıdere', 'Piraziz', 'Eynesil', 'Alucra', 'Çamoluk', 'Güce', 'Doğankent', 'Çanakçı',
            ],

            Iller::ILLER['Gümüşhane'] => [
                'Merkez', 'Kelkit', 'Şiran', 'Kürtün', 'Torul', 'Köse',
            ],

            Iller::ILLER['Hakkari'] => [
                'Yüksekova', 'Merkez', 'Şemdinli', 'Derecik', 'Çukurca',
            ],

            Iller::ILLER['Hatay'] => [
                'Antakya', 'İskenderun', 'Defne', 'Dörtyol', 'Samandağ', 'Kırıkhan', 'Reyhanlı', 'Arsuz', 'Altınözü', 'Hassa', 'Payas', 'Erzin', 'Yayladağı', 'Belen', 'Kumlu',
            ],

            Iller::ILLER['Isparta'] => [
                'Merkez', 'Yalvaç', 'Eğirdir', 'Şarkikaraağaç', 'Gelendost', 'Keçiborlu', 'Senirkent', 'Sütçüler', 'Gönen', 'Uluborlu', 'Atabey', 'Aksu', 'Yenişarbademli',
            ],

            Iller::ILLER['Mersin'] => [
                'Tarsus', 'Toroslar', 'Akdeniz', 'Yenişehir', 'Mezitli', 'Erdemli', 'Silifke', 'Anamur', 'Mut', 'Bozyazı', 'Gülnar', 'Aydıncık', 'Çamlıyayla',
            ],

            Iller::ILLER['İstanbul'] => [
                'Esenyurt', 'Küçükçekmece', 'Bağcılar', 'Pendik', 'Ümraniye', 'Bahçelievler', 'Üsküdar', 'Sultangazi', 'Maltepe', 'Gaziosmanpaşa', 'Kartal', 'Kadıköy', 'Esenler', 'Kağıthane', 'Fatih', 'Avcılar', 'Başakşehir', 'Ataşehir', 'Sancaktepe', 'Eyüp', 'Sarıyer', 'Beylikdüzü', 'Sultanbeyli', 'Güngören', 'Zeytinburnu', 'Şişli', 'Bayrampaşa', 'Arnavutköy', 'Tuzla', 'Çekmeköy', 'Büyükçekmece', 'Beykoz', 'Beyoğlu', 'Bakırköy', 'Silivri', 'Beşiktaş', 'Çatalca', 'Şile', 'Adalar',
            ],

            Iller::ILLER['İzmir'] => [
                'Buca', 'Karabağlar', 'Bornova', 'Konak', 'Karşıyaka', 'Bayraklı', 'Çiğli', 'Torbalı', 'Menemen', 'Gaziemir', 'Ödemiş', 'Kemalpaşa', 'Bergama', 'Aliağa', 'Menderes', 'Tire', 'Balçova', 'Urla', 'Narlıdere', 'Dikili', 'Kiraz', 'Seferihisar', 'Çeşme', 'Bayındır', 'Selçuk', 'Foça', 'Güzelbahçe', 'Kınık', 'Beydağ', 'Karaburun',
            ],

            Iller::ILLER['Kars'] => [
                'Merkez', 'Kağızman', 'Sarıkamış', 'Selim', 'Digor', 'Arpaçay', 'Akyaka', 'Susuz',
            ],

            Iller::ILLER['Kastamonu'] => [
                'Merkez', 'Tosya', 'Taşköprü', 'Cide', 'İnebolu', 'Araç', 'Bozkurt', 'Daday', 'Azdavay', 'Çatalzeytin', 'Doğanyurt', 'Küre', 'Pınarbaşı', 'İhsangazi', 'Şenpazar', 'Abana', 'Hanönü', 'Seydiler', 'Ağlı'
            ],

            Iller::ILLER['Kayseri'] => [
                'Melikgazi', 'Kocasinan', 'Talas', 'Develi', 'Yahyalı', 'Bünyan', 'Pınarbaşı', 'Tomarza', 'Yeşilhisar', 'Sarıoğlan', 'Hacılar', 'Sarız', 'Felahiye', 'Akkışla', 'Özvatan',
            ],

            Iller::ILLER['Kırklareli'] => [
                'Lüleburgaz', 'Merkez', 'Babaeski', 'Vize', 'Pınarhisar', 'Demirköy', 'Pehlivanköy', 'Kofçaz',
            ],

            Iller::ILLER['Kırşehir'] => [
                'Merkez', 'Kaman', 'Mucur', 'Çiçekdağı', 'Akpınar', 'Boztepe', 'Akçakent'
            ],

            Iller::ILLER['Kocaeli'] => [
                'Gebze', 'İzmit', 'Darıca', 'Körfez', 'Gölcük', 'Derince', 'Çayırova', 'Kartepe', 'Başiskele', 'Karamürsel', 'Kandıra', 'Dilovası',
            ],

            Iller::ILLER['Konya'] => [
                'Selçuklu', 'Meram', 'Karatay', 'Ereğli', 'Akşehir', 'Beyşehir', 'Çumra', 'Seydişehir', 'Ilgın', 'Cihanbeyli', 'Kulu', 'Karapınar', 'Kadınhanı', 'Sarayönü', 'Bozkır', 'Yunak', 'Hüyük', 'Doğanhisar', 'Altınekin', 'Hadim', 'Çeltik', 'Güneysınır', 'Emirgazi', 'Taşkent', 'Tuzlukçu', 'Derebucak', 'Akören', 'Ahırlı', 'Derbent', 'Halkapınar', 'Yalıhüyük',
            ],

            Iller::ILLER['Kütahya'] => [
                'Merkez', 'Tavşanlı', 'Simav', 'Gediz', 'Emet', 'Altıntaş', 'Domaniç', 'Hisarcık', 'Aslanapa', 'Çavdarhisar', 'Şaphane', 'Pazarlar', 'Dumlupınar',
            ],

            Iller::ILLER['Malatya'] => [
                'Yeşilyurt', 'Battalgazi', 'Doğanşehir', 'Akçadağ', 'Darende', 'Hekimhan', 'Yazıhan', 'Pütürge', 'Arapgir', 'Kuluncak', 'Arguvan', 'Kale', 'Doğanyol',
            ],

            Iller::ILLER['Manisa'] => [
                'Yunusemre', 'Akhisar', 'Şehzadeler', 'Turgutlu', 'Salihli', 'Soma', 'Alaşehir', 'Saruhanlı', 'Kula', 'Demirci', 'Kırıkağaç', 'Sarıgöl', 'Gördes', 'Selendi', 'Ahmetli', 'Gölmarmara', 'Köprübaşı',
            ],

            Iller::ILLER['Kahramanmaraş'] => [
                'Onikişubat', 'Dulkadiroğlu', 'Elbistan', 'Afşin', 'Türkoğlu', 'Pazarcık', 'Göksun', 'Andırın', 'Çağlayancerit', 'Nurhak', 'Ekinözü',
            ],

            Iller::ILLER['Mardin'] => [
                'Kızıltepe', 'Artuklu', 'Midyat', 'Nusaybin', 'Derik', 'Mazıdağı', 'Dargeçit', 'Savur', 'Yeşilli', 'Ömerli',
            ],

            Iller::ILLER['Muğla'] => [
                'Bodrum', 'Fethiye', 'Milas', 'Menteşe', 'Marmaris', 'Seydikemer', 'Ortaca', 'Yatağan', 'Dalaman', 'Köyceğiz', 'Ula', 'Datça', 'Kavaklıdere',
            ],

            Iller::ILLER['Muş'] => [
                'Merkez', 'Bulanık', 'Malazgirt', 'Varto', 'Korkut', 'Hasköy',
            ],

            Iller::ILLER['Nevşehir'] => [
                'Merkez', 'Ürgüp', 'Avanos', 'Gülşehir', 'Derinkuyu', 'Acıgöl', 'Kozaklı', 'Hacıbektaş',
            ],

            Iller::ILLER['Niğde'] => [
                'Merkez', 'Bor', 'Çiftlik', 'Ulukışla', 'Altunhisar', 'Çamardı',
            ],

            Iller::ILLER['Ordu'] => [
                'Altınordu', 'Ünye', 'Fatsa', 'Perşembe', 'Kumru', 'Korgan', 'Gölköy', 'Ulubey', 'Mesudiye', 'Akkuş', 'Aybastı', 'Gürgentepe', 'İkizce', 'Çatalpınar', 'Çaybaşı', 'Çamaş', 'Kabataş', 'Kabadüz', 'Gülyalı',
            ],

            Iller::ILLER['Rize'] => [
                'Merkez', 'Çayeli', 'Ardeşen', 'Pazar', 'Fındıklı', 'Kalkandere', 'Güneysu', 'İyidere', 'İkizdere', 'Derepazarı', 'Çamlıhemşin', 'Hemşin',
            ],

            Iller::ILLER['Sakarya'] => [
                'Adapazarı', 'Serdivan', 'Akyazı', 'Erenler', 'Hendek', 'Karasu', 'Geyve', 'Arifiye', 'Sapanca', 'Pamukova', 'Ferizli', 'Kocaali', 'Kaynarca', 'Söğütlü', 'Karapürçek', 'Taraklı',
            ],

            Iller::ILLER['Samsun'] => [
                'İlkadım', 'Atakum', 'Bafra', 'Çarşamba', 'Canik', 'Vezirköprü', 'Terme', 'Tekkeköy', 'Havza', '19 Mayıs', 'Alaçam', 'Salıpazarı', 'Ayvacık', 'Kavak', 'Asarcık', 'Ladik', 'Yakakent',
            ],

            Iller::ILLER['Siirt'] => [
                'Merkez', 'Kurtalan', 'Pervari', 'Baykan', 'Şirvan', 'Eruh', 'Tillo'
            ],

            Iller::ILLER['Sinop'] => [
                'Merkez', 'Boyabat', 'Gerze', 'Ayancık', 'Durağan', 'Türkeli', 'Erfelek', 'Saraydüzü', 'Dikmen',
            ],

            Iller::ILLER['Sivas'] => [
                'Merkez', 'Şarkışla', 'Yıldızeli', 'Suşehri', 'Gemerek', 'Zara', 'Kangal', 'Gürün', 'Divriği', 'Koyulhisar', 'Hafik', 'Ulaş', 'Altınyayla', 'İmranlı', 'Akıncılar', 'Gölova', 'Doğanşar',
            ],

            Iller::ILLER['Tekirdağ'] => [
                'Çorlu', 'Süleymanpaşa', 'Çerkezköy', 'Kapaklı', 'Ergene', 'Malkara', 'Saray', 'Şarköy', 'Hayrabolu', 'Muratlı', 'Marmaraereğlisi',
            ],

            Iller::ILLER['Tokat'] => [
                'Merkez', 'Erbaa', 'Turhal', 'Niksar', 'Zile', 'Reşadiye', 'Almus', 'Pazar', 'Yeşilyurt', 'Artova', 'Sulusaray', 'Başçiftlik',
            ],

            Iller::ILLER['Trabzon'] => [
                'Ortahisar', 'Akçaabat', 'Araklı', 'Of', 'Yomra', 'Arsin', 'Vakfıkebir', 'Sürmene', 'Maçka', 'Beşikdüzü', 'Çarşıbaşı', 'Çaykara', 'Tonya', 'Düzköy', 'Şalpazarı', 'Hayrat', 'Köprübaşı', 'Dernekpazarı',
            ],

            Iller::ILLER['Tunceli'] => [
                'Merkez', 'Pertek', 'Mazgirt', 'Çemişgezek', 'Ovacık', 'Hozat', 'Pülümür', 'Nazımiye',
            ],

            Iller::ILLER['Şanlıurfa'] => [
                'Eyyübiye', 'Haliliye', 'Siverek', 'Viranşehir', 'Karaköprü', 'Akçakale', 'Suruç', 'Birecik', 'Harran', 'Ceylanpınar', 'Bozova', 'Hilvan',
            ],

            Iller::ILLER['Uşak'] => [
                'Merkez', 'Banaz', 'Eşme', 'Sivaslı', 'Ulubey', 'Karahallı',
            ],

            Iller::ILLER['Van'] => [
                'İpekyolu', 'Erciş', 'Tuşba', 'Edremit', 'Özalp', 'Çaldıran', 'Başkale', 'Muradiye', 'Gürpınar', 'Gevaş', 'Saray', 'Çatak', 'Bahçesaray',
            ],

            Iller::ILLER['Yozgat'] => [
                'Merkez', 'Sorgun', 'Akdağmadeni', 'Yerköy', 'Boğazlıyan', 'Sarıkaya', 'Çekerek', 'Şefaatli', 'Saraykent', 'Çayıralan', 'Kadışehri', 'Aydıncık', 'Yenifakılı', 'Çandır',
            ],

            Iller::ILLER['Zonguldak'] => [
                'Ereğli', 'Merkez', 'Çaycuma', 'Devrek', 'Kozlu', 'Alaplı', 'Kilimli', 'Gökçebey',
            ],

            Iller::ILLER['Aksaray'] => [
                'Merkez', 'Ortaköy', 'Eskil', 'Gülağaç', 'Güzelyurt', 'Sultanhanı', 'Ağaçören', 'Sarıyahşi',
            ],

            Iller::ILLER['Bayburt'] => [
                'Merkez', 'Demirözü', 'Aydıntepe',
            ],

            Iller::ILLER['Karaman'] => [
                'Merkez', 'Ermenek', 'Sarıveliler', 'Ayrancı', 'Kazımkarabekir', 'Başyayla',
            ],

            Iller::ILLER['Kırıkkale'] => [
                'Merkez', 'Yahşihan', 'Keskin', 'Delice', 'Sulakyurt', 'Bahşili', 'Balışeyh', 'Karakeçili', 'Çelebi',
            ],

            Iller::ILLER['Batman'] => [
                'Merkez', 'Kozluk', 'Sason', 'Beşiri', 'Gercüş', 'Hasankeyf',
            ],

            Iller::ILLER['Şırnak'] => [
                'Cizre', 'Silopi', 'Merkez', 'İdil', 'Uludere', 'Beytüşşebap', 'Güçlükonak',
            ],

            Iller::ILLER['Bartın'] => [
                'Merkez', 'Ulus', 'Amasra', 'Kurucaşile',
            ],

            Iller::ILLER['Ardahan'] => [
                'Merkez', 'Göle', 'Çıldır', 'Hanak', 'Posof', 'Damal',
            ],

            Iller::ILLER['Iğdır'] => [
                'Merkez', 'Tuzluca', 'Aralık', 'Karakoyunlu',
            ],

            Iller::ILLER['Yalova'] => [
                'Merkez', 'Çiftlikköy', 'Çınarcık', 'Altınova', 'Armutlu', 'Termal',
            ],

            Iller::ILLER['Karabük'] => [
                'Merkez', 'Safranbolu', 'Yenice', 'Eskipazar', 'Eflani', 'Ovacık',
            ],

            Iller::ILLER['Kilis'] => [
                'Merkez', 'Musabeyli', 'Elbeyli', 'Polateli',
            ],

            Iller::ILLER['Osmaniye'] => [
                'Merkez', 'Kadirli', 'Düziçi', 'Bahçe', 'Toprakkale', 'Sumbas', 'Hasanbeyli',
            ],

            Iller::ILLER['Düzce'] => [
                'Merkez', 'Akçakoca', 'Kaynaşlı', 'Gölyaka', 'Çilimli', 'Yığılca', 'Gümüşova', 'Cumayeri',
            ],
        ];

        $this->createIlce($iller);

    }

    public function createIlce($iller)
    {
        foreach ($iller as $il_adi => $ilceler) {
            foreach ($ilceler as $ilce) {
                Ilceler::query()->create([
                    'il_id' => Iller::query()->where('il', $il_adi)->first()->id,
                    'ilce' => $ilce
                ]);
            }
        }
    }
}

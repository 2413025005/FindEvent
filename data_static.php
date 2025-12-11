<?php
// FILE: data_static.php
// Berisi array statis lama untuk memberikan detail tambahan (Pemateri, HTM, Kontak)
// yang tidak ada di skema database sederhana kita.

// TANGGAL REFERENSI HARI INI: 2025-12-08

$events = [
    // --- 1. EVENT SEMINAR: Future of Key ---
    [
        'id' => 'seminar-cosplay',
        'judul' => 'Future of English: Key to Academic and Career Achievement',
        'kategori' => 'seminar', 
        'lokasi' => 'Auditorium Fakultas Hukum Universitas Lampung',
        'tanggal' => '27 Desember 2025',
        'waktu' => 'Waktu tidak disebutkan',
        'gambar' => 'assets/seminar_cosplay.jpg', 
        'deskripsi' => 'Seminar unik yang memadukan pembelajaran, kreativitas, cosplay, dan kegiatan menyenangkan. Bertujuan untuk menjelajahi pentingnya penguasaan Bahasa Inggris sebagai pondasi masa depan.',
        'tag_tema' => 'Future of English: Key to Academic and Career Achievement',
        'deadline' => '2025-12-28', 
        'pendaftaran' => [
            ['gelombang' => 'Pendaftaran', 'periode' => 'HTM', 'htm' => 'Rp 30.000,00'],
        ],
        'link_daftar' => 'https://bit.ly/seminarlc25',
        'benefit' => [
            'E-Certificate', 'Boost Your Academic Performance', 'Expand Your Network and Have Fun',
        ],
        'aktivitas' => [
            'Inspiring Seminar', 'Fun Activities & Games', 'Cosplay Showcase',
        ],
        'kontak' => [
            'Fawazzah' => '+62 852-7456-0088', 'Sisil' => '+62 857-6679-4396',
        ],
        'organizer' => 'UKM ESO Universitas Lampung',
    ],

    // --- 2. EVENT WORKSHOP: Design Editing Class 2025 ---
    [
        'id' => 'design-class',
        'judul' => 'Design Editing Class 2025',
        'kategori' => 'workshop', 
        'lokasi' => 'Zoom Meeting Cloud',
        'tanggal' => '26 Oktober 2025',
        'waktu' => '09.00 WIB s.d. selesai',
        'gambar' => 'assets/design_class.jpg', 
        'deskripsi' => 'Kelas desain gratis yang diselenggarakan oleh Assets FKIP Unila X HIMA BKPI UINRIL. Fokus pada inovasi dan eksplorasi desain editing untuk mewujudkan karya yang menginspirasi.',
        'tag_tema' => 'Beyond Creativity, Inovasi dan Eksploeasi Desain Editing untuk Mewujudkan Karya yang menginspirasi',
        'deadline' => '2025-10-25',
        'pendaftaran' => [
            ['gelombang' => 'Pendaftaran', 'periode' => '22 Oktober - 25 Oktober 2025', 'htm' => 'GRATIS'],
        ],
        'pemateri' => [
            ['materi' => 'Graphic Designer Official Unila', 'nama' => 'Rico Prediansyah', 'jabatan' => 'Graphic Designer Official Unila'],
        ],
        'link_daftar' => 'https://forms.gle/wX11ff7Sz5oTpVhH8',
        'benefit' => [
            'E-Sertifikat', 'Relasi', 'Ilmu yang Bermanfaat', 'Doorprize',
        ],
        'kontak' => [
            'Anggit Yunizar' => '+62 856-0932-9778', 'Fahda Zhafira' => '+62 877-5010-2892',
        ],
        'kolaborasi' => 'Assets FKIP Unila X HIMA BKPI UINRIL',
    ],

    // --- 3. EVENT WORKSHOP: MEDIACRAFT 2025 ---
    [
        'id' => 'mediacraft',
        'judul' => 'WORKSHOP KEMEDIAAN - MEDIACRAFT BEM U KBM 2025',
        'kategori' => 'workshop', 
        'lokasi' => 'Gedung Aula K - FKIP Unila',
        'tanggal' => '14 Juni 2025',
        'waktu' => '08.30 WIB – selesai',
        'gambar' => 'assets/mediacraft.jpg', 
        'deskripsi' => 'Workshop gratis tentang dunia kreatif & produksi konten yang berdampak. Pelajari cara mengembangkan ide dan menyuarakan melalui media yang tepat.',
        'tag_tema' => 'Crafting Ideas, Shaping Impact',
        'deadline' => '2025-06-13',
        'pendaftaran' => [
            ['gelombang' => 'Pendaftaran', 'periode' => '8 Juni - 13 Juni 2025', 'htm' => 'GRATIS'],
        ],
        'pemateri' => [
            ['materi' => 'Staff Humas Unila', 'nama' => 'Kak Andri Wijaya', 'jabatan' => 'Staff Humas Unila'],
        ],
        'link_daftar' => 'https://bit.ly/pendaftaranmediacraft2025',
        'benefit' => [
            'Wawasan & Insight keren', 'E-sertifikat', 'Snack', 'Doorprize menarik', 'Relasi & networking',
        ],
        'catatan' => 'Seluruh peserta membawa alat tulis dan botol minum.',
        'kontak' => [
            'Destia Rahma' => '0857-1814-3386', 'Muthia Fazila' => '0856-5898-1702',
        ],
        'organizer' => 'Kementerian Kominfo BEM U KBM 2025',
    ],

    // --- 4. EVENT LOMBA: GAMUD 2025 ---
    [
        'id' => 'gamud-2025',
        'judul' => 'Gelaran Karya Eksakta Muda (GAMUD) 2025',
        'kategori' => 'lomba', 
        'lokasi' => 'Aula Gedung C FKIP Unila',
        'tanggal' => '22 November 2025',
        'waktu' => '07.30 WIB s.d. selesai',
        'gambar' => 'assets/gamud.jpg', 
        'deskripsi' => 'GAMUD 2025 adalah ajang ekspresi bagi mahasiswa/i Universitas Lampung melalui Lomba Poster, Solo Song, dan Baca Puisi.',
        'tag_tema' => 'Ignite Your Passion, Create Your Future',
        'deadline' => '2025-11-21', 
        'cabang_lomba' => [
            ['nama' => 'Lomba Poster', 'tingkat' => 'Terbuka untuk seluruh mahasiswa/i Universitas Lampung'],
            ['nama' => 'Lomba Solo Song', 'tingkat' => 'Khusus mahasiswa/i Fakultas Keguruan dan Ilmu Pendidikan (FKIP)'],
            ['nama' => 'Lomba Baca Puisi', 'tingkat' => 'Khusus mahasiswa/i Fakultas Keguruan dan Ilmu Pendidikan (FKIP)'],
        ],
        'htm_note' => 'Untuk pembayaran dimohon untuk melebihkan Rp. 1.000,- sebagai biaya admin.',
        'htm' => [
            ['lomba' => 'Solo Song', 'gelombang' => 'Gelombang 1', 'harga' => 'Rp 15.000'], ['lomba' => 'Poster', 'gelombang' => 'Gelombang 1', 'harga' => 'Rp 10.000'],
            ['lomba' => 'Baca Puisi', 'gelombang' => 'Gelombang 1', 'harga' => 'Rp 10.000'], ['lomba' => 'Solo Song', 'gelombang' => 'Gelombang 2', 'harga' => 'Rp 20.000'],
            ['lomba' => 'Poster', 'gelombang' => 'Gelombang 2', 'harga' => 'Rp 15.000'], ['lomba' => 'Baca Puisi', 'gelombang' => 'Gelombang 2', 'harga' => 'Rp 15.000'],
        ],
        'link_daftar' => 'https://msha.ke/gamud2025',
        'pembayaran' => [
            ['metode' => 'DANA', 'rekening' => '082316757291', 'an' => 'Esti Yulia'], ['metode' => 'BANK BRI', 'rekening' => '069701030890505', 'an' => 'Giskha ayudhiya'],
        ],
        'kontak' => [
            'CP Lomba (Erik Mediyanto)' => '0856-0900-3651', 'CP Lomba (Risti Tri Ariani)' => '0821-7624-8405',
            'Konfirmasi Pembayaran (Ghiska)' => '0857-8324-9411', 'Konfirmasi Pembayaran (Esti)' => '0831-7536-4328',
        ],
        'benefit' => [
            'JUARA 1 : Sertifikat & Uang Pembinaan', 'JUARA 2 : Sertifikat & Uang Pembinaan', 'JUARA 3 : Sertifikat & Uang Pembinaan',
        ],
        'organizer' => 'HIMASAKTA FKIP UNILA 2025',
    ],

    // --- 5. EVENT SEMINAR: LKMM-TD ---
    [
        'id' => 'lkmm-td-2025',
        'judul' => 'Latihan Kepemimpinan dan Manajemen Mahasiswa',
        'kategori' => 'seminar', 
        'lokasi' => 'Universitas Lampung',
        'tanggal' => '18 Oktober 2025',
        'waktu' => '07.30 WIB s.d. selesai',
        'gambar' => 'assets/lkmm_td.jpg', 
        'deskripsi' => 'Kegiatan ini bertujuan membentuk karakter kepemimpinan mahasiswa serta meningkatkan kemampuan manajemen diri. Peserta akan mendapatkan pembekalan dari narasumber berpengalaman di bidang kepemimpinan kampus.',
        'tag_tema' => 'Membangun Semangat Kepemimpinan dan Manajemen Diri Menuju Mahasiswa Unggul',
        'deadline' => '2025-10-11',
        'pemateri' => [
            ['materi' => 'Public Speaking', 'nama' => 'M. Fajar Ghosyiah Zain, S.Pd., CPS', 'jabatan' => 'Mentor Public Speaking'], ['materi' => 'Teknik Sidang dan Kepemimpinan', 'nama' => 'Muhammad Hari Al Fatah', 'jabatan' => 'Ketua DPM Universitas Lampung 2025'],
            ['materi' => 'Manajemen Waktu & Personal Branding', 'nama' => 'Guest Star ??', 'jabatan' => ''],
        ],
        'pendaftaran' => [
            ['gelombang' => 'Gelombang 1', 'periode' => '1 - 7 Oktober', 'htm' => 'Rp 35.000,00'], ['gelombang' => 'Gelombang 2', 'periode' => '8 - 11 Oktober', 'htm' => 'Rp 40.000,00'],
        ],
        'link_daftar' => 'https://msha.ke/lkmmtd2025', 
        'link_tambahan' => [
            'text' => 'Lihat Kontrak Belajar',
            'url' => 'https://drive.google.com/drive/folders/1KIgPpyHCCeLVy5qEor258ucpkmf9VF95',
        ],
        'pembayaran' => [
            ['metode' => 'BNI', 'rekening' => '1881462056', 'an' => 'Adinda Ulfa'], ['metode' => 'DANA', 'rekening' => '085841308676', 'an' => 'Najwa Tsabita Efendi'],
        ],
        'kontak' => [
            'Chifa Chairunnisa' => '+62 895-1920-3212', 'Winta Novinola' => '+62 823-7228-2368',
            'Konfirmasi Pembayaran (Najwa)' => '+62 858-4130-8676', 'Konfirmasi Pembayaran (Adinda)' => '+62 896-0269-5941',
        ],
        'kolaborasi' => 'Himasakta X Medfu X Fosmaki X Formandibula X Formatif',
    ],

    // --- 6. EVENT LOMBA: Impression X Specta 2025 ---
    [
        'id' => 'impression-specta',
        'judul' => 'Impression X Specta 2025',
        'kategori' => 'lomba', 
        'lokasi' => 'Aula K, FKIP Universitas Lampung',
        'tanggal' => '30 Oktober - 1 November 2025',
        'waktu' => '08.00 WIB s.d. selesai',
        'gambar' => 'assets/impression.jpg', 
        'deskripsi' => 'Impression X Specta merupakan ajang lomba tingkat nasional yang memadukan kreativitas, seni, dan teknologi. Termasuk LCT, Poster Infografis, dan E-Sport E-Football.',
        'tag_tema' => 'Membuka Ruang Ekspresi dan Inovasi Generasi Muda di Era Perubahan Digital',
        'deadline' => '2025-10-16', 
        'cabang_lomba' => [
            ['nama' => 'Lomba Cepat Tepat (LCT)', 'tingkat' => 'SMA/SMK se-Sumbagsel'], ['nama' => 'Poster Infografis', 'tingkat' => 'Umum Nasional'],
            ['nama' => 'E-Sport E-Football (Steam)', 'tingkat' => 'Siswa & Mahasiswa se-Bandar Lampung'],
        ],
        'timeline' => [
            ['kegiatan' => 'Pendaftaran Gel. 1', 'tanggal' => '31 Agustus – 21 September 2025'], ['kegiatan' => 'Pendaftaran Gel. 2', 'tanggal' => '22 September – 16 Oktober 2025'],
            ['kegiatan' => 'Technical Meeting', 'tanggal' => '21 Oktober 2025'], ['kegiatan' => 'Babak Penyisihan', 'tanggal' => '30 - 31 Oktober 2025'],
            ['kegiatan' => 'Babak Semifinal & Final', 'tanggal' => '1 November 2025'], ['kegiatan' => 'Pengumuman Pemenang', 'tanggal' => '1 November 2025'],
        ],
        'htm' => [
            ['lomba' => 'LCT', 'gel1' => '110k', 'gel2' => '130k'], ['lomba' => 'Poster Infografis', 'gel1' => '20k', 'gel2' => '25k'],
            ['lomba' => 'E-Football', 'gel1' => '30k', 'gel2' => '40k'],
        ],
        'link_daftar' => 'https://bit.ly/3JWrR3C, https://bit.ly/4piwiu7', 
        'pembayaran' => [
            ['metode' => 'BNI', 'rekening' => '1880697533', 'an' => 'Larisa Ramadhanty'], ['metode' => 'DANA', 'rekening' => '088286014286', 'an' => 'Larisa Ramadhanty'],
        ],
        'kontak' => [
            'CP LCT (Tika)' => '0857-7761-8485', 'CP E-Football (Ninda)' => '0822-9400-4980',
            'CP Poster (Naila)' => '0878-9459-0492', 'Konfirmasi Pembayaran (Larisa)' => '0882-8601-4286',
        ],
        'organizer' => 'Formatif FKIP UNILA 2025',
    ],

    // --- 7. EVENT SEMINAR/WORKSHOP: MEDIAPHORIA 2025 (Final Revision) ---
    [
        'id' => 'mediaphoria-2025-final',
        'judul' => 'Mediaphoria 2025',
        'kategori' => 'seminar', 
        'lokasi' => 'Aula C FKIP Unila',
        'tanggal' => '8 November 2025',
        'waktu' => '08.00 WIB s.d. Selesai',
        'gambar' => 'assets/mediaphoria.jpg', 
        'deskripsi' => 'Acara paling inspiratif tahun ini, MEDIAPHORIA 2025! Yuk jadi bagian dari keseruan yang penuh ilmu, relasi, dan inspirasi bareng Omped Visual, fokus pada ekspresi, edukasi, dan transformasi media.',
        'tag_tema' => 'Media sebagai Wadah Ekspresi, Edukasi, dan Transformasi',
        'deadline' => '2025-11-07', 
        'pemateri' => [
        ['materi' => 'Media & Transformasi', 'nama' => 'Omped Visual', 'jabatan' => 'Content Creator/Desainer Grafis'],
        ],
        'pendaftaran' => [
            ['gelombang' => 'Pendaftaran', 'periode' => '31 Oktober – 7 November 2025', 'htm' => '10K'], 
        ],
        'link_daftar' => 'https://bit.ly/mediaphoria2025-link',
        'benefit' => [
            'E-Sertifikat', 'Snack', 'Knowledge', 'Doorprize', 'Merchandise',
        ],
        'kontak' => [
            'CP (Tiara Dwi Priliantika)' => '0838-2751-6827',
            'Konfirmasi Pembayaran (Yulia Sinta Sari)' => '0859-7519-3703',
            'Konfirmasi Pembayaran (Zahra Salsabila)' => '0815-4127-6855',
        ],
        'organizer' => 'Himasakta, HMJPBS, Medfu, Formatif',
        'sosial_media' => [
            ['platform' => 'Instagram', 'akun' => '@himasakta_unila'], ['platform' => 'Instagram', 'akun' => '@hmjpbs.unila'],
            ['platform' => 'Instagram', 'akun' => '@medfufkipunila'], ['platform' => 'Instagram', 'akun' => '@formatiffkipunila'],
        ],
    ],

    // --- 8. EVENT WORKSHOP: Paint and Connect ---
    [
        'id' => 'paint-connect', // ID unik
        'judul' => 'Paint and Connect : Merajut Makna Lewat Warna', // HARUS SAMA PERSIS dengan di Database!
        'kategori' => 'workshop', 
        'lokasi' => 'Maru House',
        'tanggal' => 'Sabtu, 22 November 2025',
        'waktu' => '08.30 WIB – selesai',
        'gambar' => 'assets/paint.jpg',
        'deskripsi' => 'Dari setiap goresan kuas, ada cerita yang ingin disampaikan. Luangkan waktumu sejenak untuk menenangkan diri, menyalurkan kreativitas, dan menjalin koneksi baru!',
        'tag_tema' => 'Merajut Makna Lewat Warna',
        'deadline' => '2025-11-19', 
        'pendaftaran' => [
            ['gelombang' => 'Gelombang 1', 'periode' => '13 - 16 November 2025', 'htm' => 'Rp 50.000'],
            ['gelombang' => 'Gelombang 2', 'periode' => '17 - 19 November 2025', 'htm' => 'Rp 55.000'],
        ],
        'link_daftar' => 'https://forms.gle/vshYyWHSCw8tZbAE9',
        'benefit' => [
            'E-Sertifikat', 'Set Painting + 1 Minuman (Kopsu aren/Peach tea/Lemon tea)', 
            'Art Counseling Therapy bersama tim Deeptalk Lampung Camp', 'Membawa pulang karya pribadi',
        ],
        'pembayaran' => [
            ['metode' => 'DANA', 'rekening' => '087892143330', 'an' => 'Soulaluna Rabbani'],
            ['metode' => 'Seabank', 'rekening' => '901839335964', 'an' => 'Soulaluna Rabbani'],
        ],
        'kontak' => [
            'Adellya' => '0857-6994-9681', 'Melani' => '0823-7708-9460',
            'Konfirmasi Pembayaran (Luna)' => '087892143330',
        ],
        'sosial_media' => [
            ['platform' => 'Instagram', 'akun' => '@formabikaunila'], 
            ['platform' => 'YouTube', 'akun' => 'Formabika Unila'],
            ['platform' => 'Email', 'akun' => 'uformabika@gmail.com'],
        ],
    ],
];
?>
// script.js: Gabungan Logika Dark Mode dan Filter Interaktif Instan

document.addEventListener('DOMContentLoaded', () => {
    console.log("JS INTERAKTIF DIMUAT");

    // =======================================================
    // --- FITUR 1: DARK MODE TOGGLE ---
    // =======================================================

    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const body = document.body;

    function enableDarkMode() {
        body.classList.add('dark-mode');
        // Simpan preferensi di browser (agar mode tidak hilang saat refresh)
        localStorage.setItem('darkMode', 'enabled');
    }

    function disableDarkMode() {
        body.classList.remove('dark-mode');
        // Hapus preferensi
        localStorage.setItem('darkMode', 'disabled');
    }

    // 1. Cek Preferensi Saat Halaman Dimuat
    if (localStorage.getItem('darkMode') === 'enabled') {
        enableDarkMode();
    }

    // 2. Tambahkan Event Listener ke Tombol
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', () => {
            if (body.classList.contains('dark-mode')) {
                disableDarkMode();
            } else {
                enableDarkMode();
            }
        });
    }

    // =======================================================
    // --- FITUR 2: FILTER INTERAKTIF INSTAN (Tanpa Refresh) ---
    // =======================================================
    
    // NOTE: Fitur ini hanya relevan jika kamu menaruh tombol filter di halaman Beranda
    // Jika kamu hanya menggunakan filter PHP di kategori.php, blok ini bisa diabaikan/dihapus.

    const filterButtons = document.querySelectorAll('.js-filter-btn');
    const eventCards = document.querySelectorAll('.event-card');

    if (filterButtons.length > 0 && eventCards.length > 0) {
        
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                const filterType = button.getAttribute('data-filter');

                // 1. Manipulasi DOM: Ganti kelas aktif pada tombol
                filterButtons.forEach(btn => {
                    btn.classList.remove('active');
                });
                button.classList.add('active');

                // 2. Manipulasi DOM: Tampilkan/Sembunyikan Kartu Event
                eventCards.forEach(card => {
                    const cardKategori = card.getAttribute('data-kategori');
                    
                    if (filterType === 'semua' || cardKategori === filterType) {
                        card.style.display = 'flex'; // Tampilkan
                    } else {
                        card.style.display = 'none'; // Sembunyikan
                    }
                });
            });
        });

        // Terapkan filter 'Semua Event' sebagai default saat halaman dimuat
        const defaultButton = document.querySelector('.js-filter-btn[data-filter="semua"]');
        if (defaultButton) {
            defaultButton.click();
        }

    } else {
        // console.warn("Filter Interaktif tidak diinisialisasi. Tombol atau Kartu Event tidak ditemukan.");
    }
});
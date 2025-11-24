
    
    <style>

        /* * =======================================================
         * INI BAGIAN UTAMA UNTUK TOMBOL ANDA
         * =======================================================
         */
        .floating-search-bar {
            /* 1. Posisi Mengambang di Bawah Tengah */
            position: fixed;       /* Tetap di layar, bahkan saat di-scroll */
            bottom: 25px;          /* Jarak dari bawah layar */
            left: 50%;             /* Posisikan 50% dari kiri */
            transform: translateX(-50%); /* Geser ke kiri 50% dari lebarnya sendiri (trik centering) */
            z-index: 1000;         /* Pastikan selalu di atas konten lain */

            /* 2. Styling (Tampilan) */
            background-color: #FFF000; /* Kuning terang sesuai permintaan */
            border-radius: 30px;   /* Membuat sudut sangat bulat (pill shape) */
            padding: 12px 24px;    /* Jarak di dalam tombol (atas/bawah, kiri/kanan) */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15); /* Efek bayangan agar terlihat 'mengambang' */
            cursor: pointer;       /* Mengubah kursor menjadi tangan saat diarahkan */
            
            /* 3. Mengatur Konten di Dalam (Ikon + Teks) */
            display: flex;         /* Gunakan flexbox untuk menata item berdampingan */
            align-items: center;   /* Menyejajarkan item di tengah secara vertikal */
            gap: 10px;             /* Memberi jarak 10px antara ikon dan teks */
            
            /* 4. Efek Transisi */
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease;
        }

        /* Efek saat kursor mouse di atas tombol */
        .floating-search-bar:hover {
            transform: translateX(-50%) scale(1.05); /* Sedikit membesar */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);  /* Bayangan lebih jelas */
        }

        .search-icon {
            font-size: 1.1em; /* Ukuran ikon (emoji) */
        }

        .search-text {
            font-size: 1em;
            font-weight: 600; /* Membuat teks sedikit tebal */
            color: #222;      /* Warna teks agar kontras dengan kuning */
            white-space: nowrap; /* Mencegah teks patah ke baris baru */
        }
    </style>

    <div class="floating-search-bar">
        <span class="search-icon">🔍</span>
        <span class="search-text">Lihat Garasi</span>
    </div>

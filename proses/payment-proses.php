<?php
session_start();
include '../config/db.php';
include '../components/midtrans-header.php';

$database = new Database();
$conn = $database->getConnection();

$email = $_SESSION["email"];
$bayar = $_POST["bayar"] ?? null;

$imgcar = ""; 
$namacar = "";
$hargaakhir = 0;
$orderidakhir = "";
$namapanjangakhir = "";
$telpakhir = "";

$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$res = $stmt->get_result();
$user = $res->fetch_assoc();
$user_id = $user['id'] ?? null;

if (!$user_id) {
    header("Location: ../index.php?url=view");
    exit;
}

if ($bayar === "yes") {
    $namaLengkap = $_POST['namalengkap'] ?? '';
    $telp        = $_POST['telp'] ?? '';
    $country     = $_POST['country'] ?? '';
    $alamat      = $_POST['alamat'] ?? '';
    $imgcar      = $_POST['img_car'] ?? '';
    $namaCar     = $_POST['nama_car'] ?? '';
    $harga       = (int)(str_replace('.', '', $_POST['harga'] ?? 0));
    
    $stmt2 = $conn->prepare("SELECT id FROM mobil WHERE nama_car = ?");
    $stmt2->bind_param("s", $namaCar);
    $stmt2->execute();
    $res2 = $stmt2->get_result();
    $mobil = $res2->fetch_assoc();
    $mobil_id = $mobil['id'] ?? null;
    
    $status  = "pending";
    $banyak  = 1;

    $stmt3 = $conn->prepare("INSERT INTO orders (user_id, mobil_id, banyak, total_harga, status, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt3->bind_param("iiiss", $user_id, $mobil_id, $banyak, $harga, $status);
    $stmt3->execute();
    $lastOrderId = $conn->insert_id;

    $stmt4 = $conn->prepare("INSERT INTO personal (id_pembeli, id_mobil, country, alamat) VALUES (?, ?, ?, ?)");
    $stmt4->bind_param("iiss", $user_id, $mobil_id, $country, $alamat);
    $stmt4->execute();

    $namacar = $namaCar;
    $hargaakhir = $harga;
    $orderidakhir = "ORDER-" . $lastOrderId;
    $namapanjangakhir = $namaLengkap;
    $telpakhir = $telp; 

} else {
    $stmtcek = $conn->prepare("SELECT * FROM orders WHERE user_id = ? AND status = 'pending' LIMIT 1");
    $stmtcek->bind_param("i", $user_id);
    $stmtcek->execute();
    $rescek = $stmtcek->get_result();
    $order = $rescek->fetch_assoc();

    if (!$order) {
        header("Location: ../index.php?url=view");
        exit;
    }
    $lastOrderId = $order['id'];
    $mobil_id    = $order['mobil_id'];
    $hargaakhir  = $order['total_harga'];

    $stmt2 = $conn->prepare("SELECT nama_car, img_car FROM mobil WHERE id = ?"); 
    $stmt2->bind_param("i", $mobil_id);
    $stmt2->execute();
    $res2 = $stmt2->get_result();
    $mobil = $res2->fetch_assoc();
    $namacar = $mobil['nama_car'] ?? '';
    $imgcar = $mobil['img_car'] ?? ''; 
    
    $stmtUser = $conn->prepare("SELECT nama_lengkap, telp FROM users WHERE id = ?"); 
    $stmtUser->bind_param("i", $user_id);
    $stmtUser->execute();
    $resUser = $stmtUser->get_result();
    $userData = $resUser->fetch_assoc();
    $namapanjangakhir = $userData['nama_lengkap'] ?? '';
    $telpakhir        = $userData['telp'] ?? '';

    $orderidakhir = "ORDER-" . $lastOrderId;
}

$datatransaksi = [
    'transaction_details' => [
        'order_id' => $orderidakhir,
        'gross_amount' => $hargaakhir,
    ],
    'customer_details' => [
        'first_name' => $namapanjangakhir,
        'email' => $email,
        'phone' => $telpakhir,
    ],
];

try {
    $snapToken = \Midtrans\Snap::getSnapToken($datatransaksi);
} catch (Exception $e) {
    die("Gagal mendapatkan Snap Token: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Eksklusif</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0a0a0a;
            color: #f0f0f0;
        }
        .modal {
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        .exclusive-btn:hover {
            box-shadow: 0 0 30px rgba(217, 119, 6, 0.5);
        }
        .luxury-divider {
            height: 1px;
            background: linear-gradient(to right, #0a0a0a, #d97706, #0a0a0a);
        }
        @keyframes flash-red {
            0%, 100% { color: #f0f0f0; }
            50% { color: #ef4444; }
        }
        .timer-warning {
            animation: flash-red 1s infinite;
        }
    </style>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-DRmZNwaaMlyqFCtd"></script>
</head>
<body class="min-h-screen flex flex-col justify-between">

    <header class="bg-black/50 backdrop-blur-sm shadow-xl border-b border-amber-800/50 p-4 fixed top-0 w-full z-10">
        <div class="max-w-4xl mx-auto flex justify-between items-center px-4 sm:px-6 lg:px-8">
            <div class="text-xs sm:text-sm text-gray-400">
                <span class="font-light tracking-wider">ORDER ID:</span> 
                <span class="font-bold text-gray-200"><?= htmlspecialchars($orderidakhir)?></span>
            </div>
            <div id="timer-container" class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span id="timer" class="text-xl font-extrabold text-amber-400 tracking-wider">00:00:00</span>
            </div>
        </div>
    </header>

    <main class="flex-grow pt-24 pb-32 max-w-4xl mx-auto w-full px-4 sm:px-6 lg:px-8">
        
        <h1 class="text-4xl sm:text-5xl font-extrabold mb-8 mt-4 tracking-tighter text-gray-100">
            Finalisasi Transaksi
        </h1>

        <div class="grid md:grid-cols-2 gap-8 items-start">
            
            <div class="w-full relative overflow-hidden rounded-xl shadow-2xl border border-amber-900/50">
                <img 
                    src="../asset/mobil/<?= htmlspecialchars($imgcar)?>" 
                    alt="<?= htmlspecialchars($namacar)?>"
                    class="w-full h-auto object-cover transition duration-500 ease-in-out hover:scale-105"
                    onerror="this.onerror=null;this.src='https://placehold.co/600x400/171717/d97706?text=MOBIL+EKSKLUSIF';"
                >
                <div class="absolute inset-0 bg-black/30"></div>
            </div>

            <div class="space-y-6">
                
                <div class="text-left">
                    <p class="text-sm font-semibold text-amber-500 uppercase tracking-widest mb-1">Item Pesanan</p>
                    <h2 class="text-3xl sm:text-4xl font-black text-white leading-tight"><?= htmlspecialchars($namacar)?></h2>
                    <p class="text-base text-gray-400 mt-2">Pesanan atas nama: <span class="font-medium text-gray-300"><?= htmlspecialchars($namapanjangakhir)?></span></p>
                </div>
                
                <div class="luxury-divider my-6"></div>

                <div class="space-y-3">
                    <div class="flex justify-between items-center text-lg text-gray-300">
                        <span class="font-light">Harga Unit</span>
                        <span class="font-medium">Rp <?= number_format($hargaakhir, 0, ',', '.') ?></span>
                    </div>
                    <div class="flex justify-between items-center text-lg text-gray-300">
                        <span class="font-light">Biaya Layanan</span>
                        <span class="font-medium">Rp 0</span>
                    </div>
                </div>

                <div class="luxury-divider my-6"></div>
                
                <div class="flex justify-between items-center pt-2">
                    <span class="text-2xl font-semibold text-amber-500">TOTAL AKHIR</span>
                    <span class="text-4xl font-extrabold text-white tracking-wide">Rp <?= number_format($hargaakhir, 0, ',', '.') ?></span>
                </div>
            </div>
        </div>

    </main>

    <div class="fixed bottom-0 left-0 w-full bg-black/70 backdrop-blur-md p-4 border-t border-amber-800/50 shadow-[0_0_20px_rgba(217,119,6,0.2)] z-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <button 
                id="pay-button" 
                class="exclusive-btn w-full bg-amber-600 text-black font-extrabold py-4 rounded-xl shadow-lg hover:bg-amber-500 transition duration-300 ease-in-out transform active:scale-[0.99] focus:outline-none focus:ring-4 focus:ring-amber-300"
            >
                <svg class="w-6 h-6 inline mr-3 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                BAYAR SEKARANG DENGAN MIDTRANS
            </button>
        </div>
    </div>
    
    <div id="status-modal" class="modal fixed inset-0 bg-gray-900 bg-opacity-95 flex items-center justify-center p-4 z-50 invisible opacity-0" onclick="hideModal()">
        <div class="bg-gray-800 p-8 rounded-xl shadow-2xl w-full max-w-sm transform transition-all duration-300 scale-95 border border-amber-700/50" onclick="event.stopPropagation()">
            <div id="modal-icon" class="text-5xl mb-4 text-center"></div>
            <h3 id="modal-title" class="text-2xl font-bold mb-2 text-center text-white"></h3>
            <p id="modal-message" class="text-gray-400 mb-6 text-center text-sm"></p>
            <button id="modal-button" class="w-full bg-amber-600 text-black font-semibold py-3 rounded-lg hover:bg-amber-500 transition duration-200">OK</button>
        </div>
    </div>


    <script>
        const modal = document.getElementById('status-modal');
        const modalTitle = document.getElementById('modal-title');
        const modalMessage = document.getElementById('modal-message');
        const modalIcon = document.getElementById('modal-icon');
        const modalButton = document.getElementById('modal-button');

        function showModal(title, message, iconHtml, buttonAction) {
            modalTitle.textContent = title;
            modalMessage.textContent = message;
            modalIcon.innerHTML = iconHtml;
            modal.classList.remove('invisible', 'opacity-0');
            modal.classList.add('visible', 'opacity-100');

            modalButton.onclick = function() {
                hideModal();
                if (buttonAction) buttonAction();
            };
            modal.onclick = hideModal;
        }

        function hideModal() {
            modal.classList.remove('visible', 'opacity-100');
            modal.classList.add('invisible', 'opacity-0');
        }

        
        document.getElementById('pay-button').onclick = function(){
            snap.pay('<?= $snapToken ?>', {
                onSuccess: function(result){
                    console.log(result);
                    const successIcon = '<span class="text-green-400">✅</span>';
                    showModal(
                        "Pembayaran Berhasil",
                        "Terima kasih. Transaksi Anda telah berhasil diselesaikan.",
                        successIcon,
                        function() {
                            localStorage.removeItem(timerKey);
                            window.location.href = "../index.php?url=akun";
                        }
                    );
                },
                onPending: function(result){
                    console.log(result);
                    const pendingIcon = '<span class="text-yellow-400">⏳</span>';
                    showModal(
                        "Menunggu Pembayaran",
                        "Instruksi pembayaran sudah terbit. Silakan selesaikan pembayaran sebelum batas waktu.",
                        pendingIcon,
                        function() {
                            window.location.href = "../index.php?url=akun";
                        }
                    );
                },
                onError: function(result){
                    console.log(result);
                    const errorIcon = '<span class="text-red-500">❌</span>';
                    showModal(
                        "Pembayaran Gagal",
                        "Terjadi kesalahan saat memproses pembayaran Anda. Silakan coba lagi.",
                        errorIcon,
                        function() {
                            window.location.href = "../index.php?url=view";
                        }
                    );
                },
                onClose: function(){
                    console.log("Pop-up ditutup tanpa menyelesaikan pembayaran.");
                    const closeIcon = '<span class="text-gray-500">ℹ️</span>';
                    showModal(
                        "Pembayaran Belum Selesai",
                        "Anda menutup jendela pembayaran. Pesanan Anda akan tetap tertunda.",
                        closeIcon,
                        null
                    );
                }
            });
        };

        const timerEl = document.getElementById("timer");
        const timerContainer = document.getElementById("timer-container");
        const payButton = document.getElementById('pay-button');

        const timerKey = "endTime_<?= $orderidakhir ?>"; 
        let endTime = localStorage.getItem(timerKey);
        
        if (!endTime) {
            endTime = new Date().getTime() + (24 * 60 * 60 * 1000); 
            localStorage.setItem(timerKey, endTime);
        } else {
            endTime = parseInt(endTime);
        }

        function updateTimer() {
            const now = new Date().getTime();
            const distance = endTime - now;

            timerEl.classList.remove('timer-warning', 'text-amber-400', 'text-red-500');

            if (distance <= 0) {
              timerEl.textContent = "Waktu Habis";
              timerEl.classList.add('text-red-500');
              localStorage.removeItem(timerKey); 
              clearInterval(timerInterval); 
              payButton.disabled = true;
              payButton.textContent = 'WAKTU PEMBAYARAN HABIS';
              payButton.classList.remove('bg-amber-600', 'hover:bg-amber-500');
              payButton.classList.add('bg-gray-700', 'text-gray-400', 'shadow-none');
              return;
            }
            
            if (distance < (60 * 60 * 1000)) {
                 timerEl.classList.add('timer-warning');
            } else {
                timerEl.classList.add('text-amber-400');
            }


            const hours = Math.floor((distance / (1000 * 60 * 60)));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            timerEl.textContent =
              String(hours).padStart(2, "0") + ":" +
              String(minutes).padStart(2, "0") + ":" +
              String(seconds).padStart(2, "0");
        }

        updateTimer();
        const timerInterval = setInterval(updateTimer, 1000);

    </script>
</body>
</html>
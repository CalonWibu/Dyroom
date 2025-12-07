<?php
$log_file = 'midtrans_notification_log.txt';
$log_time = date('Y-m-d H:i:s');

try {
    require_once '../config/db.php'; 
    require_once '../components/midtrans-header.php'; 
} catch (Throwable $e) {
    file_put_contents($log_file, $log_time . " | [FATAL] REQUIRE FAILED: " . $e->getMessage() . "\n\n", FILE_APPEND);
    http_response_code(500);
    exit;
}

$json_result = file_get_contents('php://input');
$result = json_decode($json_result, true);

$order_id_midtrans = $result['order_id'] ?? 'N/A';
$transaction_status = $result['transaction_status'] ?? 'N/A';
$status_code = $result['status_code'] ?? 'N/A';
$gross_amount = $result['gross_amount'] ?? '0.00';

file_put_contents($log_file, $log_time . " | [RECEIVE] Status: " . $transaction_status . " | Order ID: " . $order_id_midtrans . "\nJSON Data: " . $json_result . "\n", FILE_APPEND);

if (empty($result)) {
    http_response_code(400); 
    exit;
}

$database = new Database();
$conn = $database->getConnection();

if (!$conn) {
    file_put_contents($log_file, $log_time . " | [FATAL] Database Connection Failed.\n\n", FILE_APPEND);
    http_response_code(500); 
    exit;
}

$midtrans_server_key = \Midtrans\Config::$serverKey; 
$hashed = hash('sha512', $order_id_midtrans . $status_code . $gross_amount . $midtrans_server_key);

if ($hashed != $result['signature_key']) {
    file_put_contents($log_file, $log_time . " | [SECURITY ERROR] Signature Key Mismatch.\n\n", FILE_APPEND);
    http_response_code(403); 
    $conn->close();
    exit;
}

file_put_contents($log_file, $log_time . " | [VERIFICATION] Success. Proceeding to update DB.\n", FILE_APPEND);

$new_status = null;
$fraud_status = $result['fraud_status'] ?? 'none';

if ($transaction_status == 'settlement' || ($transaction_status == 'capture' && $fraud_status == 'accept')) {
    $new_status = 'paid';
} elseif ($transaction_status == 'cancel' || $transaction_status == 'expire' || $transaction_status == 'deny') {
    $new_status = 'cancelled';
} 

$order_id_numeric = (int)str_replace('ORDER-', '', $order_id_midtrans); 

if (isset($new_status)) {
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");

    if (!$stmt) {
        file_put_contents($log_file, $log_time . " | [DB ERROR] Prepare failed: " . $conn->error . "\n\n", FILE_APPEND);
        http_response_code(500); 
        $conn->close();
        exit;
    }

    $stmt->bind_param("si", $new_status, $order_id_numeric);
    
    if ($stmt->execute()) {
        $rows_affected = $stmt->affected_rows;
        
        file_put_contents($log_file, $log_time . " | [DB SUCCESS] Order ID " . $order_id_numeric . " updated to " . $new_status . " | Rows Affected: " . $rows_affected . "\n\n", FILE_APPEND);
        
        http_response_code(200); 
        echo "Update status berhasil";

    } else {
        file_put_contents($log_file, $log_time . " | [DB ERROR] Execute failed: " . $stmt->error . "\n\n", FILE_APPEND);
        http_response_code(500); 
        echo "Gagal update database";
    }
    $stmt->close();
} else {
    file_put_contents($log_file, $log_time . " | [INFO] Status (" . $transaction_status . ") did not require DB update.\n\n", FILE_APPEND);
    http_response_code(200); 
    echo "Status notifikasi diterima";
}

$conn->close();
?>
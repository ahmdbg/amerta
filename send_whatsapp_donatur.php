<?php
require_once 'vendor/autoload.php';

function sendWhatsAppMessageDonatur($data, $bookingId)
{
    $ultramsg_token = "rmop7b5hmnkcywvp"; // Get your token from ultramsg.com
    $instance_id = "instance118084"; // Get your instance ID from ultramsg.com

    try {
        $client = new UltraMsg\WhatsAppApi($ultramsg_token, $instance_id);

        // Prepare WhatsApp message
        $to = $data['no_wa'];
        $body = "Terima kasih telah melakukan pemesanan tiket Donatur AMERTA!\n\n"
            . "Detail Pemesanan sebagai berikut\n\n"
            . "Nama Donatur: {$data['nama_wali']}\n"
            . "Status: {$data['status_menginap']}\n"
            . "ID Booking: {$bookingId}\n\n"
            . "Simpan tiket ini sebagai bukti pendaftaran.\n\n"
            . "Untuk informasi lebih lanjut, silakan hubungi admin:\n"
            . "+6281229175559 \n\n";

        // Send WhatsApp message
        $response = $client->sendChatMessage($to, $body);
        return [
            'success' => true,
            'message' => 'WhatsApp message sent successfully'
        ];
    } catch (Exception $e) {
        return [
            'success' => false,
            'message' => $e->getMessage()
        ];
    }
}
?>

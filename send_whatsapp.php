<?php
require_once 'vendor/autoload.php';

function sendWhatsAppMessage($data, $seat_number)
{
    $ultramsg_token = "243pcm6evqvrr5nn"; // Get your token from ultramsg.com
    $instance_id = "instance118084"; // Get your instance ID from ultramsg.com

    try {
        $client = new UltraMsg\WhatsAppApi($ultramsg_token, $instance_id);

        // Prepare WhatsApp message
        $to = $data['no_wa'];
        $body = "Terima kasih telah melakukan pemesanan tiket AMERTA!\n\n"
            . "Detail Pemesanan:\n"
            . "Nama Wali: {$data['nama_wali']}\n"
            . "Nama Santri: {$data['nama_murid']}\n"
            . "Kelas: {$data['kelas_murid']}\n"
            . "Status: {$data['status_menginap']}\n"
            . "Nomor Kursi: {$seat_number}\n\n"
            . "Silakan lakukan pembayaran untuk mengkonfirmasi tiket Anda.\n"
            . "Untuk informasi lebih lanjut, silakan hubungi admin: 085640054840";

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

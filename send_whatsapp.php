<?php
require_once 'vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

function sendWhatsAppMessage($data, $seat_number)
{
    $ultramsg_token = getenv('ULTRAMSG_TOKEN'); // Get your token from .env
    $instance_id = getenv('INSTANCE_ID'); // Get your instance ID from .env

    try {
        $client = new UltraMsg\WhatsAppApi($ultramsg_token, $instance_id);

        // Prepare WhatsApp message
        $to = $data['no_wa'];
        $body = "Terima kasih telah melakukan pemesanan tiket AMERTA!\n\n"
            . "Detail Pemesanan Abi/Ummi sebagai berikut\n\n"
            . "Nama Wali: {$data['nama_wali']}\n"
            . "Nama Santri: {$data['nama_murid']}\n"
            . "Kelas: {$data['kelas_murid']}\n"
            . "Status: {$data['status_menginap']}\n"
            . "Nomor Kursi: {$seat_number}\n\n"
            . "Agar tidak tertinggal informasi terbaru terkait Amerta Night Show 2025, silakan Abi/Ummi dapat bergabung dalam grup WhatsApp melalui tautan berikut:\n\n"
            . "https://chat.whatsapp.com/L3AR71DGMYFIB474PZiKuu\n\n"
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

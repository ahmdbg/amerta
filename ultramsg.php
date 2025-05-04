<?php
require_once 'vendor/autoload.php';

use UltraMsg\WhatsAppApi;

$instance_id = "instance118084";   // Ganti dengan instance kamu
$token = "243pcm6evqvrr5nn";               // Ganti dengan token kamu

$wa = new WhatsAppApi($token, $instance_id);

$to = "6285640054840"; // Nomor tujuan, awali dengan kode negara (misal: 62 untuk Indonesia)
$body = "Halo! Ini pesan dari PHP menggunakan UltraMsg.";

$response = $wa->sendChatMessage($to, $body);
print_r($response);

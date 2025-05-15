<?php
require_once 'vendor/autoload.php';
include 'config/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID booking tidak ditemukan.");
}

// Fetch booking data from pengunjung_donatur table
$stmt = mysqli_prepare($conn, "SELECT nama, status, no_wa, created_at FROM pengunjung_donatur WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$booking = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$booking) {
    die("Data booking tidak ditemukan.");
}

// Generate QR Code
$qrCode = new Endroid\QrCode\QrCode('https://' . $_SERVER['HTTP_HOST'] . '/konfirmasi_donatur.php?id=' . $id);
$qrCode->setSize(250);
$qrCode->setMargin(10);
$writer = new Endroid\QrCode\Writer\PngWriter();
$result = $writer->write($qrCode);
$qrDataUri = $result->getDataUri();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Konfirmasi Booking Donatur</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #1b425c;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .ticket {
            background: #00171f;
            width: 600px;
            height: 300px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            position: relative;
            padding: 20px 30px;
            color: #eee;
            display: flex;
            flex-direction: row;
            gap: 30px;
        }
        .ticket::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 8px;
            width: 100%;
            background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
        }
        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .field {
            margin-bottom: 15px;
        }
        .label {
            font-size: 12px;
            color: #6a11cb;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 5px;
            font-weight: 600;
        }
        .value {
            font-size: 18px;
            font-weight: 700;
            color: #eaeaea;
        }
        .qr-container {
            width: 250px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .qr-code {
            width: 180px;
            height: 180px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            background: white;
            padding: 10px;
        }
        .footer {
            position: absolute;
            bottom: 15px;
            width: 100%;
            text-align: center;
            font-size: 14px;
            color: #777;
            letter-spacing: 1px;
        }
        #btnDownload {
            margin-top: 20px;
            background: #6a11cb;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            box-shadow: 0 6px 20px rgba(106, 17, 203, 0.4);
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        #btnDownload:hover {
            background: #2575fc;
        }
    </style>
</head>

<body>
    <div class="ticket" id="ticket">
        <div class="content">
            <div class="field">
                <div class="label">Nama Donatur</div>
                <div class="value"><?= htmlspecialchars($booking['nama']) ?></div>
            </div>
            <div class="field">
                <div class="label">Status Menginap</div>
                <div class="value"><?= htmlspecialchars($booking['status']) ?></div>
            </div>
            <div class="field">
                <div class="label">Nomor WhatsApp</div>
                <div class="value"><?= htmlspecialchars($booking['no_wa']) ?></div>
            </div>
            <div class="field">
                <div class="label">Tanggal Booking</div>
                <div class="value"><?= date('d M Y H:i', strtotime($booking['created_at'])) ?></div>
            </div>
        </div>
        <div class="qr-container">
            <img src="<?= $qrDataUri ?>" alt="QR Code" class="qr-code" />
        </div>
    </div>
    <button id="btnDownload">Unduh Tiket PDF</button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        window.jsPDF = window.jspdf.jsPDF;

        document.getElementById("btnDownload").addEventListener("click", function() {
            const ticketElement = document.getElementById("ticket");

            html2canvas(ticketElement, {
                scale: 2,
                useCORS: true,
                logging: false
            }).then(canvas => {
                const imgData = canvas.toDataURL("image/png");
                const pdf = new jsPDF("l", "mm", [297, 210]); // Landscape A4 size

                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = pdf.internal.pageSize.getHeight();
                const imgWidth = canvas.width;
                const imgHeight = canvas.height;
                const ratio = Math.min(pdfWidth / imgWidth, pdfHeight / imgHeight);
                const imgX = (pdfWidth - imgWidth * ratio) / 2;
                const imgY = (pdfHeight - imgHeight * ratio) / 2;

                pdf.addImage(imgData, "PNG", imgX, imgY, imgWidth * ratio, imgHeight * ratio);
                pdf.save("Tiket_Donatur_<?= str_pad($id, 5, '0', STR_PAD_LEFT) ?>.pdf");
            });
        });
    </script>
</body>

</html>

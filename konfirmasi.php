<?php
include './config/db.php';

// Get ID from URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Get ticket data
$sql = "SELECT * FROM pengunjung WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$ticket = mysqli_fetch_assoc($result);

if (!$ticket) {
    header('Location: index.php');
    exit;
}

// Generate QR Code
require_once 'vendor/autoload.php';
$qrCode = new Endroid\QrCode\QrCode('https://' . $_SERVER['HTTP_HOST'] . '/konfirmasi.php?id=' . $id);
$qrCode->setSize(250);
$qrCode->setMargin(10);
$writer = new Endroid\QrCode\Writer\PngWriter();
$result = $writer->write($qrCode);
$qrDataUri = $result->getDataUri();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>AMERTA Ticket</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #1b425c;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column; /* Changed to column */
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            gap: 20px; /* Add gap between ticket and button */
        }

        #ticket {
            background: #00171f;
            width: 300px; /* Reduced from 400px */
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            position: relative;
            padding: 20px 30px; /* Reduced padding */
            color: #333;
        }

        #ticket::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 8px;
            width: 100%;
            background: linear-gradient(90deg, #ffb347, #ffcc33);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 28px; /* Reduced from 36px */
            color: #ff8c00;
            letter-spacing: 4px;
            font-weight: 900;
            text-transform: uppercase;
            font-family: 'Arial', Arial, sans-serif;
        }

        .header p {
            margin: 5px 0 0 0;
            font-size: 16px;
            color: #666;
            letter-spacing: 2px;
        }

        .content {
            display: block; /* Changed from flex */
            margin-bottom: 30px;
        }

        .left, .right {
            width: 100%; /* Changed from 48% */
            margin-bottom: 20px;
        }

        .field {
            margin-bottom: 20px;
        }

        .label {
            font-size: 12px;
            color: #e07b00;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .value {
            font-size: 16px; /* Reduced from 18px */
            font-weight: 700;
            color: #eaeaea;
        }

        .qr-container {
            text-align: center;
            margin-top: 10px;
        }

        .qr-code {
            width: 140px; /* Reduced from 160px */
            height: 140px; /* Reduced from 160px */
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            background: white;
            padding: 10px;
            display: inline-block;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 20px;
            letter-spacing: 1px;
        }

        #btnDownload {
            margin: 0; /* Reset margin since we're using flex gap */
            background: #ff8c00;
            color: white;
            border: none;
            padding: 14px 36px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            box-shadow: 0 6px 20px rgba(255, 140, 0, 0.4);
        }

        #btnDownload:hover {
            background: #e07b00;
        }
    </style>
</head>

<body>
    <div id="ticket">
        <div class="header">
            <h1>AMERTA</h1>
            <p>The Grand Performance</p>
        </div>
        <div class="content">
            <div class="left">
                <div class="field">
                    <div class="label">Nama Wali</div>
                    <div class="value"><?= htmlspecialchars($ticket['nama']) ?></div>
                </div>
                <div class="field">
                    <div class="label">Nama Santri</div>
                    <div class="value"><?= htmlspecialchars($ticket['nama_murid']) ?></div>
                </div>
                <div class="field">
                    <div class="label">Kelas</div>
                    <div class="value"><?= htmlspecialchars($ticket['kelas']) ?></div>
                </div>
            </div>
            <div class="right">
                <div class="field">
                    <div class="label">Nomor Kursi</div>
                    <div class="value">#<?= str_pad($ticket['nomor_kursi'], 3, '0', STR_PAD_LEFT) ?></div>
                </div>
                <div class="field">
                    <div class="label">Status</div>
                    <div class="value"><?= htmlspecialchars($ticket['status']) ?></div>
                </div>
                <div class="field">
                    <div class="label">Ticket ID</div>
                    <div class="value">#<?= str_pad($ticket['id'], 5, '0', STR_PAD_LEFT) ?></div>
                </div>
            </div>
        </div>
        <div class="qr-container">
            <img src="<?= $qrDataUri ?>" alt="QR Code" class="qr-code" />
        </div>
        <div class="footer">
            <p>Scan QR code untuk verifikasi tiket</p>
            <p>Valid untuk 1 orang</p>
        </div>
    </div>

    <button id="btnDownload">Unduh Tiket PDF</button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        window.jsPDF = window.jspdf.jsPDF;

        document.getElementById("btnDownload").addEventListener("click", function () {
            const ticketElement = document.getElementById("ticket");

            html2canvas(ticketElement, {
                scale: 2,
                useCORS: true,
                logging: false
            }).then(canvas => {
                const imgData = canvas.toDataURL("image/png");
                const pdf = new jsPDF("p", "mm", [210, 500]);

                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = pdf.internal.pageSize.getHeight();
                const imgWidth = canvas.width;
                const imgHeight = canvas.height;
                const ratio = Math.min(pdfWidth / imgWidth, pdfHeight / imgHeight);
                const imgX = (pdfWidth - imgWidth * ratio) / 2;
                const imgY = 30;

                pdf.addImage(imgData, "PNG", imgX, imgY, imgWidth * ratio, imgHeight * ratio);
                pdf.save("AMERTA_Ticket_<?= str_pad($ticket['id'], 5, '0', STR_PAD_LEFT) ?>.pdf");
            });
        });
    </script>
</body>

</html>

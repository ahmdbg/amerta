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

// Ensure temp directory exists
$tempDir = __DIR__ . '/temp';
if (!is_dir($tempDir)) {
    mkdir($tempDir, 0755, true);
}

$qrFilePath = $tempDir . '/qr_' . $id . '.png';
$result = $writer->write($qrCode);
$result->saveToFile($qrFilePath);

$qrBase64 = base64_encode(file_get_contents($qrFilePath));
$qrDataUri = 'data:image/png;base64,' . $qrBase64;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>AMERTA Ticket</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0d1b3d 0%, #1a2a6c 100%);
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            gap: 20px;
            color: #cbd5e1;
        }

        /* New Ticket Design */
        .ticket-container {
            max-width: 400px;
            margin: 20px auto;
            background: linear-gradient(145deg, #1a2a6c, #0d1b3d);
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(10, 25, 70, 0.8);
            position: relative;
            overflow: hidden;
            border: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px 20px;
            gap: 20px;
        }

        .ticket-header {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            padding: 20px 25px;
            border-radius: 20px 20px 0 0;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-shadow: 0 1px 3px rgba(0,0,0,0.5);
            flex: none;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
        }

        .ticket-header h1 {
            margin: 0 0 10px 0;
            font-size: 32px;
            text-shadow: 0 2px 5px rgba(0,0,0,0.7);
        }

        .ticket-header div {
            font-size: 16px;
            margin-bottom: 6px;
            color: #cbd5e1;
        }

        .ticket-body {
            padding: 0;
            display: flex;
            flex-direction: column;
            width: 100%;
            gap: 15px;
            color: #cbd5e1;
        }

        .ticket-section {
            margin-bottom: 0;
            display: flex;
            flex-direction: column;
            gap: 15px;
            border-bottom: 1px solid #3b82f6;
            padding-bottom: 15px;
        }

        .security-strip {
            display: none;
        }

        .ticket-footer {
            background: transparent;
            padding: 0;
            text-align: center;
            border: none;
            color: #94a3b8;
            font-style: normal;
            font-weight: 600;
            margin-top: 15px;
        }

        /* Enhanced Detail Styling */
        .detail-label {
            font-size: 14px;
            color: #94a3b8;
            text-transform: none;
            letter-spacing: normal;
            margin-bottom: 4px;
            font-weight: 600;
        }

        .detail-value {
            font-size: 20px;
            font-weight: 700;
            color: #e0e7ff;
            margin-bottom: 10px;
        }

        .highlight-box {
            background: transparent;
            border-radius: 0;
            padding: 0;
            border: none;
            box-shadow: none;
        }

        .qr-container {
            text-align: center;
            padding: 0;
            background: transparent;
            border-radius: 0;
            border: none;
            box-shadow: none;
            margin: 10px auto 0 auto;
            width: 200px;
        }

        #statusButton {
            background: #1e40af;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(30, 64, 175, 0.6);
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
        }

        #statusButton.used {
            background: #475569;
            cursor: not-allowed;
            box-shadow: none;
        }

        #statusButton:hover:not(.used) {
            background: #2563eb;
        }

        #btnDownload {
            background: #2563eb;
            color: white;
            border: none;
            padding: 15px 35px;
            border-radius: 30px;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 5px 20px rgba(37, 99, 235, 0.7);
            transition: background-color 0.3s ease;
            margin-top: 30px;
        }

        #btnDownload:hover {
            background: #1e40af;
        }

        @media print {
            .ticket-container {
                box-shadow: none;
                border: 2px solid #000;
            }

            #statusButton,
            #btnDownload {
                display: none;
            }
        }
    </style>
</head>

<body>
    <button id="statusButton" class="status-button <?= $ticket['status_pakai'] == 'sudah_dipakai' ? 'used' : 'unused' ?>" <?= $ticket['status_pakai'] == 'sudah_dipakai' ? 'disabled' : '' ?>>
        <?= $ticket['status_pakai'] == 'sudah_dipakai' ? 'Sudah Dipakai' : 'Belum Dipakai' ?>
    </button>
    <div id="ticket">
        <div class="ticket-container">
            <div class="ticket-header">
                <h1 style="margin:0 0 5px 0; font-size: 28px">AMERTA 2025</h1>
                <div style="display: flex; justify-content: space-between; font-size: 14px">
                    <div>Date: 31 May 2025</div>
                    <div>Time: 19:00 WIB</div>
                </div>
            </div>

            <div class="security-strip"></div>

            <div class="ticket-body">
                <div class="ticket-section">
                    <div class="highlight-box">
                        <div class="detail-label">Pemegang Tiket</div>
                        <div class="detail-value"><?= htmlspecialchars($ticket['nama']) ?></div>

                        <div class="detail-label" style="margin-top:15px">Santri</div>
                        <div class="detail-value"><?= htmlspecialchars($ticket['nama_murid']) ?></div>
                        <div class="detail-value">Kelas <?= htmlspecialchars($ticket['kelas']) ?></div>
                    </div>
                </div>

                <div class="ticket-section">
                    <div class="highlight-box">
                        <div class="detail-label">Nomor Kursi</div>
                        <div class="detail-value" style="font-size: 24px; color: #6a11cb">
                            #<?= str_pad($ticket['nomor_kursi'], 3, '0', STR_PAD_LEFT) ?>
                        </div>

                        <div class="detail-label" style="margin-top:15px">Ticket ID</div>
                        <div class="detail-value">
                            AMT-<?= str_pad($ticket['id'], 5, '0', STR_PAD_LEFT) ?>
                        </div>
                    </div>

                    <div class="qr-container">
                        <img src="<?= $qrDataUri ?>" alt="QR Code" class="qr-code" style="width: 120px; height: 120px" />
                        <div class="detail-label" style="margin-top:10px">Scan untuk verifikasi</div>
                    </div>
                </div>
            </div>

            <div class="ticket-footer">
                <div style="font-size: 12px; color: #666; text-align: center;">
                    * Tiket berlaku untuk 1 orang
                </div>
            </div>
        </div>
    </div>

    <button id="btnDownload">Unduh Tiket PDF</button>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusButton = document.getElementById('statusButton');

            // If already used, disable the button and exit
            if (statusButton.classList.contains('used')) {
                statusButton.style.cursor = 'not-allowed';
                return;
            }

            let clicks = 0;
            let lastClick = 0;

            statusButton.addEventListener('click', function() {
                const now = Date.now();

                if (now - lastClick > 2000) {
                    clicks = 1;
                } else {
                    clicks++;
                }

                lastClick = now;

                if (clicks === 5) {
                    fetch('update_status.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: 'id=<?= $ticket['id'] ?>'
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                statusButton.textContent = 'Sudah Dipakai';
                                statusButton.classList.remove('unused');
                                statusButton.classList.add('used');
                                statusButton.disabled = true;
                                statusButton.style.cursor = 'not-allowed';
                            }
                        });

                    clicks = 0;
                }
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        window.jsPDF = window.jspdf.jsPDF;

        document.getElementById("btnDownload").addEventListener("click", function() {
            const ticketElement = document.getElementById("ticket");
            const qrImage = ticketElement.querySelector(".qr-code");

            function generatePDF() {
                html2canvas(ticketElement, {
                    scale: 2,
                    useCORS: true,
                    allowTaint: true,
                    logging: false
                }).then(canvas => {
                    const imgData = canvas.toDataURL("image/png");

                    const pdfWidth = 210; // A4 width in mm
                    const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

                    const pdf = new jsPDF("p", "mm", [pdfWidth, pdfHeight]);

                    // Add the entire ticket content including QR code
                    pdf.addImage(imgData, "PNG", 0, 0, pdfWidth, pdfHeight);

                    pdf.save("AMERTA_Ticket_<?= str_pad($ticket['id'], 5, '0', STR_PAD_LEFT) ?>.pdf");
                });
            }

            // Ensure QR code image is loaded before generating PDF
            if (qrImage.complete && qrImage.naturalHeight !== 0) {
                generatePDF();
            } else {
                qrImage.onload = generatePDF;
            }
        });
    </script>
</body>

</html>
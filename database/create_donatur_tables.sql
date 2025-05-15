-- Create donatur table
CREATE TABLE IF NOT EXISTS donatur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_donatur VARCHAR(255) NOT NULL UNIQUE
);

-- Insert example donaturs
INSERT INTO donatur (nama_donatur) VALUES
('donatur A'),
('donatur B'),
('donatur C');

-- Create pengunjung_donatur table
CREATE TABLE IF NOT EXISTS pengunjung_donatur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    status VARCHAR(50) NOT NULL,
    no_wa VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert example pengunjung_donatur data
INSERT INTO pengunjung_donatur (nama, status, no_wa) VALUES
('donatur A', 'Menginap', '6281234567890'),
('donatur B', 'Tidak', '6281987654321');

CREATE TABLE IF NOT EXISTS team (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    instagram VARCHAR(255) NOT NULL,
    division VARCHAR(50) NOT NULL,
    image_ext VARCHAR(10) DEFAULT 'webp'
);

-- Sample inserts (please update with real data as needed)
INSERT INTO team (name, instagram, division) VALUES
('pubdok 1', 'daffrnd', 'pubdok'),
('pubdok 2', 'fadlilalmasy', 'pubdok'),
('pubdok 3', 'afathinf_', 'pubdok'),
('pubdok 4', 'haedrrlhq', 'pubdok'),
('pubdok 5', 'eztkahhh/', 'pubdok'),
('acara 16', 'syariefhida', 'acara'),
('acara 2', 'aqeel_ajaa', 'acara'),
('acara 3', 'faizhrohmann', 'acara'),
('perkap 1', 'ahmd._bg', 'perkap'),
('dekor 1', 'ahmd._bg', 'dekor'),
('fundraising 1', 'ahmd._bg', 'fundraising'),
('konsumsi 1', 'ahmd._bg', 'konsumsi');

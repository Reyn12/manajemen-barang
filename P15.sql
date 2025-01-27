-- Materi JOIN
-- Soal 1
SELECT 
    t.kode_transaksi,
    p.nama_produk,
    t.tgl_jual,
    t.total_harga
FROM transaksis t
JOIN produks p ON t.id_produk = p.id_produk;

-- Soal 2
SELECT 
    t.kode_transaksi,
    p.nama_produk,
    s.nama_supplier,
    t.jumlah,
    t.total_harga,
    t.tgl_jual
FROM transaksis t
JOIN produks p ON t.id_produk = p.id_produk
JOIN suppliers s ON p.id_supplier = s.id_supplier
WHERE t.status_bayar = 'Sukses'
ORDER BY t.tgl_jual DESC;

-- Soal 3
SELECT 
    s.nama_supplier,
    SUM(t.total_harga) as total_pendapatan,
    SUM(t.jumlah) as total_produk_terjual,
    AVG(t.total_harga) as rata_rata_per_transaksi
FROM suppliers s
JOIN produks p ON s.id_supplier = p.id_supplier
JOIN transaksis t ON p.id_produk = t.id_produk
WHERE t.status_bayar = 'Sukses'
    AND p.kategori IN ('Laptop', 'HP')
GROUP BY s.id_supplier, s.nama_supplier
ORDER BY total_pendapatan DESC;

-- Materi SUBQUERY
-- Soal 1
SELECT 
    nama_produk,
    kategori,
    harga
FROM produks
WHERE harga > (
    SELECT AVG(harga)
    FROM produks
)
ORDER BY harga DESC;

-- Soal 2
SELECT 
    s.nama_supplier,
    p.nama_produk,
    p.kategori,
    p.stok
FROM suppliers s
JOIN produks p ON s.id_supplier = p.id_supplier
WHERE p.id_produk NOT IN (
    SELECT DISTINCT id_produk
    FROM transaksis
)
ORDER BY s.nama_supplier;

-- Soal 3
WITH supplier_sales AS (
    SELECT 
        p.kategori,
        s.nama_supplier,
        SUM(t.total_harga) as total_pendapatan,
        RANK() OVER (PARTITION BY p.kategori ORDER BY SUM(t.total_harga) DESC) as rank
    FROM suppliers s
    JOIN produks p ON s.id_supplier = p.id_supplier
    JOIN transaksis t ON p.id_produk = t.id_produk
    WHERE t.status_bayar = 'Sukses'
    GROUP BY p.kategori, s.id_supplier, s.nama_supplier
)
SELECT 
    kategori,
    nama_supplier as supplier_terbaik,
    total_pendapatan
FROM supplier_sales
WHERE rank = 1
ORDER BY total_pendapatan DESC;

-- Materi STORED PROCEDURE
-- Soal 1
DELIMITER //

CREATE PROCEDURE GetTransaksiByStatus(
    IN p_status_bayar VARCHAR(10)
)
BEGIN
    SELECT 
        t.kode_transaksi,
        p.nama_produk,
        t.jumlah,
        t.total_harga,
        t.tgl_jual,
        t.status_bayar
    FROM transaksis t
    JOIN produks p ON t.id_produk = p.id_produk
    WHERE BINARY t.status_bayar = BINARY p_status_bayar;
END //

DELIMITER ;

CALL GetTransaksiByStatus('Sukses');

-- Soal 2
DELIMITER //

CREATE PROCEDURE UpdateStokProduk(
    IN p_produk_id INT,
    IN p_jumlah_tambah INT,
    OUT p_pesan VARCHAR(100)
)
BEGIN
    DECLARE stok_sekarang INT;
    
    SELECT stok INTO stok_sekarang
    FROM produks 
    WHERE id_produk = p_produk_id;
    
    IF stok_sekarang IS NULL THEN
        SET p_pesan = 'Produk tidak ditemukan';
    ELSE
        UPDATE produks 
        SET stok = stok + p_jumlah_tambah,
            updated_at = NOW()
        WHERE id_produk = p_produk_id;
        
        SET p_pesan = CONCAT('Stok berhasil ditambah. Stok sekarang: ', stok_sekarang + p_jumlah_tambah);
    END IF;
END //

DELIMITER ;

-- Cara pakai:
SET @pesan = '';
CALL UpdateStokProduk(1, 10, @pesan);
SELECT @pesan AS Hasil;

-- Soal 3
DELIMITER //

CREATE PROCEDURE ProsesPenjualan(
    IN p_produk_id INT,
    IN p_jumlah_beli INT,
    IN p_status_bayar VARCHAR(10),
    OUT p_pesan VARCHAR(100)
)
BEGIN
    DECLARE harga_produk DECIMAL(12,2);
    DECLARE stok_sekarang INT;
    DECLARE total DECIMAL(12,2);
    DECLARE kode_trans VARCHAR(20);
    
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SET p_pesan = 'Terjadi kesalahan! Transaksi dibatalkan';
    END;
    
    START TRANSACTION;
    
    SELECT harga, stok INTO harga_produk, stok_sekarang
    FROM produks 
    WHERE id_produk = p_produk_id;
    
    IF harga_produk IS NULL THEN
        SET p_pesan = 'Produk tidak ditemukan';
        ROLLBACK;
    ELSEIF stok_sekarang < p_jumlah_beli THEN
        SET p_pesan = 'Stok tidak mencukupi';
        ROLLBACK;
    ELSE
        SET kode_trans = CONCAT('TRX', DATE_FORMAT(NOW(), '%Y%m%d'), LPAD(FLOOR(RAND() * 1000), 3, '0'));
        SET total = harga_produk * p_jumlah_beli;
        
        INSERT INTO transaksis (
            kode_transaksi,
            id_produk,
            tgl_jual,
            jumlah,
            status_bayar,
            total_harga,
            created_at,
            updated_at
        ) VALUES (
            kode_trans,
            p_produk_id,
            CURDATE(),
            p_jumlah_beli,
            p_status_bayar,
            total,
            NOW(),
            NOW()
        );
        
        UPDATE produks 
        SET stok = stok - p_jumlah_beli,
            updated_at = NOW()
        WHERE id_produk = p_produk_id;
        
        SET p_pesan = CONCAT('Transaksi berhasil. Kode: ', kode_trans);
        COMMIT;
    END IF;
END //

DELIMITER ;

-- Cara pakai:
SET @pesan = '';
CALL ProsesPenjualan(1, 2, 'Sukses', @pesan);
SELECT @pesan AS Hasil;

-- materi stored function
-- Soa1 1
DELIMITER //

CREATE FUNCTION HitungTotalPendapatan(
    p_status_bayar VARCHAR(10)
) 
RETURNS DECIMAL(15,2)
DETERMINISTIC
BEGIN
    DECLARE total DECIMAL(15,2);
    
    SELECT COALESCE(SUM(total_harga), 0)
    INTO total
    FROM transaksis
    WHERE BINARY status_bayar = BINARY p_status_bayar;
    
    RETURN total;
END //

DELIMITER ;

-- Cara pakai:
SELECT HitungTotalPendapatan('Sukses') AS Total_Pendapatan_Sukses;

-- Soal 2
DELIMITER //

CREATE FUNCTION CekStatusStok(
    p_produk_id INT
) 
RETURNS VARCHAR(20)
DETERMINISTIC
BEGIN
    DECLARE stok_tersisa INT;
    DECLARE status VARCHAR(20);
    
    SELECT stok INTO stok_tersisa
    FROM produks
    WHERE id_produk = p_produk_id;
    
    IF stok_tersisa IS NULL THEN
        RETURN 'Produk Tidak Ada';
    ELSEIF stok_tersisa = 0 THEN
        RETURN 'Kosong';
    ELSEIF stok_tersisa <= 10 THEN
        RETURN 'Hampir Habis';
    ELSE
        RETURN 'Tersedia';
    END IF;
END //

DELIMITER ;

-- Cara pakai:
SELECT nama_produk, CekStatusStok(id_produk) as status_stok 
FROM produks;

-- Soal 3
DELIMITER //

CREATE FUNCTION AnalisisPerformaProduk(
    p_produk_id INT
) 
RETURNS VARCHAR(100)
DETERMINISTIC
BEGIN
    DECLARE avg_monthly DECIMAL(12,2);
    DECLARE last_month DECIMAL(12,2);
    DECLARE current_month DECIMAL(12,2);
    DECLARE tren VARCHAR(20);
    DECLARE hasil VARCHAR(100);
    
    -- Hitung rata-rata bulanan
    SELECT COALESCE(AVG(total_per_bulan), 0) INTO avg_monthly
    FROM (
        SELECT SUM(total_harga) as total_per_bulan
        FROM transaksis
        WHERE id_produk = p_produk_id
        AND status_bayar = 'Sukses'
        GROUP BY YEAR(tgl_jual), MONTH(tgl_jual)
    ) monthly_sales;
    
    -- Hitung penjualan bulan lalu
    SELECT COALESCE(SUM(total_harga), 0) INTO last_month
    FROM transaksis
    WHERE id_produk = p_produk_id
    AND status_bayar = 'Sukses'
    AND tgl_jual BETWEEN DATE_SUB(DATE_SUB(CURDATE(), INTERVAL DAY(CURDATE())-1 DAY), INTERVAL 1 MONTH)
    AND LAST_DAY(DATE_SUB(CURDATE(), INTERVAL 1 MONTH));
    
    -- Hitung penjualan bulan ini
    SELECT COALESCE(SUM(total_harga), 0) INTO current_month
    FROM transaksis
    WHERE id_produk = p_produk_id
    AND status_bayar = 'Sukses'
    AND tgl_jual >= DATE_SUB(CURDATE(), INTERVAL DAY(CURDATE())-1 DAY);
    
    -- Tentukan tren
    IF current_month > last_month THEN
        SET tren = 'Naik';
    ELSEIF current_month < last_month THEN
        SET tren = 'Turun';
    ELSE
        SET tren = 'Stabil';
    END IF;
    
    SET hasil = CONCAT('Rata-rata: Rp', FORMAT(avg_monthly, 0), ', Tren: ', tren);
    RETURN hasil;
END //

DELIMITER ;

-- Cara pakai:
SELECT 
    p.nama_produk,
    AnalisisPerformaProduk(p.id_produk) as performa
FROM produks p;

-- Materi view
-- Soal 1
CREATE VIEW v_transaksi_detail AS
SELECT 
    t.kode_transaksi,
    t.tgl_jual,
    p.nama_produk,
    s.nama_supplier,
    t.jumlah,
    t.total_harga,
    t.status_bayar
FROM transaksis t
JOIN produks p ON t.id_produk = p.id_produk
JOIN suppliers s ON p.id_supplier = s.id_supplier;

-- Cara pakai:
SELECT * FROM v_transaksi_detail;
-- atau
SELECT * FROM v_transaksi_detail WHERE status_bayar = 'Sukses';

-- Soal 2
CREATE VIEW v_stok_kategori AS
SELECT 
    kategori,
    COUNT(*) as jumlah_produk,
    SUM(stok) as total_stok,
    SUM(stok * harga) as nilai_inventori,
    MIN(stok) as stok_terendah,
    MAX(stok) as stok_tertinggi
FROM produks
GROUP BY kategori;

-- Cara pakai:
SELECT * FROM v_stok_kategori;
-- atau
SELECT * FROM v_stok_kategori WHERE total_stok < 100;

-- Soal 3
CREATE VIEW v_analisis_penjualan AS
WITH monthly_sales AS (
    SELECT 
        DATE_FORMAT(tgl_jual, '%Y-%m') as bulan,
        SUM(total_harga) as total_penjualan,
        COUNT(*) as jumlah_transaksi,
        COUNT(DISTINCT id_produk) as produk_terjual
    FROM transaksis
    WHERE status_bayar = 'Sukses'
    GROUP BY DATE_FORMAT(tgl_jual, '%Y-%m')
),
prev_month_sales AS (
    SELECT 
        bulan,
        total_penjualan,
        LAG(total_penjualan) OVER (ORDER BY bulan) as penjualan_bulan_sebelumnya
    FROM monthly_sales
)
SELECT 
    ms.bulan,
    ms.total_penjualan,
    ms.jumlah_transaksi,
    ms.produk_terjual,
    pms.penjualan_bulan_sebelumnya,
    CASE 
        WHEN pms.penjualan_bulan_sebelumnya = 0 THEN 100
        ELSE ((ms.total_penjualan - pms.penjualan_bulan_sebelumnya) / pms.penjualan_bulan_sebelumnya * 100)
    END as persentase_pertumbuhan,
    CASE
        WHEN ms.total_penjualan >= 100000000 THEN 'Target Tercapai'
        WHEN ms.total_penjualan >= 75000000 THEN 'Mendekati Target'
        ELSE 'Di Bawah Target'
    END as status_pencapaian
FROM monthly_sales ms
LEFT JOIN prev_month_sales pms ON ms.bulan = pms.bulan
ORDER BY ms.bulan DESC;

-- Cara pakai:
SELECT * FROM v_analisis_penjualan;
-- atau
SELECT * FROM v_analisis_penjualan WHERE status_pencapaian = 'Target Tercapai';

-- Materi TRIGGER
-- Soal 1
-- Buat tabel log dulu
CREATE TABLE log_stok (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_produk INT,
    stok_lama INT,
    stok_baru INT,
    waktu_perubahan TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    keterangan VARCHAR(100)
);

-- Buat trigger
DELIMITER //

CREATE TRIGGER tr_log_perubahan_stok
AFTER UPDATE ON produks
FOR EACH ROW
BEGIN
    IF OLD.stok != NEW.stok THEN
        INSERT INTO log_stok (id_produk, stok_lama, stok_baru, keterangan)
        VALUES (
            NEW.id_produk,
            OLD.stok,
            NEW.stok,
            CONCAT('Perubahan stok dari ', OLD.stok, ' ke ', NEW.stok)
        );
    END IF;
END //

DELIMITER ;

-- Cara test:
UPDATE produks SET stok = stok - 1 WHERE id_produk = 1;
SELECT * FROM log_stok;

-- Soal 2
DELIMITER //

CREATE TRIGGER tr_validasi_transaksi
BEFORE INSERT ON transaksis
FOR EACH ROW
BEGIN
    DECLARE stok_tersedia INT;
    
    -- Cek stok
    SELECT stok INTO stok_tersedia
    FROM produks
    WHERE id_produk = NEW.id_produk;
    
    -- Validasi stok
    IF stok_tersedia < NEW.jumlah THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Stok tidak mencukupi';
    END IF;
END //

CREATE TRIGGER tr_update_stok
AFTER INSERT ON transaksis
FOR EACH ROW
BEGIN
    UPDATE produks
    SET stok = stok - NEW.jumlah,
        updated_at = NOW()
    WHERE id_produk = NEW.id_produk;
END //

DELIMITER ;

-- Cara test:
INSERT INTO transaksis (kode_transaksi, id_produk, jumlah, status_bayar, total_harga, tgl_jual)
VALUES ('TRX001', 1, 2, 'Sukses', 1000000, CURDATE());

-- Soal 3
-- Buat tabel notifikasi dulu
CREATE TABLE notifikasi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipe VARCHAR(50),
    pesan TEXT,
    status_baca ENUM('Belum', 'Sudah') DEFAULT 'Belum',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DELIMITER //

-- Trigger untuk stok menipis
CREATE TRIGGER tr_notif_stok_menipis
AFTER UPDATE ON produks
FOR EACH ROW
BEGIN
    IF NEW.stok <= 10 AND OLD.stok > 10 THEN
        INSERT INTO notifikasi (tipe, pesan)
        VALUES (
            'Stok Menipis',
            CONCAT('Stok produk ', NEW.nama_produk, ' tinggal ', NEW.stok, ' unit')
        );
    END IF;
END //

-- Trigger untuk transaksi baru
CREATE TRIGGER tr_notif_transaksi_baru
AFTER INSERT ON transaksis
FOR EACH ROW
BEGIN
    DECLARE nama_produk_val VARCHAR(100);
    
    SELECT nama_produk INTO nama_produk_val
    FROM produks
    WHERE id_produk = NEW.id_produk;
    
    INSERT INTO notifikasi (tipe, pesan)
    VALUES (
        'Transaksi Baru',
        CONCAT('Transaksi baru: ', NEW.kode_transaksi, 
               ' - Produk: ', nama_produk_val,
               ' - Total: Rp', FORMAT(NEW.total_harga, 0))
    );
END //

-- Trigger untuk pembatalan transaksi
CREATE TRIGGER tr_notif_pembatalan
AFTER UPDATE ON transaksis
FOR EACH ROW
BEGIN
    IF NEW.status_bayar = 'Gagal' AND OLD.status_bayar != 'Gagal' THEN
        -- Kembalikan stok
        UPDATE produks
        SET stok = stok + NEW.jumlah
        WHERE id_produk = NEW.id_produk;
        
        -- Buat notifikasi
        INSERT INTO notifikasi (tipe, pesan)
        VALUES (
            'Pembatalan',
            CONCAT('Transaksi ', NEW.kode_transaksi, ' dibatalkan - Stok dikembalikan')
        );
    END IF;
END //

DELIMITER ;

-- Cara test:
-- Test stok menipis
UPDATE produks SET stok = 10 WHERE id_produk = 1;

-- Test transaksi baru
INSERT INTO transaksis (kode_transaksi, id_produk, jumlah, status_bayar, total_harga, tgl_jual)
VALUES ('TRX002', 1, 1, 'Sukses', 500000, CURDATE());

-- Test pembatalan
UPDATE transaksis SET status_bayar = 'Gagal' WHERE kode_transaksi = 'TRX002';

-- Lihat hasil
SELECT * FROM notifikasi ORDER BY created_at DESC;
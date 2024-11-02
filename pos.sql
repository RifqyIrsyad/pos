-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Okt 2024 pada 16.19
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`) VALUES
(2, 'admin123@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'makanan'),
(2, 'minuman'),
(3, 'snack'),
(5, 'dessert'),
(7, 'esteh jumbo'),
(9, 'soto');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `email`, `alamat`) VALUES
(1, 'joko', '098765646', 'jokon@gmail.com', 'ungaran'),
(3, 'memet', '123456776', 'mamet@gmail.com', 'semarang\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `change_amount` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `admin_id`, `customer_id`, `total_price`, `payment_amount`, `change_amount`, `order_date`) VALUES
(1, 0, 1, 56000.00, 0.00, 0.00, '2024-10-04 16:08:59'),
(2, 0, 1, 33000.00, 0.00, 0.00, '2024-10-04 16:28:01'),
(3, 0, 1, 4000.00, 10000.00, 6000.00, '2024-10-04 16:35:55'),
(4, 0, 1, 43000.00, 50000.00, 7000.00, '2024-10-04 17:59:05'),
(5, 0, 1, 12000.00, 100000.00, 88000.00, '2024-10-04 18:33:51'),
(6, 0, 1, 12000.00, 1000000.00, 988000.00, '2024-10-05 07:40:51'),
(7, 0, 3, 7000.00, 10000000.00, 9993000.00, '2024-10-05 07:46:49'),
(8, 0, 1, 2000.00, 10000.00, 8000.00, '2024-10-05 07:53:26'),
(9, 0, 1, 2000.00, 1000000.00, 998000.00, '2024-10-05 08:31:29'),
(10, 0, 3, 425000.00, 1000000.00, 575000.00, '2024-10-05 09:48:43'),
(11, 0, 1, 2000.00, 10000.00, 8000.00, '2024-10-05 10:25:07'),
(12, 0, 1, 26000.00, 30000.00, 4000.00, '2024-10-05 10:38:25'),
(13, 0, 3, 25000.00, 70000.00, 45000.00, '2024-10-05 10:42:49'),
(14, 0, 1, 2000.00, 2000.00, 0.00, '2024-10-05 10:44:02'),
(15, 0, 1, 25000.00, 100000.00, 75000.00, '2024-10-05 10:46:31'),
(16, 0, 1, 3012.00, 10000.00, 6988.00, '2024-10-05 12:11:44'),
(17, 0, 1, 23000.00, 30000.00, 7000.00, '2024-10-05 12:21:16'),
(18, 0, 1, 49000.00, 100000.00, 51000.00, '2024-10-05 12:28:18'),
(19, 0, 1, 13000.00, 20000.00, 7000.00, '2024-10-05 12:30:19'),
(20, 0, 3, 59000.00, 100000.00, 41000.00, '2024-10-05 13:01:55'),
(21, 0, 3, 43000.00, 43000.00, 0.00, '2024-10-05 13:02:33'),
(22, 0, 1, 40000.00, 40000.00, 0.00, '2024-10-05 13:07:32'),
(23, 0, 1, 10000.00, 20000.00, 10000.00, '2024-10-05 13:07:58'),
(24, 0, 1, 120000.00, 200000.00, 80000.00, '2024-10-05 13:08:49'),
(25, 0, 3, 240000.00, 240000.00, 0.00, '2024-10-05 13:16:50'),
(26, 0, 3, 9000.00, 15000.00, 6000.00, '2024-10-05 13:17:14'),
(27, 0, 1, 65000.00, 65000.00, 0.00, '2024-10-05 13:30:42'),
(28, 0, 1, 90896.00, 100000.00, 9104.00, '2024-10-05 13:31:04'),
(29, 0, 1, 272688.00, 300000.00, 27312.00, '2024-10-05 13:32:16'),
(30, 0, 1, 9000.00, 15000.00, 6000.00, '2024-10-05 14:00:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `quantity`, `price`, `total_price`) VALUES
(1, NULL, NULL, 2, 25000.00, 0.00),
(2, 1, 1, 2, 50000.00, 0.00),
(3, 1, 2, 3, 6000.00, 0.00),
(4, 2, 2, 4, 8000.00, 0.00),
(5, 2, 1, 1, 25000.00, 0.00),
(6, 3, 2, 2, 4000.00, 0.00),
(7, 4, 1, 1, 25000.00, 0.00),
(8, 4, 2, 2, 4000.00, 0.00),
(10, 5, 3, 1, 12000.00, 0.00),
(11, 6, 3, 1, 12000.00, 0.00),
(12, 7, 4, 1, 7000.00, 0.00),
(13, 8, 2, 1, 2000.00, 0.00),
(14, 9, 2, 1, 2000.00, 0.00),
(15, 10, 1, 17, 425000.00, 0.00),
(16, 11, 2, 1, 2000.00, 0.00),
(17, 12, 2, 1, 2000.00, 0.00),
(18, 12, 3, 2, 24000.00, 0.00),
(19, 14, 2, 1, 2000.00, 0.00),
(20, 15, 1, 1, 25000.00, 0.00),
(21, 16, 1, 1, 12.00, 0.00),
(22, 16, 2, 1, 3000.00, 0.00),
(23, 17, 2, 1, 3000.00, 0.00),
(24, 17, 3, 1, 20000.00, 0.00),
(25, 18, 3, 1, 20000.00, 0.00),
(26, 18, 4, 2, 20000.00, 0.00),
(27, 18, 2, 3, 9000.00, 0.00),
(28, 19, 2, 1, 3000.00, 0.00),
(29, 19, 4, 1, 10000.00, 0.00),
(30, 20, 3, 2, 40000.00, 0.00),
(31, 20, 4, 1, 10000.00, 0.00),
(32, 20, 2, 3, 9000.00, 0.00),
(33, 21, 2, 1, 3000.00, 0.00),
(34, 21, 3, 2, 40000.00, 0.00),
(35, 22, 3, 2, 40000.00, 0.00),
(36, 23, 4, 1, 10000.00, 0.00),
(37, 24, 4, 12, 120000.00, 0.00),
(38, 25, 3, 12, 240000.00, 0.00),
(39, 26, 2, 3, 9000.00, 0.00),
(40, 27, 2, 5, 15000.00, 0.00),
(41, 27, 4, 5, 50000.00, 0.00),
(42, 28, 11, 1, 90896.00, 0.00),
(43, 29, 11, 3, 272688.00, 0.00),
(44, 30, 2, 3, 9000.00, 0.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `price`, `stock`, `image`) VALUES
(1, 'pisang goreng', 3, 12.00, 98, 'images/gorengan.jpg'),
(2, 'es teh jumbo', 2, 3000.00, 279, 'images/es teh jumbo.jpg'),
(3, 'nasi padang', 1, 20000.00, 6, 'images/padang.jpg'),
(4, 'soto', 1, 10000.00, 95, 'images/download.jpg'),
(11, 'gado gado', 5, 90896.00, 0, 'images/gado.jpg'),
(13, 'soto', 7, 949495.00, 3, 'images/es teh jumbo.jpg'),
(15, 'soto', 3, 43787.00, 4, 'images/gado.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indeks untuk tabel `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Ketidakleluasaan untuk tabel `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

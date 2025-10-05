-- Database: petshop
--
CREATE DATABASE IF NOT EXISTS `petshop`;
USE `petshop`;

-- Table: roles
CREATE TABLE IF NOT EXISTS `roles` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL UNIQUE
);

-- Insert default roles
INSERT IGNORE INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- Table: users
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `role_id` INT NOT NULL DEFAULT 2, -- Default to 'user'
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`)
);

-- Table: categories
CREATE TABLE IF NOT EXISTS `categories` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL UNIQUE,
    `description` TEXT
);

-- Table: products
CREATE TABLE IF NOT EXISTS `products` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `category_id` INT,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `price` DECIMAL(10, 2) NOT NULL,
    `stock` INT NOT NULL DEFAULT 0,
    `image` VARCHAR(255),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`)
);

-- Table: orders
CREATE TABLE IF NOT EXISTS `orders` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `order_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `total_amount` DECIMAL(10, 2) NOT NULL,
    `status` VARCHAR(50) NOT NULL DEFAULT 'pending', -- e.g., pending, completed, cancelled
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);

-- Table: order_items
CREATE TABLE IF NOT EXISTS `order_items` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    `quantity` INT NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL, -- Price at the time of order
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`),
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`)
);

INSERT IGNORE INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Comida para Perros', 'Alimentos de alta calidad para perros de todas las edades y razas.'),
(2, 'Juguetes para Gatos', 'Divertidos y estimulantes juguetes para tu felino.'),
(3, 'Accesorios para Mascotas', 'Collares, correas y otros accesorios esenciales.'),
(4, 'Ropa para Perros', 'Vestimenta cómoda y a la moda para tu compañero canino.'),
(5, 'Artículos de Aseo', 'Productos para mantener a tu mascota limpia y saludable.');

-- Insert dummy products
INSERT IGNORE INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `stock`, `image`)
VALUES
(1, 1, 'Alimento Seco Premium para Perros Adultos', 'Fórmula balanceada con pollo real y vegetales.', 85.50, 100, 'https://via.placeholder.com/150/A61C28/FFFFFF?text=ComidaPerro'),
(2, 2, 'Set de Juguetes Interactivos para Gatos', 'Incluye ratones, pelotas y plumas para horas de diversión.', 35.00, 75, 'https://via.placeholder.com/150/C3C2C0/000000?text=JuguetesGato'),
(3, 3, 'Correa Retráctil de 5 Metros', 'Ideal para paseos seguros y cómodos.', 60.00, 50, 'https://via.placeholder.com/150/E0DEA3/000000?text=Correa'),
(4, 4, 'Chaqueta Impermeable para Perros Pequeños', 'Protege a tu perro de la lluvia y el frío.', 95.00, 30, 'https://via.placeholder.com/150/A66F2D/FFFFFF?text=RopaPerro'),
(5, 5, 'Champú Hipoalergénico para Mascotas', 'Suave con la piel sensible y deja un pelaje brillante.', 45.00, 60, 'https://via.placeholder.com/150/A61C28/FFFFFF?text=Champú'),
(6, 1, 'Alimento Húmedo para Cachorros (Latas)', 'Nutrición completa para el crecimiento de tu cachorro.', 12.00, 120, 'https://via.placeholder.com/150/C3C2C0/000000?text=ComidaCachorro'),
(7, 2, 'Rascador de Cartón Reversible', 'Para que tu gato afile sus garras y se divierta.', 25.00, 40, 'https://via.placeholder.com/150/E0DEA3/000000?text=RascadorGato'),
(8, 3, 'Placa Identificatoria Grabada', 'Personaliza con el nombre de tu mascota y tu teléfono.', 20.00, 80, 'https://via.placeholder.com/150/A66F2D/FFFFFF?text=Placa');

SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';

CREATE TABLE `user` (
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `nom` varchar(200),
    `prenom` varchar(200),
    `email` varchar(200),
    `password` varchar(200)
);

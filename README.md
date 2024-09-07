# Atari Game Catalog Search


## Atari Games Catalog Schema
```sql
CREATE TABLE `videogames` (
  `atariTitle` varchar(50) NOT NULL,
  `searsTitle` varchar(50) DEFAULT NULL,
  `code` varchar(20) NOT NULL,
  `leadProgrammer` varchar(50) DEFAULT NULL,
  `yearReleased` int unsigned NOT NULL,
  `genre` varchar(20) NOT NULL,
  `notes` text,
  `username` varchar(100) NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
```

## Developers Database Schema
```sql
CREATE TABLE `developers` (
  `userid` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

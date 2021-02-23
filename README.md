### How to start this app
You need to setup database with user "counter" and password "bad_password" first, then setup table:

```sql
CREATE TABLE `users` (
  `login` varchar(30) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `counter` mediumint DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;
```
and execute php from source directory
```bash
php -S 127.0.0.1:8000 index.php
```

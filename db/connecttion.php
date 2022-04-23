<?php
$PDO = new PDO("mysql:host=localhost; port = 3306;dbname=els_db", "root", "");
$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

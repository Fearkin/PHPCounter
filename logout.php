<?php

session_destroy();
header('Location: ' . HOME_URL);
die();
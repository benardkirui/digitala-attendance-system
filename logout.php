<?php
session_start();
include 'database/DAO.php';
$dbc = new DAO();
$dbc->logout_attachee();
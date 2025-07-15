<?php
require_once '../config/db.php';
require_once '../models/QueryModel.php';

$queryModel = new QueryModel($conn);
$queries = $queryModel->getAllQueries();

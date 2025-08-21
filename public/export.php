<?php
require_once __DIR__ . '/../config/db.php';
$id = (int)($_GET['id'] ?? 0);
if (!$id) exit('Invalid ID');
$stmt = $pdo->prepare('SELECT * FROM poems WHERE id = ?');
$stmt->execute([$id]);
$poem = $stmt->fetch();
if (!$poem) exit('Not found');

$txt = "Theme: {$poem['theme']}\nCreated: {$poem['created_at']}\n\n" . $poem['content'];
header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename=poem-' . $id . '.txt');
echo $txt;
exit;

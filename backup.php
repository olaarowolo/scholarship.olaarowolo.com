<?php
$src = __DIR__ . '/database/database.sqlite';
if (!file_exists($src)) {
    fwrite(STDERR, "Source database file not found: $src\n");
    exit(1);
}
$ts = date('Ymd_His');
$destDir = __DIR__ . '/database/backups';
if (!is_dir($destDir)) {
    mkdir($destDir, 0755, true);
}
$dest = $destDir . "/database.sqlite.$ts.bak";
if (!copy($src, $dest)) {
    fwrite(STDERR, "Failed to copy $src to $dest\n");
    exit(1);
}
file_put_contents($dest . '.meta', json_encode(['created_at' => date('c'), 'source' => $src]));
fwrite(STDOUT, "Backup created: $dest\n");
return 0;

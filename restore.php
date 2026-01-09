<?php
$backupDir = __DIR__ . '/database/backups';
if (!is_dir($backupDir)) {
    fwrite(STDERR, "No backups directory found: $backupDir\n");
    exit(1);
}
$files = glob($backupDir . '/database.sqlite.*.bak');
if (!$files) {
    fwrite(STDERR, "No backup files found in $backupDir\n");
    exit(1);
}
usort($files, function ($a, $b) {
    return filemtime($b) <=> filemtime($a);
});
$latest = $files[0];
$dest = __DIR__ . '/database/database.sqlite';
if (!copy($latest, $dest)) {
    fwrite(STDERR, "Failed to restore $latest to $dest\n");
    exit(1);
}
fwrite(STDOUT, "Restored backup: $latest -> $dest\n");
return 0;

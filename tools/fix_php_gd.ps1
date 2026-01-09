# Restore php.ini from backup if present and ensure GD is enabled for CLI
$ini = 'C:\Users\user\.config\herd-lite\bin\php.ini'
$bak = $ini + '.bak'
if (Test-Path $bak) {
    Copy-Item -Path $bak -Destination $ini -Force
    Write-Output "Restored $ini from backup $bak"
}

# Read current content
$content = Get-Content -Path $ini -ErrorAction Stop -Raw

# Ensure extension_dir is set correctly
if ($content -notmatch '^[ \t]*extension_dir[ \t]*=') {
    Add-Content -Path $ini -Value "`r`nextension_dir = \"C:\\php\\ext\"`r`n"
    Write-Output "Appended extension_dir to $ini"
} else {
    $updated = $content -replace '^[ \t]*extension_dir[ \t]*=.*', 'extension_dir = "C:\\php\\ext"'
    Set-Content -Path $ini -Value $updated -Force
    Write-Output "Ensured extension_dir line in $ini"
}

# Ensure php_gd.dll is enabled
if (-not (Select-String -Path $ini -Pattern '^[ \t]*extension[ \t]*=[ \t]*php_gd' -Quiet)) {
    Add-Content -Path $ini -Value "extension=php_gd.dll`r`n"
    Write-Output "Appended extension=php_gd.dll to $ini"
} else {
    Write-Output "php_gd.dll already enabled in $ini"
}

# Verify GD module and image function
Write-Output "--- PHP modules (filtering for gd) ---"
php -m 2>&1 | Select-String -Pattern gd -SimpleMatch | ForEach-Object { Write-Output $_ }
Write-Output "--- imagejpeg available? ---"
php -r "var_dump(function_exists('imagejpeg'));
" 2>&1 | ForEach-Object { Write-Output $_ }

Write-Output "Script finished."
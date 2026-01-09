# tools/install_php_gd.ps1
$ErrorActionPreference = 'Stop'
$zipPath = Join-Path $env:TEMP 'php-8.4.0-nts-Win32-vs16-x64.zip'
$extractDir = Join-Path $env:TEMP 'php84'
$destDll = 'C:\php\ext\php_gd.dll'
$backupDll = 'C:\php\ext\php_gd.dll.bak'

Write-Output "Backup existing DLL if present"
if (Test-Path $destDll) {
    Copy-Item -Path $destDll -Destination $backupDll -Force
    Write-Output "Existing DLL backed up to $backupDll"
} else {
    Write-Output "No existing php_gd.dll found at $destDll"
}

Write-Output "Downloading PHP 8.4.0 NTS x64 archive"
$uri = 'https://windows.php.net/downloads/archives/php-8.4.0-nts-Win32-vs16-x64.zip'
Invoke-WebRequest -Uri $uri -OutFile $zipPath -UseBasicParsing

Write-Output "Extracting archive to $extractDir"
if (Test-Path $extractDir) { Remove-Item -Path $extractDir -Recurse -Force }
Expand-Archive -LiteralPath $zipPath -DestinationPath $extractDir -Force

Write-Output "Searching for php_gd.dll in extracted files"
$found = Get-ChildItem -Path $extractDir -Filter 'php_gd.dll' -Recurse -ErrorAction SilentlyContinue | Select-Object -First 1
if ($null -eq $found) {
    Write-Error "php_gd.dll not found in the archive"
    exit 1
}

Write-Output "Copying $($found.FullName) to $destDll"
Copy-Item -Path $found.FullName -Destination $destDll -Force

Write-Output "Verifying imagejpeg availability in PHP CLI"
php -r "var_dump(function_exists('imagejpeg'));" 2>&1 | ForEach-Object { Write-Output $_ }

Write-Output 'Done.'

# tools/install_sqlite3.ps1
$ErrorActionPreference = 'Stop'

$urls = @(
    'https://www.sqlite.org/2024/sqlite-tools-win32-x86-3420000.zip',
    'https://www.sqlite.org/2023/sqlite-tools-win32-x86-3410200.zip',
    'https://www.sqlite.org/2022/sqlite-tools-win32-x86-3360000.zip'
)

$zip = Join-Path $env:TEMP 'sqlite-tools.zip'
$extractDir = Join-Path $env:TEMP 'sqlite-tools'

Write-Output "Attempting to download sqlite-tools to $zip"
$downloaded = $false
foreach ($u in $urls) {
    try {
        Write-Output "Trying $u"
        Invoke-WebRequest -Uri $u -OutFile $zip -UseBasicParsing -ErrorAction Stop
        Write-Output "Downloaded $u"
        $downloaded = $true
        break
    } catch {
        Write-Output ("Failed to download " + $u + ": " + $_.Exception.Message)
    }
}

if (-not $downloaded) {
    Write-Error "All downloads failed. Please ensure internet access or provide sqlite3.exe manually."
    exit 1
}

if (Test-Path $extractDir) { Remove-Item -Path $extractDir -Recurse -Force }
Expand-Archive -LiteralPath $zip -DestinationPath $extractDir -Force

$exe = Get-ChildItem -Path $extractDir -Filter 'sqlite3.exe' -Recurse -ErrorAction SilentlyContinue | Select-Object -First 1
if ($null -eq $exe) {
    Write-Error "sqlite3.exe not found in archive"
    exit 1
}

$dest = 'C:\Windows\System32\sqlite3.exe'
Write-Output "Copying $($exe.FullName) to $dest"
Copy-Item -Path $exe.FullName -Destination $dest -Force

Write-Output "sqlite3 version:" 
& sqlite3 --version

# Copy live DB to test DB
Write-Output "Copying database/database.sqlite to database/database.test.sqlite"
php -r "copy('database/database.sqlite','database/database.test.sqlite');"

# Run tests against file DB
Write-Output "Running tests against file DB copy"
$env:DB_CONNECTION='sqlite'
$env:DB_DATABASE='database/database.test.sqlite'
php artisan test

Write-Output "Script finished."

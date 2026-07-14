$migrationPath = ".\console\migrations"

Write-Host "Scanning migrations..." -ForegroundColor Green

Get-ChildItem $migrationPath -Filter "*.php" | ForEach-Object {

    $file = $_.FullName
    $text = Get-Content $file -Raw

    # ==============================
    # PRIMARY KEY
    # ==============================

    if ($text -match "create_table_(.*?)\.php") {
        $table = $matches[1]
    }
    else {
        $table = $_.BaseName
    }

    $text = $text -replace "'PRIMARYKEY'","'pk_$table'"

    # ==============================
    # FOREIGN KEY
    # ==============================

    $fk = 1
    while($text -match "'FOREIGNKEY'"){
        $text = $text -replace "'FOREIGNKEY'","'fk_${table}_$fk'",1
        $fk++
    }

    # ==============================
    # INDEX
    # ==============================

    $idx = 1
    while($text -match "'INDEXKEY'"){
        $text = $text -replace "'INDEXKEY'","'idx_${table}_$idx'",1
        $idx++
    }

    # ==============================
    # MySQL Engine
    # ==============================

    $text = $text -replace "ENGINE=InnoDB",""
    $text = $text -replace "ENGINE=MyISAM",""

    # ==============================
    # Charset
    # ==============================

    $text = $text -replace "DEFAULT CHARSET=utf8",""
    $text = $text -replace "DEFAULT CHARSET=utf8mb4",""

    # ==============================
    # AUTO_INCREMENT
    # ==============================

    $text = $text -replace "AUTO_INCREMENT",""

    # ==============================
    # UNSIGNED
    # ==============================

    $text = $text -replace "UNSIGNED",""

    Set-Content $file $text -Encoding UTF8

    Write-Host "Fixed $($_.Name)"
}

Write-Host ""
Write-Host "==================================" -ForegroundColor Cyan
Write-Host "Migration auto-fix selesai." -ForegroundColor Green
Write-Host "=================================="
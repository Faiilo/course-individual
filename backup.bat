@echo off
setlocal enabledelayedexpansion

:: Путь к sqlite3.exe (должен лежать в папке проекта)
set SQLITE3=%~dp0sqlite3.exe

:: Путь к базе данных
set DB_PATH=%~dp0database\database.sqlite

:: Папка для бэкапов
set BACKUP_DIR=%~dp0database\backup

:: Проверка наличия sqlite3.exe
if not exist "%SQLITE3%" (
    echo [ОШИБКА] sqlite3.exe не найден в папке проекта
    echo Положите sqlite3.exe рядом с этим скриптом
    pause
    exit /b 1
)

:: Проверка наличия базы данных
if not exist "%DB_PATH%" (
    echo [ОШИБКА] База данных не найдена: %DB_PATH%
    pause
    exit /b 1
)

:: Создание папки для бэкапов
if not exist "%BACKUP_DIR%" mkdir "%BACKUP_DIR%"

:: Формирование имени файла (database_backup_20260515.sql)
set YEAR=%DATE:~6,4%
set MONTH=%DATE:~3,2%
set DAY=%DATE:~0,2%
set BACKUP_FILE=%BACKUP_DIR%\database_backup_%YEAR%%MONTH%%DAY%.sql

:: Создание дампа
echo Создание резервной копии...
"%SQLITE3%" "%DB_PATH%" .dump > "%BACKUP_FILE%"

:: Проверка результата
if %errorlevel% equ 0 (
    echo [УСПЕХ] Резервная копия создана: %BACKUP_FILE%
    echo Размер файла: 
    dir "%BACKUP_FILE%" | findstr ".sql"
) else (
    echo [ОШИБКА] Не удалось создать резервную копию
    pause
    exit /b 1
)

pause
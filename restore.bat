@echo off
setlocal

:: Путь к sqlite3.exe
set SQLITE3=%~dp0sqlite3.exe

:: Путь к базе данных
set DB_PATH=%~dp0database\database.sqlite

:: Путь к папке с бэкапами
set BACKUP_DIR=%~dp0database\backup

:: Файл бэкапа (меняй дату под свой файл)
set BACKUP_FILE=%BACKUP_DIR%\database_backup_20260515.sql

:: Проверка наличия sqlite3.exe
if not exist "%SQLITE3%" (
    echo [ОШИБКА] sqlite3.exe не найден в папке проекта
    pause
    exit /b 1
)

:: Проверка наличия файла бэкапа
if not exist "%BACKUP_FILE%" (
    echo [ОШИБКА] Файл бэкапа не найден: %BACKUP_FILE%
    echo Укажите правильный файл в переменной BACKUP_FILE
    pause
    exit /b 1
)

:: Удаление старой базы данных (если есть)
if exist "%DB_PATH%" (
    echo Удаление существующей базы данных...
    del "%DB_PATH%"
)

:: Восстановление из бэкапа
echo Восстановление базы данных из бэкапа...
"%SQLITE3%" "%DB_PATH%" < "%BACKUP_FILE%"

:: Проверка результата
if %errorlevel% equ 0 (
    echo [УСПЕХ] База данных восстановлена из: %BACKUP_FILE%
) else (
    echo [ОШИБКА] Не удалось восстановить базу данных
    pause
    exit /b 1
)

pause
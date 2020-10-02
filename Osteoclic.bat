@echo off
tasklist /nh /fi "imagename eq laragon.exe" | find /i "laragon.exe" >nul && (
echo Laragon is running
) || (
start C:\laragon\laragon.exe
)
start "" http://127.0.0.1:8000/
symfony serve

pause>nul

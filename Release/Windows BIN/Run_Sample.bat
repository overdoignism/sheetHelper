@echo off
set "current_time=%date:~0,4%%date:~5,2%%date:~8,2%_%time:~0,2%%time:~3,2%%time:~6,2%"

rem https://sh100.000webhostapp.com/SH_Read.php?id=Sample1
sheetHelper.exe Sample1.txt https://my.000webhostapp.com/SH_Write.php
if not %errorlevel% == 0 echo "" > %current_time%_1.err

rem https://sh100.000webhostapp.com/SH_Read.php?id=Sample2
sheetHelper.exe Sample2.txt https://my.000webhostapp.com/SH_Write.php
if not %errorlevel% == 0 echo "" > %current_time%_2.err

timeout /t 3
exit
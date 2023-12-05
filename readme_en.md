## Operation Principle

Using WebView2 (=Edge=Chromium) as the core component, it emulates real web browsing, captures content based on XPath, and then uploads the information to an external PHP website for retrieval by Google Sheets or other programs.

## How to use

### Step 1: Prepare the URL and XPath you want to capture.

Assume the target URL is _ht<span>tp://www<span>.somestock<span>.com/stock1001/_ .

Assume the XPath is _/html/body/main/div/div\[3\]/span\[1\]_ .

**( How to get XPath: https://www.youtube.com/watch?v=mNpqZoZArt0 )**

### Step 2: Register a free website that supports PHP.

Assume the website is _ht<span>tp://whoAmI<span>.freehost<span>.com/_ .

### Step 3: Download this program. Rename the PHP files for security (Don't tell anyone):

Assume:

_SH\_Write.php -> Help\_W.php_  
_SH\_Read.php -> Help\_R.php_

### Step 4: Upload the PHP files to the free website.

### Step 5: Edit a text file

e.g., _Sample1.TXT_.

The format of this text file is as follows:

Line 1: URL to capture  
Line 2: XPath to capture  
Line 3: ID for future retrieval (choose a unique ID without commas)  
Line 4: Data mode, 0=text, 1=number  
  
Example:

_ht<span>tp://www<span>.somestock<span>.com/stock1001/_  
_/html/body/main/div/div\[3\]/span\[1\]_  
_Example\_1_  
_0_

### Step 6: Edit a batch file

e.g., _Run.BAT_.

**Its content is as follows:**

_sheetHelper.exe Sample1.TXT ht<span>tp://whoAmI<span>.freehost<span>.com/Help_W.php_  
_timeout /t 10_

**For multiple targets:**

_sheetHelper.exe Sample1.TXT ht<span>tp://whoAmI<span>.freehost<span>.com/Help_W.php_  
_sheetHelper.exe Sample2.TXT ht<span>tp://whoAmI<span>.freehost<span>.com/Help_W.php_  
_sheetHelper.exe Sample3.TXT ht<span>tp://whoAmI<span>.freehost<span>.com/Help_W.php_  
_timeout /t 10_

Run the batch file. If it prompts to install the WebView2 runtime component, download it from:  
https://developer.microsoft.com/zh-tw/microsoft-edge/webview2/

### Step 7: Set up the first column in Google Sheets:

_\=IMPORTXML("ht<span>tp://whoAmI<span>.freehost<span>.com/Help_R.php?id=Example_1","//span[@class='Example_1']")_  
This displays the captured value.

### Step 8: If you need an alert when it stops, set up the second column:

_\=IMPORTXML("ht<span>tp://whoAmI.freehost.com/Help_R.php?id=Example_1","//span[@class='Example_1_sec']")_  
This shows the seconds since the last update. You can perform calculations, e.g., divide by 3600 for hours.

### Step 9: Task Scheduler 
After confirming everything works, use the Task Scheduler to execute Run.BAT based on your desired conditions.

### Step 10: Congratulations! You're done.

### Advanced Usage:

1. If you have multiple capture targets, set them as …Help\_R.php?id=Example\_1,Example\_2,Example\_3 to save on read traffic.

2. For the stop working alert column, use "Conditional Formatting" to display a specific style when exceeding a certain time.

3. If data mode is set to 0 (text), it uploads any information.  
If set to 1 (number), it only uploads when detecting as an number (excluding % symbol) to enhance field change detection.

4. For batch file or powershell, the errorlevels mean:  
0=success / 1=runtime error / 2=Settings error / 3=Target connect error / 4=Target value error / 5=Host connect error

### Final Reminders:

1. Google Sheets update frequency is limited (approximately once per hour). Adjust the program's start time accordingly. Set a longer update time to avoid unnecessary traffic waste.

2. The program may work with Microsoft Excel 2013 and later versions, but testing is required.

3. The program generates a browsing cache folder in the same directory. You may delete it when the program is not running, but keeping it can speed up webpage loading.

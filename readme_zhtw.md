## 工作原理

採取 WebView2 （=Edge=Chromium）作為核心元件，模擬真實網頁瀏覽，截取 XPath 內容後，再上傳資訊給外部 PHP 網站，以供 Google sheets 或其他程式截取。

## 如何使用

### 第一步 準備好你要截取的網址、XPath。

這裡假定目標網址為 _ht<span>tp://www<span>.somestock<span>.com/stock1001/_ 。

這裡假定 XPath 為 _/html/body/main/div/div\[3\]/span\[1\]_ 。

**( 如何取得 XPath 教學: https://www.youtube.com/watch?v=mNpqZoZArt0 )**

### 第二步 申請一個支援 PHP 的免費網站。

這裡假定網址為 _ht<span>tp://whoAmI<span>.freehost<span>.com/_ 。

### 第三步 下載本程式。其中的 PHP 檔案最好改名一下，並且保密。

這裡假定為：

_SH\_Write.php -> Help\_W.php_  
_SH\_Read.php -> Help\_R.php_

### 第四步 將 PHP 檔案上傳到該免費網站。

### 第五步 編輯一個文字檔。

這裡假定為 _Sample1.TXT_ 。此文字檔其內容格式如下：

第一行是要截取的網址  
第二行是要截取的XPATH  
第三行是未來讀回時要用ID，自己設定。不能有","符號。  
第四行是資料模式， 0=文字 1=數字

如果套用上面的範例即為：

_ht<span>tp://www<span>.somestock<span>.com/stock1001/_  
_/html/body/main/div/div\[3\]/span\[1\]_  
_Example\_1_  
_0_

### 第六步　編輯一個批次檔。

這裡假定為 _Run.BAT_ 。其內容如下：

_sheetHelper.exe Sample1.TXT ht<span>tp://whoAmI.freehost.com/Help_W.php_  
_timeout /t 10_

如果你要一次處理多個目標，那就是增加多行，像這樣：

_sheetHelper.exe Sample1.TXT ht<span>tp://whoAmI<span>.freehost<span>.com/Help_W.php_  
_sheetHelper.exe Sample2.TXT ht<span>tp://whoAmI<span>.freehost<span>.com/Help_W.php_  
_sheetHelper.exe Sample3.TXT ht<span>tp://whoAmI<span>.freehost<span>.com/Help_W.php_  
_timeout /t 10_

然後執行。如果執行時說需要安裝 webview2 執行元件，可至此處下載：  
https://developer.microsoft.com/zh-tw/microsoft-edge/webview2/

### 第七步  到 Google Sheets 設置第一個欄位。

_\=IMPORTXML("ht<span>tp://whoAmI<span>.freehost<span>.com/Help_R.php?id=Example_1","//span[@class='Example_1']")_

這樣顯示的就是讀值了。

### 第八步  如果你需要停擺時的警示，請設置第二個欄位：

_\=IMPORTXML("ht<span>tp://whoAmI<span>.freehost<span>.com/Help_R.php?id=Example_1","//span[@class='Example_1_sec']")_

這樣會讀回距離上次更新有多少秒。你可以自行加入運算，除 3600 就成為小時。

### 第九步  工作排程

確定一切都正常後，可以利用工作排程器（task scheduler），設置 Run.BAT 依照你想要的條件來排程執行。

### 第十步  到此，已經大功告成。

---

### 進階使用方式：

一、如果你有多個截取目標，可以設置成 ...Help\_R.php?id=Example\_1,Example\_2,Example\_3，  
Google Sheets 應該可以節省一些讀取次數，節省免費網站的流量。

二、停擺警示欄位，可以設定「條件式格式設定」，在超過時間時顯示為指定的顏色。

三、資料模式若設置為 0 (文字)，會上傳任何資訊，設置為 1 (數字) 則只在檢測為數字時上傳 (不含%符號)。  
這是為了增加欄位變動時的檢測性。  

四、應用於批次檔 (bat) 或 Powershell 的 errorlevel 值：  
0=成功 / 1=執行期間錯誤 / 2=設定錯誤 / 3=目標連線錯誤 / 4=目標取值錯誤 / 5=主機連接錯誤

---

### 最後提醒：

一、更新頻率受限於 Google Sheets，約每小時一次。更新程式的啟動時間不宜短於此。請在符合您的需求的前提下，  
更新時間盡量設置長些，以免造成不必要的流量浪費。

二、本程式應該也可以適用於 Microsoft Excel 2013 之後的版本，但請自行研究測試。

三、本程式執行後會在同資料夾內生成一個瀏覽快取資料夾，用於儲存瀏覽資訊。在程式未執行時可以刪除，  
但建議保留可以加快網頁載入速度。

香海禪寺住房管理系統使用說明
=========
本網頁程式以「保留作者名字|非商業使用|請勿更改」的方式進行分享，作者名字爲「尹卂|Ejsoon Y」。

任何問題請發送郵件至
ejsoon@outlook.com(國際)
ejsoon@126.com(中國大陸)

使用說明
---
見[help.pdf](https://github.com/ejsoonyang/heohoh/raw/master/help.pdf)

安裝步驟
---
一，更改以下文檔
connect_db.php
login.php
php_create/person_history.php
php_create/person_history.php
中的服務器位址，用戶名，密碼，數據庫名。

二，上傳文檔，並更改所有文檔的權限爲755。

三，在網頁位址欄中輸入php_create/person_main.php，建立主數據庫。成功後請記住顯示的預設的用戶名和密碼。

四，在網頁位址欄中輸入php_create/person_history.php，建立歷史數據庫。

五，進入首頁，使用在步驟二中獲取的用戶名和密碼登入。

六，登入成功後，請刪除php_create/資料夾，更改用戶密碼。

注意事項
---
* 如果創建數據庫不成功，請檢查權限和服務器位址，用戶名，密碼，數據庫名是否填寫正確。
* 一些服務端文檔管理有在綫解壓的功能，可在步驟二上傳之前壓縮，上傳之後再解壓。

;<?php exit(); ?>
;
[framework]

directory.controls = APPLICATION_DIR "/Controls"
directory.actions = APPLICATION_DIR "/Actions"
directory.layouts = APPLICATION_DIR "/Templates/layouts"
directory.templates = APPLICATION_DIR "/Templates"
directory.managers = APPLICATION_DIR "/Managers"
directory.entity = APPLICATION_DIR "/Entity"

file.repository = APPLICATION_DIR "/repository.rep"

[application]
name = "gss"                                            ; Имя сессии НЕ МЕНЯТЬ!
url = "https://gastreet.com"                            ; URL проекта (без конечного слеша)
urlHttps = "http://gss"                                 ; SSL-URL проекта (протокол https://, без конечного слеша)
internalIp = "http://127.0.0.1"                         ; Ip проекта относительно монеты
baseHost = "gss"
basePath = "/"						                    ; Каталог, в котором находится приложение
nocache = true						                    ; Отправлять HTTP заголовки запрещающие кеширование
encoding = "utf-8"					                    ; Кодировка HTML содержимого
debug = false						                    ; Режим отладки
protocol = "https://"                                   ; Протокол
revisionFile = DOCUMENT_ROOT "/version.xml"             ; XML файл, который содержит номер текущей ревизии
tempDir = DOCUMENT_ROOT "/app/var/tmp/"                 ; Каталог для временных файлов, например, для lock-файлов Mutex
hintsFolder = DOCUMENT_ROOT "/storage/hints/"
areasFolder = DOCUMENT_ROOT "/images/areas/"
productsFolder = DOCUMENT_ROOT "/images/products/"
prizesFolder = DOCUMENT_ROOT "/images/prizes/"
speackersFolder = DOCUMENT_ROOT "/images/speackers/"
folkSpeakerFolder = DOCUMENT_ROOT "/images/folkspeaker/"
volunteersFolder = DOCUMENT_ROOT "/images/volunteers/"
placesFolder = DOCUMENT_ROOT "/images/places/"
contactsFolder = DOCUMENT_ROOT "/images/contacts/"
videoFolder = DOCUMENT_ROOT "/images/video/"
parthnersFolder = DOCUMENT_ROOT "/images/parthners/"
ticketsFolder = DOCUMENT_ROOT "/storage/"
pdfFolder = DOCUMENT_ROOT "/pdf/battle/"
paySystemCommision = 5
seo = "rewrite"                                         ; ЧПУ (значения: url или rewrite)
jivoSite = 1                                            ; Модуль JivoSite (1 - вкл./ 0 - выкл)
bitSync = 1                                             ; Синхронизация с БИТом (1 - вкл./ 0 - выкл)

[adminka]
enableWYSIWYG = false; // отображать HTML редактор

[mail]
enabled = true
connection = "smtp"
from = "ticket@gastreet.com"
fromName = "GASTREET"
support = "ticket@gastreet.com"
admin = "dev@gastreet.com"
sign = "<br>С уважением, GASTREET TEAM" ; подпись добавляемая к уведомлениям
usleep = 500                            ; задержка между отправкой пачки писем
usend = 3                               ; кол-во писем между задержками
uall = 20                               ; кол-во писем за один крон

[smtp]
server = "smtp.yandex.ru"               ; SMTP адрес почтового сервера
port = "465"                            ; порт
login = "ticket@gastreet.com"           ; адрес с которого будет осуществляться рассылка уведомлений
password = "nepir2019"                  ; пароль от ящика указанного строкой выше lpMWZS

[master]
debug = true
user = "srv163959_gstrt"				; u430747
password = "NFmAlo0Cgp"			        ; uNeMiSmAC3I.le
host = "mysql-163959.srv.hoster.ru" 	; u430747.mysql.masterhost.ru
database = "srv163959_g20"			    ; u430747_2017
driver = "MySQL"
encoding = "utf8"
persist = false							; set persistent connection
port = 3306								; set another value if you need
;socket = "/var/run/mysqld/mysqld.sock"	; you may use socket

[smarty]
compile.check = true
debugging = false
error.reporting = E_ALL & ~E_NOTICE
compile.dir = APPLICATION_DIR "/var/compile"
config.dir = ""
lang.enable = "ru,en"
lang.default = "ru"
lang.dir = APPLICATION_DIR "/lang"
cache.dir = APPLICATION_DIR "/var/cache"
user.plugins = APPLICATION_DIR "/Smarty.Plugins"
security = true
IF_FUNCS = "strpos"
MODIFIER_FUNCS = ""

[mutex]
queueworker = "queueworker"
daysreserve = "daysreserve"
daysdeletereserved = "daysdeletereserved"
checkusersbaseticket = "checkusersbaseticket"
recalcallproducts = "recalcallproducts"
reportworker = "reportworker"
custombroadcastworker = "custombroadcastworker"

[logger]
logger.dir = APPLICATION_DIR "/var/logs/"

[MailTextHelper]
path = APPLICATION_DIR "/Templates/mail/"

[securitylog]
enabled = true                                          ; включено\выключено
passwordBrutforceLimit = 3                              ; количество попыток ввода пароля, которое считается подбором
evasiveLog = DOCUMENT_ROOT "/storage/evasive/"          ; Каталог для хранения логов mod_evasive (детектор большого числа запросов)

[IntrusionDetector]
enabled = true											; Включено\Выключено
rules = APPLICATION_DIR "/Config/intrusionRules.xml"	; Путь у XML файлу с правилами
stopOnFirstOccurence = false							; Прекращать проверку при первом же совпадении (для ускорения можно выставить true)
callback = "SecurityLogManager::writeIntrusionDetect"	; Имя метода для обработки события срабатывания правила

[sms]
from = ""
login = ""
password = ""
ApiKey = "AC7B435B-E804-3887-4E5B-06745A3F578B"         ; Ключ доступа к сервису SMS.RU

[moneta]    ; Старое
accountId = 11493408;
accountCode = ""; 
reccurentAccount = 0;

[rfi]
rfi_enable = 1                                                 ; Включена /выключена оплата
service_id = 82125                                             ; ID Сервиса
service_id_en = 82126                                          ; ID Сервиса (eng)
secretKey = "e938c3a2b5"                                       ; Ключ РФИ
key = "D50OhvwG/p4kLLsFkbDtKxY3dLLjyg/CExIs48ug4/s="           ; Ключ формы оплаты
key_en = "vnmwduB5ByoBn1Gc7eJ0ybm1DkyMwm10sQUFvKfK6Fw="        ; Ключ формы оплаты (eng)
redirect = 1                                                   ; Редирект в форме оплаты
reccurentAccount = 0                                           ; Доступны ли рекурентные платежи (не реализовано)

[eventicious]
host = "https://api.eventicious.com/"                          ; Адрес хоста
code = "3e6062e4-383b-4345-95c6-0fee20fb38b0"                  ; Код доступа к API   dc98e055-2388-4b7b-8c00-88d50fd803d3
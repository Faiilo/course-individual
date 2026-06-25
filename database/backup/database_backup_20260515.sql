PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "migrations" ("id" integer primary key autoincrement not null, "migration" varchar not null, "batch" integer not null);
INSERT INTO migrations VALUES(1,'0001_01_01_000000_create_users_table',1);
INSERT INTO migrations VALUES(2,'0001_01_01_000001_create_cache_table',1);
INSERT INTO migrations VALUES(3,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO migrations VALUES(4,'2026_04_13_102100_add_is_admin_to_users_table',2);
INSERT INTO migrations VALUES(5,'2026_04_13_155845_add_is_paid_to_posts_table',3);
INSERT INTO migrations VALUES(6,'2026_04_13_163858_add_server_to_posts_table',4);
INSERT INTO migrations VALUES(7,'2026_04_16_162153_add_sort_order_to_posts_table',5);
CREATE TABLE IF NOT EXISTS "users" ("id" integer primary key autoincrement not null, "name" varchar not null, "email" varchar not null, "email_verified_at" datetime, "password" varchar not null, "remember_token" varchar, "created_at" datetime, "updated_at" datetime, "is_admin" tinyint(1) not null default '0', "id_subscription" INTEGER);
INSERT INTO users VALUES(1,'Dimet','domator.1@mail.ru',NULL,'$2y$12$84EJuhF7kqTZfZxT8Xnr6eftODZYXq4S9fOy1AWFEj2bw40/Iecwe',NULL,'2026-04-13 10:31:41','2026-04-17 04:29:07',1,1);
INSERT INTO users VALUES(3,'67','suprasell@mail.ru',NULL,'$2y$12$zq4QsKJkJSEHwCMeK3tNF.VYjXCjUzPMZz5S43qFLdAbMRpJQ2eti',NULL,'2026-04-13 17:48:01','2026-04-19 16:34:30',1,NULL);
INSERT INTO users VALUES(4,'67','hez-ohifiho95@yandex.ru',NULL,'$2y$12$r23S.F8j4i6RndKFW/xf3eVgcxzoJgF0sDN3ldU.GcRFp195DEOaa',NULL,'2026-04-16 14:41:21','2026-04-17 04:29:37',0,1);
CREATE TABLE IF NOT EXISTS "password_reset_tokens" ("email" varchar not null, "token" varchar not null, "created_at" datetime, primary key ("email"));
CREATE TABLE IF NOT EXISTS "sessions" ("id" varchar not null, "user_id" integer, "ip_address" varchar, "user_agent" text, "payload" text not null, "last_activity" integer not null, primary key ("id"));
INSERT INTO sessions VALUES('JEc0mBL0mj83SP1IFUnqODcS33Sf44EOMiUNCyXf',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 YaBrowser/26.4.0.0 Safari/537.36','eyJfdG9rZW4iOiI0MU1acUo2ZzQyZDV2UXZCenRQUFdNNUtCek9OSFJwNmhHQ1pzcHh0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL215LWZpcnN0LXNpdGUudGVzdFwvbG9naW4iLCJyb3V0ZSI6ImxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjF9',1778823009);
INSERT INTO sessions VALUES('fEPUnnzroVX0nvBETTfmWkK7Q1fsFHHjSP7Fqwhl',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 YaBrowser/26.4.0.0 Safari/537.36','eyJfdG9rZW4iOiJNSnppWThORElNbERrdzBCVnlVUWNreVlvOFRTeDBWeGtsUHBiM2VkIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbXktZmlyc3Qtc2l0ZS50ZXN0XC9hZG1pblwvbmV3cyIsInJvdXRlIjoiYWRtaW4ubmV3cyJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=',1778824038);
CREATE TABLE IF NOT EXISTS "cache" ("key" varchar not null, "value" text not null, "expiration" integer not null, primary key ("key"));
CREATE TABLE IF NOT EXISTS "cache_locks" ("key" varchar not null, "owner" varchar not null, "expiration" integer not null, primary key ("key"));
CREATE TABLE IF NOT EXISTS "jobs" ("id" integer primary key autoincrement not null, "queue" varchar not null, "payload" text not null, "attempts" integer not null, "reserved_at" integer, "available_at" integer not null, "created_at" integer not null);
CREATE TABLE IF NOT EXISTS "job_batches" ("id" varchar not null, "name" varchar not null, "total_jobs" integer not null, "pending_jobs" integer not null, "failed_jobs" integer not null, "failed_job_ids" text not null, "options" text, "cancelled_at" integer, "created_at" integer not null, "finished_at" integer, primary key ("id"));
CREATE TABLE IF NOT EXISTS "failed_jobs" ("id" integer primary key autoincrement not null, "uuid" varchar not null, "connection" text not null, "queue" text not null, "payload" text not null, "exception" text not null, "failed_at" datetime not null default CURRENT_TIMESTAMP);
CREATE TABLE IF NOT EXISTS "media" (
	"id"	INTEGER,
	"filename"	TEXT NOT NULL,
	"file_type"	TEXT,
	"description"	TEXT,
	PRIMARY KEY("id" AUTOINCREMENT)
);
INSERT INTO media VALUES(1,'images/other1.jpg','image/jpeg','Список Forbes серверов 02-04, обновлено 22.03.2026');
INSERT INTO media VALUES(2,'images/other1.jpg','image/jpeg','Список Forbes серверов 02-04, обновлено 22.03.2026');
INSERT INTO media VALUES(3,'images/other1.jpg','image/jpeg','Список Forbes серверов 02-04, обновлено 22.03.2026');
INSERT INTO media VALUES(6,'news/news1.jpg','image/jpeg','Динамика капиталов MVP Spartak_Andeground');
INSERT INTO media VALUES(8,'news/1776351441_anon-8809955.png','image/png','focus-malinovka.ru');
INSERT INTO media VALUES(15,'news/1776352218_news2.jpg','image/jpeg','Спроси у «Фокуса» | Продление сбора вопросов до 15 апреля');
INSERT INTO media VALUES(36,'images/1776359450_anon-8809955.png','image/png','Мартовская редакция 2026');
INSERT INTO media VALUES(41,'news/1776399932_news2.jpg','image/jpeg','Спроси у «Фокуса» | Продление сбора вопросов до 15 апреля');
INSERT INTO media VALUES(46,'news/1776614633_c21700c64f5e10b0a89cde739514eaa3.jpg','image/jpeg','dwdw');
INSERT INTO media VALUES(47,'images/1778823066_ZUaxoBOyjjLaIYiXaueIRpWxHMbveBJieM52ZbIwaw9-cs_AmaeIhmcRv9Q2qWbjhB_-gAaMAtuSUxu7qB5vlHd7.jpg','image/jpeg','1');
INSERT INTO media VALUES(48,'images/1778823145_PeMYAV5ZnZ-ovb_o6PPVFgN2wtqFtczjXj2M0b21rY0Bjhi1XhShuxqsEv8erZKEUsrAYXIUNl6QpAhYQYwATLSB.jpg','image/jpeg','17');
INSERT INTO media VALUES(49,'news/1778823221_Cm3vnI_pz7S3YGoISNILpkgZLgOXlh6YURnLOWq5lFLGN_BLGI5_jXiu7drymiiAVW6D1qCF3qQeQSSkDfc2xvdV.jpg','image/jpeg','🌟 Спасибо, что вы с нами!');
INSERT INTO media VALUES(50,'news/1778823280_dtvJsNYx5RJ_obwpbYrHzPI0sDnV42FZb8r1rD-knL748hLd4r6Iyx_jy9MVgwYYd8Fu71wkn8pm8tP-NXDwuD5q.jpg','image/jpeg','Информация по Rossler Riviera Turbo (III)');
INSERT INTO media VALUES(51,'news/1778823333_Uc6sBd1h5-gtelFCG-mXGDgIfqApF9EAA-K_bhNPC4aiaTFz2qs5dIwKvNWUOHjMF7MmNz1OAL3oQTEVx65qVClU.jpg','image/jpeg','Начинаем обратный отсчёт...');
INSERT INTO media VALUES(52,'news/1778823361_6YYRMMsb2R7PRe131EkLkicAeBAydO8Y93PLn80tXjMmGQsUEPaNZU1o2GPu13hg6SpP8klxj6yE4l_a8N7K-Dv4.jpg','image/jpeg','⚡Новые предложения уникальных наборов на сайте Малиновки');
INSERT INTO media VALUES(53,'news/1778823403_-srBxk6G5If8PW9_21f6bGLpphuRp6WEsyA3fFeq8lARJSyEhKWfkxAnTpKefO-MXBOGXRwifMlL6KjMB2-VkYnL.jpg','image/jpeg','Обновление магазина');
INSERT INTO media VALUES(54,'news/1778823455_NnQwips5HopvawPjIfNrcoreJ6MD3R-CjKERB15B8u4hDDW7Y4De1ImXuiNY9RoDNsu0bjgT6RFuGIXkhSNC0_9F.jpg','image/jpeg','Очистка неиспользованных бустеров');
INSERT INTO media VALUES(55,'news/1778823610_B6VpEC32xYviXOBR2ghOQjuw2yR4BeBGE4Z8e06ktDfZJCNSNA6efweVSplCHtm-or1yDJTLWB2-cO2VcIm0GQkm.jpg','image/jpeg','Новая машина серии "Malini"?');
INSERT INTO media VALUES(56,'news/1778823662_Vlswn1DWb9RQxcQ3Js99h9JbJa8EFW7iNqeJg0KQPFsfsgxWznGkoYsLNAD2Jh2PlBU6xvJMHcHUCiFnzsR-8DIX.jpg','image/jpeg','Новая деталь списка');
INSERT INTO media VALUES(57,'news/1778823702_BncxY7HbItQB2m4tGIPEyOvrc7Opv-NUNGncw-xovOpQbPbiMtWp_N_RHpqIkInTOiTKfM-2l3fzfSlBp4oO7uHv.jpg','image/jpeg','Предположения по новой машине');
INSERT INTO media VALUES(58,'news/1778823882_43zed9pEVHLjHuI_q51LNSGUZDGJXMmGQPQM6h8GNVpTr0QMg165cPAHLUtC3mJJxI3Sv00lVUyvSDpYwBmFithA.jpg','image/jpeg','Обновление для фармил');
INSERT INTO media VALUES(59,'images/1778823973_TRSD7arsKfWF772I4RIf-WB1iAibW6XA_ePXBpmZNfhkl3Ix8P0mvpslJ-s74sRNXxFDTUH3Y_N_NF7l15d3KN_X.jpg','image/jpeg','16');
INSERT INTO media VALUES(60,'news/1778824038_kKu9pUNYNSqUKrUzsCRdAlZsw_yQfeuU12C1z40fs6z65Cx0f63EQzrZBDpWvLievRh4wrK8AXvbE9oSKzsxRefG.jpg','image/jpeg','Сколько можно получить на новой работе?');
CREATE TABLE subscription (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    status TEXT
);
INSERT INTO subscription VALUES(1,'Активна');
INSERT INTO subscription VALUES(2,'Не активна');
CREATE TABLE posts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    text TEXT,
    media_id INTEGER,
    post_type TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP, "is_paid" tinyint(1) not null default '0', "server" varchar, "sort_order" integer not null default '0',
    FOREIGN KEY (media_id) REFERENCES media(id) ON DELETE SET NULL
);
INSERT INTO posts VALUES(4,'Динамика капиталов | MVP Spartak_Andeground',unistr('ANATOLY_CAT — ВСЁ! С выходом новой редакции от 27.11.2025 мы запускаем небольшую аналитику и определяем MVP редакции — того игрока, который больше всех постарался и поднялся в рейтинге.\u000d\u000a\u000d\u000aВажно: В расчетах приростов и убытков новые игроки не участвуют, так как их имущество до редакции неизвестно и точного вывода сделать невозможно.\u000d\u000a\u000d\u000a1. Основные изменения\u000d\u000aНа третьем сервере с ходу ворвались в элиту Natasha_Flame (1-е место), Lana_Flatline (3-е) и Oleg_Sokolovsky (5-е). На четвертом сервере к пятёрке лучших присоединились: Viktor_Mavrodi (2-е), Safonov_Oplati (3-е), Safonow_Oplati (4-е) и Bad_Corrado (5-е). На втором сервере новый лидер — Houston_Braun.\u000d\u000a\u000d\u000aЛидеры и падения:\u000d\u000a\u000d\u000aSpartak_Andeground не просто сохранил первое место на Четвертом сервере, а увеличил отрыв до космических масштабов, прибавив к состоянию +361.52 млн P. Также Спартаку удалось обойти Anatoly_Cat (1 сервер) в общем зачёте. На данный момент Спартак — самый богатый игрок Малиновки.\u000d\u000a\u000d\u000aArtemka_Qupin — несмотря на полную смену обстановки, он не только удержал вторую позицию, но и более чем удвоил свой капитал, прибавив ~40млн.\u000d\u000a\u000d\u000aEmma_Emeralds, напротив, демонстрирует парадокс: несмотря на рост состояния на ~63млн, она потеряла первую позицию на Третьем сервере, опустившись на 2-е место. Это доказывает, что рост капитала не всегда гарантирует удержание позиции.\u000d\u000a\u000d\u000a2. Динамика по семьям\u000d\u000a«Emeralds»: Семья понесла самые серьезные потери. Из 7 представителей в топе осталось лишь трое. Emma_Emeralds и Killian_Emeralds показали рост, но John_Emeralds, Feechka_Emeralds и Katesha_Emeralds покинули рейтинг. Katana_Emeralds сменил фаму.\u000d\u000a\u000d\u000a«Andeground»: Семья усилила свои позиции, но не количеством, а качеством. Spartak_Andeground установил абсолютный рекорд по приросту капитала. Однако семья понесла потери — Sponsor_Andeground и Winston_Andeground покинули рейтинг.\u000d\u000a\u000d\u000a«Iskander»: Из могущественной семьи в списке остался лишь один представитель — Mark_Iskander, который, несмотря на рост капитала, опустился на две позиции. Elka_Iskander покинул список, а Max_Iskander сменил никнейм.'),6,'news','2026-04-13 16:57:27',0,NULL,0);
INSERT INTO posts VALUES(5,'Спроси у «Фокуса» | Продление сбора вопросов до 15 апреля',unistr('# Спросу у «ФокусаАААААА\u000d\u000a\u000d\u000a**Dimas_Lean**\u000d\u000aProfessor_Crew\u000d\u000a\u000d\u000a**Nikki_Crew**\u000d\u000aDonya_Hoodthugger\u000d\u000a\u000d\u000a**Forbes_Malinovka**\u000d\u000aShakug_Kugshovich\u000d\u000a\u000d\u000a**Casper_Corrado**\u000d\u000aZ1dipex\u000d\u000a\u000d\u000a---\u000d\u000a\u000d\u000aМы продлеваем сбор вопросов для рубрики «Спроси у «Фокуса» до 15 апреля и заодно напоминаем, что форма всё ещё открыта.\u000d\u000a\u000d\u000aЕсли вы хотели спросить что‑то у наших редакторов, аналитиков или основателей, но забыли или не успели — теперь у вас есть ещё немного времени 😉\u000d\u000a\u000d\u000aПереходите по ссылке, выбирайте адресата и задавайте свой вопрос: forms.gle/AcdFuJH5XP...\u000d\u000a\u000d\u000aЛучшие вопросы попадут в спецвыпуск.\u000d\u000a\u000d\u000a---\u000d\u000a\u000d\u000aЗадай бонус в гобуме по ссылке'),41,'news','2026-04-13 17:27:27',1,NULL,0);
INSERT INTO posts VALUES(29,'dq','das',NULL,'news','2026-04-19 16:03:33',0,NULL,0);
INSERT INTO posts VALUES(30,'dwsa','dwas',NULL,'news','2026-04-19 16:03:37',0,NULL,0);
INSERT INTO posts VALUES(31,'dwas','dwsa',NULL,'news','2026-04-19 16:03:42',1,NULL,0);
INSERT INTO posts VALUES(32,'dwdw','wdwddd',46,'news','2026-04-19 16:03:53',1,NULL,0);
INSERT INTO posts VALUES(33,'1',NULL,47,'editorial','2026-05-15 05:31:06',0,'02',0);
INSERT INTO posts VALUES(34,'17',NULL,48,'editorial','2026-05-15 05:32:25',0,'01',1);
INSERT INTO posts VALUES(35,'🌟 Спасибо, что вы с нами!',unistr('Каждое ваше сердечко, комментарий и репост — это не просто активность, а настоящая поддержка и вдохновение для нашего сообщества!\u000d\u000aБлагодаря вам наше сообщество растёт, становится дружнее и интереснее.\u000d\u000a\u000d\u000aМы ценим каждого из вас и всегда рады вашим идеям и предложениям.\u000d\u000a\u000d\u000aОставайтесь на связи, впереди много интересного! ❤'),49,'news','2026-05-15 05:33:41',0,NULL,0);
INSERT INTO posts VALUES(36,'Информация по Rossler Riviera Turbo (III)',unistr('Rossler Riviera Turbo (III) из центра «БАГ» продолжают появляться на дорогах Нижегородской области! 🚙\u000d\u000a\u000d\u000aПрямо сейчас на Первом сервере им торгует живая легенда Pauk_Freak.'),50,'news','2026-05-15 05:34:40',0,NULL,0);
INSERT INTO posts VALUES(37,'Начинаем обратный отсчёт...',unistr('Паков на 01 сервере осталось совсем чуть чуть 🤏 едва хватит до вечера.\u000d\u000a\u000d\u000aВаши предположения,что добавят в замен? Или пополнят старые паки? 🤔\u000d\u000a\u000d\u000aПиши свои идеи в комментариях 👇'),51,'news','2026-05-15 05:35:33',0,NULL,0);
INSERT INTO posts VALUES(38,'⚡Новые предложения уникальных наборов на сайте Малиновки','⚡Новые предложения уникальных наборов на сайте Малиновки',52,'news','2026-05-15 05:36:01',0,NULL,0);
INSERT INTO posts VALUES(39,'Обновление магазина',unistr('Сегодня в магазине 24/7 произошли небольшие изменения в интерьере: вывеску «Табачные изделия» заменили на «Спортивное питание» 🏋️‍♂️\u000d\u000a\u000d\u000aБлагодарим за предоставленную информацию Makar_Solist.'),53,'news','2026-05-15 05:36:43',0,NULL,0);
INSERT INTO posts VALUES(40,'Очистка неиспользованных бустеров','Все бустеры, не активированные до 1 июня, будут удалены. Пока есть время, выгружайте их в инвентарь',54,'news','2026-05-15 05:37:27',0,NULL,0);
INSERT INTO posts VALUES(41,'Новая машина серии "Malini"?',unistr('На днях вышла очередная машина из серии "Malini", а через несколько дней добавят ещё одну🔥\u000d\u000a\u000d\u000aПодготовили для Вас список всех машин из этой коллекции.\u000d\u000a1. Porsche 911 R — добавлен на 3-летие игры в 2022 году;\u000d\u000a2. Mercedes-Benz Malpool — первая гоночная фура в игре, добавлена на 4-летие игры в 2023 году;\u000d\u000a3. Audi Sport Quattro S1 — добавлена вместе с коробкой "Случайный VAG" 1 апреля 2024 года;\u000d\u000a4. LADA Revolution (RS2) — добавлена вместе с коробкой "Случайный набор киберпанка" 1 октября 2024 года;\u000d\u000a5. Volvo Crimson Knight — добавлена вместе с коробкой "Случайный набор Скандинавии" 8 февраля 2026 года;\u000d\u000a6. BMW M1 Malini Sport — выдан за 10-й день "Календаря подарков" в честь 7-летия игры 3 марта 2026 года;\u000d\u000a7. DeLorean DMC-12 — будет разыгран 7 марта 2026 года в ограниченном тираже в честь 7-летия игры.\u000d\u000a\u000d\u000aЧто ждём на 8-летие игры? 😁'),55,'news','2026-05-15 05:40:10',0,NULL,0);
INSERT INTO posts VALUES(42,'Новая деталь списка',unistr('🔥 Мы впервые вводим фиксированную стоимость на автомобиль за счёт дополнительного атрибута, а именно — покраски.\u000d\u000a\u000d\u000aРечь про легендарную SAAB 92HK в покраске «Скуби-Ду».\u000d\u000a\u000d\u000aПочему мы решили её выделить? Потому что это уже не просто машина, а полноценный коллекционный актив: с уникальной покраской, шансом выпадения равному 1% и ценой на рынке, которая живёт своей собственной жизнью, далёкой от базовой SAAB.\u000d\u000a\u000d\u000a🎨 Теперь в Forbes автодом в этой покраске будет учитываться по фиксированной стоимости, а не по базовой цене обычной модели.'),56,'news','2026-05-15 05:41:02',0,NULL,0);
INSERT INTO posts VALUES(43,'Предположения по новой машине',unistr('Предположительно, DeLorean из «Назад в Будущее» станет главным призом в «Календаре подарков» . Уже известны характеристики машины:\u000d\u000a\u000d\u000aТип двигателя: бензиновый\u000d\u000aТип топлива: АИ-92\u000d\u000aРасход топлива: 26.0 л/ч\u000d\u000aВместимость бака: 60.0 л.\u000d\u000aМакс. скорость: 136км/ч\u000d\u000aРазгон до 100км/ч: 6.0 сек.\u000d\u000aРазгон до 136км/ч: 9.0 сек.\u000d\u000aВместимость багажника: 12 слотов\u000d\u000aОсобенности: дрифт-режим.\u000d\u000a\u000d\u000aИгроки интересуются, почему ДеЛореан не умеет летать. А как Вам такой подарок? 😉'),57,'news','2026-05-15 05:41:42',0,NULL,0);
INSERT INTO posts VALUES(44,'Обновление для фармил',unistr('Ура! 👏 Теперь будем успевать!!\u000d\u000a\u000d\u000aНа работе развозчика и дальнобойщика увеличили время выхода из транспорта на 3 минуты (До этого оно составляло 90сек).\u000d\u000aТеперь будем успевать цеплять груз который улетел? 😜\u000d\u000a\u000d\u000aСпасибо за информацию: Pink_Moriarti'),58,'news','2026-05-15 05:44:42',0,NULL,0);
INSERT INTO posts VALUES(45,'16',NULL,59,'editorial','2026-05-15 05:46:13',0,'01',2);
INSERT INTO posts VALUES(46,'Сколько можно получить на новой работе?',unistr('Сколько можно заработать на работе почтальона в Малиновке?\u000d\u000a\u000d\u000aМы решили проверить, сколько реально можно заработать на новой работе Почтальона в Малиновке и сколько времени потребуется, чтобы подняться на следующий уровень.\u000d\u000a\u000d\u000aЧтобы перейти с первого на второй уровень, нужно выполнить 75 заказов.\u000d\u000aРаботу мы начали в 21:51, а 75-й заказ был доставлен уже через час и одну минуту — в 22:52.\u000d\u000a\u000d\u000a✅ Итог: переход с первого на второй уровень занимает примерно 1 час.\u000d\u000a\u000d\u000aДальше требования растут:\u000d\u000a• для третьего уровня — 150 заказов,\u000d\u000a• для четвёртого — примерно 300 заказов,\u000d\u000a• а чтобы дойти до десятого уровня, придётся выполнить около 19 200 заказов (если сохраняется та же логика удвоения).\u000d\u000a\u000d\u000a💰 Что по деньгам:\u000d\u000aЗа все выполненные заказы мы получили всего 6 756 рублей. (и все эти деньги были благополучно отданы как чаевые таксисту, чтоб добраться с Батырево до Южного и завершить работу😜)\u000d\u000aСредняя оплата одного заказа составила около 89 рублей.'),60,'news','2026-05-15 05:47:18',0,NULL,0);
PRAGMA writable_schema=ON;
CREATE TABLE IF NOT EXISTS sqlite_sequence(name,seq);
DELETE FROM sqlite_sequence;
INSERT INTO sqlite_sequence VALUES('migrations',7);
INSERT INTO sqlite_sequence VALUES('users',4);
INSERT INTO sqlite_sequence VALUES('media',60);
INSERT INTO sqlite_sequence VALUES('posts',46);
INSERT INTO sqlite_sequence VALUES('subscription',2);
CREATE TRIGGER trg_check_subscription_expiry
AFTER UPDATE ON users
BEGIN
    UPDATE subscription
    SET status = 'Не активна'
    WHERE id = NEW.id_subscription
      AND status = 'Активна'
      AND (
          SELECT julianday('now') - julianday(NEW.updated_at) > 30
      );
END;
CREATE UNIQUE INDEX "users_email_unique" on "users" ("email");
CREATE INDEX "sessions_user_id_index" on "sessions" ("user_id");
CREATE INDEX "sessions_last_activity_index" on "sessions" ("last_activity");
CREATE INDEX "cache_expiration_index" on "cache" ("expiration");
CREATE INDEX "cache_locks_expiration_index" on "cache_locks" ("expiration");
CREATE INDEX "jobs_queue_index" on "jobs" ("queue");
CREATE UNIQUE INDEX "failed_jobs_uuid_unique" on "failed_jobs" ("uuid");
PRAGMA writable_schema=OFF;
COMMIT;

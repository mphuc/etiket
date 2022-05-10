<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-02-24 09:46:43 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 09:46:43 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 09:47:33 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-24 09:47:33 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:47:33 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:47:33 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:47:33 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:47:33 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:47:33 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:47:33 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:47:33 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:47:33 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:47:33 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:47:33 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:47:33 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:47:33 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\system\core\Common.php 570
ERROR - 2022-02-24 09:47:33 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\application\helpers\my_helper.php 157
ERROR - 2022-02-24 09:47:47 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 09:47:47 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 09:47:47 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 09:47:47 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 09:47:47 --> Could not find the language line "user_avatar"
ERROR - 2022-02-24 09:47:47 --> Could not find the language line "user_display_name"
ERROR - 2022-02-24 09:47:47 --> Could not find the language line "user_email"
ERROR - 2022-02-24 09:47:47 --> Could not find the language line "user_last_login"
ERROR - 2022-02-24 09:47:47 --> Could not find the language line "user_active"
ERROR - 2022-02-24 09:48:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 09:48:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 09:48:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 09:48:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 09:48:00 --> Could not find the language line "user_avatar"
ERROR - 2022-02-24 09:48:00 --> Could not find the language line "user_display_name"
ERROR - 2022-02-24 09:48:00 --> Could not find the language line "user_email"
ERROR - 2022-02-24 09:48:00 --> Could not find the language line "user_last_login"
ERROR - 2022-02-24 09:48:00 --> Could not find the language line "user_active"
ERROR - 2022-02-24 08:48:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:48:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:48:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:48:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:48:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:48:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:48:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:48:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:48:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:48:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:48:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:48:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 09:49:01 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 09:49:01 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 09:49:01 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 09:49:01 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 09:49:01 --> Could not find the language line "user_avatar"
ERROR - 2022-02-24 09:49:01 --> Could not find the language line "user_display_name"
ERROR - 2022-02-24 09:49:01 --> Could not find the language line "user_email"
ERROR - 2022-02-24 09:49:01 --> Could not find the language line "user_last_login"
ERROR - 2022-02-24 09:49:01 --> Could not find the language line "user_active"
ERROR - 2022-02-24 09:49:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 09:49:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 09:49:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 09:49:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 09:49:48 --> Could not find the language line "user_avatar"
ERROR - 2022-02-24 09:49:48 --> Could not find the language line "user_display_name"
ERROR - 2022-02-24 09:49:48 --> Could not find the language line "user_email"
ERROR - 2022-02-24 09:49:48 --> Could not find the language line "user_last_login"
ERROR - 2022-02-24 09:49:48 --> Could not find the language line "user_active"
ERROR - 2022-02-24 09:49:50 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 09:49:50 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 09:49:50 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 09:49:50 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 09:49:50 --> Could not find the language line "user_avatar"
ERROR - 2022-02-24 09:49:50 --> Could not find the language line "user_display_name"
ERROR - 2022-02-24 09:49:50 --> Could not find the language line "user_email"
ERROR - 2022-02-24 09:49:50 --> Could not find the language line "user_last_login"
ERROR - 2022-02-24 09:49:50 --> Could not find the language line "user_active"
ERROR - 2022-02-24 08:50:22 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:50:22 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:50:22 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:50:22 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:50:23 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:50:23 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:50:23 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:50:23 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:50:23 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:50:23 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:50:23 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:50:23 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:51:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:51:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:51:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:51:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:51:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:51:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:51:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:51:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:51:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:51:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:51:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:51:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:51:26 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:51:26 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:51:26 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:51:26 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:51:26 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:51:26 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:51:26 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:51:26 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:51:26 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:51:26 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:51:26 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:51:26 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:51:39 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:51:39 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:51:39 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:51:39 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:52:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:52:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:52:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:52:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:52:45 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:52:45 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:52:45 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:52:45 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:52:45 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:52:45 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:52:45 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:52:45 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:52:55 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:52:55 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:52:55 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:52:55 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:52:56 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:52:56 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:52:56 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:52:56 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:52:56 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:52:56 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:52:56 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:52:56 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 09:53:17 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 09:53:17 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 09:53:17 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 09:53:17 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 09:53:17 --> Could not find the language line "user_avatar"
ERROR - 2022-02-24 09:53:17 --> Could not find the language line "user_display_name"
ERROR - 2022-02-24 09:53:17 --> Could not find the language line "user_email"
ERROR - 2022-02-24 09:53:17 --> Could not find the language line "user_last_login"
ERROR - 2022-02-24 09:53:17 --> Could not find the language line "user_active"
ERROR - 2022-02-24 09:53:34 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-24 09:53:34 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:34 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:34 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:34 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:34 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:34 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:34 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:34 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:34 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:34 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:34 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:34 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:34 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\system\core\Common.php 570
ERROR - 2022-02-24 09:53:34 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\application\helpers\my_helper.php 157
ERROR - 2022-02-24 09:53:44 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:44 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:44 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:44 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:44 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:44 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:44 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:44 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:44 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:44 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:44 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:44 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:44 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\system\core\Common.php 570
ERROR - 2022-02-24 09:53:44 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\application\helpers\my_helper.php 157
ERROR - 2022-02-24 09:53:44 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-24 09:53:58 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:58 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:58 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:58 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:58 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:58 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:58 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:58 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:58 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:58 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:58 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:58 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:53:58 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\system\core\Common.php 570
ERROR - 2022-02-24 09:53:58 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\application\helpers\my_helper.php 157
ERROR - 2022-02-24 09:53:59 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-24 09:54:00 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:00 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:00 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:00 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:00 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:00 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:00 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:00 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:00 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:00 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:00 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:00 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:00 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\system\core\Common.php 570
ERROR - 2022-02-24 09:54:00 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\application\helpers\my_helper.php 157
ERROR - 2022-02-24 09:54:00 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-24 09:54:01 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:01 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:01 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:01 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:01 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:01 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:01 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:01 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:01 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:01 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:01 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:01 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 09:54:01 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\system\core\Common.php 570
ERROR - 2022-02-24 09:54:01 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\application\helpers\my_helper.php 157
ERROR - 2022-02-24 09:54:01 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-24 08:54:13 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:54:13 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:54:13 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:54:13 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:54:13 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:54:13 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:54:13 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:54:13 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:54:13 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:54:13 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:54:13 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:54:13 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:54:23 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:54:23 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:54:23 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:54:23 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:54:24 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:54:24 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:54:24 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:54:24 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:54:24 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:54:24 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:54:24 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:54:24 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:54:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:54:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:54:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:54:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:54:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:54:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:54:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:54:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:54:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:54:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:54:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:54:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:54:36 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:54:36 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:54:36 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:54:36 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:54:37 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:54:37 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:54:37 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:54:37 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:54:37 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:54:37 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:54:37 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:54:37 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:54:40 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:54:40 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:54:40 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:54:40 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:54:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:54:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:54:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:54:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:54:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:54:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:54:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:54:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:54:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:54:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:54:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:54:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:54:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:54:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:54:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:54:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:54:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:54:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:54:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:54:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:54:54 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:54:54 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:54:54 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:54:54 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:54:54 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:54:54 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:54:54 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:54:54 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:54:54 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:54:54 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:54:54 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:54:54 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:55:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:55:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:55:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:55:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:55:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:55:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:55:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:55:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:55:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:55:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:55:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:55:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:55:33 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:55:33 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:55:33 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:55:33 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:55:33 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:55:33 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:55:33 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:55:33 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:55:33 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:55:33 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:55:33 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:55:33 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:55:34 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:55:34 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:55:34 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:55:34 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:55:35 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:55:35 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:55:35 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:55:35 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:55:35 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:55:35 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:55:35 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:55:35 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 09:55:40 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 09:55:40 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 08:56:01 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:56:01 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:56:01 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:56:01 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:56:01 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:56:01 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:56:01 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:56:01 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:56:01 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:56:01 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:56:01 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:56:01 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:56:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:56:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:56:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:56:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:56:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:56:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:56:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:56:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:56:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:56:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:56:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:56:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:56:21 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:56:21 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:56:21 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:56:21 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:56:22 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:56:22 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:56:22 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:56:22 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:56:22 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:56:22 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:56:22 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:56:22 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:57:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:57:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:57:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:57:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:57:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:57:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:57:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:57:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:57:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:57:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:57:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:57:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:57:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:57:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:57:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:57:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:57:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:57:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:57:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:57:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:57:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:57:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:57:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:57:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:57:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:57:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:57:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:57:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:57:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:57:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:57:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:57:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:57:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:57:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:57:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:57:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:57:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:57:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:57:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:57:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:57:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:57:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:57:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:57:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:57:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:57:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:57:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:57:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:58:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:58:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:58:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:58:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:58:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:58:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:58:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:58:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:58:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:58:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:58:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:58:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:58:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:58:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:58:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:58:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:58:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:58:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:58:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:58:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:58:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:58:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:58:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:58:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:58:29 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:58:29 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:58:29 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:58:29 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:58:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:58:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:58:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:58:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:58:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:58:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:58:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:58:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:58:31 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:58:31 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:58:31 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:58:31 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:58:31 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:58:31 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:58:31 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:58:31 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:58:31 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:58:31 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:58:31 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:58:31 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:58:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:58:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:58:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:58:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:58:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:58:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:58:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:58:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:58:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:58:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:58:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:58:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 09:58:44 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 09:58:44 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 08:58:57 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:58:57 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:58:57 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:58:57 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:58:57 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:58:57 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:58:57 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:58:57 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:58:57 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:58:57 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:58:57 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:58:57 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:59:09 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:59:09 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:59:09 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:59:09 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:59:09 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:59:09 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:59:09 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:59:09 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 08:59:09 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 08:59:09 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 08:59:09 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 08:59:09 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 09:59:11 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 09:59:11 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 09:59:13 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 09:59:13 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 09:00:16 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 09:00:16 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 09:00:16 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 09:00:16 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 09:00:16 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 09:00:16 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 09:00:16 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 09:00:16 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 09:00:16 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 09:00:16 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 09:00:16 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 09:00:16 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 09:00:21 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 09:00:21 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 09:00:21 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 09:00:21 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 09:00:52 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 09:00:52 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 09:00:52 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 09:00:52 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 09:00:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 09:00:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 09:00:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 09:00:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 09:00:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 09:00:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 09:00:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 09:00:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 10:32:45 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-24 10:32:45 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:32:45 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:32:45 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:32:45 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:32:45 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:32:45 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:32:45 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:32:45 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:32:45 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:32:45 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:32:45 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:32:45 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:32:45 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\system\core\Common.php 570
ERROR - 2022-02-24 10:32:45 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\application\helpers\my_helper.php 157
ERROR - 2022-02-24 09:35:36 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 09:35:36 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 09:35:36 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 09:35:36 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 09:35:37 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 09:35:37 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 09:35:37 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 09:35:37 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 09:35:37 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 09:35:37 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 09:35:37 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 09:35:37 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 10:35:59 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:35:59 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:35:59 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:35:59 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:35:59 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:35:59 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:35:59 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:35:59 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:35:59 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:35:59 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:35:59 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:35:59 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 10:35:59 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\system\core\Common.php 570
ERROR - 2022-02-24 10:35:59 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\application\helpers\my_helper.php 157
ERROR - 2022-02-24 10:35:59 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-24 10:38:27 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 10:38:27 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 10:38:27 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 10:38:27 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 10:38:27 --> Could not find the language line "user_avatar"
ERROR - 2022-02-24 10:38:27 --> Could not find the language line "user_display_name"
ERROR - 2022-02-24 10:38:27 --> Could not find the language line "user_email"
ERROR - 2022-02-24 10:38:27 --> Could not find the language line "user_last_login"
ERROR - 2022-02-24 10:38:27 --> Could not find the language line "user_active"
ERROR - 2022-02-24 10:38:45 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 10:38:45 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 10:38:45 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 10:38:45 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 10:38:45 --> Could not find the language line "user_avatar"
ERROR - 2022-02-24 10:38:45 --> Could not find the language line "user_display_name"
ERROR - 2022-02-24 10:38:45 --> Could not find the language line "user_email"
ERROR - 2022-02-24 10:38:45 --> Could not find the language line "user_last_login"
ERROR - 2022-02-24 10:38:45 --> Could not find the language line "user_active"
ERROR - 2022-02-24 11:12:36 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 11:12:36 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 11:12:36 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 11:12:36 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 11:12:36 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 11:12:36 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 11:12:36 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 11:12:36 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 11:12:36 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 11:12:36 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 11:12:36 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 11:12:36 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 11:12:36 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\system\core\Common.php 570
ERROR - 2022-02-24 11:12:36 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\application\helpers\my_helper.php 157
ERROR - 2022-02-24 11:12:36 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-24 11:15:31 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 11:15:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 12:26:37 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 12:26:37 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 12:26:48 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:26:48 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:26:48 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:26:48 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:26:48 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:26:48 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:26:48 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:26:48 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:26:48 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:26:48 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:26:48 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:26:48 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:26:48 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\system\core\Common.php 570
ERROR - 2022-02-24 12:26:48 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\application\helpers\my_helper.php 157
ERROR - 2022-02-24 12:26:48 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-24 11:27:24 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 11:27:24 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 11:27:24 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 11:27:24 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 11:27:24 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 11:27:24 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 11:27:24 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 11:27:24 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 11:27:24 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 11:27:24 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 11:27:24 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 11:27:24 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:27:32 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:27:32 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:27:32 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:27:32 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:27:32 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:27:32 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:27:32 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:27:32 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:27:32 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:27:32 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:27:32 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:27:32 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 12:27:32 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\system\core\Common.php 570
ERROR - 2022-02-24 12:27:32 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\application\helpers\my_helper.php 157
ERROR - 2022-02-24 12:27:32 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-24 12:28:20 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 12:28:20 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 12:33:00 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 12:33:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 13:39:23 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 13:39:23 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 13:39:50 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:50 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:50 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:50 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:50 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:50 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:50 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:50 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:50 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:50 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:50 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:50 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:50 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\system\core\Common.php 570
ERROR - 2022-02-24 13:39:50 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\application\helpers\my_helper.php 157
ERROR - 2022-02-24 13:39:50 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-24 13:39:58 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-24 13:39:58 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:58 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:58 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:58 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:58 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:58 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:58 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:58 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:58 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:58 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:58 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:58 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 13:39:58 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\system\core\Common.php 570
ERROR - 2022-02-24 13:39:58 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\application\helpers\my_helper.php 157
ERROR - 2022-02-24 12:44:03 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:44:03 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:44:03 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:44:03 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:44:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:44:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:44:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:44:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:44:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:44:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:44:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:44:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 13:47:07 --> Severity: error --> Exception: syntax error, unexpected 'public' (T_PUBLIC), expecting ';' or '{' C:\laragon\www\html\application\third_party\MX\Modules.php 114
ERROR - 2022-02-24 12:47:40 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:47:40 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:47:40 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:47:40 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:47:40 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:47:40 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:47:40 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:47:40 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:47:40 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:47:40 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:47:40 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:47:40 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:49:56 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:49:56 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:49:56 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:49:56 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:49:56 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:49:56 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:49:56 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:49:56 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:49:56 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:49:56 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:49:56 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:49:56 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:49:57 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:49:57 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:49:57 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:49:57 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:49:58 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:49:58 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:49:58 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:49:58 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:49:58 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:49:58 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:49:58 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:49:58 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:51:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:51:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:51:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:51:25 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:51:26 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:51:26 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:51:26 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:51:26 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:51:26 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:51:26 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:51:26 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:51:26 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:51:27 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:51:27 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:51:27 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:51:27 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:51:27 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:51:27 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:51:27 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:51:27 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:51:27 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:51:27 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:51:27 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:51:27 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:51:28 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:51:28 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:51:28 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:51:28 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:51:28 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:51:28 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:51:28 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:51:28 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:51:28 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:51:28 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:51:28 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:51:28 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:51:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:51:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:51:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:51:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:51:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:51:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:51:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:51:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 12:51:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 12:51:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 12:51:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 12:51:44 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 14:12:18 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 14:12:18 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 14:13:31 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 14:13:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 13:13:36 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 13:13:36 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 13:13:36 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 13:13:36 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 13:13:36 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 13:13:36 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 13:13:36 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 13:13:36 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 13:13:36 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 13:13:36 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 13:13:36 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 13:13:36 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 14:14:49 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 14:14:49 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 14:14:49 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 14:14:49 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 14:14:49 --> Could not find the language line "user_avatar"
ERROR - 2022-02-24 14:14:49 --> Could not find the language line "user_display_name"
ERROR - 2022-02-24 14:14:49 --> Could not find the language line "user_email"
ERROR - 2022-02-24 14:14:49 --> Could not find the language line "user_last_login"
ERROR - 2022-02-24 14:14:49 --> Could not find the language line "user_active"
ERROR - 2022-02-24 16:08:58 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 16:08:58 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 16:09:03 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 16:09:03 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 16:09:03 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 16:09:03 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 16:09:03 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 16:09:03 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 16:09:03 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 16:09:03 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 16:09:03 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 16:09:03 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 16:09:03 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 16:09:03 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 16:09:03 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\system\core\Common.php 570
ERROR - 2022-02-24 16:09:03 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\application\helpers\my_helper.php 157
ERROR - 2022-02-24 16:09:03 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-24 15:09:06 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:09:06 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:09:06 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:09:06 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 16:09:06 --> Severity: Error --> Out of memory (allocated 2097152) (tried to allocate 163840 bytes) C:\laragon\www\html\system\core\Security.php 1054
ERROR - 2022-02-24 15:09:06 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:09:06 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:09:06 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:09:06 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 15:09:06 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:09:06 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:09:06 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:09:06 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 15:10:46 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:10:46 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:10:46 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:10:46 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 15:10:47 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:10:47 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:10:47 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:10:47 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 15:10:47 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:10:47 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:10:47 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:10:47 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 15:10:47 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:10:47 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:10:47 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:10:47 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 15:10:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:10:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:10:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:10:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 15:10:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:10:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:10:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:10:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 15:10:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:10:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:10:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:10:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 15:10:49 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:10:49 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:10:49 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:10:49 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 15:10:49 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:10:49 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:10:49 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:10:49 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 15:10:50 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:10:50 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:10:50 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:10:50 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 15:10:51 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:10:51 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:10:51 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:10:51 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 15:10:51 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:10:51 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:10:51 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:10:51 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 15:11:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:11:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:11:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:11:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 15:11:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:11:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:11:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:11:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 15:11:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:11:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:11:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:11:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 15:12:14 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:12:14 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:12:14 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:12:14 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 15:12:14 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:12:14 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:12:14 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:12:14 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 15:12:14 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:12:14 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:12:14 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:12:14 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 15:17:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:17:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:17:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:17:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 15:17:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:17:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:17:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:17:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 15:17:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 15:17:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 15:17:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 15:17:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 16:18:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 16:18:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 16:18:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 16:18:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 16:18:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 16:18:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 16:18:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 16:18:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 16:18:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 16:18:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 16:18:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 16:18:38 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 20:25:52 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 20:25:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 20:26:06 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:26:06 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:26:06 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:26:06 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:26:06 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:26:06 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:26:06 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:26:06 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:26:06 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:26:06 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:26:06 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:26:06 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:26:06 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\system\core\Common.php 570
ERROR - 2022-02-24 20:26:06 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\application\helpers\my_helper.php 157
ERROR - 2022-02-24 20:26:06 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-24 19:26:12 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 19:26:12 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 19:26:12 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 19:26:12 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 19:26:12 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 19:26:12 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 19:26:12 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 19:26:12 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 19:26:12 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 19:26:12 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 19:26:12 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 19:26:12 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 19:26:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 19:26:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 19:26:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 19:26:30 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 19:26:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 19:26:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 19:26:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 19:26:41 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 19:26:43 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 19:26:43 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 19:26:43 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 19:26:43 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 19:26:43 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 19:26:43 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 19:26:43 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 19:26:43 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 19:26:43 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 19:26:43 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 19:26:43 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 19:26:43 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 19:27:08 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 20:27:14 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:27:14 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:27:14 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:27:14 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:27:14 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:27:14 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:27:14 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:27:14 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:27:14 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:27:14 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:27:14 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:27:14 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 20:27:14 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\system\core\Common.php 570
ERROR - 2022-02-24 20:27:14 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\application\helpers\my_helper.php 157
ERROR - 2022-02-24 20:27:14 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-24 19:28:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 19:28:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 19:28:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 19:28:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 19:28:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 19:28:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 19:28:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 19:28:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 19:28:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 19:28:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 19:28:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 19:28:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 20:52:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 20:52:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 20:52:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 20:52:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 20:52:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 20:52:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 20:52:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 20:52:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 20:52:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2707
ERROR - 2022-02-24 20:52:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2713
ERROR - 2022-02-24 20:52:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2750
ERROR - 2022-02-24 20:52:48 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\laragon\www\html\application\libraries\Grocery_CRUD.php 2756
ERROR - 2022-02-24 21:53:37 --> Could not find the language line "user_avatar"
ERROR - 2022-02-24 21:53:37 --> Could not find the language line "user_display_name"
ERROR - 2022-02-24 21:53:37 --> Could not find the language line "user_email"
ERROR - 2022-02-24 21:53:37 --> Could not find the language line "user_last_login"
ERROR - 2022-02-24 21:53:37 --> Could not find the language line "user_active"
ERROR - 2022-02-24 21:54:45 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-24 21:54:45 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 21:54:45 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 21:54:45 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 21:54:45 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 21:54:45 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 21:54:45 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 21:54:45 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 21:54:45 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 21:54:45 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 21:54:45 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 21:54:45 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 21:54:45 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 21:54:45 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\system\core\Common.php 570
ERROR - 2022-02-24 21:54:45 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\application\helpers\my_helper.php 157
ERROR - 2022-02-24 21:54:51 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 21:54:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 22:13:08 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 22:13:08 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 22:13:08 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 22:13:08 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 22:13:08 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 22:13:08 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 22:13:08 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 22:13:08 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 22:13:08 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 22:13:08 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 22:13:08 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 22:13:08 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-24 22:13:08 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\system\core\Common.php 570
ERROR - 2022-02-24 22:13:08 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\application\helpers\my_helper.php 157
ERROR - 2022-02-24 22:13:08 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-24 22:13:13 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 22:13:13 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 22:16:24 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 22:16:24 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 22:16:25 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 22:16:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 22:24:49 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 22:24:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 22:25:51 --> Severity: Warning --> fsockopen(): SSL: Handshake timed out C:\laragon\www\html\system\libraries\Email.php 2069
ERROR - 2022-02-24 22:25:51 --> Severity: Warning --> fsockopen(): Failed to enable crypto C:\laragon\www\html\system\libraries\Email.php 2069
ERROR - 2022-02-24 22:25:51 --> Severity: Warning --> fsockopen(): unable to connect to ssl://mail.kemdikbud.go.id:465 (Unknown error) C:\laragon\www\html\system\libraries\Email.php 2069
ERROR - 2022-02-24 22:25:51 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 22:25:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 22:28:05 --> Severity: Warning --> fsockopen(): SSL: Handshake timed out C:\laragon\www\html\system\libraries\Email.php 2069
ERROR - 2022-02-24 22:28:05 --> Severity: Warning --> fsockopen(): Failed to enable crypto C:\laragon\www\html\system\libraries\Email.php 2069
ERROR - 2022-02-24 22:28:05 --> Severity: Warning --> fsockopen(): unable to connect to ssl://mail.kemdikbud.go.id:465 (Unknown error) C:\laragon\www\html\system\libraries\Email.php 2069
ERROR - 2022-02-24 22:28:05 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 22:28:05 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 22:31:27 --> Severity: Warning --> fsockopen(): unable to connect to http://mail.kemdikbud.go.id/:465 (Unable to find the socket transport &quot;http&quot; - did you forget to enable it when you configured PHP?) C:\laragon\www\html\system\libraries\Email.php 2069
ERROR - 2022-02-24 22:31:27 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-24 22:31:27 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801

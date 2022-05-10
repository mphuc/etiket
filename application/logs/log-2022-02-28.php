<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-02-28 11:34:42 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:37:39 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:37:50 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:37:52 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:37:53 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:37:54 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:37:57 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:38:21 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:38:34 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:38:44 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:39:14 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:39:32 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:39:33 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:39:34 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:39:37 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:40:36 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:42:21 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:42:28 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:42:37 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:42:37 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:42:41 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:42:50 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:42:51 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 11:42:52 --> Severity: error --> Exception: syntax error, unexpected '$config' (T_VARIABLE) C:\laragon\www\tiket1\application\config\xendit.php 8
ERROR - 2022-02-28 12:22:49 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 12:22:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 12:23:04 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 12:23:04 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 12:23:39 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-28 12:23:39 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:23:39 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:23:39 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:23:39 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:23:39 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:23:39 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:23:39 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:23:39 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:23:39 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:23:39 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:23:39 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:23:39 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:23:39 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\online\system\core\Exceptions.php:271) C:\laragon\www\online\system\core\Common.php 570
ERROR - 2022-02-28 12:23:39 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\online\system\core\Exceptions.php:271) C:\laragon\www\online\application\helpers\my_helper.php 157
ERROR - 2022-02-28 12:23:55 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 12:23:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 12:24:31 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\laragon\www\online\vendor\guzzlehttp\guzzle\src\Handler\CurlFactory.php 67
ERROR - 2022-02-28 12:24:31 --> Severity: error --> Exception: The API key provided is invalid. Please make sure to use the secret/public API key that you can obtain from the Xendit Dashboard. See https://developers.xendit.co/api-reference/#authentication for more details C:\laragon\www\online\vendor\xendit\xendit-php\src\HttpClient\GuzzleClient.php 167
ERROR - 2022-02-28 12:24:31 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\online\system\core\Exceptions.php:271) C:\laragon\www\online\system\core\Common.php 570
ERROR - 2022-02-28 12:24:31 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 12:24:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 12:28:18 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:28:18 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:28:18 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:28:18 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:28:18 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:28:18 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:28:18 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:28:18 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:28:18 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:28:18 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:28:18 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:28:18 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 12:28:18 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\online\system\core\Exceptions.php:271) C:\laragon\www\online\system\core\Common.php 570
ERROR - 2022-02-28 12:28:18 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\online\system\core\Exceptions.php:271) C:\laragon\www\online\application\helpers\my_helper.php 157
ERROR - 2022-02-28 12:28:18 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-28 12:30:02 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 12:30:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 12:30:04 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\laragon\www\online\vendor\guzzlehttp\guzzle\src\Handler\CurlFactory.php 67
ERROR - 2022-02-28 12:30:04 --> Severity: error --> Exception: The API key provided is invalid. Please make sure to use the secret/public API key that you can obtain from the Xendit Dashboard. See https://developers.xendit.co/api-reference/#authentication for more details C:\laragon\www\online\vendor\xendit\xendit-php\src\HttpClient\GuzzleClient.php 167
ERROR - 2022-02-28 12:30:04 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\online\system\core\Exceptions.php:271) C:\laragon\www\online\system\core\Common.php 570
ERROR - 2022-02-28 12:30:04 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 12:30:04 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 12:30:17 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 12:30:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 12:30:18 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 12:30:18 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 12:46:01 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\laragon\www\online\vendor\guzzlehttp\guzzle\src\Handler\CurlFactory.php 67
ERROR - 2022-02-28 12:46:01 --> Severity: error --> Exception: The API key provided is invalid. Please make sure to use the secret/public API key that you can obtain from the Xendit Dashboard. See https://developers.xendit.co/api-reference/#authentication for more details C:\laragon\www\online\vendor\xendit\xendit-php\src\HttpClient\GuzzleClient.php 167
ERROR - 2022-02-28 12:46:01 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\online\system\core\Exceptions.php:271) C:\laragon\www\online\system\core\Common.php 570
ERROR - 2022-02-28 12:46:01 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 12:46:01 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 12:49:40 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 12:49:40 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 12:50:13 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 12:50:13 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 15:39:56 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 15:39:56 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 15:40:06 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:40:06 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:40:06 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:40:06 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:40:06 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:40:06 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:40:06 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:40:06 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:40:06 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:40:06 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:40:06 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:40:06 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:40:06 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\online\system\core\Exceptions.php:271) C:\laragon\www\online\system\core\Common.php 570
ERROR - 2022-02-28 15:40:06 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\online\system\core\Exceptions.php:271) C:\laragon\www\online\application\helpers\my_helper.php 157
ERROR - 2022-02-28 15:40:06 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-28 15:40:15 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 15:40:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 15:44:31 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\laragon\www\online\vendor\guzzlehttp\guzzle\src\Handler\CurlFactory.php 67
ERROR - 2022-02-28 15:44:31 --> Severity: error --> Exception: The API key provided is invalid. Please make sure to use the secret/public API key that you can obtain from the Xendit Dashboard. See https://developers.xendit.co/api-reference/#authentication for more details C:\laragon\www\online\vendor\xendit\xendit-php\src\HttpClient\GuzzleClient.php 167
ERROR - 2022-02-28 15:44:31 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\online\system\core\Exceptions.php:271) C:\laragon\www\online\system\core\Common.php 570
ERROR - 2022-02-28 15:44:31 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 15:44:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 15:49:08 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-28 15:49:08 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:49:08 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:49:08 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:49:08 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:49:08 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:49:08 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:49:08 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:49:08 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:49:08 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:49:08 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:49:08 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:49:08 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 15:49:08 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\online\system\core\Exceptions.php:271) C:\laragon\www\online\system\core\Common.php 570
ERROR - 2022-02-28 15:49:08 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\online\system\core\Exceptions.php:271) C:\laragon\www\online\application\helpers\my_helper.php 157
ERROR - 2022-02-28 15:49:58 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\laragon\www\online\vendor\guzzlehttp\guzzle\src\Handler\CurlFactory.php 67
ERROR - 2022-02-28 15:49:58 --> Severity: error --> Exception: The API key provided is invalid. Please make sure to use the secret/public API key that you can obtain from the Xendit Dashboard. See https://developers.xendit.co/api-reference/#authentication for more details C:\laragon\www\online\vendor\xendit\xendit-php\src\HttpClient\GuzzleClient.php 167
ERROR - 2022-02-28 15:49:58 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\online\system\core\Exceptions.php:271) C:\laragon\www\online\system\core\Common.php 570
ERROR - 2022-02-28 15:49:58 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 15:49:58 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 16:01:02 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 16:01:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 16:01:23 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 16:01:23 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 16:01:23 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 16:01:23 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 16:01:23 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 16:01:23 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 16:01:23 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 16:01:23 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 16:01:23 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 16:01:23 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 16:01:23 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 16:01:23 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\online\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-28 16:01:23 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\online\system\core\Exceptions.php:271) C:\laragon\www\online\system\core\Common.php 570
ERROR - 2022-02-28 16:01:23 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\online\system\core\Exceptions.php:271) C:\laragon\www\online\application\helpers\my_helper.php 157
ERROR - 2022-02-28 16:01:23 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-28 16:02:09 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 16:02:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 16:04:06 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\laragon\www\online\vendor\guzzlehttp\guzzle\src\Handler\CurlFactory.php 67
ERROR - 2022-02-28 16:04:06 --> Severity: error --> Exception: The API key provided is invalid. Please make sure to use the secret/public API key that you can obtain from the Xendit Dashboard. See https://developers.xendit.co/api-reference/#authentication for more details C:\laragon\www\online\vendor\xendit\xendit-php\src\HttpClient\GuzzleClient.php 167
ERROR - 2022-02-28 16:04:06 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\online\system\core\Exceptions.php:271) C:\laragon\www\online\system\core\Common.php 570
ERROR - 2022-02-28 16:04:06 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 16:04:06 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 16:07:54 --> Severity: Notice --> Undefined index: id C:\laragon\www\online\application\models\XenditModel.php 29
ERROR - 2022-02-28 16:07:54 --> Severity: Notice --> Undefined index: external_id C:\laragon\www\online\application\models\XenditModel.php 30
ERROR - 2022-02-28 16:07:54 --> Severity: Notice --> Undefined index: user_id C:\laragon\www\online\application\models\XenditModel.php 34
ERROR - 2022-02-28 16:07:54 --> Severity: Notice --> Undefined index: status C:\laragon\www\online\application\models\XenditModel.php 35
ERROR - 2022-02-28 16:07:54 --> Severity: Notice --> Undefined index: merchant_name C:\laragon\www\online\application\models\XenditModel.php 36
ERROR - 2022-02-28 16:07:54 --> Severity: Notice --> Undefined index: merchant_profile_picture_url C:\laragon\www\online\application\models\XenditModel.php 37
ERROR - 2022-02-28 16:07:54 --> Severity: Notice --> Undefined index: amount C:\laragon\www\online\application\models\XenditModel.php 38
ERROR - 2022-02-28 16:07:54 --> Severity: Notice --> Undefined index: payer_email C:\laragon\www\online\application\models\XenditModel.php 39
ERROR - 2022-02-28 16:07:54 --> Severity: Notice --> Undefined index: description C:\laragon\www\online\application\models\XenditModel.php 40
ERROR - 2022-02-28 16:07:54 --> Severity: Notice --> Undefined index: expiry_date C:\laragon\www\online\application\models\XenditModel.php 41
ERROR - 2022-02-28 16:07:54 --> Severity: Notice --> Undefined index: invoice_url C:\laragon\www\online\application\models\XenditModel.php 42
ERROR - 2022-02-28 16:07:54 --> Severity: Notice --> Undefined index: should_exclude_credit_card C:\laragon\www\online\application\models\XenditModel.php 43
ERROR - 2022-02-28 16:07:54 --> Severity: Notice --> Undefined index: should_send_email C:\laragon\www\online\application\models\XenditModel.php 44
ERROR - 2022-02-28 16:07:54 --> Severity: Notice --> Undefined index: created C:\laragon\www\online\application\models\XenditModel.php 45
ERROR - 2022-02-28 16:07:54 --> Severity: Notice --> Undefined index: updated C:\laragon\www\online\application\models\XenditModel.php 46
ERROR - 2022-02-28 16:07:54 --> Query error: Column 'id' cannot be null - Invalid query: INSERT INTO `tb_xendit` (`id`, `external_id`, `user_id`, `status`, `merchant_name`, `merchant_profile_picture_url`, `amount`, `payer_email`, `description`, `expiry_date`, `invoice_url`, `should_exclude_credit_card`, `should_send_email`, `created`, `updated`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)
ERROR - 2022-02-28 16:07:54 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\online\system\core\Exceptions.php:271) C:\laragon\www\online\system\core\Common.php 570
ERROR - 2022-02-28 16:07:54 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 16:07:54 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\online\application\cache\6a719889e0624638718bfbe5ceefc9540b2094a4.php 801
ERROR - 2022-02-28 16:22:16 --> Severity: Notice --> Undefined variable: transaction C:\xampp2\htdocs\online\application\cache\419618445c1851254053bbd8f05d167a0d8605cc.php 801
ERROR - 2022-02-28 16:22:16 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp2\htdocs\online\application\cache\419618445c1851254053bbd8f05d167a0d8605cc.php 801
ERROR - 2022-02-28 16:25:43 --> Severity: Notice --> Undefined variable: transaction C:\xampp2\htdocs\online\application\cache\419618445c1851254053bbd8f05d167a0d8605cc.php 801
ERROR - 2022-02-28 16:25:43 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp2\htdocs\online\application\cache\419618445c1851254053bbd8f05d167a0d8605cc.php 801
ERROR - 2022-02-28 16:26:46 --> Severity: Notice --> Undefined variable: transaction C:\xampp2\htdocs\online\application\cache\419618445c1851254053bbd8f05d167a0d8605cc.php 801
ERROR - 2022-02-28 16:26:46 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp2\htdocs\online\application\cache\419618445c1851254053bbd8f05d167a0d8605cc.php 801
ERROR - 2022-02-28 17:14:46 --> Severity: Warning --> mysqli::real_connect(): (HY000/1049): Unknown database 'admin_benteng' C:\xampp\htdocs\online\system\database\drivers\mysqli\mysqli_driver.php 203
ERROR - 2022-02-28 17:14:46 --> Unable to connect to the database
ERROR - 2022-02-28 17:15:10 --> Severity: Warning --> mysqli::real_connect(): (HY000/1049): Unknown database 'admin_benteng' C:\xampp\htdocs\online\system\database\drivers\mysqli\mysqli_driver.php 203
ERROR - 2022-02-28 17:15:10 --> Unable to connect to the database
ERROR - 2022-02-28 17:15:19 --> Severity: Warning --> mysqli::real_connect(): (HY000/1049): Unknown database 'admin_benteng' C:\xampp\htdocs\online\system\database\drivers\mysqli\mysqli_driver.php 203
ERROR - 2022-02-28 17:15:19 --> Unable to connect to the database
ERROR - 2022-02-28 17:16:18 --> Severity: 8192 --> Required parameter $id_transaksi follows optional parameter $subject C:\xampp\htdocs\online\application\models\M_base_config.php 211
ERROR - 2022-02-28 17:16:18 --> Severity: 8192 --> Required parameter $email_title follows optional parameter $subject C:\xampp\htdocs\online\application\models\M_base_config.php 0
ERROR - 2022-02-28 17:16:18 --> Severity: 8192 --> Required parameter $dateUsed follows optional parameter $userId C:\xampp\htdocs\online\application\models\OrderModel.php 108
ERROR - 2022-02-28 17:16:18 --> Severity: 8192 --> Required parameter $message follows optional parameter $type C:\xampp\htdocs\online\application\models\ApiModel.php 311
ERROR - 2022-02-28 17:16:18 --> Severity: Warning --> Undefined variable $transaction C:\xampp\htdocs\online\application\cache\8bf5fb6d94dbf6097f3bdfe03fc1c7e7b1d244e7.php 801
ERROR - 2022-02-28 17:16:18 --> Severity: Warning --> foreach() argument must be of type array|object, null given C:\xampp\htdocs\online\application\cache\8bf5fb6d94dbf6097f3bdfe03fc1c7e7b1d244e7.php 801
ERROR - 2022-02-28 17:18:34 --> Severity: 8192 --> Required parameter $id_transaksi follows optional parameter $subject C:\xampp\htdocs\online\application\models\M_base_config.php 211
ERROR - 2022-02-28 17:18:34 --> Severity: 8192 --> Required parameter $email_title follows optional parameter $subject C:\xampp\htdocs\online\application\models\M_base_config.php 0
ERROR - 2022-02-28 17:18:34 --> Severity: 8192 --> Required parameter $dateUsed follows optional parameter $userId C:\xampp\htdocs\online\application\models\OrderModel.php 108
ERROR - 2022-02-28 17:18:34 --> Severity: 8192 --> Required parameter $message follows optional parameter $type C:\xampp\htdocs\online\application\models\ApiModel.php 311
ERROR - 2022-02-28 17:18:34 --> Severity: Warning --> Undefined variable $transaction C:\xampp\htdocs\online\application\cache\8bf5fb6d94dbf6097f3bdfe03fc1c7e7b1d244e7.php 801
ERROR - 2022-02-28 17:18:34 --> Severity: Warning --> foreach() argument must be of type array|object, null given C:\xampp\htdocs\online\application\cache\8bf5fb6d94dbf6097f3bdfe03fc1c7e7b1d244e7.php 801
ERROR - 2022-02-28 19:23:28 --> Severity: Notice --> Undefined variable: transaction C:\Users\Lenovo\Downloads\Documents\xampp\htdocs\online\application\cache\441078e07038fda4a71896e827397e8155472ba2.php 801
ERROR - 2022-02-28 19:23:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\Users\Lenovo\Downloads\Documents\xampp\htdocs\online\application\cache\441078e07038fda4a71896e827397e8155472ba2.php 801

<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-02-25 13:22:30 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 13:22:30 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 13:22:33 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 13:22:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 13:22:34 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 13:22:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 13:22:35 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 13:22:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 13:22:55 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-25 13:22:55 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 13:22:55 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 13:22:55 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 13:22:55 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 13:22:55 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 13:22:55 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 13:22:55 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 13:22:55 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 13:22:55 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 13:22:55 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 13:22:55 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 13:22:55 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\html\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 13:22:55 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\system\core\Common.php 570
ERROR - 2022-02-25 13:22:55 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\html\system\core\Exceptions.php:271) C:\laragon\www\html\application\helpers\my_helper.php 157
ERROR - 2022-02-25 13:23:04 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 13:23:04 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 14:55:59 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 14:55:59 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 14:56:11 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 14:56:11 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 14:57:02 --> Severity: Warning --> fsockopen(): php_network_getaddresses: getaddrinfo failed: No such host is known.  C:\laragon\www\html\system\libraries\Email.php 2069
ERROR - 2022-02-25 14:57:02 --> Severity: Warning --> fsockopen(): unable to connect to ssl://mail.kemdikbud.go.id/:465 (php_network_getaddresses: getaddrinfo failed: No such host is known. ) C:\laragon\www\html\system\libraries\Email.php 2069
ERROR - 2022-02-25 14:57:02 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 14:57:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 14:59:36 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 14:59:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 15:15:06 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 15:15:06 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 15:15:08 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 15:15:08 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 15:19:01 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 15:19:01 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\html\application\cache\7f543aa78ca92c5d141fa2f339935eed985805e5.php 801
ERROR - 2022-02-25 15:38:23 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\tiket1\application\cache\748e0f1e8294f05cea2b01c9a964d3645a4a352c.php 801
ERROR - 2022-02-25 15:38:23 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\tiket1\application\cache\748e0f1e8294f05cea2b01c9a964d3645a4a352c.php 801
ERROR - 2022-02-25 15:38:46 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'admin_benteng.tb_transaction.transaction_created' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `transaction_created`, UNIX_TIMESTAMP(transaction_created) as created, (SUM(transaction_total)-SUM(transaction_fee)) as total
FROM `tb_transaction`
WHERE `transaction_paid` = '1'
AND MONTH(transaction_created) = '02'
GROUP BY DATE(transaction_created)
ORDER BY `transaction_created` ASC
ERROR - 2022-02-25 15:38:46 --> Severity: Notice --> Undefined offset: 1 C:\laragon\www\tiket1\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 15:38:46 --> Severity: Notice --> Undefined offset: 2 C:\laragon\www\tiket1\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 15:38:46 --> Severity: Notice --> Undefined offset: 3 C:\laragon\www\tiket1\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 15:38:46 --> Severity: Notice --> Undefined offset: 4 C:\laragon\www\tiket1\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 15:38:46 --> Severity: Notice --> Undefined offset: 5 C:\laragon\www\tiket1\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 15:38:46 --> Severity: Notice --> Undefined offset: 6 C:\laragon\www\tiket1\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 15:38:46 --> Severity: Notice --> Undefined offset: 7 C:\laragon\www\tiket1\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 15:38:46 --> Severity: Notice --> Undefined offset: 8 C:\laragon\www\tiket1\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 15:38:46 --> Severity: Notice --> Undefined offset: 9 C:\laragon\www\tiket1\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 15:38:46 --> Severity: Notice --> Undefined offset: 10 C:\laragon\www\tiket1\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 15:38:46 --> Severity: Notice --> Undefined offset: 11 C:\laragon\www\tiket1\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 15:38:46 --> Severity: Notice --> Undefined offset: 12 C:\laragon\www\tiket1\application\modules\api\controllers\Chart.php 136
ERROR - 2022-02-25 15:38:46 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\tiket1\system\core\Exceptions.php:271) C:\laragon\www\tiket1\system\core\Common.php 570
ERROR - 2022-02-25 15:38:46 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\laragon\www\tiket1\system\core\Exceptions.php:271) C:\laragon\www\tiket1\application\helpers\my_helper.php 157
ERROR - 2022-02-25 15:38:58 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\tiket1\application\cache\748e0f1e8294f05cea2b01c9a964d3645a4a352c.php 801
ERROR - 2022-02-25 15:38:58 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\tiket1\application\cache\748e0f1e8294f05cea2b01c9a964d3645a4a352c.php 801
ERROR - 2022-02-25 15:39:36 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\tiket1\application\cache\748e0f1e8294f05cea2b01c9a964d3645a4a352c.php 801
ERROR - 2022-02-25 15:39:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\tiket1\application\cache\748e0f1e8294f05cea2b01c9a964d3645a4a352c.php 801
ERROR - 2022-02-25 15:39:53 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\tiket1\application\cache\748e0f1e8294f05cea2b01c9a964d3645a4a352c.php 801
ERROR - 2022-02-25 15:39:53 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\tiket1\application\cache\748e0f1e8294f05cea2b01c9a964d3645a4a352c.php 801
ERROR - 2022-02-25 15:51:48 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\tiket1\application\cache\748e0f1e8294f05cea2b01c9a964d3645a4a352c.php 801
ERROR - 2022-02-25 15:51:48 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\tiket1\application\cache\748e0f1e8294f05cea2b01c9a964d3645a4a352c.php 801
ERROR - 2022-02-25 15:52:29 --> Severity: Warning --> fsockopen(): unable to connect to SSL://smtp.gmail.com:465 (Unable to find the socket transport &quot;SSL&quot; - did you forget to enable it when you configured PHP?) C:\laragon\www\tiket1\system\libraries\Email.php 2069
ERROR - 2022-02-25 15:52:29 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\tiket1\application\cache\748e0f1e8294f05cea2b01c9a964d3645a4a352c.php 801
ERROR - 2022-02-25 15:52:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\tiket1\application\cache\748e0f1e8294f05cea2b01c9a964d3645a4a352c.php 801
ERROR - 2022-02-25 15:55:26 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\tiket1\application\cache\748e0f1e8294f05cea2b01c9a964d3645a4a352c.php 801
ERROR - 2022-02-25 15:55:26 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\tiket1\application\cache\748e0f1e8294f05cea2b01c9a964d3645a4a352c.php 801
ERROR - 2022-02-25 15:56:19 --> Severity: Notice --> Undefined variable: transaction C:\laragon\www\tiket1\application\cache\748e0f1e8294f05cea2b01c9a964d3645a4a352c.php 801
ERROR - 2022-02-25 15:56:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\tiket1\application\cache\748e0f1e8294f05cea2b01c9a964d3645a4a352c.php 801

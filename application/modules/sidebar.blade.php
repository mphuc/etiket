<?php
$data = get_instance()->setting->get_all();
?>
{!! get_instance()->parser->parse('back/2ndmaterial/nav.php',$data) !!}
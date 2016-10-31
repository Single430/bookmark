<?php
use Phalcon\Tag;

{#$old_user = $this->session->get('username');#}

echo "注销成功！";

echo Tag::linkTo("index", '<br />返回重新登录');

?>
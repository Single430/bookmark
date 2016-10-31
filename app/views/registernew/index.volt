<h3>信息: </h3>
<?php

use Phalcon\Tag;
echo $this->session->get('error');
if(!$this->session->get('flag')){
    echo Tag::linkTo("register", '<br />返 回');
}else{
    echo Tag::linkTo("index", '<br />返 回');
}
$this->session->remove('error');
$this->session->remove('flag');
?>
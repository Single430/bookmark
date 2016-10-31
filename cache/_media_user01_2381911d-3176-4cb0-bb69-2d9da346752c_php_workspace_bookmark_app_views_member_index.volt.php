<hr />
<?php
use Phalcon\Tag;

global $bm_table;

if(!$this->session->get('username')){
    echo '请重新登录。';
    echo Tag::linkTo("index", '<br />返 回');
}else{
    echo "登录用户是： " . $this->session->get('username') . "<br /><hr />";
    $url_array = Bookmark::find(array(
        "username = :username:",
        'bind' => array('username' => $this->session->get('username'))
    ));
    if (count($url_array)){
        $urls = array();
        $count = 0;
        foreach ($url_array as $u){
            $urls[$count++] = $u->bm_URL;
        }
        $bm_table = true;
?>
        <br />
        <form name="bm_table" action="/bookmark/delete" method="post">
        <table width="300" cellpadding="2" cellspacing="0">
        <?php
        $color = "#cccccc";
        echo "<tr bgcolor=\"".$color."\"><td><strong>书 签</strong></td>";
        echo "<td><strong>删 除?</strong></td></tr>";
        if ((is_array($urls)) && (count($urls) > 0)) {
            foreach ($urls as $url)  {
                if ($color == "#cccccc") {
                    $color = "#ffffff";
                } else {
                    $color = "#cccccc";
                }
                echo "<tr bgcolor=\"".$color."\"><td><a href=\"".$url."\">".htmlspecialchars($url)."</a></td>
                    <td><input type=\"checkbox\" name=\"del_me[]\"
                        value=\"".$url."\"/></td>
                    </tr>";
            }
        } else {
            echo "<tr><td>没有书签...</td></tr>";
        }}
        ?>
        </table>
        </form>
        <hr />
        <a href="#">Home</a> &nbsp;|&nbsp;
        <a href="/bookmark/addbm">添加书签</a> &nbsp;|&nbsp;
        <?php
        }
        echo $bm_table;
        if ($bm_table == true) {
            echo "<a href=\"#\" onClick=\"bm_table.submit();\">删除书签</a> &nbsp;|&nbsp;";
        } else {
            echo "<span style=\"color: #cccccc\">删除书签</span> &nbsp;|&nbsp;";
        }
        ?>
        <a href="/bookmark/changepassword">修改密码</a>
        <br />
        <a href="/bookmark/share">推荐网址给我</a> &nbsp;|&nbsp;
        <a href="/bookmark/logout">注 销</a>

        <hr />
<?php
}
?>
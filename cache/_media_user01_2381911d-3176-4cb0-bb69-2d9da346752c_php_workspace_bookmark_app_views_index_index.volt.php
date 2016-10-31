<?php
use Phalcon\Tag;
$old_user = $this->session->get('username');
if($old_user){
    echo '用户: ' . $old_user . ' 已经登录。';
}else{
    echo '未登录...';
}
?>
<p><?php echo Tag::linkTo("register", "没有帐号?") ?></p>
<?php echo Tag::form(array("member", "method"=>"post")); ?>
    <table bgcolor="#cccccc">
        <tr>
            <td colspan="2">帐号登录:</td>
        <tr>
            <td>用户名:</td>
            <td><?php echo Tag::textField("username") ?></td></tr>
        <tr>
            <td>密 码:</td>
            <td><?php echo Tag::passwordField("password") ?></td></tr>
        <tr>
            <td colspan="2" align="center">
                <?php echo Tag::submitButton("登 录") ?></td></tr>
        <tr>
            <td colspan="2"><a><?php echo Tag::linkTo("forgotpassword", "点我，找回密码?") ?></a></td>
        </tr>
    </table>
</form>
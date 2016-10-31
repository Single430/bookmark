<?php
use Phalcon\Tag;
echo Tag::linkTo("index", '<br />返回');
?>
<?php echo Tag::form(array("registernew", "method"=>"post")); ?>
    <table bgcolor="#cccccc">
        <tr>
            <td colspan="2">帐号注册:</td>
        <tr>
            <td>邮箱:</td>
            <td><?php echo Tag::textField("email") ?></td></tr>
        <tr>
            <td>用户名 <br />(3~16 chars):</td>
            <td><?php echo Tag::textField("username") ?></td></tr>
        <tr>
            <td>密 码 <br />(6~16 chars):</td>
            <td><?php echo Tag::passwordField("password") ?></td></tr>
        <tr>
            <td>再次输入密码:</td>
            <td><?php echo Tag::passwordField("password2") ?></td></tr>
        <tr>
            <td colspan="2" align="center">
                <?php echo Tag::submitButton("注 册") ?></td>
        </tr>
    </table>
</form>
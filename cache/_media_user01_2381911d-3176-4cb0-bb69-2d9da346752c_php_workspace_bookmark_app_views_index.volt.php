<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <?php echo $this->tag->getTitle(); ?>
    </head>
    <body>
        
             
        <?php
        echo '<h1>' . $this->tag->image("img/bookmark.gif") . 'PHP 书签</h1>';
        ?>
        <hr />
        <ul>
            <li>将你的书签存放在我们的网上！</li>
            <li>看看其他用户使用什么！</li>
            <li>与他人分享你最喜欢的链接！</li>
        </ul>
        <div class="container">
            <?= $this->getContent() ?>
        </div>
        <footer>
            <p>&copy; Company 2016</p>
        </footer>
    </body>
</html>

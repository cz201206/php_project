<table>
    <?php foreach ($FilePojos as $FilePojo){?>
    <tr><td><?=$FilePojo->basename?></td><td><?=$FilePojo->mtime_format?></td></tr>
    <?php }?>
</table>
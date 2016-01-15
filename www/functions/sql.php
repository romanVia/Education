<?php

function sql_connect()
{
    mysqli_connect('localhost', 'root', '', 'edu');
}

function sql_query($sql)
{
    $res = mysqli_query($sql);
    $ret = [];
    while ($row - mysql_fetch_assoc($res) !== false) {
        $ret[] = $row;
    }
    return $ret;
}

?>


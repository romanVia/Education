<?php

require_once __DIR__ . '/../functions/sql.php';

function getAll()
{
    sql_connect();

    $sql = 'SELECT * FROM news BY date DESC';

    return sql_query($sql);
}

?>


<?php
function xDbMysqlDriver() {
    $db = xConfigGet('db');
    $dsn = sprintf('mysql:dbname=%s;host=%s', $db['name'], $db['host']);
    
    try {
        $dbh = new PDO($dsn, $db['user'], $db['pass']);
    } catch (PDOException $e) {
        xErrorX('Connection failed: ' . $e->getMessage());
    }
}

function xDbSqliteDriver() {
    $db = xConfigGet('db');
    $dsn = 'sqlite:' . ($db['host'] == 'memory' ? ':memory:' : $db['host']);
    
    try {
        return new PDO($dsn, $db['user'], $db['password']);
    } catch (PDOException $e) {
        xErrorX('Connection failed: ' . $e->getMessage());
    }
}

function xDbSqliteCreate($tableName, array $tableDef) {
    $cols = array();
    foreach($tableDef as $col => $type) {
        $cols[] = "$col $type";
    }
    $cols = implode(',', $cols);
    
    return xDbQuery("CREATE TABLE $tableName(id INTEGER PRIMARY KEY ASC, $cols)");
}


function xDb($newDb = false) {
    static $db;
    if($newDb) {
        $db = $newDb;
    } else {
        return $db;
    }
}
function xDbConnect() {
    $driver = xConfigGet('db', 'driver');
    $driver = "xDb{$driver}Driver";
    xDb($driver());
}
function xDbQuery($sql, array $values = array()) {
    if(empty($values)) {    
        if($r = xDb()->query($sql)) {
            return $r;
        } else {
            xErrorX('Error in Statement: ' . implode(" ;\n", xDb()->errorInfo()));
        }
    } else {
        $stmt = xDb()->prepare($sql);
        if(!$stmt) { 
            xErrorX('Error in Statement: ' .  implode(" ;\n", xDb()->errorInfo()));
        }
        
        $stmt->execute($values);
        return $stmt;
    }
}
function xDbRead($fields, $table, array $where = array()) {
    $fields = implode(',', (array) $fields);
    $whereStr  = xDbBoundStr($where);
    
    return xDbQuery("SELECT $fields FROM $table WHERE $whereStr", $where);
}

function xDbWrite($table, $data) {
    $fields = array_keys($data);
    $values = array();
    foreach($fields as $places) {
        $values[] = ":$places";
    }
    $fields = implode(', ', $fields);
    $values = implode(', ', $values);
    return xDbQuery("INSERT INTO $table ($fields) VALUES($values);", $data);
}

function xDbUpdate($table, $data, $where = null) {
    $where  = xDbBoundStr($where);
    $update = xDbBoundStr($data, ', ');    
    
    return xDbQuery("UPDATE $table SET $update WHERE $where", $data);
}

function xDbDelete($table, $where = null) {
    $where = xDbBoundStr($where);
    
    return xDbQuery("DELETE FROM $table WHERE $where", $data);
}

function xDbFetch($result, $as = 'assoc', $all = false) {    
    if(!$result) {
        xErrorX('Query Failed');
    }
    
    $rtnMethod = array('assoc' => PDO::FETCH_ASSOC, 'num' => PDO::FETCH_NUM, 
                       'both'  => PDO::FETCH_BOTH,  'obj' => PDO::FETCH_OBJ);
    
    return $all ? $result->fetchAll($rtnMethod[$as]) : $result->fetch($rtnMethod[$as]);
}

function xDbBoundStr($data, $sep = ' AND ') {
    if(empty($data)) { 
        return '1'; 
    }
    $out = array();
    foreach($data as $field => $value) {
        $out[] = "$field = :$field";
    }
    return implode($sep, $out);
}
?>

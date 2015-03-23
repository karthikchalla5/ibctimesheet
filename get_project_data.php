
<?php

include 'connection.php';

$sidx = $_REQUEST['sidx'];
$sord = $_REQUEST['sord'];

$rows = array();
$searchon = $_REQUEST['_search'];
$wh = "";

if ($searchon == 'true') {
    $searchstr = Strip($_REQUEST['filters']);
    $wh = constructWhere($searchstr);

    $sth = mysqli_query($conn, "select project_id,project_name,project_manager,client_name,client_mail_id,client_number,start_date,end_date from project WHERE " . $wh . " ORDER BY " . $sidx . " " . $sord);

    if ($sth === FALSE) {
        die(mysqli_error()); // TODO: better error handling
    }

    while ($row = mysqli_fetch_array($sth, MYSQL_ASSOC)) {
        $row_array['project_id'] = $row['project_id'];
        $row_array['project_name'] = $row['project_name'];
        $row_array['project_manager'] = $row['project_manager'];
        $row_array['client_name'] = $row['client_name'];
        $row_array['client_mail_id'] = $row['client_mail_id'];
        $row_array['client_number'] = $row['client_number'];
        $row_array['start_date'] = $row['start_date'];
        $row_array['end_date'] = $row['end_date'];
        array_push($rows, $row_array);
    }
    echo json_encode($rows);
} else {
    $sth = mysqli_query($conn, "select project_id,project_name,project_manager,client_name,client_mail_id,client_number,start_date,end_date from project ORDER BY " . $sidx . " " . $sord);

    if ($sth === FALSE) {
        die(mysqli_error()); // TODO: better error handling
    }

    while ($row = mysqli_fetch_array($sth, MYSQL_ASSOC)) {
        $row_array['project_id'] = $row['project_id'];
        $row_array['project_name'] = $row['project_name'];
        $row_array['project_manager'] = $row['project_manager'];
        $row_array['client_name'] = $row['client_name'];
        $row_array['client_mail_id'] = $row['client_mail_id'];
        $row_array['client_number'] = $row['client_number'];
        $row_array['start_date'] = $row['start_date'];
        $row_array['end_date'] = $row['end_date'];
        array_push($rows, $row_array);
    }
    echo json_encode($rows);
}

function constructWhere($s) {
    $qwery = "";
    //['eq','ne','lt','le','gt','ge','bw','bn','in','ni','ew','en','cn','nc']
    $qopers = array(
        'eq' => " = ",
        'ne' => " <> ",
        'lt' => " < ",
        'le' => " <= ",
        'gt' => " > ",
        'ge' => " >= ",
        'bw' => " LIKE ",
        'bn' => " NOT LIKE ",
        'in' => " IN ",
        'ni' => " NOT IN ",
        'ew' => " LIKE ",
        'en' => " NOT LIKE ",
        'cn' => " LIKE ",
        'nc' => " NOT LIKE ");
    if ($s) {
        $jsona = json_decode($s, true);
        if (is_array($jsona)) {
            $gopr = $jsona['groupOp'];
            $rules = $jsona['rules'];
            $i = 0;
            foreach ($rules as $key => $val) {
                $field = $val['field'];
                $op = $val['op'];
                $v = $val['data'];
                if ($v && $op) {
                    // ToSql in this case is absolutely needed
                    $v = ToSql($field, $op, $v);
                    if ($i > 0)
                        $qwery .= " " . $gopr . " ";
                    else
                        $qwery .= "  ";
                    switch ($op) {
                        // in need other thing
                        case 'in' :
                        case 'ni' :
                            $qwery .= $field . $qopers[$op] . " (" . $v . ")";
                            break;
                        default:
                            $qwery .= $field . $qopers[$op] . "'" . $v . "'";
                    }
                    $i++;
                }
            }
        }
    }
    return $qwery;
}

function ToSql($field, $oper, $val) {
    // we need here more advanced checking using the type of the field - i.e. integer, string, float
    switch ($field) {
        case 'project_id':
            return $val;
            break;
        //return intval($val);
        //break;
        case 'project_name':
            return $val;
            break;
        case 'project_manager':
            return $val;
            break;
        case 'client_name':
            return $val;
            break;
        case 'client_mail_id':
            return $val;        //return floatval($val);
            break;
        case 'client_number':
            return intval($val);
            break;
        case 'start_date':
            return $val;
            break;
        case 'end_date':
            return $val;
            break;
        default :
            //mysql_real_escape_string is better
            if ($oper == 'bw' || $oper == 'bn')
                return "'" . addslashes($val) . "%'";
            else if ($oper == 'ew' || $oper == 'en')
                return "'%" . addcslashes($val) . "'";
            else if ($oper == 'cn' || $oper == 'nc')
                return "'%" . addslashes($val) . "%'";
            else
                return "'" . addslashes($val) . "'";
    }
}

function Strip($value) {
    if (get_magic_quotes_gpc() != 0) {
        if (is_array($value))
            if (array_is_associative($value)) {
                foreach ($value as $k => $v)
                    $tmp_val[$k] = stripslashes($v);
                $value = $tmp_val;
            } else
                for ($j = 0; $j < sizeof($value); $j++)
                    $value[$j] = stripslashes($value[$j]);
        else
            $value = stripslashes($value);
    }
    return $value;
}

function array_is_associative($array) {
    if (is_array($array) && !empty($array)) {
        for ($iterator = count($array) - 1; $iterator; $iterator--) {
            if (!array_key_exists($iterator, $array)) {
                return true;
            }
        }
        return !array_key_exists(0, $array);
    }
    return false;
}

?>
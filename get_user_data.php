
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
    //echo $wh;
    $sth = mysqli_query($conn, "select employee_id,employee_name,designation_id,official_mail_id,personal_mail_id,contact_number,address from employee WHERE " . $wh . " ORDER BY " . $sidx . " " . $sord);

    if ($sth === FALSE) {
        die(mysqli_error()); // TODO: better error handling
    }

    while ($row = mysqli_fetch_array($sth, MYSQL_ASSOC)) {

        $row_array['employee_id'] = $row['employee_id'];
        $row_array['employee_name'] = $row['employee_name'];
        $row_array['designation_id'] = $row['designation_id'];
        $row_array['official_mail_id'] = $row['official_mail_id'];
        $row_array['personal_mail_id'] = $row['personal_mail_id'];
        $row_array['contact_number'] = $row['contact_number'];
        $row_array['address'] = $row['address'];

        array_push($rows, $row_array);
    }

    echo json_encode($rows);
} else {
    $sth = mysqli_query($conn, "select employee_id,employee_name,designation_id,official_mail_id,personal_mail_id,contact_number,address from employee ORDER BY " . $sidx . " " . $sord);

    if ($sth === FALSE) {
        die(mysqli_error()); // TODO: better error handling
    }

    while ($row = mysqli_fetch_array($sth, MYSQL_ASSOC)) {
        $row_array['employee_id'] = $row['employee_id'];
        $row_array['employee_name'] = $row['employee_name'];
        $row_array['designation_id'] = $row['designation_id'];
        $row_array['official_mail_id'] = $row['official_mail_id'];
        $row_array['personal_mail_id'] = $row['personal_mail_id'];
        $row_array['contact_number'] = $row['contact_number'];
        $row_array['address'] = $row['address'];

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
        case 'employee_name':
            return $val;
            break;
        //return intval($val);
        //break;
        case 'designation_id':
            return $val;
            break;
        case 'employee_id':
            return $val;
            break;
        case 'official_mail_id':
            return $val;        //return floatval($val);
            break;
        case 'personal_mail_id':
            return $val;
            break;
        case 'contact_number':
            return intval($val);
            break;
        case 'address':
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
<?php

/**
 * This class is used to clean user input data such as:
 * Remove whitespace and other predefined characters from both sides of a string
 * Remove the backslash
 * Converts some predefined characters to HTML entities
 * The htmlentities() function converts characters to HTML entities
 */
class cleandata
{
    public static function clean($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data,ENT_QUOTES);
        return $data;
    }
}

/******************  Function  ***********************/
function parseMethod($method) {
    if ($method == 1) {
        return 'GeneNet';
    } elseif ($method == 2) {
        return 'Neighborhood selection';
    } elseif ($method == 3) {
        return 'GLASSO';
    } elseif ($method == 4) {
        return 'GLASSO-SF';
    } elseif ($method == 5) {
        return 'PCA-CMI';
    } elseif ($method == 6) {
        return 'CMI2NI';
    } elseif ($method == 7) {
        return 'SPACE';
    } elseif ($method == 8) {
        return 'EGLASSO';
    } elseif ($method == 9) {
        return 'ESPACE';
    } elseif ($method == 10) {
        return 'ENA';
    } elseif ($method == 11) {
        return 'BayesianGLASSO';
    } else {
        return Null;
    }
}

function parseParam($method) {
    if ($method == 1) {
        return 'FDR: ';
    } elseif ($method == 10) {
        return 'p-value: ';
    } elseif (in_array($method, array(2, 5, 6, 7, 8, 9, 11))) {
        return 'Alpha: ';
    } elseif (in_array($method, array(3, 4))) {
        return 'Lambda: ';
    } else {
        return Null;
    }
}

function parseParam_2($method) {
    if ($method == 8 | $method == 9) {
        return 'Lambda: ';
    } elseif ($method == 10) {
        return 'Include BayesianGLASSO: ';
    } else {
        return Null;
    }
}

function parseParam2_value($method, $param_2) {
    if ($method == 10) {
        if ($param_2 == 0) {
            return 'No';
        } elseif ($param_2 == 1) {
            return 'Yes';
        }
    } else {
        return $param_2;
    }
}
?>
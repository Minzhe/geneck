<?php

/**
 * this class contains the common funcions in the whole website development
 */

class util
{
    /*
     * Remove whitespace and other predefined characters from both sides of a string
     * Remove the backslash
     * Converts some predefined characters to HTML entities
     * The htmlentities() function converts characters to HTML entities
     */
    public static function clean($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data,ENT_QUOTES);
        return $data;
    }
    
    public static function parseMethod($mymethod) {
        if ($mymethod == 1) {
            return 'GeneNet';
        } elseif ($mymethod == 2) {
            return 'Neighborhood selection';
        } elseif ($mymethod == 3) {
            return 'GLASSO';
        } elseif ($mymethod == 4) {
            return 'GLASSO-SF';
        } elseif ($mymethod == 5) {
            return 'PCA-CMI';
        } elseif ($mymethod == 6) {
            return 'CMI2NI';
        } elseif ($mymethod == 7) {
            return 'SPACE';
        } elseif ($mymethod == 8) {
            return 'EGLASSO';
        } elseif ($mymethod == 9) {
            return 'ESPACE';
        } elseif ($mymethod == 10) {
            return 'ENA';
        } elseif ($mymethod == 11) {
            return 'BayesianGLASSO';
        }
        return Null;
    }

    public static function parseParam($method) {
        if ($method == 10) {
            return 'p-value: ';
        } elseif (in_array($method, array(1, 2, 5, 6, 7, 8, 9, 11))) {
            return 'Alpha: ';
        } elseif (in_array($method, array(3, 4))) {
            return 'Lambda: ';
        } else {
            return Null;
        }
    }

    public static function parseParam_2($method) {
        if ($method == 8 | $method == 9) {
            return 'Lambda: ';
        } elseif ($method == 10) {
            return 'BayesianGLASSO: ';
        } else {
            return Null;
        }
    }

    public static function parseParam2_value($method, $param_2) {
        if ($method == 10) {
            if ($param_2 == 0) {
                return 'No';
            } elseif ($param_2 == 1) {
                return 'Yes';
            }
        }
        return $param_2;
    }
}


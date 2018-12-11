<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('set_session'))
{
    function set_session($var = '')
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (is_array($var)){
            foreach ($var as $item => $value) {
                if( isset( $_SESSION[$item] ) ) {
                    $_SESSION[$item] = $value;
                }
                else {
                    $_SESSION[$item] = $value;
                }

            }
            return TRUE;
        } else {
            return FALSE;
        }

    }
}

if ( ! function_exists('show_session'))
{
    function show_session($var = '')
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if( isset( $_SESSION[$var])) {
            $result = $_SESSION[$var];
        } else {
            $result='';
        }
        return $result;
    }
}
if ( ! function_exists('end_session'))
{
    function end_session()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
    }
}

if ( ! function_exists('get_level'))
{
    function get_level($lvl)
    {
        if ($lvl==1){
            return 'superadmin';
        }elseif($lvl==2){
            return 'admin';
        }elseif($lvl==3){
            return 'warehouse';
        }elseif($lvl==5){
            return 'pelanggan';
        }elseif($lvl==6){
            return 'pemilik';
        }
    }
}


if ( ! function_exists('spell')) {
    function spell($value)
    {
        $str = '';
        if ($value == 0) {
            $str = "nihil";
        } else {
            $basic = array(1 => 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan');
            $number = array(1000000000000, 1000000000, 1000000, 1000, 100, 10, 1);
            $unit = array('triliun', 'milyar', 'juta', 'ribu', 'ratus', 'puluh', '');

            $i = 0;
            while ($value != 0) {
                $count = (int)($value / $number[$i]);
                if ($count >= 10) $str .= $this->spell($count) . " " . $unit[$i] . " ";
                else if ($count > 0 && $count < 10)
                    $str .= $basic[$count] . " " . $unit[$i] . " ";
                $value -= $number[$i] * $count;
                $i++;
            }
            $str = preg_replace("/satu puluh (\w+)/i", "\\1 belas", $str);
            $str = preg_replace("/satu (ribu|ratus|puluh|belas)/i", "se\\1", $str);
        }

        return ucwords($str);
    }
}


if ( ! function_exists('dateIndo')) {
    function dateIndo($tanggal, $jenis = 0)
    {
        $iMonth = date('n', strtotime($tanggal));
        if ($jenis) {
            $bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember');
        } else {
            $bulan = array('', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nop', 'Des');
        }
        $hari = date('d', strtotime($tanggal));
        $bln = $bulan[$iMonth];
        $tahun = date('Y', strtotime($tanggal));

        return $hari . " " . $bln . " " . $tahun;
    }
}

if ( ! function_exists('monthIndo')) {

    function monthIndo($kode, $jenis = 0)
    {
        if ($jenis) {
            $bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember');
        } else {
            $bulan = array('', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nop', 'Des');
        }

        return $bulan[$kode];
    }
}
if ( ! function_exists('numberFormat')) {

    function numberFormat($value)
    {
        return number_format($value, 0, ',', '.');
    }
}

if ( ! function_exists('numberFormatDash')) {
    function numberFormatDash($value)
    {
        if ($value == 0 || $value == '' || $value == null) {
            return '-';
        } else {
            return number_format($value, 0, ',', '.');
        }
    }
}

if ( ! function_exists('formatMinus')) {
    function formatMinus($nilai)
    {
        if ($nilai > 0) {
            return $this->numberFormat($nilai);
        } else if ($nilai == 0) {
            return "-";
        } else {
            $nilai = substr($nilai, 1, strlen($nilai));
            return '(' . $this->numberFormat($nilai) . ')';
        }
    }
}

if ( ! function_exists('capitalize_each_first')) {
    function capitalize_each_first($value)
    {
        return ucwords(strtolower($value));
    }
}

if ( ! function_exists('replace_input_mask')) {
    function replace_input_mask($value)
    {
        $replace    = array('Rp. ','.',',');
        $new        = str_replace($replace,'',$value);
        $new_val    = intval($new);
        return $new_val;
    }
}

if ( ! function_exists('rupiah_format')) {
    function rupiah_format($value)
    {
        return 'Rp. '.number_format($value);
    }
}
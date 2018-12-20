<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_level'))
{
    function get_level($lvl)
    {
        if ($lvl==1){
            return 'superadmin';
        }elseif($lvl==2){
            return 'admin';
        }elseif($lvl==3){
            return 'gudang';
        }elseif($lvl==5){
            return 'pelanggan';
        }elseif($lvl==6){
            return 'pemilik';
        }
    }
}

if ( ! function_exists('get_status_penjualan'))
{
    function get_status_penjualan($lvl)
    {
//        1 = antrian ;
//        2 = verifikasi ;
//        3 = sedang proses servis ;
//        4 = selesai servis / invoice outstanding / tunggu pembayaran ;
//        5 = lunas/selesai

        if ($lvl==1){
            return 'Belum Verifikasi';
        }elseif($lvl==2){
            return 'Selesai Verifikasi';
        }elseif($lvl==3){
            return 'Proses Pengerjaan';
        }elseif($lvl==4){
            return 'Belum Lunas';
        }elseif($lvl==5){
            return 'Lunas';
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
    function dateIndo($tanggal, $jenis = 0,$day = 0)
    {
        $iMonth = date('n', strtotime($tanggal));
        if ($jenis) {
            $bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember');
        } else {
            $bulan = array('', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nop', 'Des');
        }
        $hari   = date('d', strtotime($tanggal));
        $bln    = $bulan[$iMonth];
        $tahun  = date('Y', strtotime($tanggal));
        $day_spell = array('', 'Senin, ', 'Selasa, ', 'Rabu, ', 'Kamis, ', 'Jumat, ', 'Sabtu, ', 'Minggu, ');

        return $day_spell[$day].$hari . " " . $bln . " " . $tahun;
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

if ( ! function_exists('formatDate')) {

    function formatDate($date,$param)
    {
        $date=date_create($date);
        return date_format($date,"$param");
    }
}


if ( ! function_exists('numberFormat')) {

    function numberFormat($value,$jenis=null)//jenis 1 =  ubah nilai jadi separator titik(.); jenis 2 = jika value 0, ganti dash; jenis 3 = replace ,(comma jadi tidak ada, biar bisa di hitung)
    {
        if ($jenis==null){
            return number_format($value, 0, '.', ',');
        } elseif ($jenis==1){
            if ($value == 0 || $value == '' || $value == null) {
                return '-';
            } else {
                return number_format($value, 0, '.', ',');
            }
        }elseif ($jenis==3){
            return intval(str_replace(',','',$value));
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

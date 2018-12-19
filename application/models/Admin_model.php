<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 09/12/2018
 * Time: 6:39
 *
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function insert_data($tabel,$data)
    {
        $this->db->insert($tabel,$data);
    }

    public function update_data($id,$valueid,$tabel,$data)
    {
        $this->db->where($id,$valueid);
        $this->db->update($tabel,$data);
    }

    public function select_data($tabel,$order='',$option='')
    {
        $this->db->order_by($order,$option);
        $result=$this->db->get($tabel);
        return $result;
    }

    public function cek_data($data,$tabel,$order='',$option='')
    {
        $this->db->where($data);
        $this->db->order_by($order,$option);
        $result=$this->db->get($tabel);
        return $result;
    }

    public function delete_data($id,$valueid,$tabel)
    {
        $this->db->where($id,$valueid);
        $this->db->delete($tabel);
    }

    function kode_auto($tabel,$id,$kode)
    {
        $this->db->select_max('RIGHT('.$id.',4)', 'kd_max');//select
        $query = $this->db->get($tabel);
        $kd = "";
        if($query->num_rows()>0)
        {
            foreach($query->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }
        else
        {
            $kd = "0001";
        }
        return $kode.$kd;
    }

    function get_kode_barang($jenis)
    {
        $this->db->where('jenis',$jenis);
        $this->db->select_max('RIGHT(kode,4)', 'kd_max');//select
        $query = $this->db->get('barang');
        $kd = "";
        if($query->num_rows()>0)
        {
            foreach($query->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }
        else
        {
            $kd = "0001";
        }
        if ($jenis=='layanan'){
            return 'LYAN'.$kd;
        } elseif ($jenis=='spare_part'){
            return 'SPRT'.$kd;
        }
    }

    function get_kode_kategori_barang($jenis)
    {
        $this->db->where('jenis_kategori',$jenis);
        $this->db->select_max('RIGHT(kode_kategori,4)', 'kd_max');//select
        $query = $this->db->get('kategori_barang');
        $kd = "";
        if($query->num_rows()>0)
        {
            foreach($query->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }
        else
        {
            $kd = "0001";
        }
        if ($jenis=='layanan'){
            return 'KTLY'.$kd;
        } elseif ($jenis=='spare_part'){
            return 'KTSP'.$kd;
        }
    }

    function get_daftar_barang($jenis){
        $this->db->select('a.*,b.nama_kategori as nama_kategori');
        $this->db->from('barang a');
        $this->db->join('kategori_barang b', 'a.kode_kategori = b.kode_kategori');
        $this->db->where("a.jenis",$jenis);
        $this->db->order_by('entry_time','ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_kode_supplier()
    {
        $this->db->select_max(" RIGHT(kode_supplier,4)", 'kd_max');//select
        $query = $this->db->get('supplier');
        $kd = "";
        if($query->num_rows()>0)
        {
            foreach($query->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }
        else
        {
            $kd = "0001";
        }
        return 'SPL'.$kd;
    }

    function get_kode_pembelian()
    {
        $this->db->select_max(" RIGHT(kode_pembelian,4)", 'kd_max');//select
        $query = $this->db->get('pembelian');
        $kd = "";
        if($query->num_rows()>0)
        {
            foreach($query->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }
        else
        {
            $kd = "0001";
        }
        return 'PBLN'.date('Ymd').$kd;
    }

    function get_no_invoice_pembelian()
    {
        $this->db->select_max(" RIGHT(no_invoice_pembayaran,4)", 'kd_max');//select
        $query = $this->db->get('pembelian');
        $kd = "";
        if($query->num_rows()>0)
        {
            foreach($query->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }
        else
        {
            $kd = "0001";
        }
        return 'INVBL'.date('Ymd').$kd;
    }

    function get_no_invoice_penjualan()
    {
        $this->db->select_max(" RIGHT(no_invoice_pembayaran,4)", 'kd_max');//select
        $query = $this->db->get('penjualan');
        $kd = "";
        if($query->num_rows()>0)
        {
            foreach($query->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }
        else
        {
            $kd = "0001";
        }
        return 'INVJL'.date('Ymd').$kd;
    }

    function get_list_pembelian($where){//status = input / belum_lunas / lunas
        $this->db->select("a.*,b.nama_supplier as nama_supplier,(select sum(qty) as total_qty from pembelian_detail where kode_pembelian=a.kode_pembelian) as total_qty");
        $this->db->from('pembelian a');
        $this->db->join('supplier b', 'a.kode_supplier= b.kode_supplier');
        $this->db->where($where);
        $this->db->order_by('kode_pembelian','ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_list_barang_pembelian($where){
        $this->db->select('a.*,b.nama as nama_barang,b.satuan as satuan');
        $this->db->from('pembelian_detail a');
        $this->db->join('barang b', 'a.kode_barang = b.kode');
        $this->db->where($where);
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        return $query;
    }

    function sum_total_pembelian_barang($kode_pembelian){
        $this->db->select_sum('subtotal');
        $this->db->where('kode_pembelian',$kode_pembelian);
        $query      = $this->db->get('pembelian_detail'); // Produces: SELECT SUM(age) as age FROM members
        $subtotal   = $query->row()->subtotal;
        $this->db->where('kode_pembelian',$kode_pembelian);
        $this->db->update('pembelian',['total_pembelian'=> $subtotal]);
        return TRUE;
    }

    function sum_total_penjualan_barang($kode_penjualan){
        $this->db->select_sum('subtotal');
        $this->db->where('kode_penjualan',$kode_penjualan);
        $query      = $this->db->get('penjualan_detail'); // Produces: SELECT SUM(age) as age FROM members
        $subtotal   = $query->row()->subtotal;
        $this->db->where('kode_penjualan',$kode_penjualan);
        $this->db->update('penjualan',['total_penjualan'=> $subtotal]);
        return TRUE;
    }

    public function get_no_registrasi_pelanggan(){
        $x                  = 0;
        $length             = 10;
        $characters         = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength   = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $kode = $randomString;

        while ($x==0){
            $this->db->where("no_registrasi ='".$kode."' ");
            $result=$this->db->get('user');
            if ($result->num_rows()==0){
                $no_reg = $kode;
                $x = 1;
            } else {
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                $kode=$randomString;
                $no_reg = 0;
            }
        }
        return $no_reg;

    }

    public function generate_password(){
        $x                  = 0;
        $length             = 8;
        $characters         = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength   = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function get_kode_penjualan()
    {
        $this->db->select_max(" RIGHT(kode_penjualan,4)", 'kd_max');//select
        $query = $this->db->get('penjualan');
        $kd = "";
        if($query->num_rows()>0)
        {
            foreach($query->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }
        else
        {
            $kd = "0001";
        }
        return 'PJLN'.date('Ymd').$kd;
    }

    public function get_antrian_penjualan($date){
        $this->db->select_max(" antrian", 'max');//select
        $this->db->where("date(tgl_penjualan) = '{$date}'"); //and status_penjualan in ('1','2','3')
        $query = $this->db->get('penjualan');
        $tmp = "";
        if($query->num_rows()>0)
        {
            foreach($query->result() as $k)
            {
                $tmp = ((int)$k->max)+1;
            }
        }
        else
        {
            $tmp = "1";
        }
        return $tmp;
    }

    function get_list_penjualan($where=null){//status = input / belum_lunas / lunas
        $this->db->select("a.*,b.nama as 'nama_pelanggan',c.merk as 'merk', c.tipe as 'tipe',b.telepon as telepon,b.alamat as alamat ");
        $this->db->from('penjualan a');
        $this->db->join('user b', 'a.no_pelanggan= b.no_registrasi');
        $this->db->join('kendaraan c', 'a.kode_kendaraan= c.id');
        if ($where!=null){
            $this->db->where($where);
        }
        $this->db->order_by('antrian','ASC');
        $query = $this->db->get();
        return $query;
    }

    function get_list_barang_penjualan($where){
        $this->db->select('a.*,b.nama as nama_barang,b.satuan as satuan,b.jenis as jenis');
        $this->db->from('penjualan_detail a');
        $this->db->join('barang b', 'a.kode_barang = b.kode');
        $this->db->where($where);
        $this->db->order_by('b.jenis','ASC');
        $query = $this->db->get();
        return $query;
    }

}
?>
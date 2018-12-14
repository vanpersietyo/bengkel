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
}
?>
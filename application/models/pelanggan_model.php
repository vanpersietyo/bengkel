<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 13/12/2018
 * Time: 17:09
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pelanggan_model extends CI_Model {

    public function insert_data($tabel,$data)
    {
        $this->db->insert($tabel,$data);
    }

    public function update_data($id,$valueid,$tabel,$data)
    {
        $this->db->where($id,$valueid);
        $this->db->update($tabel,$data);
    }

    public function delete_sessions($id,$valueid,$tabel)
    {
        $this->db->where($id,$valueid);
        $this->db->delete($tabel);
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

    function get_kode_kendaraan_user()
    {
        $x                  = 0;
        $length             = 10;
        $characters         = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength   = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $kode = $randomString;

        while ($x==0){
            $this->db->where("kode_kendaraan ='".$kode."' ");
            $result=$this->db->get('kendaraan_user');
            if ($result->num_rows()==0){
                $kode_kendaraan = $kode;
                $x = 1;
            } else {
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                $kode=$randomString;
                $kode_kendaraan = 0;
            }
        }
        return $kode_kendaraan;
        #TODO -- buat fungsi generate kode kendaraan acak
    }

    function get_list_kendaraan_user($kode_user){
        $this->db->select('a.*,b.merk as merk,b.tipe as tipe');
        $this->db->from('kendaraan_user a');
        $this->db->join('kendaraan b', 'a.id_kendaraan= b.id');
        $this->db->where('a.kode_user',$kode_user);
        $query = $this->db->get();
        return $query;
    }

    function get_kendaraan_user_by_kode($kode_kendaraan){
        $this->db->select('a.*,b.merk as merk,b.tipe as tipe');
        $this->db->from('kendaraan_user a');
        $this->db->join('kendaraan b', 'a.id_kendaraan= b.id');
        $this->db->where('a.kode_kendaraan',$kode_kendaraan);
        $query = $this->db->get();
        return $query;
    }
}

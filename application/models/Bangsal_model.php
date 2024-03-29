<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Bangsal_model extends CI_Model
{
    
    var $table = 'bangsal'; //nama tabel dari database
    var $column_order = array(null,  'nm_bangsal','status'); //field yang ada di table user
    var $column_search = array('nm_bangsal'); //field yang diizin untuk pencarian 
    var $order = array('kd_bangsal' => 'asc'); // default order    

    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get bangsal by kd_bangsal
     */
    function get_bangsal($kd_bangsal)
    {
        return $this->db->get_where('bangsal',array('kd_bangsal'=>$kd_bangsal))->row_array();
    }
        
    /*
     * Get all bangsal
     */
    function get_all_bangsal()
    {
        $this->db->order_by('kd_bangsal', 'desc');
        return $this->db->get('bangsal')->result_array();
    }
        
    /*
     * function to add new bangsal
     */
    function add_bangsal($params)
    {
        $this->db->insert('bangsal',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update bangsal
     */
    function update_bangsal($kd_bangsal,$params)
    {
        $this->db->where('kd_bangsal',$kd_bangsal);
        return $this->db->update('bangsal',$params);
    }
    
    /*
     * function to delete bangsal
     */
    function delete_bangsal($kd_bangsal)
    {
        return $this->db->delete('bangsal',array('kd_bangsal'=>$kd_bangsal));
    }

     private function _get_datatables_query()
    {
        
        $this->db->from($this->table);

        $i = 0;
    
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
        
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
 
}

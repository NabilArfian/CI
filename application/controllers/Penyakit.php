<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Penyakit extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Penyakit_model');
    } 

    /*
     * Listing of penyakit
     */
    function index()
    {
        $data['penyakit'] = $this->Penyakit_model->get_all_penyakit();
        
        $data['_view'] = 'penyakit/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new penyakit
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'nm_penyakit' => $this->input->post('nm_penyakit'),
				'ciri_ciri' => $this->input->post('ciri_ciri'),
				'status' => $this->input->post('status'),
            );
            
            $penyakit_id = $this->Penyakit_model->add_penyakit($params);
            redirect('penyakit/index');
        }
        else
        {            
            $data['_view'] = 'penyakit/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a penyakit
     */
    function edit($kd_penyakit)
    {   
        // check if the penyakit exists before trying to edit it
        $data['penyakit'] = $this->Penyakit_model->get_penyakit($kd_penyakit);
        
        if(isset($data['penyakit']['kd_penyakit']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'nm_penyakit' => $this->input->post('nm_penyakit'),
					'ciri_ciri' => $this->input->post('ciri_ciri'),
					'status' => $this->input->post('status'),
                );

                $this->Penyakit_model->update_penyakit($kd_penyakit,$params);            
                redirect('penyakit/index');
            }
            else
            {
                $data['_view'] = 'penyakit/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The penyakit you are trying to edit does not exist.');
    } 

    /*
     * Deleting penyakit
     */
    function remove($kd_penyakit)
    {
        $penyakit = $this->Penyakit_model->get_penyakit($kd_penyakit);

        // check if the penyakit exists before trying to delete it
        if(isset($penyakit['kd_penyakit']))
        {
            $this->Penyakit_model->delete_penyakit($kd_penyakit);
            redirect('penyakit/index');
        }
        else
            show_error('The penyakit you are trying to delete does not exist.');
    }
    
}

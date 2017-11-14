<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// -- settings -- \\
class M_settings extends CI_Model {
    //-- settings page --\\
    function get_angkatan_array($batas=null, $offset=null, $key=null) {
        $this->db->select('a.*,a.id as alumni_id');
        $this->db->from('alumni as a');
        if($batas != null){
           $this->db->limit($batas,$offset);
        }
        if ($key != null) {
           $this->db->or_like($key);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function count_angkatan_array(){
        $this->db->select('a.*,a.id as alumni_id');
        $this->db->from('alumni as a');
        $query = $this->db->get()->num_rows();
        return $query;
    }

    function count_angkatan_array_search($orlike) {
        $this->db->or_like($orlike);
        $this->db->select('a.*,a.id as alumni_id');
        $this->db->from('alumni as a');
        $query = $this->db->get();
        return $query->num_rows();
    }

    function validate_link_website_angkatan($key) {
      $this->db->select('a.id');
      $this->db->from('alumni a');
      $this->db->where('website',$key);
      $query = $this->db->get();
       if($query->num_rows() > 0){
          $this->form_validation->set_message('unique_url', 'link sudah dipakai periksa kembali');
          return false;
       } else {
          return true;
       }
    }

    function save_angkatan($data) {
      return $this->db->insert('alumni', $data);
      // return $this->db->insert_id();
    }

    function validate_add() {
         $data = array();
         $data['error_string'] = array();
         $data['inputerror'] = array();
         $data['status'] = TRUE;

         $firstname = $this->input->post('firstname');
         if(!empty($firstname))
            {
                foreach($firstname as $id => $value)
                {
                    $this->form_validation->set_rules('firstname['.$id.']', 'nama depan', 'trim|required');
                    $this->form_validation->set_rules('lastname['.$id.']', 'nama belakang', 'trim|required');
                    $this->form_validation->set_rules('angkatan['.$id.']', 'angkatan ke', 'trim|required');
                    $this->form_validation->set_rules('biography['.$id.']', 'deskripsi tentang alumni', 'trim|required');
                    $this->form_validation->set_rules('phone['.$id.']', 'no telp/handphone', 'trim|required');
                    $this->form_validation->set_rules('email['.$id.']', 'email', 'trim|required|valid_email|is_unique[alumni.email]');
                    $this->form_validation->set_rules('website['.$id.']', 'link url', 'trim|required|callback_unique_url|prep_url');
                }
            }

         $this->form_validation->set_error_delimiters('', '');
         $this->form_validation->run();

         $loop = $this->input->post('firstname');
         if(!empty($loop))
            {
                foreach($loop as $id => $value)
                {
                    if(form_error('firstname['.$id.']')!= '')
                    {
                        $data['inputerror'][] = 'firstname['.$id.']';
                        $data['error_id'][] = 'firstname_'.$id.'';
                        $string = form_error('firstname['.$id.']');
                        $result = str_replace(array('</p>', '<p>'), '', $string);
                        $data['error_string'][] = $result;
                        $data['status'] = FALSE;
                    }

                    if(form_error('lastname['.$id.']')!= '')
                    {
                        $data['inputerror'][] = 'lastname['.$id.']';
                        $data['error_id'][] = 'lastname_'.$id.'';
                        $string = form_error('lastname['.$id.']');
                        $result = str_replace(array('</p>', '<p>'), '', $string);
                        $data['error_string'][] = $result;
                        $data['status'] = FALSE;
                    }

                    if(form_error('angkatan['.$id.']')!= '')
                    {
                        $data['inputerror'][] = 'angkatan['.$id.']';
                        $data['error_id'][] = 'angkatan_'.$id.'';
                        $string = form_error('angkatan['.$id.']');
                        $result = str_replace(array('</p>', '<p>'), '', $string);
                        $data['error_string'][] = $result;
                        $data['status'] = FALSE;
                    }

                    if(form_error('email['.$id.']')!= '')
                    {
                        $data['inputerror'][] = 'email['.$id.']';
                        $data['error_id'][] = 'email_'.$id.'';
                        $string = form_error('email['.$id.']');
                        $result = str_replace(array('</p>', '<p>'), '', $string);
                        $data['error_string'][] = $result;
                        $data['status'] = FALSE;
                    }

                    if(form_error('website['.$id.']')!= '')
                    {
                        $data['inputerror'][] = 'website['.$id.']';
                        $data['error_id'][] = 'website_'.$id.'';
                        $string = form_error('website['.$id.']');
                        $result = str_replace(array('</p>', '<p>'), '', $string);
                        $data['error_string'][] = $result;
                        $data['status'] = FALSE;
                    }

                    $allowed =  array('png','jpg','jpeg','PNG','JPG','JPEG');

                    if (isset($_FILES['file_image['.$id.']'])){
                        $new = $_FILES['file_image['.$id.']']['name'];

                        $ext = pathinfo($new, PATHINFO_EXTENSION);
                        if(!in_array($ext,$allowed) ) {
                            $data['inputerror'][] = 'file_image['.$id.']';
                            $data['error_id'][] = 'file_image_'.$id.'';
                            $string = 'Type File PNG JPG JPEG';

                            $result = str_replace(array('</p>', '<p>'),'',$string);
                            $data['error_string'][] = $result;
                            $data['status'] = FALSE;
                        }
                    }
                }
            }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }
}

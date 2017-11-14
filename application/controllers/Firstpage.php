<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Firstpage extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        //models connection back-end
        $this->load->model('M_settings', 'settings');// jangan lupa load model nya ya gan
        $this->load->helper(array('url'));
        //end models connection back-end
    }
    public function index() {
      //-- pagination --//
      $page=$this->input->get('per_page');
      $batas=6; //jlh data yang ditampilkan per halaman
      if(!$page):     //jika page bernilai kosong maka batas akhirna akan di set 0
         $offset = 0;
      else:
         $offset = $page; // jika tidak kosong maka nilai batas akhir nya akan diset nilai page terakhir
      endif;

      $config['page_query_string'] = TRUE; //mengaktifkan pengambilan method get pada url default
      $config['base_url'] = base_url().'firstpage?';   //url yang muncul ketika tombol pada paging diklik
      $config['total_rows'] = $this->settings->count_angkatan_array(); // jlh total article
      $config['per_page'] = $batas; //batas sesuai dengan variabel batas
      $config['uri_segment'] = $page; //merupakan posisi pagination dalam url pada kesempatan ini saya menggunakan method get untuk menentukan posisi pada url yaitu per_page

      $config['full_tag_open'] = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = '&laquo; First';
      $config['first_tag_open'] = '<li class="prev page">';
      $config['first_tag_close'] = '</li>';

      $config['last_link'] = 'Last &raquo;';
      $config['last_tag_open'] = '<li class="next page">';
      $config['last_tag_close'] = '</li>';

      $config['next_link'] = 'Next &rarr;';
      $config['next_tag_open'] = '<li class="next page">';
      $config['next_tag_close'] = '</li>';

      $config['prev_link'] = '&larr; Prev';
      $config['prev_tag_open'] = '<li class="prev page">';
      $config['prev_tag_close'] = '</li>';

      $config['cur_tag_open'] = '<li class="current"><a href="">';
      $config['cur_tag_close'] = '</a></li>';

      $config['num_tag_open'] = '<li class="page">';
      $config['num_tag_close'] = '</li>';
      $this->pagination->initialize($config);

      $this->data['pagination']=$this->pagination->create_links();

      $this->data['jlhpage']=$page;
      // end pagination
      // get article list
      $this->data['angkatan_data'] = $this->settings->get_angkatan_array($batas,$offset);
      //main content
      $this->load->view('v_angkatan', $this->data);
      //end main content
   }
   public function add() {
      $this->settings->validate_add();    // validasi file
          if(empty($_FILES['file_image']['tmp_name'])) {
            $firstname = count($this->input->post('firstname'));
            for($i = 0; $i < $firstname; $i++) {
                $data = array (
                 'img' => "",
                 'date_created' => date("Y-m-d"),
                 'firstname' => $_POST['firstname'][$i],
                 'lastname' => $_POST['lastname'][$i],
                 'phone' => $_POST['phone'][$i],
                 'email' => $_POST['email'][$i],
                 'biography' => $_POST['biography'][$i],
                 'angkatan' => $_POST['angkatan'][$i],
                 'website' => $_POST['website'][$i]
                );
                $insert = $this->settings->save_angkatan($data);
            }


        echo json_encode(array("status" => TRUE));

        } else {
        // cek berapa file yang akan di upload;
        $number_of_files = sizeof($_FILES['file_image']['tmp_name']);
        $firstname = count($this->input->post('firstname'));
        $files = $_FILES['file_image'];
        $errors = array();
        if(isset($_FILES['file_image'])){
             for($i = 0; $i < $firstname; $i++) {
             $this->image_path = realpath(APPPATH.'../image/alumni');
             $this->image_path_url = base_url().'image/alumni';
                $config = array(
                    'allowed_types' => 'jpg|gif|GIF|jpeg|png|JPG|JPEG|PNG',
                    'upload_path'     => $this->image_path,
                    'encrypt_name'     => TRUE
                );
                if(!empty($files['name'][$i])) {
                    $_FILES['file_image']['name']         = $files['name'][$i];
                    $_FILES['file_image']['type']         = $files['type'][$i];
                    $_FILES['file_image']['tmp_name']     = $files['tmp_name'][$i];
                    $_FILES['file_image']['error']         = $files['error'][$i];
                    $_FILES['file_image']['size']         = $files['size'][$i];
                        $this->load->library('upload');
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('file_image')) {
                            $upload_data = $this->upload->data();

                            $image_config["image_library"] = "gd2";
                            $image_config["source_image"] = $this->image_path . '/' . $upload_data['file_name'];
                            $image_config['create_thumb'] = FALSE;
                            $image_config['maintain_ratio'] = FALSE;
                            $image_config['new_image'] = $this->image_path . '/' . $upload_data['file_name'];
                            $image_config['quality'] = "100%";
                            $image_config['width'] = 320;
                            $image_config['height'] = 480;
                            //$dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($image_config['width'] / $image_config['height']);
                            //$image_config['master_dim'] = ($dim > 0)? "height" : "width";
                            $this->load->library('image_lib');
                            $this->image_lib->initialize($image_config);
                            $this->image_lib->resize();

                            $data = array (
                             'img' => $upload_data["file_name"],
                             'date_created' => date("Y-m-d"),
                             'firstname' => $_POST['firstname'][$i],
                             'lastname' => $_POST['lastname'][$i],
                             'phone' => $_POST['phone'][$i],
                             'email' => $_POST['email'][$i],
                             'biography' => $_POST['biography'][$i],
                             'angkatan' => $_POST['angkatan'][$i],
                             'website' => $_POST['website'][$i]
                            );
                        } else {
                            $data['upload_errors'][$i] = $this->upload->display_errors();
                        }

                    } else {
                        $data = array (
                         'img' => "",
                         'date_created' => date("Y-m-d"),
                         'firstname' => $_POST['firstname'][$i],
                         'lastname' => $_POST['lastname'][$i],
                         'phone' => $_POST['phone'][$i],
                         'email' => $_POST['email'][$i],
                         'biography' => $_POST['biography'][$i],
                         'angkatan' => $_POST['angkatan'][$i],
                         'website' => $_POST['website'][$i]
                        );
                    }
                $insert = $this->settings->save_angkatan($data);
                }
            }
            echo json_encode(array("status" => TRUE));
        }
    }
    function unique_url($key) {
        return $this->settings->validate_link_website_angkatan($key);
    }
}

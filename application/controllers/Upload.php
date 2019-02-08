<?php
header('Access-Control-Allow-Origin: *');
class Upload extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->helper(array('form', 'url'));
        }

        public function index()
        {
            $this->load->view('Formup', array('error' => ' ' ));
        }

        public function uploadImage(){
            $up_config['upload_path'] = './assets/uploads';
            $up_config['allowed_types'] = 'gif|jpg|png';
            $up_config['overwrite'] = TRUE;

            $this->load->library('upload', $up_config);

            if($this->upload->do_upload('Imagem')){
               $data_image = $this->upload->data();

               echo json_encode($data_image['file_name']);
            }else{
               echo json_encode($this->upload->display_errors());
            }
        }

        public function cropImage()
        {
			if($this->input->post(NULL, FALSE)){

				$img_config['source_image'] = './assets/uploads/'.$this->input->post('name_file');
				$img_config['maintain_ratio'] = FALSE;
				$img_config['dynamic_output'] = TRUE;

				$img_config['x_axis'] = $this->input->post('x');
				$img_config['y_axis'] = $this->input->post('y');
				$img_config['width'] = $this->input->post('w');
				$img_config['height'] = $this->input->post('h');

				$this->load->library('image_lib', $img_config);

				if(!$this->image_lib->crop()){
					echo $this->upload->display_errors();
				}else{

				}

		  	}

        }
}
?>

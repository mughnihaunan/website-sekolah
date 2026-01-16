<?php

/**
 * 
 */
class AdminGaleri extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (cek_login() === 'noLogin') {
			redirect('auth/login');
			return false;
		}

		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Model_galeri', 'galeri');
	}

	public function index()
	{
		$this->foto();
	}

	public function foto()
	{
		$data['foto'] = $this->galeri->getFoto(15);
		$this->template->load('templateAdmin', 'admin/foto/foto', $data);
	}

	public function ajaxGetFoto()
	{
		$data = $this->galeri->getFoto(15, $this->input->get('offset'));
		if ($data) {
			echo json_encode($data);
		} else {
			echo json_encode(null);
		}
		return true;
	}

	public function insertFoto()
	{

		if (isset($_POST['submit'])) {

			$url_foto = '';

			// Check if file is uploaded
			if (!empty($_FILES['file_foto']['name'])) {
				// Configure upload
				$config['upload_path'] = './assets/uploads/galeri/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
				$config['max_size'] = 2048; // 2MB
				$config['encrypt_name'] = TRUE;

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('file_foto')) {
					$upload_data = $this->upload->data();
					$url_foto = base_url('assets/uploads/galeri/' . $upload_data['file_name']);
				} else {
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect('adminGaleri/insertFoto');
					return false;
				}
			} else {
				// Use URL if no file uploaded
				$url_foto = $this->input->post('url_foto', true);
			}

			// Validate
			if (empty($url_foto)) {
				$this->session->set_flashdata('error', '<p class="warning">Harap upload foto atau masukkan URL!</p>');
				redirect('adminGaleri/insertFoto');
				return false;
			}

			$this->form_validation->set_rules('keterangan', 'keterangan', 'required', message_id());
			$this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

			if (!$this->form_validation->run()) {
				generate_errors(['keterangan']);
				redirect('adminGaleri/insertFoto');
				return false;

			} else {

				// Insert with uploaded URL
				$data = [
					'foto_id' => $this->uuid->generate_uuid(),
					'url_foto' => $url_foto,
					'keterangan' => $this->input->post('keterangan', true),
					'post' => time()
				];
				$this->db->insert('foto', $data);

				$this->session->set_flashdata('success', 'Foto berhasil diupload!');
				redirect('adminGaleri/foto');
				return true;
			}

		} else {
			$data['errors'] = get_errors();
			$data['old_value'] = get_old_value();
			$data['error'] = $this->session->flashdata('error');
			$data['success'] = $this->session->flashdata('success');
			$this->template->load('templateAdmin', 'admin/foto/insertFoto', $data);
		}
	}

	public function editFoto()
	{

		if (isset($_POST['submit'])) {

			$foto_id = $this->input->post('foto_id', true);
			$url_foto = '';

			// Check if new file is uploaded
			if (!empty($_FILES['file_foto']['name'])) {
				// Configure upload
				$config['upload_path'] = './assets/uploads/galeri/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
				$config['max_size'] = 2048; // 2MB
				$config['encrypt_name'] = TRUE;

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('file_foto')) {
					$upload_data = $this->upload->data();
					$url_foto = base_url('assets/uploads/galeri/' . $upload_data['file_name']);
				} else {
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect('adminGaleri/editFoto/' . $foto_id);
					return false;
				}
			} else {
				// Use URL from form
				$url_foto = $this->input->post('url_foto', true);
			}

			// Validate
			if (empty($url_foto)) {
				$this->session->set_flashdata('error', '<p class="warning">Harap upload foto baru atau masukkan URL!</p>');
				redirect('adminGaleri/editFoto/' . $foto_id);
				return false;
			}

			$this->form_validation->set_rules('keterangan', 'keterangan', 'required', message_id());
			$this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

			if (!$this->form_validation->run()) {
				generate_errors(['keterangan'], false);
				redirect('adminGaleri/editFoto/' . $foto_id);
				return false;

			} else {

				// Update foto
				$data = [
					'url_foto' => $url_foto,
					'keterangan' => $this->input->post('keterangan', true),
					'post' => time()
				];
				$this->db->where('foto_id', $foto_id);
				$this->db->update('foto', $data);

				$this->session->set_flashdata('success', 'Foto berhasil diupdate!');
				redirect('adminGaleri/foto');
				return true;
			}

		} else {
			$data['errors'] = get_errors();
			$data['error'] = $this->session->flashdata('error');
			$data['success'] = $this->session->flashdata('success');
			$data['foto'] = $this->galeri->getOneFoto();
			$this->template->load('templateAdmin', 'admin/foto/editFoto', $data);
		}
	}

	public function deleteFoto()
	{
		$this->galeri->deleteFoto();
		redirect('adminGaleri/foto');
		return true;
	}

	//video
	public function video()
	{
		$data['video'] = $this->galeri->getVideo(6);
		$this->template->load('templateAdmin', 'admin/video/video', $data);
	}

	public function ajaxGetVideo()
	{
		$data = $this->galeri->getVideo(6, $this->input->get('offset'));
		if ($data) {
			echo json_encode($data);
		} else {
			echo json_encode(null);
		}
		return true;
	}

	public function insertVideo()
	{

		if (isset($_POST['submit'])) {

			$this->form_validation->set_rules('url_video', 'Url video', 'required|max_length[100]', message_id());
			$this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

			if (!$this->form_validation->run()) {
				generate_errors(['url_video']);
				redirect('adminGaleri/insertVideo');

			} else {

				$this->galeri->insertVideo();
				redirect('adminGaleri/video');
			}

		} else {
			$data['errors'] = get_errors();
			$data['old_value'] = get_old_value();
			$this->template->load('templateAdmin', 'admin/video/insertVideo', $data);
		}
	}

	public function editVideo()
	{

		if (isset($_POST['submit'])) {

			$this->form_validation->set_rules('url_video', 'Url video', 'required|max_length[100]', message_id());
			$this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

			if (!$this->form_validation->run()) {
				generate_errors(['url_video'], false);
				redirect('adminGaleri/editVideo/' . $this->input->post('video_id'));

			} else {

				$this->galeri->editVideo();
				redirect('adminGaleri/video');
			}

		} else {
			$data['errors'] = get_errors();
			$data['video'] = $this->galeri->getOneVideo();
			$this->template->load('templateAdmin', 'admin/video/editVideo', $data);
		}
	}

	public function deleteVideo()
	{
		$this->galeri->deleteVideo();
		redirect('adminGaleri/video');
	}
}
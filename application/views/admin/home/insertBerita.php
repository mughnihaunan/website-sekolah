<div class="col-md-10 col-md-offset-1 nopadding-all marginTop60px marginBottom50px">
	<h3 class="judulAbuAbu alignCenter">Insert Berita</h3>
	<hr>

	<?php if (!empty($error)): ?>
		<div class="alert alert-danger"><?= $error; ?></div>
	<?php endif; ?>

	<?= form_open_multipart('adminHome/insertBerita', ['class' => 'form']); ?>
	<?= $errors['judulBesar'] ?? ''; ?>
	<div class="form-group">
		<label><strong>Judul Besar:</strong></label>
		<input type="text" name="judulBesar" placeholder="Judul utama berita" class="form-control"
			value="<?= $old_value['judulBesar'] ?? ''; ?>">
	</div>

	<?= $errors['judulKecil'] ?? ''; ?>
	<div class="form-group">
		<label><strong>Judul Kecil (opsional):</strong></label>
		<input type="text" name="judulKecil" placeholder="Sub judul" class="form-control"
			value="<?= $old_value['judulKecil'] ?? ''; ?>">
	</div>

	<!-- Upload Image Section -->
	<div class="form-group">
		<label><strong>Gambar Utama:</strong></label>
		<label for="file_image" class="upload-area" id="uploadArea">
			<div class="upload-icon">
				<span class="glyphicon glyphicon-picture" style="font-size: 36px; color: #2E7D32;"></span>
			</div>
			<p>Klik atau drag & drop gambar</p>
			<p class="text-muted" style="font-size: 11px;">Format: JPG, PNG, GIF (Max: 2MB)</p>
			<input type="file" name="file_image" id="file_image" accept="image/*" class="file-input-hidden">
		</label>
		<div id="imagePreview" style="display: none; margin-top: 15px; text-align: center;">
			<img id="previewImg" src="" alt="Preview" style="max-width: 100%; max-height: 200px; border-radius: 8px;">
			<br>
			<button type="button" class="btn btn-sm btn-danger" id="removeImage" style="margin-top: 10px;">
				<span class="glyphicon glyphicon-trash"></span> Hapus
			</button>
		</div>
	</div>

	<div class="divider-text" style="text-align: center; margin: 15px 0; color: #999;">
		<span style="background: #fff; padding: 0 15px;">ATAU</span>
	</div>

	<?= $errors['urlImgUtama'] ?? ''; ?>
	<div class="form-group">
		<label><strong>URL Gambar (opsional):</strong></label>
		<input type="text" name="urlImgUtama" id="urlImgUtama" placeholder="https://example.com/image.jpg"
			class="form-control" value="<?= $old_value['urlImgUtama'] ?? ''; ?>">
	</div>

	<?= $errors['isi'] ?? ''; ?>
	<div class="form-group">
		<label><strong>Isi Berita:</strong></label>
		<textarea class="ckeditor" id="ckeditor" name="isi"><?= $old_value['isi'] ?? ''; ?></textarea>
	</div>

	<div class="form-group" style="margin-top: 20px;">
		<button type="submit" name="submit" class="btn btn-success btn-lg">
			<span class="glyphicon glyphicon-save"></span> Simpan Berita
		</button>
		<a href="<?= base_url('adminHome'); ?>" class="btn btn-danger btn-lg">
			<span class="glyphicon glyphicon-remove"></span> Batal
		</a>
	</div>
	</form>
</div>

<style>
	.upload-area {
		border: 2px dashed #2E7D32;
		border-radius: 12px;
		padding: 25px 20px;
		text-align: center;
		cursor: pointer;
		transition: all 0.3s ease;
		background: #f8fff8;
		display: block;
	}

	.upload-area:hover {
		background: #e8f5e9;
		border-color: #1B5E20;
	}

	.upload-area p {
		margin: 8px 0 0;
		color: #555;
	}

	.file-input-hidden {
		position: absolute;
		left: -9999px;
		opacity: 0;
	}

	.divider-text {
		position: relative;
	}

	.divider-text::before,
	.divider-text::after {
		content: '';
		position: absolute;
		top: 50%;
		width: 40%;
		height: 1px;
		background: #ddd;
	}

	.divider-text::before {
		left: 0;
	}

	.divider-text::after {
		right: 0;
	}
</style>

<script>
	$(document).ready(function () {
		var fileInput = $('#file_image');
		var preview = $('#imagePreview');
		var previewImg = $('#previewImg');
		var uploadArea = $('#uploadArea');

		fileInput.change(function () {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					previewImg.attr('src', e.target.result);
					uploadArea.hide();
					preview.show();
					$('#urlImgUtama').val('');
				}
				reader.readAsDataURL(this.files[0]);
			}
		});

		$('#removeImage').click(function () {
			fileInput.val('');
			preview.hide();
			uploadArea.show();
		});

		uploadArea.on('dragover', function (e) { e.preventDefault(); $(this).addClass('dragover'); });
		uploadArea.on('dragleave', function (e) { e.preventDefault(); $(this).removeClass('dragover'); });
		uploadArea.on('drop', function (e) {
			e.preventDefault(); $(this).removeClass('dragover');
			if (e.originalEvent.dataTransfer.files.length > 0) {
				fileInput[0].files = e.originalEvent.dataTransfer.files;
				fileInput.trigger('change');
			}
		});
	});
</script>
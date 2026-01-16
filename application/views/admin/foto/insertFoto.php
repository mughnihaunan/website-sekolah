<div class="col-md-8 col-md-offset-2 marginTop60px">
	<h3 class="judulAbuAbu alignCenter">Insert Foto</h3>
	<hr>

	<?php if (!empty($error)): ?>
		<div class="alert alert-danger"><?= $error; ?></div>
	<?php endif; ?>
	<?php if (!empty($success)): ?>
		<div class="alert alert-success"><?= $success; ?></div>
	<?php endif; ?>

	<?= form_open_multipart('adminGaleri/insertFoto', ['class' => 'form', 'id' => 'uploadForm']); ?>

	<!-- Upload File Section -->
	<div class="form-group">
		<label><strong>Upload Foto dari Komputer:</strong></label>
		<label for="file_foto" class="upload-area" id="uploadArea">
			<div class="upload-icon">
				<span class="glyphicon glyphicon-cloud-upload" style="font-size: 48px; color: #2E7D32;"></span>
			</div>
			<p>Klik atau drag & drop foto di sini</p>
			<p class="text-muted" style="font-size: 12px;">Format: JPG, PNG, GIF (Max: 2MB)</p>
			<input type="file" name="file_foto" id="file_foto" accept="image/*" class="file-input-hidden">
		</label>
		<div id="imagePreview" style="display: none; margin-top: 15px; text-align: center;">
			<img id="previewImg" src="" alt="Preview"
				style="max-width: 100%; max-height: 300px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
			<br>
			<button type="button" class="btn btn-sm btn-danger" id="removeImage" style="margin-top: 10px;">
				<span class="glyphicon glyphicon-trash"></span> Hapus
			</button>
		</div>
	</div>

	<div class="divider-text" style="text-align: center; margin: 20px 0; color: #999;">
		<span style="background: #fff; padding: 0 15px;">ATAU</span>
	</div>

	<!-- URL Input Section -->
	<div class="form-group">
		<label for="url_foto"><strong>Gunakan URL Foto:</strong></label>
		<?= $errors['url_foto'] ?? ''; ?>
		<input type="text" name="url_foto" id="url_foto" placeholder="https://example.com/image.jpg"
			class="form-control" value="<?= $old_value['url_foto'] ?? ''; ?>">
		<p class="text-muted" style="font-size: 12px;">Masukkan URL jika foto sudah ada di internet</p>
	</div>

	<!-- Keterangan -->
	<div class="form-group">
		<label for="keterangan"><strong>Keterangan Foto:</strong></label>
		<?= $errors['keterangan'] ?? ''; ?>
		<textarea placeholder="Masukkan keterangan foto..." name="keterangan" id="keterangan" class="form-control"
			rows="3"><?= $old_value['keterangan'] ?? ''; ?></textarea>
	</div>

	<div class="form-group" style="margin-top: 20px;">
		<button type="submit" name="submit" class="btn btn-success btn-lg">
			<span class="glyphicon glyphicon-cloud-upload"></span> Upload & Simpan
		</button>
		<a href="<?= base_url('adminGaleri/foto') ?>" class="btn btn-danger btn-lg">
			<span class="glyphicon glyphicon-remove"></span> Batal
		</a>
	</div>
	</form>
</div>

<style>
	.upload-area {
		border: 3px dashed #2E7D32;
		border-radius: 12px;
		padding: 40px 20px;
		text-align: center;
		cursor: pointer;
		transition: all 0.3s ease;
		background: #f8fff8;
	}

	.upload-area:hover,
	.upload-area.dragover {
		background: #e8f5e9;
		border-color: #1B5E20;
	}

	.upload-area p {
		margin: 10px 0 0;
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
		var uploadArea = $('#uploadArea');
		var fileInput = $('#file_foto');
		var preview = $('#imagePreview');
		var previewImg = $('#previewImg');
		var urlInput = $('#url_foto');

		// Click to upload
		uploadArea.click(function () {
			fileInput.click();
		});

		// Drag and drop
		uploadArea.on('dragover', function (e) {
			e.preventDefault();
			$(this).addClass('dragover');
		});

		uploadArea.on('dragleave', function (e) {
			e.preventDefault();
			$(this).removeClass('dragover');
		});

		uploadArea.on('drop', function (e) {
			e.preventDefault();
			$(this).removeClass('dragover');
			var files = e.originalEvent.dataTransfer.files;
			if (files.length > 0) {
				fileInput[0].files = files;
				showPreview(files[0]);
			}
		});

		// File input change
		fileInput.change(function () {
			if (this.files && this.files[0]) {
				showPreview(this.files[0]);
				urlInput.val(''); // Clear URL if file is selected
			}
		});

		// Show preview
		function showPreview(file) {
			var reader = new FileReader();
			reader.onload = function (e) {
				previewImg.attr('src', e.target.result);
				uploadArea.hide();
				preview.show();
			}
			reader.readAsDataURL(file);
		}

		// Remove image
		$('#removeImage').click(function () {
			fileInput.val('');
			preview.hide();
			uploadArea.show();
		});
	});
</script>
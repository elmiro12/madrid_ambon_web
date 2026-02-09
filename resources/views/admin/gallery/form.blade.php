<div class="row g-2">
    @if(isset($gallery))
        <input type="hidden" name="id" value="{{ $gallery->id }}"/>
    @endif
    <input type="hidden" name="is_image" value="{{ $is_image ? 1:0 }}" />
    <div class="col-md-6 col-sm-6 mb-3">
        <label for="title" class="form-label">Judul</label>
        <input type="text" name="title" class="form-control" value="{{ isset($gallery->title) ? $gallery->title : old('title') }}" required>
    </div>
    <div class="col-md-6 col-sm-6 mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <input type="text" name="deskripsi" class="form-control" value="{{ isset($gallery->deskripsi) ? $gallery?->deskripsi : old('deskripsi') }}">
    </div>
    @if($is_image)
        <div class="col-md-10 mb-3">
            <!-- Form untuk Gambar -->
            <div id="imageForm" class="mb-3" style="display: {{ $is_image ? 'block' : 'none' }};">
                <label for="images" class="form-label">Pilih Gambar</label>
                <input type="file" class="form-control" id="images" name="images[]" multiple>
            </div>
            @if(isset($gallery))

                <p class="text-muted text-sm"><i>Biarkan kosong jika tidak ingin mengganti gambar</i></p>
            @endif
        </div>
    @else
        <div class="col-12">
            <!-- Form untuk Video -->
            <div id="videoForm" class="mb-3" style="display: {{ !$is_image ? 'block' : 'none' }};">
                <label for="video_embed" class="form-label">Embed Video</label>
                <!-- Video Embed Textarea Dinamis -->
                <div id="videoInputs">
                    <div class="video-input-group">
                        <textarea class="form-control" name="video_embed[]" rows="3" placeholder="Paste embed code video"></textarea>
                        <button type="button" class="btn btn-danger btn-sm remove-video my-2" disabled>Remove</button>
                    </div>
                </div>
                <button type="button" class="btn btn-info mt-2" id="addVideoInput">Tambah Video</button>
            </div>
            <p class="text-muted text-sm"><i>Paste Embed Code iframe dari Youtube/Video Platform Lainnya</i></p>
        </div>
    @endif
</div>
<button type="submit" class="btn bg-primary text-white mt-3">Simpan</button>

@section('custom-js')
<script>
    // Menambahkan textarea embed video baru
    document.getElementById('addVideoInput').addEventListener('click', function() {
        var videoInputs = document.getElementById('videoInputs');
        var newInputGroup = document.createElement('div');
        newInputGroup.classList.add('video-input-group');

        newInputGroup.innerHTML = `
            <textarea class="form-control" name="video_embed[]" rows="3" placeholder="Paste embed code video"></textarea>
            <button type="button" class="btn btn-danger btn-sm remove-video my-2">Remove</button>
        `;

        videoInputs.appendChild(newInputGroup);
        updateRemoveButtons();  // Perbarui tombol Remove setelah menambah input
    });

    // Fungsi untuk memperbarui status tombol Remove
    function updateRemoveButtons() {
        var removeButtons = document.querySelectorAll('.remove-video');
        removeButtons.forEach(function(button, index) {
            if (removeButtons.length > 1) {
                button.disabled = false;  // Enable tombol Remove jika lebih dari 1 input
            } else {
                button.disabled = true;   // Disable tombol Remove jika hanya 1 input
            }
        });
    }

    // Menghapus input video
    document.getElementById('videoInputs').addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('remove-video')) {
            event.target.parentElement.remove();  // Hapus grup input video
            updateRemoveButtons();  // Perbarui tombol Remove setelah penghapusan
        }
    });

    // Jalankan updateRemoveButtons setelah form dimuat untuk memastikan tombol Remove pada input pertama ter-disable
    updateRemoveButtons();
</script>
@endsection

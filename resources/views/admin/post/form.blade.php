<div class="row g-2">
    @if(isset($post))
        <input type="hidden" name="id" value="{{ $post->id }}"/>
    @endif
    <div class="col-md-4 col-sm-6 mb-3">
        <label for="title" class="form-label">Judul Berita</label>
        <input type="text" name="title" class="form-control" value="{{ isset($post->title) ? $post->title : old('title') }}" required>
    </div>
    <div class="col-md-4 col-sm-6 mb-3">
        <label for="title" class="form-label">Deskripsi</label>
        <input type="text" name="summary" class="form-control" value="{{ isset($post->summary) ? $post->summary : old('summary') }}" required>
    </div>
    <div class="col-md-4 col-sm-6 mb-3">
        <label for="category_id" class="form-label">Kategory</label>
        <select name="category_id" class="form-select">
            <option value="">Tidak ada</option>
            @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ (isset($post) && $post->category_id == $category->id) ? 'selected' : ''  }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 col-sm-6 mb-3">
        <label for="image" class="form-label">Gambar</label>
        <input type="file" name="image" class="form-control">
        <span class="text-muted text-sm"><i>{{ isset($post) ? 'biarkan kosong jika tidak ingin merubah gambar' : 'upload gambar berita' }}</i></span>
    </div>
    <div class="col-md-4 col-sm-6 mb-3">
        <label for="is_published" class="form-label">Aktif</label>
        <select name="is_published" class="form-select">
            <option value="1" {{ (isset($post) && $post->is_published) ? 'selected' : '' }}>Ya</option>
            <option value="0" {{ (isset($post) && !$post->is_published) ? 'selected' : '' }}>Tidak</option>
        </select>
    </div>
    <div class="col-md-4 col-sm-6 mb-3">
        <label for="image" class="form-label">Keywords (Pencarian Google)</label>
        <input type="text" name="keywords" class="form-control" value="{{ isset($post->keywords) ? $post->keywords : old('keywords') }}">
        <i class="text-mute text-sm">pisahkan dengan tanda koma (,)</i>
    </div>
    <div class="col-12">
        <label for="content" class="form-label">Kontent</label>
        <textarea name="content" id="content" class="form-control" required>{!! isset($post) ? $post->content : '' !!}</textarea>
    </div>
</div>
<a href="{{ route('admin.posts.index') }}" class="btn bg-secondary text-white mt-3"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
<button type="submit" class="btn bg-primary text-white mt-3">Simpan</button>

<div class="row g-2">
    @if(isset($page))
        <input type="hidden" name="id" value="{{ $page->id }}"/>
    @endif
    <div class="col-md-4 col-sm-6 mb-3">
        <label for="title" class="form-label">Judul Halaman</label>
        <input type="text" name="title" class="form-control" value="{{ isset($page->title) ? $page->title : old('title') }}" required>
    </div>
    <div class="col-md-4 col-sm-6 mb-3">
        <label for="menu_id" class="form-label">Menu</label>
        <select name="menu_id" class="form-select">
            <option value="">Tidak ada</option>
            @foreach($menus as $menu)
                    <option value="{{ $menu->id }}" {{ (isset($page) && $page->menu_id == $menu->id) ? 'selected' : ''  }}>{{ $menu->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 col-sm-6 mb-3">
        <label for="image" class="form-label">Icon</label>
        <input type="text" name="icon" class="form-control" value="{{ isset($page->icon) ? $page?->icon : '' }}">
        <span class="text-muted text-sm"><i>Icon hanya untuk halaman yang memiliki menu</i></span>
        <a href="https://fontawesome.com/icons" target="_blank" class="text-decoration-none">Lihat Daftar Icon</a>
    </div>
    <div class="col-md-4 col-sm-6 mb-3">
        <label for="image" class="form-label">Gambar</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="col-md-4 col-sm-6 mb-3">
        <label for="is_carousel" class="form-label">Halaman Utama</label>
        <select name="is_carousel" class="form-select">
            <option value="1" {{ (isset($page) && $page->is_carousel) ? 'selected' : '' }}>Ya</option>
            <option value="0" {{ (isset($page) && !$page->is_carousel) ? 'selected' : '' }}>Tidak</option>
        </select>
    </div>
    <div class="col-md-4 col-sm-6 mb-3">
        <label for="is_active" class="form-label">Aktif</label>
        <select name="is_active" class="form-select">
            <option value="1" {{ (isset($page) && $page->is_active) ? 'selected' : '' }}>Ya</option>
            <option value="0" {{ (isset($page) && !$page->is_active) ? 'selected' : '' }}>Tidak</option>
        </select>
    </div>
    <div class="col-12">
        <label for="content" class="form-label">Kontent</label>
        <textarea name="content" id="content" class="form-control" required>{!! isset($page) ? $page->content : '' !!}</textarea>
    </div>
</div>
<button type="submit" class="btn bg-primary text-white mt-3">Simpan</button>

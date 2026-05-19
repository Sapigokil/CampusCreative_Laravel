@extends('layouts.main')

@section('title', 'Tulis Artikel Baru')

@push('styles')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<style>
    .admin-grid { display: grid; grid-template-columns: 1fr 350px; gap: 25px; align-items: start; }
    .card { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 20px; color: #333; }
    .form-group { margin-bottom: 20px; }
    label { display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px; color: #333; }
    input[type="text"], select, textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; color: #333; }
    
    .form-sidebar-card { padding: 20px; }
    .form-sidebar-card h3 { margin-top: 0; font-size: 16px; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 15px; color: #000; }
    
    .img-preview { width: 100%; aspect-ratio: 16/9; background: #f0f0f0; border: 1px dashed #ccc; display: flex; align-items: center; justify-content: center; margin-bottom: 10px; overflow: hidden; cursor: pointer; color: #666; }
    .img-preview img { width: 100%; height: 100%; object-fit: cover; }

    .btn-block { width: 100%; margin-bottom: 10px; padding: 12px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
    .btn-publish { background: #000; color: white; }
    .btn-publish:hover { background: #333; }
    .btn-draft { background: #eee; color: #333; border: 1px solid #ddd; }
    .btn-draft:hover { background: #e2e2e2; }

    .note-editor.note-frame { border-color: #ccc; }
    
    /* Memastikan gambar rata tengah terbaca dengan baik */
    .note-editor .note-editing-area img.note-float-center {
        display: block !important;
        margin-left: auto !important;
        margin-right: auto !important;
        float: none !important;
    }
    
    /* Mematikan kemampuan drag visual pada gambar di dalam editor */
    .note-editor .note-editing-area img { 
        -webkit-user-drag: none; 
        user-drag: none; 
    }

    .media-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 5px; max-height: 150px; overflow-y: auto; background: #f9f9f9; border: 1px solid #ddd; padding: 5px; }
    .media-item { cursor: pointer; aspect-ratio: 1/1; overflow: hidden; background: #eee; }
    .media-item img { width: 100%; height: 100%; object-fit: cover; }
    
    .alert { padding: 15px; background: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 20px; }
    .share-link-box { display: flex; margin-top: 15px; gap: 5px; background: #fff; padding: 10px; border-radius: 4px; border: 1px solid #c3e6cb; }
    .share-link-box input { flex: 1; padding: 8px; border: 1px solid #ddd; border-radius: 4px; background: #f9f9f9; color: #333; outline: none; }
    .share-link-box button { padding: 8px 15px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
    .share-link-box button:hover { background: #218838; }

    .editor-tips { font-size: 12px; color: #666; margin-top: 8px; padding: 8px 12px; background: #f8f9fa; border-left: 3px solid #ff6b00; display: inline-block;}
</style>
@endpush

@section('content')

@if(session('success'))
    <div class="alert">
        <strong>{{ session('success') }}</strong>
        @if(session('post_status') == 'published' && session('post_url'))
            <div class="share-link-box">
                <input type="text" id="postLink" value="{{ session('post_url') }}" readonly>
                <button type="button" onclick="copyPostLink()">Copy URL</button>
            </div>
        @endif
    </div>
@endif

<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="admin-grid">
        <div class="main-content">
            <div class="card">
                <div class="form-group">
                    <label>Judul Artikel</label>
                    <input type="text" name="title" id="titleInput" placeholder="Masukkan judul..." required>
                </div>

                <div class="form-group">
                    <label>Permalink / Slug</label>
                    <input type="text" name="slug" id="slugInput" placeholder="url-artikel-anda">
                    <small style="color: #666;">Biarkan kosong untuk generate otomatis dari judul.</small>
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label>Isi Konten</label>
                    <textarea name="content" id="summernote"></textarea>
                    <div class="editor-tips">
                        <strong>💡 Tips:</strong> Untuk memindah posisi gambar, jangan di-drag. Klik gambar, tekan <code>Ctrl + X</code> (Cut), lalu klik di posisi baru dan tekan <code>Ctrl + V</code> (Paste).
                    </div>
                </div>
            </div>

            <div class="card">
                <h3>SEO & Ringkasan</h3>
                <div class="form-group">
                    <label>Ringkasan (Excerpt)</label>
                    <textarea name="excerpt" rows="3" placeholder="Tulis ringkasan pendek untuk halaman depan..."></textarea>
                </div>
                <div class="form-group">
                    <label>Meta Description (SEO Google)</label>
                    <textarea name="meta_description" rows="2" maxlength="160" placeholder="Deskripsi yang muncul di hasil pencarian Google..."></textarea>
                </div>
            </div>
        </div>

        <div class="form-sidebar">
            <div class="card form-sidebar-card">
                <h3>Publish</h3>
                <button type="submit" name="action" value="draft" class="btn-block btn-draft">Simpan Draft</button>
                <button type="submit" name="action" value="publish" class="btn-block btn-publish">Terbitkan Artikel</button>
            </div>

            <div class="card form-sidebar-card">
                <h3>Kategori</h3>
                <select name="category_id">
                    <option value="">Tanpa Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="card form-sidebar-card">
                <h3>Tags</h3>
                <input type="text" name="tags" placeholder="tag1, tag2, tag3...">
                <small style="color: #666;">Pisahkan dengan koma.</small>
            </div>

            <div class="card form-sidebar-card">
                <h3>Featured Image</h3>
                <label for="feat_img" class="img-preview" id="previewContainer">
                    <span id="previewPlaceholder">Klik untuk upload</span>
                    <img id="imagePreview" style="display:none;">
                </label>
                <input type="file" name="featured_image" id="feat_img" style="display:none;" accept="image/*" onchange="previewImage(this)">
                <small style="color: #666;">Rekomendasi ukuran: 1200x675px (16:9)</small>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    function copyPostLink() {
        var copyText = document.getElementById("postLink");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value).then(function() {
            alert('URL Artikel berhasil disalin: ' + copyText.value);
        });
    }

    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result).show();
                $('#previewPlaceholder').hide();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function() {
        
        // Kembalikan definisi tombol Rata Tengah
        var imageCenterButton = function (context) {
            var ui = $.summernote.ui;
            var button = ui.button({
                contents: '<i class="note-icon-align-center"></i>',
                tooltip: 'Rata Tengah',
                click: function () {
                    var $img = $(context.invoke('restoreTarget'));
                    if ($img.length) {
                        $img.removeClass('note-float-left note-float-right');
                        $img.addClass('note-float-center');
                        $img.css({ 'display': 'block', 'margin-left': 'auto', 'margin-right': 'auto', 'float': 'none' });
                        context.invoke('editor.afterCommand');
                    }
                }
            });
            return button.render();
        }

        $('#summernote').summernote({
            height: 500,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            // Kembalikan konfigurasi buttons dan popover
            buttons: {
                imageCenter: imageCenterButton
            },
            popover: {
                image: [
                    ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                    ['float', ['floatLeft', 'imageCenter', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']]
                ]
            },
            callbacks: {
                onInit: function() {
                    $('.note-editable').on('dragstart', 'img', function(e) {
                        e.preventDefault();
                    });
                },
                onImageUpload: function(files) { 
                    $('#summernote').summernote('editor.saveRange');
                    uploadImage(files[0]); 
                },
                onDialogShown: function() { 
                    $('#summernote').summernote('editor.saveRange');
                    injectMediaLibrary(); 
                }
            }
        });

        function injectMediaLibrary() {
            let $urlInput = $('.note-group-image-url');
            if ($urlInput.length && !$('.media-library-container').length) {
                $urlInput.after('<div class="media-library-container"><span class="media-library-title" style="color:#333;">Pilih dari galeri:</span><div class="media-grid" id="mediaLibraryGrid" style="color:#333;">Memuat...</div></div>');
                $.getJSON('{{ route("admin.posts.media-library") }}', function(data) {
                    let grid = $('#mediaLibraryGrid').empty();
                    data.forEach(function(img) {
                        let item = $('<div class="media-item"><img src="'+img.url+'"></div>').click(function() {
                            
                            $('#summernote').summernote('editor.restoreRange');
                            $('#summernote').summernote('editor.focus');
                            
                            var imgNode = $('<img>').attr('src', img.url).attr('draggable', 'false')[0];
                            $('#summernote').summernote('insertNode', imgNode);
                            
                            $('.note-modal').hide(); 
                            $('.note-modal-backdrop').remove();
                        });
                        grid.append(item);
                    });
                });
            }
        }

        function uploadImage(file) {
            let data = new FormData();
            data.append("upload", file);
            data.append("_token", "{{ csrf_token() }}");
            $.ajax({
                url: '{{ route("admin.posts.upload-image") }}',
                cache: false, contentType: false, processData: false, data: data, type: "POST",
                success: function(res) { 
                    if(res.url) {
                        $('#summernote').summernote('editor.restoreRange');
                        $('#summernote').summernote('editor.focus');
                        
                        var imgNode = $('<img>').attr('src', res.url).attr('draggable', 'false')[0];
                        $('#summernote').summernote("insertNode", imgNode); 
                    } 
                }
            });
        }
    });
</script>
@endpush
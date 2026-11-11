<div class="mb-3">
    <label class="form-label">{{ $label ?? 'Additional Angle Images (Gallery)' }}</label>
    <input type="file" name="gallery_images[]" id="gallery_images_input" class="form-control" accept="image/*" multiple>
    <div class="form-text">Select one or more photos showing different angles of the project. Optional captions can be added below after choosing files.</div>
    <div id="gallery_images_preview" class="row g-2 mt-2"></div>
</div>

<script>
    (function () {
        var input = document.getElementById('gallery_images_input');
        var preview = document.getElementById('gallery_images_preview');
        if (!input || !preview) {
            return;
        }

        input.addEventListener('change', function () {
            preview.innerHTML = '';
            Array.from(input.files || []).forEach(function (file, index) {
                var col = document.createElement('div');
                col.className = 'col-md-4 col-sm-6';

                var card = document.createElement('div');
                card.className = 'border rounded p-2 h-100';

                var img = document.createElement('img');
                img.className = 'img-fluid rounded mb-2';
                img.style.maxHeight = '110px';
                img.style.width = '100%';
                img.style.objectFit = 'cover';
                img.alt = file.name;

                var reader = new FileReader();
                reader.onload = function (event) {
                    img.src = event.target.result;
                };
                reader.readAsDataURL(file);

                var captionInput = document.createElement('input');
                captionInput.type = 'text';
                captionInput.name = 'gallery_captions[' + index + ']';
                captionInput.className = 'form-control form-control-sm';
                captionInput.placeholder = 'Angle label (e.g. Side View)';
                captionInput.maxLength = 255;

                card.appendChild(img);
                card.appendChild(captionInput);
                col.appendChild(card);
                preview.appendChild(col);
            });
        });
    })();
</script>

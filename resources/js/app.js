import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;

if (document.querySelector('#dropzone')) {

    const dropzone = new Dropzone('#dropzone', {
        acceptedFiles: '.png,.jpg,.jpeg,.gif',
        addRemoveLinks: true,
        maxFiles: 1,
        uploadMultiple: false,

        init: function() {
            if (document.querySelector('[name="image"]').value.trim()) {
                const uploadedImage = {};

                uploadedImage.size = 0;
                uploadedImage.name = document.querySelector('[name="image"]').value;

                this.options.addedfile.call(this, uploadedImage);
                this.options.thumbnail.call(this, uploadedImage, `/uploads/${uploadedImage.name}`);

                uploadedImage.previewElement.classList.add('dz-success', 'dz-complete');
            }
        },
    });

    dropzone.on('success', (file, response) => {
        document.querySelector('[name="image"]').value = response.image;
    });

    dropzone.on('removedfile', () => {
        document.querySelector('[name="image"]').value = '';
    });
}

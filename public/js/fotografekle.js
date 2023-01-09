const  file = document.getElementById('fotograf'),
    image = document.querySelector('.preview-image')

file.addEventListener('change', function () {
    [...this.files].map(file => {
        if (file.name.match(/\.jpe?g|png/)) {
            const reader = new FileReader()
            reader.addEventListener('load', function () {
                image.src = this.result
            })
            reader.readAsDataURL(file);
        }
        else {
            alert('Yanlış Fotoğraf Formatı. Lütfen .jpeg , .jpg veya .png uzantılı fotoğraf yükleyiniz.')
        }
    })
})

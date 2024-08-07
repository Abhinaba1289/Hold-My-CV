const editBtn = document.getElementById("editBtn");
const body = document.body;

editBtn.addEventListener("click", () => {
    body.contentEditable = body.contentEditable === "true" ? "false" : "true";
});

const downloadBtn = document.querySelector(".download-btn");

downloadBtn.addEventListener("click", () => {
    print();
});

window.addEventListener('beforeprint', () => {
    document.getElementById('editBtn').style.display = 'none';
    document.querySelector('.download-btn').style.display = 'none';
});

window.addEventListener('afterprint', () => {
    document.getElementById('editBtn').style.display = 'inline-block';
    document.querySelector('.download-btn').style.display = 'inline-block';


});


// change profile pic?

document.getElementById('imageInput').addEventListener('change', function (event) {
    const file = event.target.files[0];
    const imagePreview = document.getElementById('imagePreview');

    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            const img = document.createElement('img');
            img.src = e.target.result;

            imagePreview.innerHTML = '';
            imagePreview.appendChild(img);
            imageInput.style.display = 'none';
            document.querySelector('label[for="imageInput"]').style.display = 'none';
            document.querySelector('.propropic').innerHTML = '';

        };

        reader.readAsDataURL(file);
    } else {
        imagePreview.innerHTML = 'No image selected';

    }
});
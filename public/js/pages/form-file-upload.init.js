/*
Template Name: Tailwick - Admin & Dashboard Template
Author: Themesdesign
Website: https://themesdesign.in/
Contact: Themesdesign@gmail.com
File: Form file upload Js File
*/
Dropzone.autoDiscover = false;

var dropzonePreviewNode = document.querySelector(".dropzone-preview-list");
dropzonePreviewNode.id = "";

if (dropzonePreviewNode) {
    var previewTemplate = dropzonePreviewNode.parentNode.innerHTML;
    dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode);

    var form = document.querySelector("form");

    var dropzone = new Dropzone(".dropzone", {
        url: form.getAttribute("action"), // 🔥 URL dynamique ici
        method: "post",
        autoProcessQueue: false,
        uploadMultiple: false,
        maxFiles: 1,
        paramName: "logo",
        previewsContainer: ".dropzone-preview",
        previewTemplate: previewTemplate,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        init: function () {
            var myDropzone = this;

            form.addEventListener("submit", function (e) {
                e.preventDefault();
                e.stopPropagation();

                if (myDropzone.getQueuedFiles().length > 0) {
                    myDropzone.processQueue();
                } else {
                    form.submit(); // submit normal s'il n'y a pas de fichier
                }
            });

            myDropzone.on("sending", function (file, xhr, formData) {
                const inputs = form.querySelectorAll("input, select, textarea");
                inputs.forEach(function(input) {
                    if (input.name && input.type !== "file") {
                        formData.append(input.name, input.value);
                    }
                });

                // Ajoute la méthode HTTP simulée (PUT, PATCH…) si définie dans le formulaire
                const methodInput = form.querySelector('input[name="_method"]');
                if (methodInput) {
                    formData.append('_method', methodInput.value);
                }
            });

            myDropzone.on("success", function (file, response) {
                // Redirige après succès
                window.location.href = form.querySelector('input[name="_previous"]').value; // ou route dynamique
            });
        }
    });
}

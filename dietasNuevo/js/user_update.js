document.addEventListener("DOMContentLoaded", function () {
    const modalUpdate = document.getElementById('modalUpdate');

    
    modalUpdate.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; 
        const userId = button.closest("form").querySelector('input[name="edit_user_id"]').value;

        console.log("ID de usuario seleccionado para editar:", userId);

 
        fetch(`./php/get_user_data.php?id=${userId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json();
            })
            .then(data => {
                modalUpdate.querySelector('#txtID').value = data.id || '';
                modalUpdate.querySelector('#updateName').value = data.name || '';
                modalUpdate.querySelector('#updateLast').value = data.last_name || '';
                modalUpdate.querySelector('#updateAge').value = data.age || '';
                modalUpdate.querySelector('#updateEmail').value = data.email || '';
            })
            .catch(error => {
                console.error('Error al obtener los datos del usuario:', error);
            });
    });

    
    const form = modalUpdate.querySelector("form");
    form.addEventListener("submit", function (event) {
        if (!form.checkValidity()) {
            event.preventDefault(); 
            event.stopPropagation();
        }
        form.classList.add("was-validated");
    });
});

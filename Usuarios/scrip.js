document.addEventListener('DOMContentLoaded', () => {
    loadUsers();
    $('#usuarios').DataTable();
});

function loadUsers() {
    fetch('load_users.php')
        .then(response => response.json())
        .then(data => {
            const usersBody = document.getElementById('usersBody');
            usersBody.innerHTML = '';
            data.forEach(user => {
                usersBody.innerHTML += `
                    <tr>
                        <td>${user.Nombres}</td>
                        <td>${user.Apellidos}</td>
                        <td>${user.Correo}</td>
                        <td>${user.Rol}</td>
                        <td>${user.Especialidad}</td>
                        <td>${user.Estado_Usuario == 1 ? 'Activo' : 'Inactivo'}</td>
                        <td>
                            <span class="btn-edit" onclick="editUser(${user.Id_usuario})">Editar</span> | 
                            <span class="btn-delete" onclick="deleteUser(${user.Id_usuario})">Eliminar</span>
                        </td>
                    </tr>
                `;
            });
        });
}



function editUser(id) {
    fetch(`get_user.php?id=${id}`)
        .then(response => response.json())
        .then(user => {
            document.getElementById('formTitle').innerText = 'Editar Usuario';
            document.getElementById('userId').value = user.Id_usuario;
            document.getElementById('nombres').value = user.Nombres;
            document.getElementById('apellidos').value = user.Apellidos;
            document.getElementById('correo').value = user.Correo;
            document.getElementById('clave').value = user.Clave;
            document.getElementById('rol').value = user.Rol;
            document.getElementById('especialidad').value = user.Especialidad;
            document.getElementById('estado').checked = user.Estado_Usuario == 1;
            document.getElementById('userForm').style.display = 'block';
        });
}

function deleteUser(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
        fetch(`delete_user.php?id=${id}`, { method: 'POST' })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadUsers();
                } else {
                    alert('Error al eliminar el usuario');
                }
            });
    }
}

function saveUser() {
    const id = document.getElementById('userId').value;
    const nombres = document.getElementById('nombres').value;
    const apellidos = document.getElementById('apellidos').value;
    const correo = document.getElementById('correo').value;
    const clave = document.getElementById('clave').value;
    const rol = document.getElementById('rol').value;
    const especialidad = document.getElementById('especialidad').value;
    const estado = document.getElementById('estado').checked ? 1 : 0;

    const user = { id, nombres, apellidos, correo, clave, rol, especialidad, estado };

    fetch('save_user.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(user)
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadUsers();
                hideForm();
            } else {
                alert('Error al guardar el usuario');
            }
        });
}

function hideForm() {
    document.getElementById('userForm').style.display = 'none';
}

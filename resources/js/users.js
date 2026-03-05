window.deleteUser = function(event, id) {
    event.preventDefault();

    axios.delete(`/admin/users/${id}`)
        .then(response => {
            const successBox = document.getElementById('successMessage');
            successBox.textContent = 'Usuário deletado com sucesso.';
            successBox.classList.remove('d-none');

            const row = event.target.closest('tr');
            if (row) row.remove();

            setTimeout(() => {
                successBox.classList.add('d-none');
            }, 3000);
        })
        .catch(error => {
            const errorBox = document.getElementById('errorMessage');

            if (error.response?.status === 403){
                errorBox.textContent =  error.response.data.error;
            } else {
                errorBox.textContent = 'Não foi possivel deletar o usuário.';
            }

            errorBox.classList.remove('d-none');

            setTimeout(() => {
                errorBox.classList.add('d-none');
            }, 3000);
        });
}

window.generateUsers = function(event){
    event.preventDefault();

    axios.post('/admin/users/generate')
        .then(response =>{
            const successBox = document.getElementById('successMessage');
            successBox.classList.remove('d-none');
            successBox.textContent = response.data.message;

            const users = response.data.users;
            const row = event.target.add('tr');
            if (row) row.add();

            console.log(users);

            setTimeout(() =>{
                successBox.classList.add('d-none');
            }, 3000);
        })
        .catch(error =>{
            const errorBox = document.getElementById('errorMessage');
            errorBox.classList.remove('d-none');
            errorBox.textContent = "Não foi possível gerar usuários.";
        });
}

window.deleteUser = function(id) {
    axios.delete(`/users/${id}`)
        .then(response => {
            const successBox = document.getElementById('successMessage');
            successBox.textContent = 'Usuário deletado com sucesso.';
            successBox.classList.remove('d-none');

            setTimeout(() => {
                successBox.classList.add('d-none');
            }, 3000);

        })
        .catch(error => {
            const errorBox = document.getElementById('errorMessage');
            errorBox.textContent = 'Não foi possivel deletar o usuário.';
            errorBox.classList.remove('d-none');

            setTimeout(() => {
                errorBox.classList.add('d-none');
            }, 3000);
        });
}

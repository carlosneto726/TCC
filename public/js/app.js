function getAddressFromViaCEP(cep) {
    const apiUrl = `https://viacep.com.br/ws/${cep}/json/`;

    return fetch(apiUrl)
        .then(response => response.json())
        .then(data => data)
        .catch(error => {
        throw new Error('Erro na consulta de CEP. Por favor, tente novamente mais tarde.');
        });
}

function fillAddressFields(data) {
    if (data.erro) {
        alert('CEP não encontrado. Por favor, verifique o CEP digitado.');
        return;
    }
    document.getElementById('endereco').value = `${data.logradouro} ${data.bairro} ${data.localidade} ${data.uf}`;
}

document.getElementById('cep').addEventListener('change', function() {
const cep = this.value.replace(/\D/g, ''); // Remove caracteres não numéricos

if (cep.length === 8) {
    getAddressFromViaCEP(cep)
    .then(data => fillAddressFields(data))
    .catch(error => {
        alert(error.message);
        console.error(error);
    });
}
});
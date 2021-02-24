function dynamicReload() {
    var minPrice = document.getElementById('priceMin');
    var maxPrice = document.getElementById('priceMax');
    var submit = document.getElementById('btn-submit');


    var xhttp = new XMLHttpRequest();

    submit.addEventListener('click', () => {
        var request = new XMLHttpRequest();
        request.onload = () => {

        };

        var requestData = `priceMin =$`

        request.open('POST', 'index.php?c=products&a=products');
        request.setRequestHeader('Contetnt-type', 'application/x-www-form-urlencoded');
        request.send(requestData);
    });
}
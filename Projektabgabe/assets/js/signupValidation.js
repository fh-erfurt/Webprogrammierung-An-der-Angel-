function signup() {
    var messages = document.getElementById('errorList');

    var form = {
        firstname: document.getElementById('firstname'),
        lastname: document.getElementById('lastname'),
        birthdate: document.getElementById('birthdate'),
        email: document.getElementById('email'),
        password: document.getElementById('password'),
        street: document.getElementById('street'),
        streetNo: document.getElementById('streetNo'),
        zip: document.getElementById('zip'),
        city: document.getElementById('city'),
        country: document.getElementById('country'),
        submit: document.getElementById('btn-submit')
    }

    form.submit.addEventListener('click', () => {
        var request = new XMLHttpRequest();

        request.onload = () => {
            let responseObject = null;

            try {
                responseObject = JSON.parse(request.responseText);
            } catch (e) {
                console.log('Could not parse JSON!');
            }

            if (responseObject) {
                handleResponse(responseObject);
            }

        }

        var requestData = `firstname=${form.firstname.value}&lastname=${form.lastname.value}&birthdate=${form.birthdate.value}&email=${form.email.value}&password=${form.password.value}&street=${form.street.value}&streetNo=${form.streetNo.value}&zip=${form.zip.value}&city=${form.city.value}&country=${form.country.value}`;

        request.open('POST', 'index.php?c=pages&a=signup');
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        request.send(requestData);
    });

    function handleResponse(responseObject) {
        if (responseObject.success) {
            location.href = 'index.php?c=pages&a=login';
        } else {
            while (messages.firstChild) {
                messages.removeChild(messages.firstChild);
            }

            responseObject.errors.foreach((error) => {
                const li = document.createElement('li');
                li.textContent = error;
                messages.appendChild(li);
            });
        }
    }
}
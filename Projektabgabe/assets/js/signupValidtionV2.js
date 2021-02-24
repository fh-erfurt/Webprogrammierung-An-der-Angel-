function signupValidation() {
    var messages = document.getElementById('errorList');
    var form = document.getElementById('form');
    var submit = form.querySelector('input[type="submit"]');

    submit.addEventListener('click', function(event) {
        //event.stopPropagation();
        event.preventDefault();

        var request = new XMLHttpRequest();
        request.open('POST', 'index.php?c=pages&a=signup');

        request.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    let responseObject = null;

                    try {
                        responseObject = JSON.parse(request.responseText);
                    } catch (e) {
                        console.log('Could not parse JSON!');
                    }

                    if (responseObject) {
                        handleResponse(responseObject);
                    }
                } else {
                    console.log(this.statusText);
                }
            }
        }
        request.send(new FormData(form));
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
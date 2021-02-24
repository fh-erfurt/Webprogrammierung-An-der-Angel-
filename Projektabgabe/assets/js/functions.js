function passwordQuality() {

    var inputPassword = document.getElementById('password');

    if (inputPassword) {
        inputPassword.addEventListener('keyup', function() {
            var regexBad = /^(?=.*?[A-Z].*?)(?=.*?[a-z].*?)(?=.*?[0-9].*?).{6,}$/m;
            var regexMedium = /^(?=.*?[A-Z].*?)(?=.*?[a-z].*?)(?=.*?[0-9].*?)(?=.*?[^\w\s].*?).{8,}$/m;
            var regexGood = /^(?=.*?[A-Z].*?[A-Z])(?=.*?[a-z].*?[a-z])(?=.*?[0-9].*?[0-9])(?=.*?[^\w\s].*?[^\w\s]).{12,}$/m;

            var password = this.value;

            if (password.match(regexGood)) {
                inputPassword.style.border = '2px solid lightgreen';
            } else if (password.match(regexMedium)) {
                inputPassword.style.border = '2px solid yellow';
            } else if (password.match(regexBad)) {
                inputPassword.style.border = '2px solid orange';
            } else {
                inputPassword.style.border = '2px solid red';
            }
        });
    }

}
function checkPass(){ //TODO Prevent SQL injection on form input
    let goodColor = "#66cc66";
    let badColor = "#ff6666";

    let message = document.getElementById('confirmMessage');

    pass1 = document.getElementById("inputPassword");
    pass2 = document.getElementById("checkPassword");

    if(pass1.value === pass2.value){
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }
}

function validateCode() {
    $.ajax({
        type: 'POST',
        url: 'requests/validateCode.php',
        data: {
            email: document.getElementById("inputEmail").value,
            code: document.getElementById("validationCode").value
        },
        success: function (d) {
            if(d === "ok"){
                rp = document.getElementById("response");
                rp.innerHTML = "<div class=\"alert alert-success\" role=\"alert\">" +
                    "<strong>Cont autentificat!</strong> Acum poți cumpăra!" +
                    "</div>";
            }
            else{
                console.log(d);
            }
        }
    });
}

function register(){
    $.ajax({
        type: 'POST',
        url: 'requests/registerCheck.php',
        data: {
            email: document.getElementById("inputEmail").value,
            password: document.getElementById("inputPassword").value,
            surname: document.getElementById("surnameInput").value,
            name: document.getElementById("nameInput").value
        },
        success: function(d) {
            rp = document.getElementById("response");
            console.log(d);
            if(d !== "Account exists!"){
                let name = document.getElementById("nameInput").value + " " + document.getElementById("surnameInput").value;
                $.ajax({
                    type: 'POST',
                    url: 'requests/sendMail.php',
                    data: {
                        nume: name,
                        email: document.getElementById("inputEmail").value,
                        message: d,
                        subiectMail: "Validare Cont"

                    },
                    success: function (rd) {
                        console.log(rd);
                        rp.innerHTML = "<div class=\"alert alert-success\" role=\"alert\">" +
                            "<strong>Felicitări!</strong> Tocmai ți-ai creat un cont nou! Te rugăm să validezi contul prin <strong> linkul primit pe mail!</strong>" +
                            "</div>" +
                            "<div class=\"alert alert-info\">\n" +
                            "                    <label for=\"validationCode\">\n" +
                            "                        Cod Validare\n" +
                            "                    </label>\n" +
                            "                    <input type=\"text\" class=\"form-control\" id=\"validationCode\"/>\n" +
                            "                    <input type=\"button\" hidden id=\"fakeButton\" onclick=\"validateCode()\">" +
                            "                </div>";
                        document.getElementById("validationCode")
                            .addEventListener("keyup", function(event) {
                                event.preventDefault();
                                if (event.keyCode === 13) {
                                    document.getElementById("fakeButton").click();
                                }
                            });
                    }
                });

            } else {
                rp.innerHTML = "<div class=\"alert alert-danger\" role=\"alert\">" +
                    "Deja există un cont cu această adresă de email. Ți-ai uitat parola?" +
                    "</div>"
            }
        }
    });
}
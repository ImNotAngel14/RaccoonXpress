function validate()
{
    event.preventDefault();
    const element_password = document.getElementById('id_password');
    const element_email = document.getElementById('id_email');
    const element_username = document.getElementById('id_username');
    let password = element_password.value;
    let email = element_email.value;
    let username = element_username.value;
    let valid_input = true;
    if(username.length < 3)
    {
        element_username.classList.add('is-invalid');
        document.getElementById('id_username_validation').hidden = false;
        valid_input = false;
        element_username.scrollIntoView({
            behavior: 'smooth', // Puedes usar 'auto' o 'smooth' para especificar el comportamiento del desplazamiento
            block: 'start', // Puedes usar 'start', 'center', 'end', o 'nearest' para especificar cómo el bloque debería alinearse
            inline: 'nearest' // Puedes usar 'start', 'center', 'end', o 'nearest' para especificar cómo en línea debería alinearse
        });
    }
    else
    {
        element_username.classList.remove('is-invalid');
        document.getElementById('id_username_validation').hidden = true;
    }
    

    if(!validateEmail(email))
    {
        element_email.classList.add("is-invalid");
        document.getElementById('id_email_validation2').hidden = false;
        valid_input = false;
        element_email.scrollIntoView({
            behavior: 'smooth', // Puedes usar 'auto' o 'smooth' para especificar el comportamiento del desplazamiento
            block: 'start', // Puedes usar 'start', 'center', 'end', o 'nearest' para especificar cómo el bloque debería alinearse
            inline: 'nearest' // Puedes usar 'start', 'center', 'end', o 'nearest' para especificar cómo en línea debería alinearse
        });
    }
    else
    {
        element_email.classList.remove("is-invalid");
        document.getElementById('id_email_validation2').hidden = true;
    }
    

    if(!validatePassword(password))
    {
        element_password.classList.add("is-invalid");
        document.getElementById('id_pass_validation').hidden = false;
        valid_input = false;
        element_password.scrollIntoView({
            behavior: 'smooth', // Puedes usar 'auto' o 'smooth' para especificar el comportamiento del desplazamiento
            block: 'start', // Puedes usar 'start', 'center', 'end', o 'nearest' para especificar cómo el bloque debería alinearse
            inline: 'nearest' // Puedes usar 'start', 'center', 'end', o 'nearest' para especificar cómo en línea debería alinearse
        });
    }
    else
    {
        document.getElementById('id_pass_validation').hidden = true;
        element_password.classList.remove("is-invalid");
    }
    if(valid_input)
    {
        var saved = registerUser();
        return saved;
    }
    else
    {
        return false;
    }
}

function validatePassword(pPassword) {
    let validPassword = true;
    document.getElementById("id_req_length").style.color = "green";
    document.getElementById("id_req_upper").style.color = "green";
    document.getElementById("id_req_lower").style.color = "green";
    document.getElementById("id_req_number").style.color = "green";
    document.getElementById("id_req_special").style.color = "green";
    // Verificar si la contraseña tiene al menos 8 caracteres
    if (pPassword.length < 8)
    {
        validPassword = false;
        document.getElementById("id_req_length").style.color = "red";
    }

    // Verificar si hay al menos una letra mayúscula
    if (!/[A-Z]/.test(pPassword)) {
        validPassword = false;
        document.getElementById("id_req_upper").style.color = "red";
    }

    // Verificar si hay al menos una letra minúscula
    if (!/[a-z]/.test(pPassword)) {
        validPassword = false;
        document.getElementById("id_req_lower").style.color = "red";
    }

    // Verificar si hay al menos un número
    if (!/[0-9]/.test(pPassword)) {
        validPassword = false;
        document.getElementById("id_req_number").style.color = "red";
    }

    // Verificar si hay al menos un carácter especial
    if (!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(pPassword)) {
        validPassword = false;
        document.getElementById("id_req_special").style.color = "red";
    }
    // Si pasa todas las validaciones, la contraseña es válida
    return validPassword;
}

function validateEmail(pEmail)
{
    // Expresión regular para validar un correo electrónico
    var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    // Utilizamos el método test de la expresión regular para verificar si la cadena coincide con el patrón
    return pattern.test(pEmail);
}

function toBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}

async function registerUser()
{
    const cEmail = document.getElementById("id_email");
    const cUsername = document.getElementById("id_username");
    const cPassword = document.getElementById("id_password");
    const cName = document.getElementById("id_name");
    const cLastName = document.getElementById("id_lastname");
    const cBirthdate = document.getElementById("id_birthdate").value;
    const cGender = document.getElementById("id_gender").value;
    const cRole = document.getElementById("id_role").value;
    const cImage = document.getElementById("id_input_img").files[0];
    const base64Image = await toBase64(cImage);
    console.log(cGender);
    //console.log(base64Image);
    var authResult = false;
    let xhr = new XMLHttpRequest();
    const user = 
    {
        username: cUsername.value,
        password: cPassword.value,
        email: cEmail.value,
        name: cName.value,
        lastname: cLastName.value,
        birthdate: cBirthdate,
        gender: parseInt(cGender),
        role: cRole,
        profileImage: base64Image.substring(22)
    };

    xhr.open("POST", "../controladores/registerUser.php", true);
    xhr.onreadystatechange = function () 
    {
        try
        {
            if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
            {
                let res = JSON.parse(xhr.response);
                if(res.success != true)
                {
                    authResult = false;
                    return;
                }
                alert("Registrado correctamente.");
                window.location.replace("./login.php");
                authResult = true;
            }
        }catch(error)
        {
            console.error(xhr.response);
        }
    }
    xhr.send(JSON.stringify(user));
    return authResult;
}

async function loadImg()
{
    const cImage = document.getElementById("id_input_img").files[0];
    const prevImage = document.getElementById("id_profile_img");
    const base64Image = await toBase64(cImage);
    prevImage.src = base64Image;
    return;
}
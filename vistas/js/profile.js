document.addEventListener('DOMContentLoaded', (event) => {
    const button = document.getElementById('id_sign_off');
    button.addEventListener('click', function() {
        window.location.replace("./logout.php");
    });
});

function validate()
{
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
        var saved = updateUser();
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

async function updateUser()
{
    event.preventDefault();
    const cEmail = document.getElementById("id_email");
    const cUsername = document.getElementById("id_username");
    const cFullname = document.getElementById("id_name");
    const cPassword = document.getElementById("id_password");
    const cBirthdate = document.getElementById("id_birthdate").value;
    const cProfileImage = document.getElementById("id_profileImage").files[0];
    const cGender = document.getElementById("id_gender").value;
    const cVisbility = document.getElementById("id_visibility").value;
    const base64Image = await toBase64(cProfileImage);
    try {
        const response = await fetch('http://localhost/WebDeCapaIntermedia/controladores/updateUser.php', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json'
            },
            body: JSON.stringify({ 
                username: cUsername.value,
                password: cPassword.value,
                email: cEmail.value,
                name: cFullname.value,
                birthdate: cBirthdate,
                gender: cGender,
                visibility: cVisbility,
                profileImage: base64Image.substring(22) })
        });

        // Actuamos en base a la respuesta de la API
        const data = await response.json();
        if(data.success)
        {
            console.log(data);
            alert("Soy un breakpoint");
            //window.location.reload();
        }
        else
        {
            // Mostrar mensaje de error del registro
            // ...
            console.error("No se pudo registrar al usuario.");
        }
    } catch (error) {
        console.error('Error al llamar a la API:', error);
    }
    return false;
}
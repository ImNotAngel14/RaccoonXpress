async function authLogin()
{
    event.preventDefault();
    const cUsername = document.getElementById("username").value;
    const cPassword = document.getElementById("password").value;
    try {
        const response = await fetch('http://localhost/WebDeCapaIntermedia/controladores/authLogin.php', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json'
            },
            body: JSON.stringify({ username: cUsername, password: cPassword})
        });
        // Actuamos en base a la respuesta de la API
        const data = await response.json();
        if(data.success)
        {
            console.log("success");
            localStorage.setItem("user_id", data.user_id);
            window.location.replace("../index.php");
            return true;
            
        }
        else
        {
            document.getElementById('id_login_msg').hidden = false;
            return false;
        }
    } catch (error) {
        console.error('Error al llamar a la API:', error); 
    }
    return false;
}
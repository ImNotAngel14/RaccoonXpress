async function loadImg()
{
    const cImage = document.getElementById("id_list_image_input").files[0];
    const prevImage = document.getElementById("id_list_image");
    const base64Image = await toBase64(cImage);
    prevImage.src = base64Image;
    return;
}

function toBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}

async function createList()
{
    event.preventDefault();
    const cListName = document.getElementById("id_list_name").value;
    const cListDescription = document.getElementById("id_list_description").value;
    const cListPrivacity = document.getElementById("id_privacity").checked;
    const cImage = document.getElementById("id_list_image_input").files[0];
    const base64Image = await toBase64(cImage);
    try {
        const response = await fetch('http://localhost/WebDeCapaIntermedia/controladores/createList.php', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json'
            },
            body: JSON.stringify({ 
                name: cListName,
                description: cListDescription,
                privacity: cListPrivacity,
                image: base64Image.substring(22)
            })
        });

        // Actuamos en base a la respuesta de la API
        const data = await response.json();
        if(data.success)
        {  
            window.location.reload();
            return true;
        }
        else
        {
            console.error("No se pudo registrar al usuario.");
            return false;
        }
    } catch (error) {
        console.error('Error al llamar a la API:', error);
        return false;
    }
    
}
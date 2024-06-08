function toBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}

async function newProduct()
{
    event.preventDefault();
    const product_name = document.getElementById("id_nombre").value;
    const product_description = document.getElementById("id_descripcion").value;
    const quotable = document.getElementById("id_cotizable").value;
    const price = document.getElementById("id_precio").value;
    const quantity = document.getElementById("id_cantidad").value;
    const image1 = document.getElementById("id_imagen1").files[0];
    const image2 = document.getElementById("id_imagen2").files[0];
    const image3 = document.getElementById("id_imagen3").files[0];
    const video = document.getElementById("id_video").files[0];
    const category = document.getElementById("id_categoria").value;
    
    const base64Image1 = image1 ? await toBase64(image1) : null;
    const base64Image2 = image2 ? await toBase64(image2) : null;
    const base64Image3 = image3 ? await toBase64(image3) : null;
    const base64Video = video ? await toBase64(video) : null;
    try {
        const response = await fetch('http://localhost/WebDeCapaIntermedia/controladores/uploadProduct.php', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                product_id: 0,
                name: product_name,
                description: product_description,
                quotable,
                price,
                quantity,
                image1: base64Image1 ? base64Image1.substring(22) : null,
                image2: base64Image2 ? base64Image2.substring(22) : null,
                image3: base64Image3 ? base64Image3.substring(22) : null,
                video: video ? base64Video.substring(22) : null,
                category_id: category,
                seller_id: localStorage.getItem("user_id"),
            })
        });
        // const text = await response.text();
        // console.log(text);
        const data = await response.json();
        // Actuamos en base a la respuesta de la API
        if(data.success)
        {  
            window.location.replace("home.php");
            console.log("Insertado.");
            return true;
        }
        else
        {
            console.error("No se pudo registrar al producto.: ", data.error);
            return false;
        }
    } catch (error) {
        console.error('Error al llamar a la API:', error);
        return false;
    }
}
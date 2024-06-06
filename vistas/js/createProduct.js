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
    const category = document.getElementById("id_categoria").value;
    const base64Image1 = await toBase64(image1);
    const base64Image2 = await toBase64(image2);
    const base64Image3 = await toBase64(image3);
    //const base64Image = await toBase64(cImage);
    try {
        const response = await fetch('http://localhost/WebDeCapaIntermedia/controladores/uploadProduct.php', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json'
            },
            body: JSON.stringify({ 
                product_name,
                product_description,
                quotable,
                price,
                quantity,
                base64Image1,
                base64Image2,
                base64Image3,
                category
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
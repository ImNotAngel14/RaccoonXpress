document.addEventListener('DOMContentLoaded', (event) => {
    // Seleccionar todos los botones con la clase "my-button"
    const buttons = document.querySelectorAll('.btn-delete-item');

    // Agregar un event listener a cada botón
    buttons.forEach(button => {
        button.addEventListener('click', handleButtonClick);
    });
});

// Función que se llama cuando se presiona uno de los botones
async function handleButtonClick(event) {
    const button = event.target;
    const cartItem = button.getAttribute('data-cart-item');
    console.log('ID del producto en el carrito:', cartItem);
    try {
        const response = await fetch('http://localhost/WebDeCapaIntermedia/controladores/deleteShoppingCartItem.php', {
            method: 'DELETE',
            headers: {
            'Content-Type': 'application/json'
            },
            body: JSON.stringify({ cart_item: cartItem})
        });
        // Actuamos en base a la respuesta de la API
        const data = await response.json();
        if(data.success)
        {
            console.log("success");
            window.location.reload();
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
    // Aquí puedes agregar el código que quieras ejecutar cuando se presiona el botón
}
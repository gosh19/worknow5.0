const validationCreditCard = () =>{
    const element = document.getElementById('tc').value;
    let msj = document.getElementById('msjTc');

    let value = false;
    console.log(element);
    switch (element) {
      case '4517':
        msj.style.display = 'block';
        msj.innerHTML='<div class="alert alert-danger">POSIBLE <img class="h-20" src="https://i0.pngocean.com/files/371/4/54/visa-debit-card-credit-card-logo-mastercard-visa.jpg" alt=""> DEBITO, CONSULTAR CON EL CLIENTE</div>';
        break;
      case '6042':
        msj.style.display = 'block';
        msj.innerHTML='<div class="alert alert-danger">POSIBLE <img class="h-20" src="https://tuquejasuma.com/media/images/thumbnails/321313_tarjeta_nueva_tarjeta_cabal.jpg" alt=""> DEBITO, CONSULTAR CON EL CLIENTE</div>';
        break;
      case '5010':
        msj.style.display = 'block';
        msj.innerHTML='<div class="alert alert-danger">POSIBLE <img class="h-20" src="https://i0.wp.com/www.ebizlatam.com/wp-content/uploads/2017/03/Maestro-Tarjeta.jpg?fit=510%2C374" alt=""> DEBITO, CONSULTAR CON EL CLIENTE</div>';
        break;
      case '4513':
        msj.style.display = 'block';
        msj.innerHTML='<div class="alert alert-danger">POSIBLE <img class="h-20" src="https://www.buenosaires.travel/wp-content/buenosaires_uploads/Banco-provincia-324x190.jpg" alt=""> DEBITO, CONSULTAR CON EL CLIENTE</div>';
        break;

      case '5547':
        msj.style.display = 'block';
        msj.innerHTML='<div class="alert alert-warning">TARJETA <img class="h-20" src="https://pbs.twimg.com/profile_images/1240629438397722628/qmOFm9ar_400x400.jpg" alt=""> PREPAGA, SI ES UN PAGO TOMAR, EN CASO DE PLAN DE CUOTAS DEBE ABONAR POR CUPON</div>';
        break;
      case '5258':
        msj.style.display = 'block';
        msj.innerHTML='<div class="alert alert-warning">TARJETA <img class="h-20" src="https://seeklogo.com/images/U/uala-logo-7959775EA9-seeklogo.com.png" alt=""> PREPAGA, SI ES UN PAGO TOMAR, EN CASO DE PLAN DE CUOTAS DEBE ABONAR POR CUPON</div>';
        break;
      case '':
        msj.style.display = 'none';
        break;
      default:
        break;
    }
    
  }

  //ANIMACION DEL CARRITO FLOTANTE

var carrito = document.getElementById('carrito-flotante');
carrito.classList.add('opacity-0');
if (carrito != null) {
  
  window.onscroll = function () {
    let y = window.scrollY;
    //console.log(y);
    if (y > 150) {
      carrito.classList.add("motion-safe:animate-fadeIn");
    } else {
      carrito.classList.remove("motion-safe:animate-fadeIn");
    }
  }
};
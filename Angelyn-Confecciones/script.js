//DROPDOWN MENU FOR MOVIL PHONES
document.addEventListener('DOMContentLoaded', function() {
    const burger = document.querySelector('.burger-menu');
    const navList = document.querySelector('.nav-list');
    
    burger.addEventListener('click', function() {
        burger.classList.toggle('active');
        navList.classList.toggle('mobile-active');
    });
    
    // Cerrar al click en enlaces
    document.querySelectorAll('.nav-link, .dropdown-link').forEach(link => {
        link.addEventListener('click', () => {
            navList.classList.remove('mobile-active');
            burger.classList.remove('active');
        });
    });
    
    // Cerrar al click fuera
    document.addEventListener('click', function(e) {
        if (!navbar.contains(e.target)) {
            navList.classList.remove('mobile-active');
            burger.classList.remove('active');
        }
    });
});

// QUANTITY SELECTO FOR PRODUCTS ITEMS
document.addEventListener("DOMContentLoaded", () => {
    const btnAdd= document.querySelector(".btn-add")
    const btnSubtract = document.querySelector(".btn-subtract")
    let quantity = document.querySelector(".quantity")

    btnAdd.addEventListener("click", () => {
        let quantityValue = parseInt(quantity.value) + 1;
        quantity.value = quantityValue
    })

    btnSubtract.addEventListener("click", () => {
        let quantityValue = parseInt(quantity.value) -1;

        if(quantityValue <= 1){
            quantity.value = 1
        } else {
            quantity.value = quantityValue
        }
    })
})

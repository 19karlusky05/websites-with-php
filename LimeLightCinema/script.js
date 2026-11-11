//burger menu
document.addEventListener("DOMContentLoaded", () => {
    const hamburger = document.querySelector(".burger-menu");
    const navMenu = document.querySelector(".nav-list");

    if (hamburger && navMenu) {
        hamburger.addEventListener("click", () => {
        hamburger.classList.toggle("active");
        navMenu.classList.toggle("active");
        });


        document.querySelectorAll(".nav-link a").forEach(n => {
            n.addEventListener("click", () => {
                hamburger.classList.remove("active");
                navMenu.classList.remove("active");
                });
            });
    }
});

// CARRUSEL
document.addEventListener("DOMContentLoaded", () => {
    // Selección de elementos
    const carrusel = document.querySelector(".carrusel");
    const slides = document.querySelectorAll(".slide");
    const btnLeft = document.querySelector(".left-arrow");
    const btnRight = document.querySelector(".right-arrow");

    // Solo ejecutamos si el carrusel existe en la página
    if (carrusel && btnLeft && btnRight) {
        let index = 0;

        function showSlide(i) {
            carrusel.style.transform = `translateX(${-i * 100}%)`;
        }

        btnRight.addEventListener("click", () => {
            index++;
            if (index >= slides.length) index = 0;
            showSlide(index);
        });

        btnLeft.addEventListener("click", () => {
            index--;
            if (index < 0) index = slides.length - 1;
            showSlide(index);
        });

        setInterval(() => {
            index++;
            if (index >= slides.length) index = 0;
            showSlide(index);
        }, 5000);
    
    }
});

// TRAILERS MODAL WINDOWS
const buttons = document.querySelectorAll('.trailer-btn');
const modal = document.getElementById('trailer-modal');
const iframe = document.getElementById('trailer-iframe');
const closeBtn = document.querySelector('.trailer-close');

buttons.forEach(btn => {
    btn.addEventListener('click', () => {
        const url = btn.dataset.trailer;

        iframe.src = url;
        modal.style.display = 'flex';
    });
});

closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
    iframe.src = '';
});

window.addEventListener('click', (e) => {
    if (e.target === modal) {
        modal.style.display = 'none';
        iframe.src = '';
    }
});


// QUIZ JUNIOR GAME
function checkQuiz() {
    let score = 0;
    const totalQuestions = 3;
    const form = document.getElementById('quizForm');
    

    const data = new FormData(form);

    // Iteramos sobre las respuestas
    for (let value of data.values()) {
        score += parseInt(value);
    }

    // Buscamos el div de resultados
    const resultDiv = document.getElementById('quiz-result');
    
    if (resultDiv) {
        resultDiv.style.display = 'block';
        resultDiv.innerHTML = `Puntuación: ${score} / ${totalQuestions}`;
        
        // Estilo dinámico según el resultado
        if (score === totalQuestions) {
            resultDiv.style.color = "#4CAF50"; // Verde
            resultDiv.innerHTML += " 🏆 ¡You are a Film lover!";
        } else if (score > 0) {
            resultDiv.style.color = "#FF9800"; // Naranja
            resultDiv.innerHTML += " 🍿 ¡Not bad!";
        } else {
            resultDiv.style.color = "#f44336"; // Rojo
            resultDiv.innerHTML += " 🎟️ More cinema, my friend.";
        }
    }
}




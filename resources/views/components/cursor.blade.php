<div class="cursor-dot"></div>
<div class="cursor-outline"></div>

<style>
    /* Esconde o mouse padrão em todo o site */
    * {
        cursor: none !important;
    }

    /* Estilo do Ponto Central */
    .cursor-dot {
        width: 8px;
        height: 8px;
        background-color: #00c054; /* Roxo principal */
        pointer-events: none;
        position: fixed;
        top: 0;
        left: 0;
        transform: translate(-50%, -50%);
        border-radius: 50%;
        z-index: 9999;
        transition: opacity 0.3s ease;
    }

    /* Estilo da Aura (Círculo Externo) */
    .cursor-outline {
        width: 40px;
        height: 40px;
        border: 2px solid #00c054;
        pointer-events: none;
        position: fixed;
        top: 0;
        left: 0;
        transform: translate(-50%, -50%);
        border-radius: 50%;
        z-index: 9998;
        /* O segredo da suavidade está aqui e no JS */
        transition: all 0.2s ease-out;
    }

    /* Efeito de clique (opcional) */
    body:active .cursor-outline {
        transform: translate(-50%, -50%) scale(0.8);
        background-color: rgba(102, 17, 203, 0.2);
    }
</style>

<script>
    const cursorDot = document.querySelector(".cursor-dot");
    const cursorOutline = document.querySelector(".cursor-outline");
    let posX = 0;
    let posY = 0;
    let outlineX = 0;
    let outlineY = 0;

    window.addEventListener("mousemove", (e) => {
        posX = e.clientX;
        posY = e.clientY;

        // Move o ponto central instantaneamente
        cursorDot.style.left = `${posX}px`;
        cursorDot.style.top = `${posY}px`;
    });

    function animateOutline() {
        outlineX += (posX - outlineX) * 0.2;
        outlineY += (posY - outlineY) * 0.2;
        cursorOutline.style.left = `${outlineX}px`;
        cursorOutline.style.top = `${outlineY}px`;
        requestAnimationFrame(animateOutline);
    }

    animateOutline();

    // Esconde a aura quando o mouse sai da janela
    window.addEventListener("mouseleave", () => {
        cursorDot.style.opacity = "0";
        cursorOutline.style.opacity = "0";
    });

    window.addEventListener("mouseenter", () => {
        cursorDot.style.opacity = "1";
        cursorOutline.style.opacity = "1";
    });

    document.addEventListener("visibilitychange", () => {
        const isHidden = document.visibilityState === "hidden";
        cursorDot.style.opacity = isHidden ? "0" : "1";
        cursorOutline.style.opacity = isHidden ? "0" : "1";
    });
</script>

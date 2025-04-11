document.addEventListener("DOMContentLoaded", function () {
    // Formulário de login
    const loginForm = document.getElementById("login-form");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");
    const loginError = document.getElementById("login-error");
    const togglePassword = document.getElementById("toggle-password");
    const requestAccess = document.getElementById("request-access");

    // Adicionar redirecionamento para a página de registro
    requestAccess.addEventListener("click", function (e) {
        e.preventDefault();
        window.location.href = "register";
    });

    // Inicializar tooltips
    const tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Mostrar/ocultar senha
    togglePassword.addEventListener("click", function (e) {
        e.preventDefault();

        const type =
            passwordInput.getAttribute("type") === "password"
                ? "text"
                : "password";
        passwordInput.setAttribute("type", type);

        // Atualizar tooltip
        const tooltip = bootstrap.Tooltip.getInstance(togglePassword);
        if (tooltip) {
            tooltip.dispose();
            new bootstrap.Tooltip(togglePassword);
        }
    });

    // Validar formulário
    loginForm.addEventListener("submit", function (e) {
        e.preventDefault();

        let isValid = true;

        // Validação simples de email
        if (!emailInput.value || !emailInput.value.includes("@")) {
            emailInput.classList.add("is-invalid");
            isValid = false;
        } else {
            emailInput.classList.remove("is-invalid");
        }

        // Validação simples de senha
        if (!passwordInput.value || passwordInput.value.length < 6) {
            passwordInput.classList.add("is-invalid");
            isValid = false;
        } else {
            passwordInput.classList.remove("is-invalid");
        }

        if (isValid) {
            // Em um ambiente real, aqui você faria uma requisição AJAX para autenticar
            simulateLogin(emailInput.value, passwordInput.value);
        }
    });

    // Simulação de login (em um ambiente real, isso seria uma chamada de API)
    function simulateLogin(email, password) {
        // Simulando um atraso de rede
        const submitBtn = loginForm.querySelector('button[type="submit"]');
        const originalBtnText = submitBtn.innerHTML;

        submitBtn.disabled = true;
        submitBtn.innerHTML =
            '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Entrando...';

        setTimeout(() => {
            // Aceitar qualquer email e senha válidos (para fins de demonstração)
            // Em um ambiente real, você faria uma verificação adequada no servidor
            if (
                email &&
                email.includes("@") &&
                password &&
                password.length >= 6
            ) {
                // Login bem-sucedido
                loginError.classList.add("d-none");
                window.location.href = "dashboard.html"; // Redirecionar para a página principal
            } else {
                // Login falhou
                loginError.classList.remove("d-none");
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            }
        }, 1000);
    }

    // Formulário de recuperação de senha
    const forgotPasswordForm = document.getElementById(
        "forgot-password-form"
    );
    if (forgotPasswordForm) {
        forgotPasswordForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const emailInput = this.querySelector('input[name="email"]');
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;

            // Simular envio
            submitBtn.disabled = true;
            submitBtn.innerHTML =
                '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Enviando...';

            setTimeout(() => {
                // Fechar modal
                const modal = bootstrap.Modal.getInstance(
                    document.getElementById("forgot-password-modal")
                );
                modal.hide();

                // Mostrar alerta de sucesso
                const alertHTML = `
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <div class="d-flex">
                            <div>
                                // Check Icon
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-check alert-icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                            </div>
                            <div>
                                <h4 class="alert-title">Email enviado!</h4>
                                <div>Verifique sua caixa de entrada para instruções de recuperação de senha.</div>
                            </div>
                        </div>
                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
                `;

                const alertContainer = document.createElement("div");
                alertContainer.innerHTML = alertHTML;
                document.querySelector(".container").prepend(alertContainer);

                // Restaurar botão
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;

                // Limpar campo
                emailInput.value = "";
            }, 1500);
        });
    }
});
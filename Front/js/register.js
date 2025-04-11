document.addEventListener('DOMContentLoaded', function() {
    // Elementos do formulário
    const registerForm = document.getElementById('register-form');
    const firstName = document.getElementById('first-name');
    const lastName = document.getElementById('last-name');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm-password');
    const terms = document.getElementById('terms');
    const registerError = document.getElementById('register-error');
    const errorMessage = document.getElementById('error-message');
    
    // Inicializar tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Função para alternar a visibilidade da senha
    function setupPasswordToggle(inputId, toggleId) {
        const input = document.getElementById(inputId);
        const toggle = document.getElementById(toggleId);
        
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            // Atualizar tooltip
            const tooltip = bootstrap.Tooltip.getInstance(toggle);
            if (tooltip) {
                tooltip.dispose();
                new bootstrap.Tooltip(toggle);
            }
        });
    }
    
    // Configurar toggles de senha
    setupPasswordToggle('password', 'toggle-password');
    setupPasswordToggle('confirm-password', 'toggle-confirm-password');

    // Validar email
    function isValidEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    // Evento de envio do formulário
    registerForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        let isValid = true;
        
        // Validar nome
        if (!firstName.value.trim()) {
            firstName.classList.add('is-invalid');
            isValid = false;
        } else {
            firstName.classList.remove('is-invalid');
        }
        
        // Validar sobrenome
        if (!lastName.value.trim()) {
            lastName.classList.add('is-invalid');
            isValid = false;
        } else {
            lastName.classList.remove('is-invalid');
        }
        
        // Validar email
        if (!email.value.trim() || !isValidEmail(email.value)) {
            email.classList.add('is-invalid');
            isValid = false;
        } else {
            email.classList.remove('is-invalid');
        }
        
        // Validar senha
        if (!password.value || password.value.length < 8) {
            password.classList.add('is-invalid');
            isValid = false;
        } else {
            password.classList.remove('is-invalid');
        }
        
        // Validar confirmação de senha
        if (confirmPassword.value !== password.value) {
            confirmPassword.classList.add('is-invalid');
            isValid = false;
        } else {
            confirmPassword.classList.remove('is-invalid');
        }
        
        // Validar termos
        if (!terms.checked) {
            terms.classList.add('is-invalid');
            isValid = false;
        } else {
            terms.classList.remove('is-invalid');
        }
        
        if (isValid) {
            // Simulação de envio para API
            simulateRegistration();
        }
    });
    
    // Simulação de registro
    function simulateRegistration() {
        // Obter o botão de submit
        const submitBtn = registerForm.querySelector('button[type="submit"]');
        const originalBtnText = submitBtn.innerHTML;
        
        // Desabilitar botão e mostrar spinner
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Processando...';
        
        // Simular chamada de API com timeout
        setTimeout(() => {
            // Verificar se o email já está em uso (simulação)
            if (email.value === 'admin@exemplo.com') {
                // Mostrar erro
                errorMessage.textContent = 'Este email já está em uso. Por favor, use outro email.';
                registerError.classList.remove('d-none');
                email.classList.add('is-invalid');
                
                // Restaurar botão
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            } else {
                // Sucesso - redirecionar para página principal
                registerError.classList.add('d-none');
                
                // Criar alerta de sucesso antes de redirecionar
                const alertHTML = `
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <div class="d-flex">
                            <div>
                                // Alert-Circle Icon
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-alert-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>
                            </div>
                            <div>
                                <h4 class="alert-title">Registro realizado com sucesso!</h4>
                                <div>Sua conta foi criada. Você será redirecionado para a página inicial em alguns segundos.</div>
                            </div>
                        </div>
                    </div>
                `;
                
                // Inserir alerta no topo do formulário
                const alertContainer = document.createElement('div');
                alertContainer.innerHTML = alertHTML;
                registerForm.insertBefore(alertContainer, registerForm.firstChild);
                
                // Desabilitar todos os campos do formulário
                const formElements = registerForm.elements;
                for (let i = 0; i < formElements.length; i++) {
                    formElements[i].disabled = true;
                }
                
                // Redirecionar após um tempo para a página index.html
                setTimeout(() => {
                    window.location.href = 'index.html';
                }, 3000);
            }
        }, 1500);
    }
});
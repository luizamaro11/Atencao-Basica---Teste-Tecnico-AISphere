/**
 * Password Strength — PrimaryCare
 *
 * Módulo reutilizável para:
 *  - Checklist de requisitos em tempo real
 *  - Barra de força visual (1–4 segmentos)
 *  - Toggle show/hide nos campos de senha
 *
 * Uso: initPasswordStrength({ inputId, hintsContainerId, barsContainerId })
 */

/**
 * Avalia a força de uma senha com base nas regras definidas no backend.
 * @param {string} password
 * @returns {{ score: number, rules: object }}
 */
function evaluatePassword(password) {
    const rules = {
        length:  password.length >= 8,
        upper:   /[A-Z]/.test(password),
        lower:   /[a-z]/.test(password),
        number:  /[0-9]/.test(password),
        symbol:  /[^A-Za-z0-9]/.test(password),
    };

    const score = Object.values(rules).filter(Boolean).length;
    return { score, rules };
}

/**
 * Atualiza a aparência de um item do checklist.
 * @param {HTMLElement} el
 * @param {boolean} valid
 */
function updateHint(el, valid) {
    if (!el) return;
    const icon = el.querySelector('.hint-icon');
    if (valid) {
        el.classList.remove('text-stone-400');
        el.classList.add('text-teal-600');
        if (icon) icon.textContent = '✓';
    } else {
        el.classList.remove('text-teal-600');
        el.classList.add('text-stone-400');
        if (icon) icon.textContent = '○';
    }
}

/**
 * Atualiza a barra de força com base no score.
 * @param {NodeList} bars
 * @param {number} score (0–5)
 */
function updateBars(bars, score) {
    const colorMap = {
        0: 'bg-stone-200',
        1: 'bg-rose-400',
        2: 'bg-orange-400',
        3: 'bg-yellow-400',
        4: 'bg-teal-400',
        5: 'bg-teal-500',
    };

    const activeColor = colorMap[score] || 'bg-stone-200';
    // 4 bars represent 4 "tiers": score ≤1 / ≤2 / ≤3 / ≤4,5
    const thresholds = [1, 2, 3, 5];

    bars.forEach((bar, index) => {
        bar.className = 'h-1.5 flex-1 rounded-full transition-all duration-300';
        if (score > thresholds[index] - 1) {
            bar.classList.add(activeColor);
        } else {
            bar.classList.add('bg-stone-200');
        }
    });
}

/**
 * Inicializa o indicador de força para um campo de senha.
 * @param {object} options
 * @param {string} options.inputId            - ID do <input type="password">
 * @param {string} [options.hintsId]          - ID do container dos hints (opcional)
 * @param {string} [options.barsId]           - ID do container das barras (opcional)
 * @param {string} [options.toggleBtnId]      - ID do botão show/hide (opcional)
 */
function initPasswordStrength({ inputId, hintsId, barsId, toggleBtnId }) {
    const input     = document.getElementById(inputId);
    const hintsEl   = hintsId   ? document.getElementById(hintsId)   : null;
    const barsEl    = barsId    ? document.getElementById(barsId)    : null;
    const toggleBtn = toggleBtnId ? document.getElementById(toggleBtnId) : null;

    if (!input) return;

    // — Show / Hide toggle —
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            const eyeOpen   = toggleBtn.querySelector('.eye-open');
            const eyeClosed = toggleBtn.querySelector('.eye-closed');
            if (eyeOpen)   eyeOpen.classList.toggle('hidden', !isHidden);
            if (eyeClosed) eyeClosed.classList.toggle('hidden', isHidden);
        });
    }

    // — Strength evaluation on input —
    input.addEventListener('input', function () {
        const { score, rules } = evaluatePassword(this.value);

        // Update checklist hints
        if (hintsEl) {
            updateHint(hintsEl.querySelector('#hint-length'), rules.length);
            updateHint(hintsEl.querySelector('#hint-upper'),  rules.upper && rules.lower);
            updateHint(hintsEl.querySelector('#hint-number'), rules.number);
            updateHint(hintsEl.querySelector('#hint-symbol'), rules.symbol);
        }

        // Update strength bars
        if (barsEl) {
            const bars = barsEl.querySelectorAll('[data-bar]');
            updateBars(bars, score);
        }
    });
}

export { initPasswordStrength, evaluatePassword };

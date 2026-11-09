document.querySelectorAll('.edit-toggle').forEach((button) => {
    button.addEventListener('click', () => {
        const row = button.closest('tr');
        const editing = button.dataset.editing === 'true';

        if (editing) {
            button.closest('form').requestSubmit();
            return;
        }

        row.querySelectorAll('input:not([type="hidden"])').forEach((input) => {
            input.readOnly = false;
        });
        row.querySelectorAll('select').forEach((select) => {
            select.disabled = false;
        });

        button.dataset.editing = 'true';
        button.textContent = 'Save';
    });
});
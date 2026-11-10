// Mengaktifkan pengeditan per baris dan mengirim form setelah tombol disimpan.
document.querySelectorAll('.edit-toggle').forEach((button) => {
    button.addEventListener('click', () => {
        const row = button.closest('tr');
        const editing = button.dataset.editing === 'true';

        // Klik kedua menyimpan nilai yang sudah diedit melalui form baris.
        if (editing) {
            button.closest('form').requestSubmit();
            return;
        }

        // Input awalnya terkunci agar perubahan hanya terjadi setelah Update dipilih.
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
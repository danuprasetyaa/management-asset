function openTagihanModal() {
    const modal = document.getElementById('modaltagihan');
    if (modal) {
      modal.classList.add('active');
    }
  }

function closeTagihanModal() {
    const modal = document.getElementById('modaltagihan');
    if (modal) {
      modal.classList.remove('active');
    }
  }
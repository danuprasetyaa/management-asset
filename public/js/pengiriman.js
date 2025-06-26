function openPengirimanModal() {
    const modal = document.getElementById('modalpengiriman');
    if (modal) {
      modal.classList.add('active');
    }
  }

function closePengirimanModal() {
    const modal = document.getElementById('modalpengiriman');
    if (modal) {
      modal.classList.remove('active');
    }
  }
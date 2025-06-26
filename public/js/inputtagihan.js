function openModalTagihan() {
const modal = document.getElementById('modalBuatTagihan');
    if (modal) {
      modal.classList.add('active');
    }
  }

function closeModalTagihan() {
    const modal = document.getElementById('modalBuatTagihan');
    if (modal) {
      modal.classList.remove('active');
    }
  }


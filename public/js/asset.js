//Modal addAsset
toggleButton.addEventListener('click', () => {
    sidebar.classList.toggle('active');
});

menuHome.forEach ( item =>{
    item.addEventListener('click', () => {
        sidebar.classList.remove('active');
    });
});
    
  function openModal() {
    document.getElementById('modalAddAsset').classList.add('active');
  }

  function closeModal() {
    document.getElementById('modalAddAsset').classList.remove('active');
  }

// Table
$(document).ready(function () {
    $('#dataTable').DataTable();
});


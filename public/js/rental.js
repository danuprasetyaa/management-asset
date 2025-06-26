//Modal Rental
toggleButton.addEventListener('click', () => {
    sidebar.classList.toggle('active');
});

menuHome.forEach ( item =>{
    item.addEventListener('click', () => {
        sidebar.classList.remove('active');
    });
});
    
  function openModal() {
    document.getElementById('modalAddProject').classList.add('active');
  }

  function closeModal() {
    document.getElementById('modalAddProject').classList.remove('active');
  }
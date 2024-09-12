function markAsComplete(button) {
    // Vind de rij waar de knop zich bevindt
    var row = button.closest('tr');
    
    // Zoek de cel met de status (hier is het de 4e kolom dus index 3)
    var statusCell = row.querySelector('.status');
    
    // Verander de tekst naar "Gereed"
    statusCell.textContent = 'Gereed';
  }
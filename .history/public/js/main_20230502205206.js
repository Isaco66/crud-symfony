setTimeout(function() {
    var alert = document.querySelector('.alert');
    if (alert) {
      alert.parentNode.removeChild(alert);
    }
  }, 5000);
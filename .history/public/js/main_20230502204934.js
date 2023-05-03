document.addEventListener('DOMContentLoaded', () => {
    const alertEl = document.querySelector('.alert');
    if (alertEl) {
      alertEl.addEventListener('closed.bs.alert', () => {
        setTimeout(() => {
          alertEl.remove();
        }, 200);
      });
    }
  });
const showToast = (
  type,
  message,
  icon = 'ion-alert-circled',
  duration = 5000
) => {
  let toast = document.createElement('div');
  const toasts = $('#toasts');
  toast.classList.add('toast', type);
  let timeOutId = setTimeout(() => {
    toasts.removeChild(toast);
  }, duration);
  toast.onclick = function (e) {
    if (e.target.closest('.btn-toast')) {
      toasts.removeChild(toast);
      clearTimeout(timeOutId);
    }
  };
  toast.innerHTML = `
  <div class="icon-toast">
    <i class="${icon}"></i>
  </div>
  <div class="message-toast">${message}</div>
  <div class="btn-toast">
    <i class="ion-ios-close"></i>
  </div>
  `;
  toasts.appendChild(toast);
};

const _icon = {
  success: 'ion-ios-checkmark',
  warning: 'ion-alert',
  error: 'ion-alert-circled',
};
const showToast = (
  type,
  message,
  duration = 99999999,
  bgColor = null,
  textColor = null
) => {
  let icon = _icon[`${type}`];
  alert(_icon);
  let toast = document.createElement('div');
  const toasts = $('#toasts');
  toast.classList.add('toast', type);
  toast.style.backgroundColor = bgColor;
  toast.style.color = textColor;
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

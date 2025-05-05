const buttonEditName = document.getElementById('edit-name');
const buttonEditPassword = document.getElementById('edit-password');
const buttonDeleteAccount = document.getElementById('delete-account');

const formEditName = document.getElementById('form-edit-name');
const formEditPassword = document.getElementById('form-edit-password');
const formDeleteAccount = document.getElementById('form-delete-account');

buttonEditName.addEventListener('click', () => {
  toggleForm(formEditName);
});

buttonEditPassword.addEventListener('click', () => {
  toggleForm(formEditPassword);
});

buttonDeleteAccount.addEventListener('click', () => {
  toggleForm(formDeleteAccount);
});

let currentlyOpen = null;

function toggleForm(formElement) {
    
  if (currentlyOpen && currentlyOpen !== formElement) {
    currentlyOpen.hidden = true;
  }
  if (!formElement.hidden) {
    formElement.hidden = true;
    currentlyOpen = null;
  } else {
    formElement.hidden = false;
    currentlyOpen = formElement;
  }
}

import FormSubmit from './formSubmit.js';
import ProfileImageHandler from './ProfileImageHandler.js';
import OpenModal from './openModalCustom.js';
import './passwordToggle.js';

document.addEventListener('DOMContentLoaded', () => {
    FormSubmit.init();
    ProfileImageHandler.initAll();
    OpenModal.init();
});

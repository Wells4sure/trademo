
try {
    window.$ = window.jQuery = require('jquery');

} catch (e) {
    console.log(e)
}
window._ = require('lodash');

window.$ =window.jQuery =require('jquery');

window.izitoast = require('izitoast');
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
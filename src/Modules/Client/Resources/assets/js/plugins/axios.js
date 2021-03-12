import axios from 'axios'
import store from '../store'
import Swal from 'sweetalert2'

// Request interceptor
axios.interceptors.request.use(request => {
    Fire.$emit('showLoader');

    const locale = store.getters['lang/locale']
    if (locale) {
        request.headers.common['Accept-Language'] = locale
    }

    return request
})

// Response interceptor
axios.interceptors.response.use(response => {
    Fire.$emit('hideLoader');
    return response
}, error => {
    const { status } = error.response

    if (status >= 500) {
        Swal.fire({
            type: 'error',
            title: 'Error 500',
            reverseButtons: true,
            confirmButtonText: this.$t('ok'),
            cancelButtonText: this.$t('cancel')
        })
    }

    Fire.$emit('hideLoader');

    return Promise.reject(error)
})

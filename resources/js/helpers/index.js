import Swal from 'sweetalert2/dist/sweetalert2.js'

/**
 * Fetch data from an api.
 *
 * Note: Move to an api file if there are multiples uses.
 *
 * @param {string} api
 * @param callback callback
 */
export const fetchData = (api, callback) => {
    axios.get(api).then(response => {

        callback(response.data, null)

    }).catch(error => {

        callback(null, error)

    })
}

/**
 * @param closure
 */
export const passwordVerification = (closure) => {
    Swal.fire({
        title: 'Password Authorization',
        input: 'password',
        inputAttributes: {
            autocapitalize: 'off',
            name: 'password'
        },
        showCancelButton: true,
        confirmButtonText: 'Authorize',
        showLoaderOnConfirm: true,
        preConfirm: (password) => {
            return axios.post(`/password-check`, {password: password}).then(response => {
                return response.data
            }).catch(error => {
                Swal.showValidationMessage(
                    error.response.data.errors.password
                )
            })
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        closure(result)
    })
}

export default { fetchData, passwordVerification }

import axios from 'axios'
import Cookies from 'js-cookie'
// Create axios instance
const service = axios.create({
  baseURL: process.env.VUE_APP_BASE_API,
  timeout: 1000000 // Request timeout
})

// Request intercepter
service.interceptors.request.use(
  config => {
    // const token = isLogged();
    // if (token) {
    //   config.headers['Authorization'] = 'Bearer ' + isLogged(); // Set JWT token
    // }
    // config.headers['Access-Control-Allow-Origin'] = '*'
    // config.headers['Access-Control-Allow-Methods'] = 'POST, GET, OPTIONS'3
    const token = Cookies.get('app-Token')
    if (token) {
      if (!config.params) {
        config.params = {};
      }
      config.params.access_token = token
    }
    return config
  },
  error => {
    // Do something with request error
    // console.log(error); // for debug

    Promise.reject(error)
  }
)

// response pre-processing
service.interceptors.response.use(
  response => {
    // if (response.headers.authorization) {
    //   setLogged(response.headers.authorization);
    //   response.data.token = response.headers.authorization;
    // }

    return response.data
  },
  error => {
    let message = error.message
    if (error.response.data && error.response.data.errors) {
      message = error.response.data.errors
    } else if (error.response.data && error.response.data.error) {
      message = error.response.data.error
    }
    if (message === 'CSRF token mismatch.') {
      window.location.href = '/'
    }
    return Promise.reject(error)
  }
)

export default service

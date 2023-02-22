import request from '@/utils/request'

export function login(data) {
  return request({
    url: '/login/auth',
    method: 'POST',
    withCredentials: false,
    data: data
  })
}

export function getInfo(token, id) {
  return request({
    url: '/users/GetUserInfos',
    method: 'GET',
    params: { access_token: token, id: id }
  })
}
export function getListUser(data) {
  return request({
    url: '/users/GetUsers',
    method: 'GET',
    params: data
  })
}
// access_token
// username	string
// password	string
// fullname	string
// location	int
export function addUser(data) {
  return request({
    url: '/users/AddUser',
    method: 'POST',
    params: data
  })
}

// access_token
// id	int
// fullname	string
// location	int
export function updateUser(data) {
  return request({
    url: '/users/UpdateUser',
    method: 'put',
    params: data
  })
}

// access_token
// id	int
export function disableUser(token, id) {
  return request({
    url: '/users/DisableUser',
    method: 'POST',
    params: { access_token: token, id: id }
  })
}

// access_token
// id	int
export function enableUser(token, id) {
  return request({
    url: '/users/EnableUser',
    method: 'POST',
    params: { access_token: token, id: id }
  })
}

// access_token
// new_password	string
// old_password	string
export function changePassword(data) {
  return request({
    url: '/users/ChangePassword',
    method: 'POST',
    params: data
  })
}

// access_token
// id int
export function ressetPassword(token, id) {
  return request({
    url: '/users/RessetPassword',
    method: 'POST',
    params: { access_token: token, id: id }
  })
}

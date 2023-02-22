import request from '@/utils/request'

export const ServerTypes = {
  STORAGE: "Storage",
  RECORING: "Recording",
  ANALYZING: "Analyzing",
  TRAFFIC: "Traffic",
  AI: "AI",
  FACE: "Face",
}

// access_token
export function getServers(params) {
  return request({
    url: '/servers/GetServers',
    method: 'get',
    params: params
  })
}

// access_token
// name	string
// mac_address	string
export function addServer(params, data) {
  return request({
    url: '/servers/AddServer',
    method: 'post',
    params: params,
    data
  })
}

// access_token
// id	int
// name	string
// mac_address	string
export function updateServer(params, data) {
  return request({
    url: '/servers/UpdateServer',
    method: 'put',
    params: params,
    data
  })
}

// access_token
// id	int
export function deleteServer(params, data) {
  return request({
    url: '/servers/DeleteServer',
    method: 'put',
    params: params,
    data
  })
}

// access_token
// id	int
export function recordingConfig(params, data) {
  return request({
    url: '/servers/RecordingConfig',
    method: 'post',
    params: params,
    data
  })
}
// access_token
export function statistics(params) {
  return request({
    url: '/Statistics/Overview',
    method: 'GET',
    params: params
  })
}

import request from '@/utils/request';

export function fetchInfo(query) {
  return request({
    url: 'dashboard/get-info',
    method: 'get',
    params: query,
  });
}

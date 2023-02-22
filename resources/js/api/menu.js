import request from '@/utils/request';
import Resource from '@/api/resource';

class MenuResource extends Resource {
  constructor() {
    super('menu');
  }
  search(query) {
    return request({
      url: '/' + this.uri + '/search',
      method: 'get',
      params: query,
    });
  }
  destroyByDate(query) {
    return request({
      url: '/' + this.uri + '/delete',
      method: 'get',
      params: query,
    });
  }
}
export { MenuResource as default };

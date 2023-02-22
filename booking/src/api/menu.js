import request from '@/utils/request';
import Resource from '@/api/resource';

class MenuResource extends Resource {
  constructor() {
    super('menus');
  }
  list(query) {
    return request({
      url: '/' + this.uri + '/search',
      method: 'get',
      params: query,
    });
  }
}
export { MenuResource as default };

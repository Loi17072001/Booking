import request from '@/utils/request';
import Resource from '@/api/resource';

class GroupResource extends Resource {
  constructor() {
    super('group');
  }
  search(query) {
    return request({
      url: '/' + this.uri + '/search',
      method: 'get',
      params: query,
    });
  }
}
export { GroupResource as default };

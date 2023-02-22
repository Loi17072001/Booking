import request from '@/utils/request';
import Resource from '@/api/resource';

class ProductResource extends Resource {
  constructor() {
    super('products');
  }
  search(query) {
    return request({
      url: '/' + this.uri + '/search',
      method: 'get',
      params: query,
    });
  }
}
export { ProductResource as default };

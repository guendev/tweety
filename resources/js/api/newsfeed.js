import request from '../utils/request';

export function ApiGetNewsFeeds(params) {
    return request({
        url: '/getmore',
        method: 'post',
        params: params,
    });
}

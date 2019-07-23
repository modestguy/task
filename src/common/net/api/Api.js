import axios from 'axios';
import * as Config from '../../../config/Config';

const headers = {'Content-type': 'application/json'};

export function fetchApi(method = 'GET', url, data, params, successFunc, errorFunc) {
    axios({
        method: method,
        url: Config.api.basePath + url,
        data: data,
        params: params,
        headers: headers
    }).then(function(response) {
        successFunc(response.data)
    }, (error) => {
        errorFunc( error )
    });
}
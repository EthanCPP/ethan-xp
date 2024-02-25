import axios from "axios";

export default class Api {

    constructor() {
    }

    async sendRequest(endpoint, data = null) {
        const response = await axios({
            method: 'get',
            url: '/api/' + endpoint,
            params: data,
        });

        return response.data;
    }

    async getFilesAtLocation(location = '') {
        return await this.sendRequest('files/location/' + location);
    }

    async getFilesInFolder(id) {
        return await this.sendRequest('files/folder/' + id);
    }
}
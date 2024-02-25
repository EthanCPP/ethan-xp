import axios from "axios";

export default class Api {

    constructor() {
    }

    async sendRequest(endpoint, data = null, method = 'get') {
        const response = await axios({
            method,
            url: '/api/' + endpoint,
            data: data,
        });

        return response.data;
    }

    async getFilesAtLocation(location = '') {
        return await this.sendRequest('files/location/' + location);
    }

    async getFilesInFolder(id) {
        return await this.sendRequest('files/folder/' + id);
    }

    async getCsrfToken() {
        return await this.sendRequest('token');
    }

    async sendEmail(data) {
        return await this.sendRequest('send-email', data, 'post');
    }
}
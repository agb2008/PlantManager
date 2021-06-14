import * as API from "@/services/API";

export default {
  getSeedsList() {
    return API.apiClient.get(`/seeds`);
  },
  postSeedPack(payload) {
    return API.apiClient.post(`/seeds`, payload.newPack);
  },
  changeData(api, id, payload) {
    console.log(payload);
    return API.apiClient.patch(`${api}/${id}`, payload);
  },
  deleteData(api, id) {
    return API.apiClient.delete(`${api}/${id}`);
  },
  getSeedlingsList() {
    return API.apiClient.get(`/seedling`);
  },
}; 

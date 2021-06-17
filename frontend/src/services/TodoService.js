import * as API from "@/services/API";

export default {
  getData(api) {
    return API.apiClient.get(api);
  },
  changeData(api, id, payload) {
    console.log(payload);
    return API.apiClient.patch(`${api}/${id}`, payload);
  },
  deleteData(api, id) {
    return API.apiClient.delete(`${api}/${id}`);
  }
}
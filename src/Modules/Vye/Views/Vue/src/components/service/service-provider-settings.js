import axios from "axios";

const viteEnvBackAppServer = import.meta.env.VITE_BACK_APP_SERVER;

export async function getClassesByCommand(params) {
    const response = await axios.get(`${viteEnvBackAppServer}/api/v1/volcator/setting/search-setting`, { params });
    return response.data;
}

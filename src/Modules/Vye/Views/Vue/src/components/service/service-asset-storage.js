import axios from "axios";

const viteEnvBackStorageServer = import.meta.env.VITE_BACK_STORAGE_SERVER;

export async function uploadImage(countryIsoCode, module, params) {
    const formData = new FormData();
    formData.append('file', params.file);

    const response = await axios.post(`${viteEnvBackStorageServer}/api/asset-command/assets/add-asset/${countryIsoCode}/${module}`, formData, {
        headers: {
            'Content-Type': 'multipart/form-data',
        },
    });
    return response.data;
}

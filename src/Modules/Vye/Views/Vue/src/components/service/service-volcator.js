import axios from "axios";

const viteEnvBackAppServer = import.meta.env.VITE_BACK_APP_SERVER;
const viteEnvVersion = import.meta.env.VITE_VERSION;
const baseURI = 'volcator/application';

/**
 * Vye Api Volcator Core (Laravel)
 */
const viteEnvBackVyeServer = import.meta.env.VITE_BACK_VYE_SERVER;
const viteEnvPrefix = localStorage.getItem("prefix");

/**
 * @param refSpaceApplication
 * @returns {Promise<T>}
 */
export async function recentApplicationsByPrefix(prefix) {
    return await axios.get(`${viteEnvBackAppServer}/api/${viteEnvVersion}/${baseURI}/recent/` + prefix);
}

/**
 * @param refSpaceApplication
 * @returns {Promise<T>}
 */
export async function checkApplicationExist(refSpaceApplication) {
    return await axios.get(`${viteEnvBackAppServer}/api/${viteEnvVersion}/${baseURI}/check/` + refSpaceApplication);
}

/**
 * @param applicationRequestCommand
 * @param refSpaceApplication
 * @returns {Promise<T>}
 */
export async function addPageOfApplication(applicationRequestCommand, refSpaceApplication) {
    try {
        const response = await axios.post(`${viteEnvBackAppServer}/api/${viteEnvVersion}/${baseURI}/add-page/` + refSpaceApplication, applicationRequestCommand);
        return response;
    } catch (error) {
        console.error("Error while making the request:", error);
        throw error; // Rethrow the error to handle it at the calling site
    }
}

/**
 * @param refSpaceApplication
 * @returns {Promise<T>}
 */
export async function getPagesOfApplication(refSpaceApplication) {
    const response = await axios.get(`${viteEnvBackAppServer}/api/${viteEnvVersion}/${baseURI}/pages/`+refSpaceApplication );
    return response.data;
}

/**
 * @param refSpaceApplication
 * @param pageId
 * @returns {Promise<T>}
 */
export async function getOnePageApplication(refSpaceApplication, pageId) {
    const response = await axios.get(`${viteEnvBackAppServer}/api/${viteEnvVersion}/${baseURI}/page/`+refSpaceApplication+`/`+pageId);
    return response.data;
}

/**
 * @param applicationRequestCommand
 * @returns {Promise<T>}
 */
export async function editPageApplication(applicationRequestCommand) {
    const response = await axios.put(`${viteEnvBackAppServer}/api/${viteEnvVersion}/${baseURI}/edit`, applicationRequestCommand);
    return response.data;
}

/**
 * @param application
 * @returns {Promise<T>}
 */
export async function deleteApplication(application) {
    const response = await axios.delete(`${viteEnvBackAppServer}/api/${viteEnvVersion}/${baseURI}/delete/`+application);
    return response.data;
}

/**
 * This webservice built by Volcator Core - Laravel APi
 * Invoke Vye Module to Assign application (_id of application side volcator-ui-provider to volcator core)
 * @returns {Promise<T>}
 * @param application_vye_id
 */
export async function assignApplicationToVyeCurrentApplication(application_vye_id) {
    const token = window.localStorage.getItem("access_token");
    const current_application_core_id = window.localStorage.getItem("current_application_core");
    const headers = {
        'Authorization': `Bearer ${token}`
    };

    try {
        const response = await axios.get(viteEnvBackVyeServer+`/${viteEnvPrefix}/vye/application/${current_application_core_id}/${application_vye_id}`, {headers} );
        return response.data;
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

import { retrieveDataFromLocalStorage } from "../helpers";
export const userInitialState = {
    isLoggedIn: false,
    id: null,
    ...retrieveDataFromLocalStorage("user")
};